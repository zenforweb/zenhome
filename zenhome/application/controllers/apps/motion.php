<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Motion extends MY_Controller {

	/**
	 * Motion App
	 *
	 * Pulls in local camera feeds from Motion
	 *
	 *	WEB INTERFACE
	 *		/application/controllers/apps/motion.php 									CONTROLLER
	 *		/application/views/apps/motion/index.php  											VIEW
	 *		/application/views/apps/motion/settings.php											VIEW	 
	 *		/application/views/apps/motion/portlet.php	 										VIEW
	 *
	 *
	 */

	public function __construct(){
		parent::__construct();
		$this->load->model('AppsModel');
		$this->app_id = $this->AppsModel->getAppID('motion');
	}

	/**
	* Method which will render the Apps landing page
	*
	*/
	public function index(){
		$data = array();
		$this->view( 'apps/motion/index', $data );
	}

	/**
	* Method which will render the settings for an App
	*
	*/
	public function settings(){
		$this->view( 'apps/motion/settings' );
	}

	/**
	* Method which will render the user settings for an App, displayed in profile
	*
	*/
	public function user_settings(){
		$this->view_portlet( 'apps/motion/user_settings' );
	}

	/**
	* Method which will render the user settings for an App, displayed in profile
	*
	*/
	public function user_settings_submit(){
		redirect( 'profile' );
	}

	/**
	* Method which will render the dashboard portlet
	*
	*/
	public function portlet(){
		$this->load->model('apps/WeatherModel');
		$data = array(
		);
		$this->view_portlet( 'apps/motion/portlet', $data );
	}

}

/* End of file motion.php */
/* Location: ./application/controllers/apps/motion.php */