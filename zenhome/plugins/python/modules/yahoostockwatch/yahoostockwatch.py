import urllib2
import csv
from datetime import datetime 
from modules.db_controller import db_controller

#stock symbol -s
#last trade price - l1
#last trade volume - k3
#last trade date - d1
#day open - o
#previous_close - p
#volume - v
#rang = m

class YahooStockWatch(object):
    def __init__(self):
        self.current_user = 0

    def xlate_market_cap(self,val):
        if str(val).lower().find('M') > 0:
            full_mil = val.split('.')[0]
            sec_vals = val.split('.')[1][:-1]
            n_mil = '000000'
            u_mil = n_mil[len(sec_vals):]
            return int(full_mil+sec_vals+u_mil)
        elif str(val).lower().find('B') > 0:
            full_mil = val.split('.')[0]
            sec_vals = val.split('.')[1][:-1]
            n_mil = '000000000'
            u_mil = n_mil[len(sec_vals):]
            return int(full_mil+sec_vals+u_mil)            
        else:
            return False
            
    def get_stats_for_symbol(self,ticker_id,f_options):
        stock_data = urllib2.urlopen("http://finance.yahoo.com/d/quotes.csv?s=%s&f=%s"%(ticker_id,f_options)).read()
        stock_csvreader = csv.reader([stock_data])
        stock_dict = {}
        for stock_obj in stock_csvreader:
            print stock_obj

    def get_daily_stats(self,stock_id):
        
        dbcont = db_controller.DBController()
        dbconn, dbcurs = dbcont.getLocal()
        a = dbcurs.execute('SELECT stock_symbol FROM zenhome.apps_yahoostockwatch_stock_info WHERE stock_id = %s'%stock_id)
        if a > 0:
            stock_sym = dbcurs.fetchall()[0][0]
            #['4.64', '4.64', '1.92 - 7.41', '1.92 - 7.41', '115.0M']
        else:
            print "No Stock matching this ID."
            return False
        return_data = {}
        return_data['stock_id'] = stock_id
        return_data['stat_date'] = datetime.now().strftime('%Y-%m-%d')

        #stock_sym = get from db
        #open_num = o
        #previous_close = p
        #52week_high = w
        #52week_low = w
        #mareket_cap = j1
        stock_data = urllib2.urlopen("http://finance.yahoo.com/d/quotes.csv?s=%s&f=opwj1"%stock_sym).read()
        stock_csvreader = csv.reader([stock_data])
        for stock in stock_csvreader:
            return_data['open_num'] = float(stock[0])
            return_data['previous_close'] = float(stock[1])
            return_data['52week_high'] = float(stock[2].split('-')[0].strip())
            return_data['52week_low'] = float(stock[2].split('-')[1].strip())
            return_data['market_cap'] = self.xlate_market_cap(stock[3])
        return return_data

    def get_stats_for_user(self,user_id):
        dbcont = db_controller.DBController()
        dbconn, dbcurs = dbcont.getLocal()
