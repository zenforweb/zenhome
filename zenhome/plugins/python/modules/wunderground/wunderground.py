import urllib2
import json

class WUnderground(object):
    def __init__(self,api_key):
        self.api_key = api_key
        self.xlate_wind_dir = {'east':'E',
                               'west':'W',
                               'north':'N',
                               'south':'S'
                               }
    def get_current_weather(self,state,city):
        res = urllib2.urlopen('http://api.wunderground.com/api/%(api_key)s/conditions/q/%(state)s/%(city)s.json'%{'api_key':self.api_key,'state':state,'city':city}).read()
        w_xml = json.loads(res)
        w_xml = w_xml['current_observation']
        return_dict = {
            'heat_index_f':w_xml['heat_index_f'],
            'heat_index_c':w_xml['heat_index_c'],
            'local_timezone':w_xml['local_tz_long'],
            'obs_elevation':w_xml['observation_location']['elevation'],
            'obs_city':w_xml['observation_location']['city'],
            'obs_latitude':w_xml['observation_location']['latitude'],
            'obs_longitude':w_xml['observation_location']['longitude'],
            'weather':w_xml['weather'],
            'temp_f':w_xml['temp_f'],
            'temp_c':w_xml['temp_c'],
            'windchill_f':w_xml['windchill_f'],
            'windchill_c':w_xml['windchill_c'],
            'rel_humidity':str(w_xml['relative_humidity']).replace('%',''),
            'wind_direction':self.xlate_wind_dir.get(w_xml['wind_dir'].lower(),w_xml['wind_dir'].upper()),
            'wind_desc':w_xml['wind_string'],
            'wind_mph':w_xml['wind_mph'],
            'wind_degrees':w_xml['wind_degrees'],
            'pressure_in':w_xml['pressure_in'],
            'pressure_trend':w_xml['pressure_trend'],
            'solar_radiation':w_xml['solarradiation'],
            'dewpoint_f':w_xml['dewpoint_f'],
            'dewpoint_c':w_xml['dewpoint_c'],
            'feelslike_f':w_xml['feelslike_f'],
            'feelslike_c':w_xml['feelslike_c'],
            'station_id':w_xml['station_id'],
            'visibility_mi':w_xml['visibility_mi'],
            'uv':w_xml['UV']
            }
        return return_dict
