<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 */
class MY_Controller extends CI_Controller{

  function __construct(){
  	parent::__construct();
  	session_start();
  	if( ! isset( $_SESSION['user_id'] ) ){
  		$this->setMessage( 'error', 'Your session does not exist' );
			redirect('/');
		}
	
		$this->load_user();
  }

  private function load_user(){
  	$this->load->model('AccountModel');
		$this->user = $this->AccountModel->userInfo( $_SESSION['user_id'] );
  }

	private function main_menu(){
		$menu = array( 
			array( 'Dashboard', 'dashboard',  		0 ), 
			array( 'Devices', 	'devices', 				0 ),
			array( 'Apps', 			'apps', 					0,  $this->make_app_menu() ),
		);
		foreach ($menu as $key => $item) {
			if ( strstr( $_SERVER['REQUEST_URI'], $item[1] ) ){
				$menu[$key][2] = 1;
			}
		}
		return $menu;
	}

  public function view( $view, $data = Null ){
  	$this->header();
		$this->load->view( $view, $data );
		$this->load->view( 'private/footer.php' );
		if( isset( $_SESSION['message'] ) )
			$this->unsetMessage();
	}

  public function header(){
  	$this->load_user();
		if( isset( $_SESSION['guest'] ) ){
			$this->load->view('private/header_guest');
		} else {
			$header = array( 
				'menu'    => $this->main_menu(),
				'user'    => $this->user,
				'userACL' => new ACL(),
			);
			$this->load->view('private/header_private', $header );
		}
	}

	public function view_widget( $view, $data = Null ){
		$this->load->view( $view, $data );
	}

	public function setMessage( $type, $message){
		$_SESSION['message'] = array( 'type' => $type, 'msg' => $message );
	}

	public function admin_menu(){
		$menu = array();
		//$menu['General']['Status'] = '#';
		$menu['General']['Basic Settings'] = 'admin/settings/basic';
		$menu['General']['Advanced Settings'] = 'admin/settings/advanced';

		$menu['User']['All Users']  = 'admin/users';
		$menu['User']['User Roles'] = 'admin/users/roles';
		//$menu['User']['User Stats'] = '#';

		$menu['Apps']['App Control'] = 'admin/apps';

		//$menu['Devices']['All Devices'] = '#';

		if( $this->check_access( 'developer', False ) ){
			$menu['Dev Tools']['App Control'] = 'admin/dev';
		}

		return $menu;
	}

	private function unsetMessage(){
		unset( $_SESSION['message'] );
	}

	private function make_app_menu(){
		$this->load->model('AppsModel');
		$enabled_apps = $this->AppsModel->getEnabledAppsForUser( $this->user['user_id']);
		$app_menu = array();
		foreach ($enabled_apps as $app) {
			$app_menu[] = array( $app->pretty_name, $app->slug_name, 0 );
		}
		return $app_menu;
	}

	public function check_access( $perm, $message = True ){
		$ACL = new ACL();
		if ( ! $ACL->hasPermission( $perm ) ){
			if( $message ){
				$this->setMessage('error', 'You do not have access to that.');	
				redirect('/');
			} else {
				return True;
			}
		} else {
			return False;
		}
	}

}
// END Controller class

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */