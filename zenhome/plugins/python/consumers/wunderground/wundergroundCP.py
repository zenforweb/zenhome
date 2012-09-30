import pika
import json
from modules.wunderground import wunderground
from modules.db_controller import db_controller
connection = pika.BlockingConnection(pika.ConnectionParameters(host='10.1.10.52'))
channel = connection.channel()
channel.exchange_declare(
    exchange='apps',
    type='topic'
)

result = channel.queue_declare(exclusive=True)
queue_name = result.method.queue

channel.queue_bind(
    exchange='apps',
    queue=queue_name,
    routing_key='run.wunderground'
)

def callback(ch, method, properties, body):
    message_obj = json.loads(body)
    try:
        return_method = message_obj['return_type']
    except KeyError, e:
        print "FAIL - no type mentioned"
        return False
    try:
        wunder_api = message_obj['api_key']
    except KeyError, e:
        wunder_api = 'ca98e472d4f8d395' #this is chris' api key for tests or whatever
    try:
        wunder_state = message_obj['state']
    except KeyError, e:
        wunder_state = 'CO' #defaulting to this
    try:
        wunder_city = message_obj['city']
    except KeyError, e:
        wunder_city = 'Golden'
    wunder = wunderground.WUnderground(wunder_api)
    print wunder
    current_weather = wunder.get_current_weather(wunder_state,wunder_city)
    print current_weather
    if return_method == 'return':
        try:
            return_route = message_obj['return_route']
        except KeyError, e:
            print "FAIL - no return route set but requesting return not log"
        #do rabbitmq publish here
    elif return_method == 'save':
        dbcont = db_controller.DBController()
        dbconn, dbcurs = dbcont.getLocal()
        save_sql = "INSERT INTO zenhome.apps_wunderground_data (temp_f,temp_c,wind_direction,wind_mph,condition_summary,pressure_trend,rel_humidity,pressure_in,obs_lat,obs_lon) VALUES (%(temp_f)s,%(temp_c)s,%(wind_direction)s,%(wind_mph)s,%(condition_summary)s,%(pressure_trend)s,%(rel_humidity)s,%(pressure_in)s,%(obs_lat)s,%(obs_lon)s)"
        save_sql = save_sql % {'temp_f':current_weather['temp_f'],
                               'temp_c':current_weather['temp_c'],
                               'wind_direction':current_weather['wind_direction'],
                               'wind_mph':current_weather['wind_mph'],
                               'condition_summary':current_weather['weather'],
                               'pressure_trend':current_weather['pressure_trend'],
                               'rel_humidity':current_weather['rel_humidity'],
                               'pressure_in':current_weather['pressure_in'],
                               'obs_lat':current_weather['obs_latitude'],
                               'obs_lon':current_weather['obs_longitude']
                               }
        print save_sql
#        print current_weather
#        print save_sql
        

        
    ch.basic_ack(delivery_tag = method.delivery_tag)
#    channel.exchange_declare(
#        exchange='session_traffic',
#        type='topic'
#    )
#    routing_key = 'session.123'
#    message = 'Hello World! x2'
#
#    channel.basic_publish(
#        exchange='session_traffic',
#        routing_key=routing_key,
#        body=message
#    )
#    print " [x] Received %r:%r" % (method.routing_key, body,)
#    print " [x] Sent %r:%r" % (routing_key, message)
 

channel.basic_consume(
    callback, 
    queue=queue_name, 
    no_ack=False
)
channel.start_consuming()
