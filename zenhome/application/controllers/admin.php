<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Admin controller.
	 *
	 * This is an interface for adding users, monitoring users, and other 
	 *
	 * Maps to the following URL
	 *      http://example.com/admin
	 *  - or -  
	 *      http://example.com/index.php/admin/index
	 *
	 */

	public function __construct(){
		parent::__construct();
		session_start();
		if( ! isset( $_SESSION['user_id'] ) ){
			redirect('outside/failed');
		}       
		$this->load->model('AccountModel');
		$this->user = $this->AccountModel->userInfo( $_SESSION['user_id'] );
		$this->ip = getIP();
	}

	private function view( $view, $data = Null ){
		if( isset( $_SESSION['guest'] ) ){
			$this->load->view('private/header_guest');
		} else {
			$menu = array( 
				array( 'Dashboard', 'dashboard'), 
				array('Admin', 'admin'), 
				array( 'Profile', 'profile' ),
				array( 'Devices', 'devices' ),
				array( 'Apps', 'apps' ),
				array( 'Logout', 'outside/logout' ),
			);
			$header = array( 'menu' => $menu );
			$this->load->view('private/header_private', $header );
		}
		$this->load->view( $view, $data );
	}

	public function index(){
		$this->load->model('UserModel');

		$data = array(
			'users' => $this->UserModel->getUsers(),
		);	

		$this->view('private/admin', $data);
	}

	public function add_user(){
		if( !isset( $_REQUEST['user_name'] ) 
			|| !isset( $_REQUEST['password_1'] ) 
			|| empty( $_REQUEST['user_name'] ) 
			|| empty( $_REQUEST['password_1'] ) ){
			
			//@todo: set an error message
			redirect( 'admin/' );
		}
		$this->load->model('UserModel');
		//@todo: santize username
		$this->UserModel->addUser( $_REQUEST['user_name'], md5( $_REQUEST['password_1'] ) );

		redirect('admin/');
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */