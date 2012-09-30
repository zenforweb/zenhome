<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 */
class MY_Controller extends CI_Controller{

    function __construct()
    {
        parent::__construct();
    }

    private function load_user(){
    	$this->load->model('AccountModel');
			$this->user = $this->AccountModel->userInfo( $_SESSION['user_id'] );        
    }

    public function view( $view, $data = Null ){
    	$this->load_user();
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
				$header = array( 
					'menu' => $menu,
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