<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Outside extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/
	 *	- or -  
	 * 		http://example.com/outside
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
		parent::__construct();
		session_start();
		$this->ip = getIP();
	}

	private function view( $view ){
		$this->load->view('public/header_public');
		$this->load->view( $view );
	}

	public function index(){		
		if( isset( $_SESSION['user_id'] ) ){
			redirect('dashboard/');
		}
		//@todo add config file for guests on/off
		if( $this->ip[1] == 'local' && ALLOW_GUESTS ){
			//$this->handle_guest();
		}

		$this->view('public/login');
	}

	public function login(){
		if( !isset( $_REQUEST['user_name'] ) 
			|| !isset( $_REQUEST['password'] ) 
			|| empty( $_REQUEST['user_name'] ) 
			|| empty( $_REQUEST['password'] ) ){
		  	redirect( 'outside/failed' );
		}
		$user_name = strtolower ( $_REQUEST['user_name'] );
		$password  = md5( $_REQUEST['password'] );
		$this->load->model('UserModel');
		$verify = $this->UserModel->verify_user($user_name, $password);
		$userACL = new ACL( $verify );
		if( $verify ){
			$_SESSION['user_id'] = $verify;
			if( ! $userACL->hasPermission( 'access-site' ) ){		//@todo: figure out why this bool seems flipped
				redirect('outside/index');
			} else {
				$this->setMessage('error', 'Sorry, you cannot access the site right now. Ask an administrator why, they might even know.');
				redirect( '/outside/failed' );
			}
		} else {
			redirect( '/outside/failed' );
		}
	}

	public function handle_guest(){
		$this->load->model('UserModel');
		$_SESSION['user_id'] = 0;
		$_SESSION['guest'] = True;
		$this->UserModel->logAccess( $_SESSION['user_id'] );
		redirect( 'dashboard/guest' );
	}

	public function logout(){
		session_destroy();
		redirect( '' );
	}

	public function failed(){
		echo 'you screwed up and now you\'re out';
	}

	public function mqtest(){
		$this->load->library('rabbitmq');
		$this->rabbitmq->publisher( 'stats.network', 'hello', 'exchage', 'quue=null' );		
	}

	public function setMessage( $type, $message){
		$_SESSION['message'] = array( 'type' => $type, 'msg' => $message );
	}

	private function unsetMessage(){
		unset($_SESSION['message']);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */