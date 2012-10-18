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
		$this->view('admin/settings-basic');
	}

	public function advanced(){
		$this->view('admin/settings-advanced');
	}	

}

/* End of file settings.php */
/* Location: ./application/controllers/admin/settings.php */