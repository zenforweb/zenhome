<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Devices extends MY_Controller {

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
		$this->setMessage( 'success', 'Device added');
		redirect('devices');
	}

}

/* End of file devices.php */
/* Location: ./application/controllers/devices.php */
