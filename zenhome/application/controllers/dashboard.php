<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/dashboard
	 *	- or -  
	 * 		http://example.com/index.php/dashboard/index
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
		if( isset($_SESSION['guest']) && $_SESSION['guest'] ){
			$this->guest();
		}
		$this->view('private/dashboard');
	}

	private function guest(){
		$this->view('private/dashboard_guest');	
		exit();
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */