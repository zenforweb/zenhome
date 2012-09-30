import sys
import pika
if __name__=='__main__':
    if len(sys.argv) == 3:
        state = sys.argv[1]
        city = sys.argv[2]
    else:
        print """RUN like wu_produce_request.py *state* *city*"""
        sys.exit(0)
    connection = pika.BlockingConnection(pika.ConnectionParameters(host='10.1.10.52'))
    channel = connection.channel()
    channel.exchange_declare(
        exchange='apps',
        type='topic'
        )

    routing_key = 'run.wunderground'
    message = '{"return_type":"save","state":"%(state)s","city":"%(city)s"}' % {'state':state,'city':city}

    channel.basic_publish(
        exchange='apps',
        routing_key=routing_key,
        body=message
        )




