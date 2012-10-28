<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Motion extends MY_Controller {

	/**
	 *	 _____     _   _         
	 *	|     |___| |_|_|___ ___ 
	 *	| | | | . |  _| | . |   |
	 * 	|_|_|_|___|_| |_|___|_|_|			//http://patorjk.com/software/taag/#p=display&f=Rectangles&t=Weather
   *                
	 *
	 * Pulls in local live camera feeds from Motion, and displays recently captured images
	 *
	 *	 ____FILE MANIFEST________________________________________________________
	 *	|		/application/controllers/apps/motion.php 									CONTROLLER 	
	 *	|		/application/views/apps/motion/index.php  								VIEW        
	 *	|		/application/views/apps/motion/settings.php								VIEW	 		 	
	 *	|		/application/views/apps/motion/widget.php	 								VIEW 				
	 *
	 *			
	 *	 ____APPP SETTINGS______________________________
	 *	|		enabled 							@bool
	 *	|		widget_cams 					@bool
	 *	|		widget_carosel   		 	@bool
	 *	|
	 *
	 *
	 *	 ____APPP USER SETTINGS_________________________
	 *	|		enabled 							@bool
	 *	|		widget_cams 					@bool
	 *	|		widget_carosel   		 	@bool
	 *	|
	 * 
	 *	sudo apt-get install php5-curl
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
		$this->view( 'apps/motion/index', $data );
	}

	/**
	* Method which will render the dashboard portlet
	*
	*/
	public function widget_cams(){
		$data = array();
		$this->view_portlet( 'apps/motion/widget_cams', $data );
	}

	/**
	* Method which will render the dashboard portlet
	*
	*/
	public function widget_carosel(){
		$this->load->model('apps/MotionModel');
		$data = array(
			'images' => $this->MotionModel->readRecentImages(),
		);
		$this->view_portlet( 'apps/motion/widget_carosel', $data );

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