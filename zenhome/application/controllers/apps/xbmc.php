<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Xbmc extends MY_Controller {

	/**
	 *           
	 *	 __ __ _             
	 *	|  |  | |_ _____ ___ 
	 *	|-   -| . |     |  _|
	 *	|__|__|___|_|_|_|___|
	 *
	 * 	Fetches weather, from weather underground
	 *
	 *	 ____ FILE MANIFEST ___________________________________________________
	 *	|		/application/controllers/apps/xbmc.											CONTROLLER
	 *	|		/application/models/apps/xbmcmodel.php 	 								MODEL
	 *	|		/application/views/apps/xbmc/index.php  								VIEW
	 *	|		/application/views/apps/xbmc/settings.php								VIEW
	 *	|		/application/views/apps/xbmc/user_settings.php					VIEW	 
	 *	|		/application/views/apps/xbmc/widget.php	 								VIEW
	 *
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
		$this->app_id = $this->AppsModel->getAppID('xbmc');
		$this->userAppSet = $this->AppsModel->getUserAppSettings( $this->app_id, $this->user['user_id']);
	}

	/**
	* Method which will render the Apps landing page
	*
	*/
	public function index(){
		$this->load->model('apps/XbmcModel');
		$this->XbmcModel->recentTvShows();
		$data = array(
			'recentDownloads' => $this->XbmcModel->recentTvShows(),
		);
		$this->view( 'apps/xbmc/index', $data );
	}

	/**
	* Method which will render the dashboard widget
	*
	*/
	public function widget(){
		$this->load->model('apps/XbmcModel');
		$data = array();
		$this->view_widget( 'apps/xmbc/widget', $data );
	}

	/**
	* Method which will render the settings for an App
	*
	*/
	public function settings(){
		$this->view( 'apps/xbmc/settings' );
	}

}

/* End of file xbmc.php */
/* Location: ./application/controllers/apps/xbmc.php */