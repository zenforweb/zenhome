<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/profile
	 *	- or -  
	 * 		http://example.com/index.php/profile/index
	 *
	 */

	public function __construct(){
		parent::__construct();
		$this->ip = getIP();
	}

	public function index(){
		$this->load->model('AppsModel');
		$extra_views = $this->get_app_user_settings_pages();		
		$data = array(
			'apps' => $this->AppsModel->getEnabledApps(),
		);
		$this->view_profile( 'private/profile', $data, $extra_views );
	}

	public function change_pass(){
		if( ! isset( $_REQUEST['current_password'] ) || ! isset( $_REQUEST['password_1'] ) )
			redirect( 'profile');
		$this->load->model('UserModel');
		if ( $this->UserModel->verify_user( $this->user['user_name'] , md5( $_REQUEST['current_password'] ) ) ){
			$this->UserModel->change_password( $this->user['user_id'], md5( $_REQUEST['password_1'] ) );
			$this->setMessage( 'success', 'Password updated' );
			redirect( 'profile' );
		} else {           
			$this->setMessage( 'error', 'Passwords didn\'t match' );
			redirect( 'profile' );
		}
	}

  private function view_profile( $view, $data = Null, $extra_views = Null ){
  	$this->header();
		$this->load->view( $view, $data );
		if( count( $extra_views ) > 0 ){
			foreach( $extra_views as $view){
				$this->load->view( $view['view_path'], $view['view_data'] );
			}
		}
		//echo "</div><!-- end #app_settings_list --></div><!-- end #app_settings --></div><!-- end #wrap -- >";
		$this->load->view( 'private/footer.php' );
		if( isset( $_SESSION['message'] ) )
			$this->unsetMessage();
	}

	private function get_app_user_settings_pages(){
		$this->load->model('AppsModel');
		$apps = $this->AppsModel->getEnabledApps();
		$dir = substr( __DIR__, 0, -11 ) . 'views/apps/';
		$views_to_load = array();
		foreach( $apps as $app ){
			$view_path = $dir . $app->slug_name . '/user_settings.php';
			if( file_exists( $view_path ) ){				
				$data = $this->AppsModel->getUserAppSettings( $app->row_id, $this->user['user_id'] ) ;
				$data['app_info'] = $app;

				$views_to_load[] = array(
					'view_path' => 'apps/' . $app->slug_name . '/user_settings',
				  'view_data' => $data,
				);
			}	
		}
		
		return $views_to_load;
	}	
                                                      
}

/* End of file profile.php */
/* Location: ./application/controllers/profile.php */