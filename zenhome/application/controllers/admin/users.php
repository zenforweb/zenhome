<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {

	/**
	 * Admin User controller.
	 *
	 * This is an interface for modifying users, monitoring users, and other 
	 *
	 *
	 */

	public function __construct(){
		parent::__construct();
		$this->check_access( 'access_admin' );
	}

	public function index(){
		$this->load->model('UserModel');
		$data = array(
			'admin_menu' => $this->admin_menu(),	
			'users' => $this->UserModel->getUsers(),
		);
		$this->view('admin/home', $data);
	}

	public function info( $user_id ){
		$this->load->model('AdminModel');
		$this->load->model('AccountModel');

		$data = array(
			'admin_menu' => $this->admin_menu(),
			'logins'     => $this->AdminModel->getUserLogins( $user_id ),
			'user'       => $this->AccountModel->userInfo( $user_id ),
			'userACL'    => new ACL( $user_id ),
		);
		$this->view('admin/users/user_info', $data);
	}

	public function roles(){
		$this->load->library('acl');
		$user_roles = $this->acl->getAllRoles();

		$data = array(
			'admin_menu' => $this->admin_menu(),
			'user_roles' => $user_roles,
		);
		$this->view('admin/users/roles', $data);
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

	public function update_acl( $action, $user_id, $role_id ){
		ACL::updateUserRole( $action, $user_id, $role_id );
		$this->setMessage('success', 'Permissions updated!');
		redirect( 'admin/users/info/' . $user_id );
	}

	public function become_user( $user_id ){
		session_destroy();
		session_start();
		$_SESSION['user_id'] = $user_id;
		redirect('dashboard/');
	}

}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */