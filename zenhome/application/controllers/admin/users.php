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
			'admin_menu'  => $this->admin_menu(),
			'logins'      => $this->AdminModel->getUserLogins( $user_id ),
			'user'        => $this->AccountModel->userInfo( $user_id ),
			'editUserACL' => new ACL( $user_id ),
			'allPerms'    => $this->getFullUserAcl( $user_id ),
		);
		$this->view('admin/users/user_info', $data);
	}

	public function roles(){
		$this->load->library('acl');
		$user_roles = $this->acl->getAllRoles();

		$role_perms = array();
		foreach( $user_roles as $role_id ) {
			$role_perms[ $this->acl->getRoleNameFromID( $role_id ) ] = $this->acl->getRolePerms( $role_id );
		}

		$data = array(
			'admin_menu' => $this->admin_menu(),
			'role_perms' => $role_perms,
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

	public function update_acl( $action, $area, $user_id, $role_or_perm_id, $inherited = null ){
		if( $area == 'role' ){
			$role_id = $role_or_perm_id;
			ACL::updateUserRole( $action, $user_id, $role_id );
			$type = 'success';
			$message = 'Role Added';
		} elseif ( $area == 'perm' ) {
			$perm_id = $role_or_perm_id;
			if( !empty( $inherited ) && $inherited = 1 ){
				//@todo
				//rebuild the role perms if its an inherited permission from a role
			} else {
				ACL::updateUserPerm( $action, $user_id, $perm_id );
			}
			$type = 'success';
			$message = 'Permission was '. $action .'ed';
		} else {
			$type = 'error';
			$message = 'There was an error';
		}
		$this->setMessage( $type, $message );
		redirect( 'admin/users/info/' . $user_id );
	}

	public function become_user( $user_id ){
		session_destroy();
		session_start();
		$_SESSION['user_id'] = $user_id;
		redirect('dashboard/');
	}

	/**
	 *	This is a helper that could/should probably be dropped down to the ACL library, but for now it's here.
	 */
	private function getFullUserAcl( $user_id ){
		$this->load->library('acl');
		$user_ACL = new ACL( $user_id );
		$all_perms = array();
		foreach( $this->acl->getAllPerms() as $perm_id ) {
			$all_perms[ $this->acl->getPermKeyFromID( $perm_id ) ] = array( 
				'perm'	 => $this->acl->getPermKeyFromID( $perm_id ),
				'name' => $this->acl->getPermNameFromID( $perm_id ),
				'id'   => $perm_id,
			);
		}
		$no_access_perms = array_diff_key(  $all_perms, $user_ACL->perms);
		foreach ($all_perms as $perm => $info) {
			if( array_key_exists( $perm, $no_access_perms ) ){
				$all_perms[$perm]['user_access'] = 0;
			} else {
				$all_perms[$perm]['user_access'] = 1;
			}
		}
		return $all_perms;
	}

}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */