<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 */
class MY_Controller extends CI_Controller{

  function __construct(){
      parent::__construct();
  }

  private function load_user(){
  	$this->load->model('AccountModel');
		$this->user = $this->AccountModel->userInfo( $_SESSION['user_id'] );        
  }

	private function main_menu(){
		$menu = array( 
			array( 'Dashboard', 'dashboard',  		0 ), 
			array( 'Admin', 		'admin',					0 ), 
			array( 'Profile', 	'profile', 				0 ),
			array( 'Devices', 	'devices', 				0 ),
			array( 'Apps', 			'apps', 					0 ),
			array( 'Logout', 		'outside/logout', 0 ),
		);
		foreach ($menu as $key => $item) {
			if ( strstr( $_SERVER['REQUEST_URI'], $item[1] ) ){
				$menu[$key][2] = 1;
			}
		}
		return $menu;
	}

  public function view( $view, $data = Null ){  	
  	$this->load_user();
		if( isset( $_SESSION['guest'] ) ){
			$this->load->view('private/header_guest');
		} else {
			$header = array( 
				'menu' => $this->main_menu(),
				'user' => $this->user,
			);
			$this->load->view('private/header_private', $header );
		}
		$this->load->view( $view, $data );
	}


}
// END Controller class

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */