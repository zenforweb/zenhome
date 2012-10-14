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
    routing_key='run.wunderground.daily'
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
    current_weather = wunder.get_current_weather(wunder_state,wunder_city)
    if return_method == 'return':
        try:
            return_route = message_obj['return_route']
        except KeyError, e:
            print "FAIL - no return route set but requesting return not log"
        #do rabbitmq publish here
    elif return_method == 'save':
        dbcont = db_controller.DBController()
        dbconn, dbcurs = dbcont.getLocal()
        insert_sql = """INSERT INTO zenhome.apps_wunderground_data (local_timezone,heat_index_c,heat_index_f,weather,wind_direction,windchill_c,windchill_f, obs_city,obs_elevation,obs_latitude,obs_longitude,dewpoint_f,dewpoint_c,feelslike_c,feelslike_f,temp_f,temp_c,uv,wind_mph,solar_radiation,station_id,pressure_trend,visibility_mi,pressure_in,wind_degrees,rel_humidity,wind_desc) VALUES ('%(local_timezone)s','%(heat_index_c)s','%(heat_index_f)s','%(weather)s','%(wind_direction)s','%(windchill_c)s','%(windchill_f)s','%(obs_city)s','%(obs_elevation)s','%(obs_latitude)s','%(obs_longitude)s','%(dewpoint_f)s','%(dewpoint_c)s','%(feelslike_c)s','%(feelslike_f)s','%(temp_f)s','%(temp_c)s','%(uv)s','%(wind_mph)s','%(solar_radiation)s','%(station_id)s','%(pressure_trend)s','%(visibility_mi)s','%(pressure_in)s','%(wind_degrees)s','%(rel_humidity)s','%(wind_desc)s')"""
        dbcurs.execute(insert_sql%current_weather)
        dbconn.commit()
        dbconn.close()
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
