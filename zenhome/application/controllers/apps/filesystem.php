<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filesystem extends MY_Controller {

	/**
	 *	 _____ _ _     _____         _             
	 *	|   __|_| |___|   __|_ _ ___| |_ ___ _____ 
	 *	|   __| | | -_|__   | | |_ -|  _| -_|     |
	 *	|__|  |_|_|___|_____|_  |___|_| |___|_|_|_|
	 *                    |___|                  
	 *
	 * Tracks drive statistics 
	 *
	 *	 ____FILE MANIFEST________________________________________________________
	 *	|		/application/controllers/apps/filesystem.php								CONTROLLER
	 *	|		/application/models/apps/filesystemmodel.php 								MODEL
	 *	|		/application/views/apps/filesystem/index.php  							VIEW 
	 *	|		/application/views/apps/filesystem/settings.php							VIEW 
	 *	|		/application/views/apps/filesystem/user_settings.php 				VIEW  
	 *
	 */

	public function __construct(){
		parent::__construct();
		$this->load->model('AppsModel');
		$this->app_id = $this->AppsModel->getAppID('chat');
		//$this->app_user_settings = 
	}

	/**
	* Method which will render the Apps landing page
	*
	*/
	public function index(){
		$this->load->model('apps/FilesystemModel');
		$this->appConfiguredCheck();
		$data = array();
		$this->view( 'apps/filesystem/index', $data );
	}

	/**
	* Method which will render the dashboard portlet
	*
	*/
	// public function widget(){
	// 	$this->load->model('apps/ChatModel');
	// 	$data = array(
	// 		'chat' => $this->ChatModel->readChat( ),
	// 	);
	// 	$this->view_portlet( 'apps/chat/widget', $data );
	// }

	/**
	* Method which will render the settings for an App
	*
	*/
	public function settings(){
		$this->view( 'apps/filesystem/settings' );
	}

	public function setup(){
		$this->view( 'apps/filesystem/setup' );
	}

	private function appConfiguredCheck(){
		$this->load->model('AppsModel');
		if( ! $this->FilesystemModel->checkForAppDiskSettings( $this->app_id ) ){
			$message = 'This App is not configured yet, head over to the apps setting page';
			$this->setMessage('info', $message);
			redirect('apps/filesystem/setup');
		}
	}

}

/* End of file filesystem.php */
/* Location: ./application/controllers/apps/filesystem.php */