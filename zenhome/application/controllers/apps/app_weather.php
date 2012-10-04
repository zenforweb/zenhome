<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_weather extends MY_Controller {

	/**
	 * Weather App
	 *
	 * Fetches weather, from weather underground
	 *
	 *	WEB INTERFACE
	 *		/application/controllers/apps/app_weather.php 					CONTROLLER
	 *		/application/models/apps/weathermodel.php 							MODEL
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
		$this->load->model('apps/WeatherModel');
		$data = array(
			'current' 			 => $this->WeatherModel->getLastPoll(),			
			'stats_overtime' => $this->WeatherModel->getTempLastMonth(),
			'stats_today' 	 => $this->WeatherModel->getToday(),
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
		$this->load->model('apps/WeatherModel');
		$data = array(
			'current' => $this->WeatherModel->getLastPoll(),
		);

		$this->view_portlet( 'apps/app_weather_portlet', $data );
	}

}

/* End of file app_weather.php */
/* Location: ./application/controllers/apps/app_weather.php */