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
		$this->view( 'apps/app_weather_index' );
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

}

/* End of file app_weather.php */
/* Location: ./application/controllers/apps/app_weather.php */