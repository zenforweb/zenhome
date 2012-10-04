<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_networkscan extends MY_Controller {

	/**
	 * Network Scan App
	 *
	 * Fetches weather, from weather underground
	 *
	 *	WEB INTERFACE
	 *		/application/controllers/app_networkscan.php 					CONTROLLER
	 *		/application/views/apps/app_networkscan_index.php  		VIEW
	 *		/application/views/apps/app_networkscan_settings.php	VIEW
	 *		/application/views/apps/app_networkscan_portlet.php	 	VIEW
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
		$this->view( 'apps/app_networkscan_index' );
	}

	/**
	* Method which will render the settings for an App
	*
	*/
	public function settings(){
		$this->view( 'apps/app_networkscan_settings' );
	}

	/**
	* Method which will render the user settings for an App, displayed in profile
	*
	*/
	public function user_settings(){
		$this->view_portlet( 'apps/app_networkscan_user_settings' );
	}

	/**
	* Method which will render the dashboard portlet
	*
	*/
	public function portlet(){
		$this->view_portlet( 'apps/app_networkscan_portlet' );
	}

        /**
        * Method which will render the dashboard portlet
        *
        */
        private function app_nav(){
       		return array( '<a href="#">Outdoor Weather</a>', '<a href="#">Settings</a>' );
        }


}

/* End of file app_networkscan.php */
/* Location: ./application/controllers/apps/app_networkscan.php */