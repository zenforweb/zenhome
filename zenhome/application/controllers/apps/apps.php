<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apps extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 *              http://example.com/plugins
	 *      - or -
	 *              http://example.com/index.php/plugins/index
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
	
	public function index(){
		 // show all devices, and management
			$this->view('private/apps');
	}
}

/* End of file plugins.php */
/* Location: ./application/controllers/plugins.php */
