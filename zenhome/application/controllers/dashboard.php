<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

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
	}

	public function index(){
		if( isset($_SESSION['guest']) && $_SESSION['guest'] ){
			$this->guest();
		}

		$this->load->model( 'AppsModel' );
		$data = array(
			'enabled' => $this->AppsModel->getEnabledApps(),
		);

		$this->view( 'private/dashboard', $data );
	}

	private function guest(){
		$this->view( 'private/dashboard_guest' );	
		exit();
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */