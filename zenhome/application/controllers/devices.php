<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Devices extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 *              http://example.com/devices
	 *      - or -
	 *              http://example.com/index.php/devices/index
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
			$header = array( 
				'menu' => $menu,
				'user' => $this->user,
			);
			$this->load->view('private/header_private', $header );
		}
		$this->load->view( $view, $data );
	}

	public function index(){
		$this->load->Model('DeviceModel');
		$data = array(
			'devices' => $this->DeviceModel->getDevices(),
			);

		$this->view('private/devices', $data);
	}

	public function add_device(){
		$this->load->Model('DeviceModel');
		$this->DeviceModel->addDevice( $_REQUEST['device_name'], $_REQUEST['device_type'], $_REQUEST['device_user'] );
		redirect('devices');
	}

}

/* End of file devices.php */
/* Location: ./application/controllers/devices.php */
