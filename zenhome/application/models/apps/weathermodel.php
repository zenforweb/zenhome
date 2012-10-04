<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WeatherModel extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function getLastPoll(){
		$query = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`apps_wunderground_data` ORDER BY `stat_ts` DESC LIMIT 1" );
		return $query->row();
	}

	public function getToday(){
		$yesterday = date( 'Y-m-d G:i', strtotime( '-1 days') );
		
		//$date = strtotime( '-1 days', time() );		
		//$this->query()
		//select * from apps_wunderground_data where `stat_ts` > '2012-10-01 8:17:00';


		$sql = "SELECT * FROM `zenhome`.`apps_wunderground_data` WHERE `stat_ts` > '". $yesterday ."' ";
		//$this->query();
		// while ( $row = mysql_fetch_array( $stat_query ) ){
		//         $stat[] = $row;
		// }
		//die($query);
	}

	public function getTempLastMonth(){
		$stats_avg  = array_reverse( $this->fetchSimpleStats( 'AVG', 'temp_f' ) );
		$stats_high = array_reverse( $this->fetchSimpleStats( 'MAX', 'temp_f' ) );
		$stats_low  = array_reverse( $this->fetchSimpleStats( 'MIN', 'temp_f' ) );
		$stats = array();
		$i = 0;
		foreach( $stats_avg as $avg ){

			$stats[$avg[0]] = array(
				'high' 				=> $stats_high[$i][1],
				'low' 	 			=> $stats_low[$i][1],
				'avg'  				=> round( $avg[1], 1),
			);
		
			switch ($i) {
				case 0:
					$stats[$avg[0]]['date_format'] = 'Today';
					break;
				case 1:
					$stats[$avg[0]]['date_format'] = 'Yesterday';
				case 1:
					$stats[$avg[0]]['date_format'] = 'Yesterday!';					
				default:
					$stats[$avg[0]]['date_format'] =  $avg[0];
					break;
			}
			$i++;
		}

		$package = array(
			'count' => count( $stats ),
			'data'  => array_reverse( $stats ),
		);
		return $package;
	}

	private function fetchSimpleStats( $type, $field, $day_interval = 30 ){
		$stat_query = mysql_query( "SELECT left(`stat_ts`,10), ".$type."(`".$field."`),count(*) FROM `". DB_NAME ."`.`apps_wunderground_data` WHERE `stat_ts` between DATE_SUB(CURRENT_DATE, INTERVAL ".$day_interval." DAY) AND NOW() GROUP BY 1 " );
		$stat = array();
		while ( $row = mysql_fetch_array( $stat_query ) ){
		        $stat[] = $row;
		}
		return $stat;
	}
}