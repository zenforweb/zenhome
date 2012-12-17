<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Motion extends MY_Controller {

	/**
	 *	 _____     _   _         
	 *	|     |___| |_|_|___ ___ 
	 *	| | | | . |  _| | . |   |
	 * 	|_|_|_|___|_| |_|___|_|_|
   *
	 *
	 * 	Pulls in local live camera feeds from Motion, and displays recently captured images
	 *
	 *	 ____FILE MANIFEST________________________________________________________
	 *	|		/application/controllers/apps/motion.php 									CONTROLLER 	
	 *	|		/application/views/apps/motion/index.php  								VIEW        
	 *	|		/application/views/apps/motion/settings.php								VIEW	 		 	
	 *	|		/application/views/apps/motion/widget.php	 								VIEW 				
	 *	|
	 *	
	 *		
	 *	 ____APPP SETTINGS______________________________
	 *	|		enabled 		@bool
	 *	|
	 *
	 *
	 *	 ____APPP USER SETTINGS_________________________
	 *	|		enabled 				@bool
	 *	|		widget_cams 		@bool
	 *	|		widget_carosel  @bool
	 *	|
	 * 
	 *	sudo apt-get install php5-curl
	 */

	public function __construct(){
		parent::__construct();
		$this->load->model( 'AppsModel' );
		$this->load->model('apps/MotionModel');
		$this->app_id 			 = $this->AppsModel->getAppID('motion');
		$this->app_settings  = $this->MotionModel->getAppSettings();
	}

	/**
	* Method which renders the apps main page
	*
	*/
	public function index(){
		$this->check_access( 'access_motion', True, 'errors' );
		$data = array(
			'status' => $this->MotionModel->systemStatus(),
			'images' => $this->MotionModel->readRecentImages(),
			'app'		 => $this->app_settings,
		);

		$this->view( 'apps/motion/index', $data );
	}

	/**
	* Method which will render the dashboard widget
	*
	*/
	public function widget_cams(){
		$this->check_access( 'access_motion', True, 'errors' );
		$data = array();
		$this->view_widget( 'apps/motion/widget_cams', $data );
	}

	/**
	* Method which will render the dashboard widget
	*
	*/
	public function widget_carosel(){
		$this->check_access( 'access_motion', True, 'errors' );
		$this->load->model('apps/MotionModel');
		$data = array(
			'images' => $this->MotionModel->readRecentImages(),
		);
		$this->view_widget( 'apps/motion/widget_carosel', $data );
	}


	public function camera( $cam_num ){
		$data = array();
		$this->view( 'apps/motion/widget_cam/', $data);
	}

	/**
	* Method which will render the settings page for an App
	*
	*/
	public function settings(){
		$data = array(
			'app_settings' => $this->app_settings,
		);
		$this->view( 'apps/motion/settings', $data );
	}

	public function settings_save(){
		$this->MotionModel->settingsSave( $_REQUEST );
		$this->setMessage('success', 'Settings saved successfully');
		redirect( 'apps/motion/settings' );
	}

	/**
	 *	Allows the Arming and disarming of a particular camera of all cameras
	 */
	public function arm( $value, $cam = Null ){
		$this->check_access( 'access_motion', True, 'errors' );
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