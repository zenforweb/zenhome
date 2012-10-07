import MySQLdb
import sys
import string
import json
class DBController(object):
    def __init__(self):
        self.default_db = 'production'
        #self.config = self.load_json_config()
#    def load_json_config(self):
#        config_data = open('../../../../db_config.json','r')
#        config=json.load(config_data)
#        print config
#        config_data.close()
#        return config
    def getdb(self,**kwargs):
        conn = None
        retry = 0
        while not conn and retry < 5:
            try:
                conn = MySQLdb.connect(**kwargs)
            except MySQLdb.OperationalError, e:
                print "Problem connecting:",str(e)
                retry += 1
                time.sleep(15*retry)
        if not conn:
            print "Could not establish connection to db, abort"
            sys.exit(-1)
        cur = conn.cursor()
        return conn, cur

    def getLocal(self):
        return self.getdb(host='localhost',user='dbadmin',passwd='Z3n4W38')

