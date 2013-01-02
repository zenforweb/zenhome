<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MY_Controller {

	/**
	 * Admin Settings controller.
	 *
	 * This is an interface for modifying simple and advanced settings
	 *
	 * Maps to the following URL
	 *      http://example.com/admin/settings
	 *
	 */

	public function __construct(){
		parent::__construct();		
	}

	public function index(){}

	public function basic(){
		$zenHome = $this->AppsModel->getZenHomeSettings();
		$data = array(
			'admin_menu' => $this->admin_menu(),
			'site_url'   => $zenHome['site_url'],
		);
		$this->view('admin/settings-basic', $data);
	}

	public function advanced(){
		$data = array(
			'admin_menu' => $this->admin_menu(),
		);

		$this->view('admin/settings-advanced', $data);
	}	

}

/* End of file settings.php */
/* Location: ./application/controllers/admin/settings.php */