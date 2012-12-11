<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chat extends MY_Controller {

	/**
	 *   _____ _       _   
	 *  |     | |_ ___| |_ 
	 *  |   --|   | .'|  _|
	 *  |_____|_|_|__,|_|  
	 *
	 * Allows users to chat on internal site
	 *
	 *	 ____FILE MANIFEST________________________________________________________
	 *	|		/application/controllers/apps/chat.php					CONTROLLER
	 *	|		/application/models/apps/chatmodel.php 					MODEL
	 *	|		/application/views/apps/chat/index.php  				VIEW 
	 *	|		/application/views/apps/chat/settings.php				VIEW 
	 *	|		/application/views/apps/chat/user_settings.php 			VIEW  
	 *	|		/application/views/apps/chat/portlet.php	 			VIEW
	 *	|		/application/views/apps/chat/chat_append.php	 		AJAX-VIEW
	 *	|		/public_html/apps/chat/js/chat_js.php	 				JS
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
		$this->load->model('apps/ChatModel');
		$data = array(
			'chat' => $this->ChatModel->readChat( $id = Null, $limit = 15 ),
		);
		$this->view( 'apps/chat/index', $data );
	}

	/**
	* Method which will render the dashboard portlet
	*
	*/
	public function widget(){
		$this->load->model('apps/ChatModel');
		$data = array(
			'chat' => $this->ChatModel->readChat(),
		);
		$this->view_widget( 'apps/chat/widget', $data );
	}

	/**
	* Method which will render the settings for an App
	*
	*/
	public function settings(){
		$this->view( 'apps/chat/settings' );
	}

	public function write( $message ){
		$message = str_replace('%800', '%2F', $message);
		$message = urldecode( $message );
		$this->load->model('apps/ChatModel');
		$this->ChatModel->writeChat( $this->user['user_id'], $message );
	}

	public function read_ajax( $last_read, $past = False ){
		$this->load->model('apps/ChatModel');
		if( $past ):
			$data = array ( 'chat' => $this->ChatModel->readChat( $last_read, True ) );
		else:
			$data = array ( 'chat' => $this->ChatModel->readChat( $last_read ) );
		endif;
		$this->view_widget('apps/chat/chat_append', $data);
	}
}

/* End of file chat.php */
/* Location: ./application/controllers/apps/chat.php */