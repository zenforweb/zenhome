<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Weather extends MY_Controller {

	/**
	 * Weather App
	 *
	 * Fetches weather, from weather underground
	 *
	 *	WEB INTERFACE
	 *		/application/controllers/apps/app_weather.php 					CONTROLLER
	 *		/application/models/apps/weathermodel.php 							MODEL
	 *		/application/views/apps/weather/index.php  							VIEW
	 *		/application/views/apps/weather/settings.php						VIEW
	 *		/application/views/apps/weather/user_settings.php				VIEW	 
	 *		/application/views/apps/weather/portlet.php	 						VIEW
	 *
	 *
	 */

	public function __construct(){
		parent::__construct();
		$this->load->model('AppsModel');
		$this->app_id = $this->AppsModel->getAppID('weather');
		//$this->app_user_settings = $this->
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
			'stats_recent' 	 => $this->WeatherModel->getRecentStats(),
		);
		$this->view( 'apps/weather/index', $data );
	}

	/**
	* Method which will render the settings for an App
	*
	*/
	public function settings(){
		$this->view( 'apps/weather/settings' );
	}

	/**
	* Method which will render the user settings for an App, displayed in profile
	*
	*/
	public function user_settings_submit(){
		$this->view_portlet( 'apps/weather/user_settings' );
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
		$this->view_portlet( 'apps/weather/portlet', $data );
	}

}

/* End of file weather.php */
/* Location: ./application/controllers/apps/weather.php */