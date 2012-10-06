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
	}

	/**
	* Method which will render the Apps landing page
	*
	*/
	public function index(){
		$this->view( 'apps/networkscan/app_networkscan_index' );
	}

	/**
	* Method which will render the settings for an App
	*
	*/
	public function settings(){
		$this->view( 'apps/networkscan/app_networkscan_settings' );
	}

	/**
	* Method which will render the user settings for an App, displayed in profile
	*
	*/
	public function user_settings(){
		$this->view_portlet( 'apps/networkscan/app_networkscan_user_settings' );
	}

	/**
	* Method which will render the dashboard portlet
	*
	*/
	public function portlet(){
		$this->view_portlet( 'apps/networkscan/app_networkscan_portlet' );
	}


}

/* End of file app_networkscan.php */
/* Location: ./application/controllers/apps/app_networkscan.php */