<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Errors extends CI_Controller {

	/**
	 *
	 * 	Displays and handles errors
	 *
	 *
	 */

	public function __construct(){
		parent::__construct();
		session_start();
	}

	/**
	* Method which renders the apps main page
	*
	*/
	public function index(){
		$this->handle_app_error();
	}

	// check if the error was sent from an app
	private function handle_app_error(){
		if( isset( $_SESSION['user_id'] ) && $_SESSION['sent_from'] ){
			if( strpos( $_SESSION['sent_from']['REQUEST_URI'], '/apps/' ) !== false ){

				//$this->setMessage('error', 'Sorry you no longer have permission to access that.');
				//redirect( '' );
				die('error, you dont have access to that');
			}
		}
	}

}

/* End of file errors.php */
/* Location: ./application/controllers/errors.php */