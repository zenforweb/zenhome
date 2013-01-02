<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MotionModel extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->app_name = 'motion';
		$this->app_id   = $this->getAppID();
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

	public function getAppSettings(){
		$query = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`app_settings` WHERE `app_id` = " .$this->app_id. " AND `setting_name` != 'widget'" );
		$settings = array();
		foreach ($query->result() as $row ){
			$settings[$row->setting_name] = $row->setting_value;
		}
		if( isset( $settings['motion_config_user'] ) && isset( $settings['motion_config_pass'] ) && isset( $settings['motion_cam_1'] ) ){
			$settings['cameras'] = array( 'http://' . $settings['motion_config_user'] . ':' . $settings['motion_config_pass'] .'@' . $settings['motion_cam_1'] );

			//@todo: figur eout out to run this better for any ammount of cameras
			if( isset( $settings['motion_cam_2'] ) ){
				$settings['cameras'][] =  'http://' . $settings['motion_config_user'] . ':' . $settings['motion_config_pass'] .'@' . $settings['motion_cam_2'];
			}
		}

		return $settings;
	}

	public function settingsSave( $settings ){
		$updates = array();
		$updates['motion_config_url']          = isset( $settings['motion_config_url'] )           ? $this->db->escape( $settings['motion_config_url'] )      : '';
		$updates['motion_config_user']         = isset( $settings['motion_config_user'] )          ? $this->db->escape( $settings['motion_config_user'] )     : '';
		$updates['motion_config_pass']         = isset( $settings['motion_config_pass'] )          ? $this->db->escape( $settings['motion_config_pass'] )     : '';
		$updates['motion_security_path']       = isset( $settings['motion_security_path'] )        ? $this->db->escape( $settings['motion_security_path'] )   : '';
		$updates['motion_cam_1']               = isset( $settings['motion_cam_1'] )                ? $this->db->escape( $settings['motion_cam_1'] )           : '';
		$updates['motion_cam_2']               = isset( $settings['motion_cam_2'] )                ? $this->db->escape( $settings['motion_cam_2'] )           : '';
		$updates['motion_cam_3']               = isset( $settings['motion_cam_3'] )                ? $this->db->escape( $settings['motion_cam_3'] )           : '';
		$updates['motion_cam_4']               = isset( $settings['motion_cam_4'] )                ? $this->db->escape( $settings['motion_cam_4'] )           : '';
		$updates['motion_cam_5']               = isset( $settings['motion_cam_5'] )                ? $this->db->escape( $settings['motion_cam_5'] )           : '';
		$updates['motion_cam_6']               = isset( $settings['motion_cam_6'] )                ? $this->db->escape( $settings['motion_cam_6'] )           : '';
		$updates['motion_cam_7']               = isset( $settings['motion_cam_7'] )                ? $this->db->escape( $settings['motion_cam_7'] )           : '';
		$updates['motion_cam_8']               = isset( $settings['motion_cam_8'] )                ? $this->db->escape( $settings['motion_cam_8'] )           : '';		
		foreach ($updates as $key => $value) {
			if( !empty( $value ) ){
				$sql = "SELECT * FROM `". DB_NAME ."`.`app_settings` WHERE `app_id` = " .$this->app_id. " AND `setting_name` = '" .$key. "'";
				$result = $this->db->query( $sql );
				if( $result->num_rows == 0 ){
					$this->db->query( "INSERT INTO `". DB_NAME ."`.`app_settings` ( `setting_name`, `setting_value`, `app_id` ) VALUES( '$key', '$value', $this->app_id )" );
				} else {
					$this->db->query( "UPDATE `". DB_NAME ."`.`app_settings` SET `setting_value` = $value WHERE `app_id` = $this->app_id AND `setting_name` = '$key'" );
				}
			}
		}
	}

	public function install(){
		//Create the Tables
		$app_motion_sql = "CREATE TABLE IF NOT EXISTS `". DB_NAME ."`.`apps_motion` (
  		`row_id` int(11) NOT NULL AUTO_INCREMENT,
			`camera` int(11) DEFAULT NULL,
			`filename` varchar(60) DEFAULT NULL,
			`frame` int(11) DEFAULT NULL,
			`file_type` int(11) DEFAULT NULL,
			`input_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			`event_id` int(11) DEFAULT NULL,
			PRIMARY KEY (`row_id`)
			) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1";

		$app_motion_arm_sql = "CREATE TABLE IF NOT EXISTS `". DB_NAME ."`.`apps_motion_arm` (
  		`id` int(11) NOT NULL AUTO_INCREMENT,
  		`user_id` int(10) DEFAULT '0',
  		`cam` int(10) DEFAULT '0',
  		`value` int(1) DEFAULT '0',
  		`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  		PRIMARY KEY (`id`)
			) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8";
	}

	private function getAppID(){
		$sql = "SELECT * FROM `". DB_NAME ."`.`apps_info` WHERE `slug_name`= '". $this->app_name ."'";
		$row = $this->db->query( $sql )->result();
		return $row[0]->row_id;
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