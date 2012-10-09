<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Networkscan extends MY_Controller {

	/**
	 * Network Scan App
	 *
	 * Fetches weather, from weather underground
	 *
	 *	WEB INTERFACE
	 *		/application/controllers/networkscan.php 				CONTROLLER
	 *		/application/views/apps/index.php  							VIEW
	 *		/application/views/apps/user_settings.php				VIEW
	 *		/application/views/apps/settings.php						VIEW
	 *		/application/views/apps/portlet.php	 						VIEW
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
		$this->view( 'apps/networkscan/index' );
	}

	/**
	* Method which will render the settings for an App
	*
	*/
	public function settings(){
		$this->view( 'apps/networkscan/settings' );
	}

	/**
	* Method which will render the dashboard portlet
	*
	*/
	public function portlet(){
		$this->view_portlet( 'apps/networkscan/portlet' );
	}

}

/* End of file networkscan.php */
/* Location: ./application/controllers/apps/networkscan.php */