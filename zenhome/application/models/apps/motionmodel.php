<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MotionModel extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function systemArm( $user_id, $cam, $value, $url ){
		$this->sendCurl( $url );
		$this->db->query( "INSERT INTO `". DB_NAME ."`.`apps_motion_arm` ( `user_id`, `cam`, `value` ) VALUES( '$user_id', $cam, $value )" );
	}

	public function systemStatus(){
		$query = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`apps_motion_arm` ORDER BY `id` DESC LIMIT 1" );
	  $package = $query->result();
	  return array(
	  	'armed' => $package[0]->value,
	  	'user'  => $this->getUser( $package[0]->user_id ),
	  	'date'  => $package[0]->date,
	  );
	}

	public function readRecentImages(){
			//@todo: set this from app settings
		$security_dir = '/media/colfax/Security/' . date( 'Y/m/d' );
			//@todo: set this from app settings
		$public_dir   = 'security/' . date( 'Y/m/d/' );
		$images = array();
		if( is_dir( $security_dir ) ){
			$dir_files = scandir( $security_dir );
			foreach ( $dir_files as $file ) {
				$blownUp = explode( '.', $file );
				if( $blownUp[1] == 'jpg' ){
					$images[] = $public_dir . $file;
				}
			}
			return array_reverse( $images );
		}
		return false;
	}

		//@note: 
	public function readMotion( $timespan = Null ){
		if( $timespan == Null){
			$timeback = date ( 'Y-m-d G:i:s', time() - 86400 );	
		}
		$query = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`apps_motion` WHERE `input_ts` > '$timeback' ORDER BY `row_id` DESC" );
			//@todo: read the app_setting for url_image_path
		$public_fp = 'security/' . date( 'Y/m/d' );
		$recording = array();
		$i = 0;
		foreach ($query->result() as $row){
			$recording[$i]['row_id'] = $row->row_id;
				//@todo: steamline camera ids
			$recording[$i]['camera'] 					= $row->camera ;
			$recording[$i]['sys_img_path']  	= $row->filename;
				//@todo: read the app_setting for url_image_path
			$recording[$i]['url_image_path']  = $public_fp . '';
			$recording[$i]['input_ts'] 				= $row->input_ts;
			$recording[$i]['event_ts'] 				= $row->text_event;
			$recording[] = $row;
		}
		return $recording;
	}

	private function sendCurl( $url ){
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 		$contents = curl_exec ($ch);
		curl_close ($ch);
		return $contents;
	}

	private function getUser( $user_id ){
		$ci =& get_instance();
		$ci->load->model('AccountModel');
		return $ci->AccountModel->userInfo( $user_id ); 
	}
}