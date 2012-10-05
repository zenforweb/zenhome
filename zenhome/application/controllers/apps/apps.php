<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apps extends MY_Controller {

	/**
	 * Main App interface
	 *
	 * Shows and allows managment of all installed apps.
	 *
	 *
	 */

	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$this->load->model( 'AppsModel' );
		$data = array(
			'apps' => $this->AppsModel->getAllApps(),
		);
		$this->view( 'private/apps', $data );
	}

	public function enable( $app_id ){
		if( !isset( $app_id ) )
			//@todo report error
			redirect( 'apps/' );
		$this->load->model( 'AppsModel' );
		$this->AppsModel->enableApp( $app_id );
		redirect( 'apps/' );
	}

	public function disable( $app_id ){
		if( !isset( $app_id ) )
			//@todo report error
			redirect( 'apps/' );
		$this->load->model( 'AppsModel' );
		$this->AppsModel->disableApp( $app_id );
		redirect( 'apps/' );
	}	
}

/* End of file apps.php */
/* Location: ./application/controllers/apps.php */