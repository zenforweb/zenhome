<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_weather extends MY_Controller {

	/**
	 * Weather App
	 *
	 * Fetches weather, from weather underground
	 *
	 */

	public function __construct(){
		parent::__construct();
		session_start();
		if( ! isset( $_SESSION['user_id'] ) ){
			redirect('outside/failed');
		}		
	}

	/**
	* Method which will render the Apps landing page
	*
	*/
	public function index(){
		$this->view( 'apps/app_weather_index');
	}

	/**
	* Method which will render the settings for an App
	*
	*/
	public function settings(){
		$this->view( 'apps/app_weather_settings');
	}

	/**
	* Method which will render the dashboard portlet
	*
	*/
	public function portlet(){
		$this->view_portlet('apps/app_weather_portlet');
	}
}

/* End of file plugins.php */
/* Location: ./application/controllers/plugins.php */