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
	 * 		sudo apt-get install php5-curl
	 */

	public function __construct(){
		parent::__construct();
		$this->load->model('AppsModel');
		$this->app_id 			 = $this->AppsModel->getAppID('motion');
		$this->app_motion_fp = 'security';
	}

	/**
	* Method which will render the Apps landing page
	*
	*/
	public function index(){
		$this->load->model('apps/MotionModel');
		
		$data = array(
			'status' => $this->MotionModel->systemStatus(),
			'images' => $this->MotionModel->readRecentImages(),
			//'recent' => $this->MotionModel->readMotion(),
		);

			// Alix {debug
		$this->view( 'apps/motion/index', $data );
	}

	/**
	* Method which will render the dashboard portlet
	*
	*/
	public function portlet(){
		$data = array(
		);
		$this->view_portlet( 'apps/motion/portlet', $data );
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

	public function arm( $value, $cam = Null ){
		$this->load->model('apps/MotionModel');
		//@todo: read this from a motion app settings
		$motion = 'http://blackbox:cleancut@10.1.10.52:8080/';
		if( $cam == Null ){
			$camera = '0/detection/';
			$cam = 0;
		} else {
			$camera = $cam .'/detection/';
		}
		if( $value == 1){
			$signal = 'start';
		} elseif ( $value == 0) {
			$signal = 'pause';
		}
		$command = $motion . $camera .  $signal;
		$this->MotionModel->systemArm( $this->user['user_id'], $cam, $value, $command );
	}

}

/* End of file motion.php */
/* Location: ./application/controllers/apps/motion.php */