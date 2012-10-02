<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_weather extends MY_Controller {

	/**
	 * Weather App
	 *
	 * Fetches weather, from weather underground
	 *
	 *	WEB INTERFACE
	 *		/application/controllers/app_weather.php 								CONTROLLER
	 *		/application/views/apps/app_weather_index.php  					VIEW
	 *		/application/views/apps/app_weather_settings.php				VIEW
	 *		/application/views/apps/app_weather_user_settings.php		VIEW	 
	 *		/application/views/apps/app_weather_portlet.php	 				VIEW
	 *
	 *
	 */

	public function __construct(){
		parent::__construct();
		session_start();
		if( ! isset( $_SESSION['user_id'] ) ){
			redirect('outside/failed');
		}
		$this->app = 'app_weather';
	}

	/**
	* Method which will render the Apps landing page
	*
	*/
	public function index(){
		$data = array(
			'stats' => $this->getTempLastMonth(),
		);

		$this->view( 'apps/app_weather_index', $data );
	}

	/**
	* Method which will render the settings for an App
	*
	*/
	public function settings(){
		$this->view( 'apps/app_weather_settings' );
	}

	/**
	* Method which will render the user settings for an App, displayed in profile
	*
	*/
	public function user_settings(){
		$this->view_portlet( 'apps/app_weather_user_settings' );
	}

	/**
	* Method which will render the dashboard portlet
	*
	*/
	public function portlet(){
		$data = array(
			'current' => $this->getLastPoll(),
		);

		$this->view_portlet( 'apps/app_weather_portlet', $data );
	}

	private function getLastPoll(){
		$this->load->database();
		$query = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`apps_wunderground_data` ORDER BY `stat_ts` DESC LIMIT 1" );

		return $query->row();
	}

	private function getTempLastMonth(){
		$this->load->database();

		$stat_query = mysql_query( "SELECT left(`stat_ts`,10),AVG(`temp_f`),count(*) FROM `". DB_NAME ."`.`apps_wunderground_data` WHERE `stat_ts` between DATE_SUB(CURRENT_DATE, INTERVAL 30 DAY) AND NOW() GROUP BY 1 " );
		$stats_avg = array();
		while ( $row = mysql_fetch_array( $stat_query ) ){
			$stats_avg[] = $row;
		}

		$stat_query = mysql_query( "SELECT left(`stat_ts`,10),MIN(`temp_f`),count(*) FROM `". DB_NAME ."`.`apps_wunderground_data` WHERE `stat_ts` between DATE_SUB(CURRENT_DATE, INTERVAL 30 DAY) AND NOW() GROUP BY 1" );
		$stats_min = array();
		while ( $row = mysql_fetch_array( $stat_query ) ){
			$stats_min[] = $row;
		}

		$stat_query = mysql_query( "SELECT left(`stat_ts`,10),MAX(`temp_f`),count(*) FROM `". DB_NAME ."`.`apps_wunderground_data` WHERE `stat_ts` between DATE_SUB(CURRENT_DATE, INTERVAL 30 DAY) AND NOW() GROUP BY 1" );
		$stats_max = array();
		while ( $row = mysql_fetch_array( $stat_query ) ){
			$stats_max[] = $row;
		}

		$stats = array();
		$i = 0;
		foreach( $stats_avg as $avg ){
			$stats[$avg[0]] = array(
				'high' => $stats_max[$i][1],
				'low'  => $stats_min[$i][1],
				'avg'	 => $avg[1],
			);
			$i++;
		}

		return $stats;
	}

}

/* End of file app_weather.php */
/* Location: ./application/controllers/apps/app_weather.php */