<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_remote extends MY_Controller {

	/**
	 * Remote App
	 *
	 * Remote for Onkyo receiver, will eventually branch out
	 *
	 *	WEB INTERFACE
	 *		/application/controllers/app_remote.php 								CONTROLLER
	 *		/application/views/apps/app_remote_index.php  					VIEW
	 *		/application/views/apps/app_remote_settings.php					VIEW
	 *		/application/views/apps/app_remote_user_settings.php		VIEW
	 *		/application/views/apps/app_remote_portlet.php	 				VIEW
	 *
	 *
	 */

	public function __construct(){
		parent::__construct();
		session_start();
		if( ! isset( $_SESSION['user_id'] ) )
			redirect('outside/failed');
		$this->app = 'app_remote';
	}

	/**
	* Method which will render the Apps landing page
	*
	*/
	public function index(){
		$this->view( 'apps/app_remote_index' );
	}

	/**
	* Method which will render the settings for an App
	*
	*/
	public function settings(){
		$this->view( 'apps/app_remote_settings' );
	}

	/**
	* Method which will render the user settings for an App, displayed in profile
	*
	*/
	public function user_settings(){
		$this->view_portlet( 'apps/app_remote_user_settings' );
	}

	/**
	* Method which will render the dashboard portlet
	*
	*/
	public function portlet(){
		$data = array( );

		$this->view_portlet( 'apps/app_remote_portlet', $data );
	}

	public function command( $device, $command ) {
		if( $device = 'reciever'){
			$this->reciever( $command );
		}
	}

	private function reciever( $command ){
  	//reciever info                                                                                                                                                                             
    $ip   = "10.1.10.83";
    $port = "60128";
		$no_volume = strpos($command, '1MVL');

		if ( $no_volume === false ){
			if( $command != 'status' ){
				$command = '!' . $command;
			}
		} else {
			$command = $this->reciever_volume( $command );
		}
		//Open an ip stream                                                                                                                                                                         
		
		$fp = stream_socket_client("tcp://".$ip.":".$port, $errno, $errstr, 30);
		$debug = 1;
		
		//send a command to the amp                                                                                                                                                                 
    if ( isset ( $command ) ) {
			if ($command == "volume") {
				$var1 = $volume;
				$task = send_cmd($var1, $fp, $debug);
			} elseif ($command == "status"){
				$var2 = $this->get_status("!1DIFQSTN", $fp, $debug);
			} else {
				$var1 = $command;
				$task = $this->send_cmd($var1, $fp, $debug);
			}
    } else {
			$var1 = "Not Set";
		}
		fclose($fp);
	}

  private function reciever_volume( $volume ){
	  $volume = substr( $volume, 4, 2 );
	  $volume = ( $volume * 36 ) / 100;
	  $volume = round( $volume, 0 );
	  if( $volume < 10){
	          $volume = '0' . $volume;
	  }
	  $volume = '!1MVL' . $volume;
	  return $volume;
  }

  private function send_cmd($cmd, $fp, $debug){
	  $length=strlen($cmd);
	  $length=$length+1;
	  $total =$length+16;
	  $code  =chr($length);
	  $line  ="ISCP\x00\x00\x00\x10\x00\x00\x00$code\x01\x00\x00\x00".$cmd."\x0D";
	  if ($debug) {
			echo "\n*** send_cmd:".$line;
	  }
	  fwrite($fp, $line);
	  return $line;
  }

	private function get_status($cmd, $fp, $debug){
	  do {
	    $this->send_cmd($cmd, $fp, $debug);
	    $status = "";
	    $status = fread($fp, 80);
	    $status = substr($status, strpos($status, "!"));
	    $status = substr($status, 0, strlen($status)-3);
      if ($debug) {
				echo "\n*** get_status:".$cmd." : ".$status;
      }
	  } 
	  while (substr_compare($status, "!1NTM", 0, 5) == 0);
	  	return $status;
	}	

}

/* End of file app_remote.php */
/* Location: ./application/controllers/apps/app_remote.php */