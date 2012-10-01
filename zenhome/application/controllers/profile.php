<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/profile
	 *	- or -  
	 * 		http://example.com/index.php/profile/index
	 *
	 */

	public function __construct(){
		parent::__construct();
		session_start();
		if( ! isset( $_SESSION['user_id'] ) ){
			redirect('outside/failed');
		}
		$this->ip = getIP();
	}

	public function index(){
	$this->load->model('AppsModel');
		$data = array(
			'apps' => $this->AppsModel->getEnabledApps(),
		);
		$this->view( 'private/profile', $data );
	}

	public function change_pass(){
		if( ! isset( $_REQUEST['current_password'] ) || ! isset( $_REQUEST['password_1'] ) ){
			//@todo: set error message
			redirect( 'profile');
		}
		$this->load->model('UserModel');
		if ( $this->UserModel->verify_user( $this->user['user_name'] , md5( $_REQUEST['current_password'] ) ) ){
			$this->UserModel->change_password( $this->user['user_id'], md5( $_REQUEST['password_1'] ) );
			redirect( 'profile' );
		} else {           
			//@todo set message saying old password was wrong
			redirect( 'profile');
		}
	}
	
}

/* End of file profile.php */
/* Location: ./application/controllers/profile.php */