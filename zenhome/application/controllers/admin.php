<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {

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
		$this->ip = getIP();
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
			$this->setMessage( 'error', 'You are missing a field which is required to add a user.');
			redirect( 'admin/' );
		}
		$this->load->model('UserModel');
		//@todo: santize username
		$this->UserModel->addUser( $_REQUEST['user_name'], md5( $_REQUEST['password_1'] ) );
		$this->setMessage( 'success', 'User added');
		redirect('admin/');
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */