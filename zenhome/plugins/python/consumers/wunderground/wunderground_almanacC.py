import pika
import json
from datetime import datetime
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
    routing_key='run.wunderground.almanac'
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
    daily_almanac = wunder.get_daily_almanac(wunder_state,wunder_city)
    daily_almanac['stat_date']=datetime.now().strftime('%y-%m-%d')
    if return_method == 'return':
        try:
            return_route = message_obj['return_route']
        except KeyError, e:
            print "FAIL - no return route set but requesting return not log"
        #do rabbitmq publish here
    elif return_method == 'save':
        dbcont = db_controller.DBController()
        dbconn, dbcurs = dbcont.getLocal()
        insert_sql = """INSERT INTO zenhome.apps_wunderground_almanac (stat_date,record_high_f,record_high_c,normal_high_c,normal_high_f,normal_low_f,normal_low_c,record_low_c,record_low_f,record_high_year,record_low_year) VALUES ('%(stat_date)s','%(record_high_f)s','%(record_high_c)s','%(normal_high_c)s','%(normal_high_f)s','%(normal_low_f)s','%(normal_low_c)s','%(record_low_c)s','%(record_low_f)s','%(record_low_year)s','%(record_high_year)s')"""
        print insert_sql
        #dbcurs.execute(insert_sql%daily_almanac)
        #dbconn.commit()
        #dbconn.close()
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
