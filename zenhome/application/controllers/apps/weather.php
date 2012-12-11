<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Weather extends MY_Controller {

	/**
	 *	 _ _ _         _   _           
	 *	| | | |___ ___| |_| |_ ___ ___ 
	 *	| | | | -_| .'|  _|   | -_|  _|
	 * 	|_____|___|__,|_| |_|_|___|_|  
	 *
	 * 	Fetches weather, from weather underground
	 *
	 *	 ____ FILE MANIFEST ___________________________________________________
	 *	|		/application/controllers/apps/app_weather.php 					CONTROLLER
	 *	|		/application/models/apps/weathermodel.php 							MODEL
	 *	|		/application/views/apps/weather/index.php  							VIEW
	 *	|		/application/views/apps/weather/settings.php						VIEW
	 *	|		/application/views/apps/weather/user_settings.php				VIEW	 
	 *	|		/application/views/apps/weather/widget.php	 						VIEW
	 *
	 *
	 *	 ___ APPP SETTINGS _______________
	 *	|		api_key						@string
	 *			
	 *	 ___ APPP USER SETTINGS _____________
	 *	|		enabled 					@bool
	 * 	|		temp_format				@string
	 *  |		widget_enabled 		@bool
	 *	|		widget_graph      @bool
	 */

	public function __construct(){
		parent::__construct();
		$this->load->model('AppsModel');
		$this->app_id = $this->AppsModel->getAppID('weather');
		$this->userAppSet = $this->AppsModel->getUserAppSettings( $this->app_id, $this->user['user_id']);
	}

	/**
	* Method which will render the Apps landing page
	*
	*/
	public function index(){
		$this->load->model('apps/WeatherModel');
		$data = array(
			'current' 			 => $this->WeatherModel->getLastPoll(),
			'stats_overtime' => $this->WeatherModel->getTempLastMonth( $this->userAppSet['temp_format']['setting_value'] ),
			'stats_recent' 	 => $this->WeatherModel->getRecentStats( ),
		);
		$this->view( 'apps/weather/index', $data );
	}

	/**
	* Method which will render the dashboard widget
	*
	*/
	public function widget(){
		$this->load->model('apps/WeatherModel');
		$data = array(
			'current' => $this->WeatherModel->getLastPoll(),
		);
		$this->view_widget( 'apps/weather/widget', $data );
	}

	/**
	* Method which will render the settings for an App
	*
	*/
	public function settings(){
		$this->view( 'apps/weather/settings' );
	}

}

/* End of file weather.php */
/* Location: ./application/controllers/apps/weather.php */