<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App extends MY_Controller {

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
	
	public function enable( $app_id ){
		if( !isset( $app_id ) )
			//@todo report error
			redirect( 'apps/' );
		$this->load->model( 'AppsModel' );
		$this->AppsModel->enableApp( $app_id );
		redirect( 'admin/apps' );
	}

	public function disable( $app_id, $user_id = Null ){
		if( !isset( $app_id ) )
			redirect( 'apps/' );
		$this->load->model( 'AppsModel' );
		if( isset( $user_id ) && !empty( $user_id ) ){
			$boom = $this->AppsModel->disableUserApp( $app_id, $user_id );
		} else {
			$this->AppsModel->disableApp( $app_id );			
		}
		redirect( 'admin/apps' );
	}

	public function update_user_setting( $app_id, $setting_name, $setting_value ){		
		$this->load->model( 'AppsModel' );
		$this->AppsModel->update_user_setting( $app_id, $this->user['user_id'], $setting_name, $setting_value );
	}

}

/* End of file apps.php */
/* Location: ./application/controllers/apps.php */