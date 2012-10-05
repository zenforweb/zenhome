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

	public function getRecentStats(){
		$last_24_gmt = date( 'Y-m-d G:i', strtotime( '-1 days') );
		$package =  array(
			'last_24' => $this->fetchRecords( $last_24_gmt ),
		);
		return $package;
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
		
			if( $i == 0 ){
				$stats[$avg[0]]['date_format'] = 'Today';
			} elseif( $i == 1 ){
				$stats[$avg[0]]['date_format'] = 'Yesterday';
			} elseif( $i < 7 ){
				$stats[$avg[0]]['date_format'] = date( 'l', strtotime( $avg[0] ) );
			} else {
				$stats[$avg[0]]['date_format'] = substr( $avg[0], 5);
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

	private function fetchRecords( $from, $to = Null){
		if( $to == Null ){
			$sql = "SELECT * FROM `". DB_NAME ."`.`apps_wunderground_data` WHERE `stat_ts` > '". $from ."' ORDER BY `stat_ts` DESC";
			$query = $this->db->query( $sql );
			$today = array();
			$i = 0;
			foreach( $query->result() as $row ){
				$today[$i]['temp'] 				= $row->temp_f;
				$today[$i]['humidity'] 		= $row->rel_humidity;
				$today[$i]['stat_ts']			= $row->stat_ts;
				$today[$i]['date_format']	= date( 'g:i a', strtotime( $row->stat_ts ) );
				$i++;
			}
			return array_reverse( $today );
		}
	}	

}