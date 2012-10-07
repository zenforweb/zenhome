import pika
import json
from modules.yahoostockwatch import yahoostockwatch
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
    routing_key='run.yahoowtockwatch.daily'
)
def callback(ch, method, properties, body):
    message_obj = json.loads(body)
    try:
        return_method = message_obj['return_type']
    except KeyError, e:
        print "FAIL - no type mentioned"
        return False
    try:
        stock = message_obj['stock_id']
    except KeyError, e:
        print "FAIL - no stock symbol mentioned"
        return False
    sw = yahoostockwatch.YahooStockWatch()
    daily_info = sw.get_daily_stats(stock)

    if return_method == 'save':
        #dbcont = db_controller.DBController()
        #dbconn, dbcurs = dbcont.getLocal()
        insert_sql = "INSERT INTO zenhome.apps_yahoostockwatch_stock_daily (`stat_date`,`stock_id`,`open`,`previous_close`,`52week_high`,`52week_low`,`market_cap`) VALUES (%(stat_date)s,%(stock_id)s,%(open_num)s,%(previous_close)s,%(52week_high)s,%(52week_low)s,%(market_cap)s,)"
        print insert_sql % daily_info
        #dbcurs.execute(insert_sql%current_weather)
        #dbconn.commit()
        #dbconn.close()
    ch.basic_ack(delivery_tag = method.delivery_tag)
channel.basic_consume(
    callback, 
    queue=queue_name, 
    no_ack=False
)
channel.start_consuming()
