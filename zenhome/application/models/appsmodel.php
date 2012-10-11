<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AppsModel extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function getAllApps(){
		$query = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`apps_info`" );
		$apps = array();
		foreach ($query->result() as $row){
			$apps[] = $row;
		}
		return $apps;
	}

	public function getEnabledApps(){
		$query = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`apps_info` WHERE `enabled` = 1 " );
		$apps = array();
		foreach ($query->result() as $row){
			$apps[] = $row;
		}
		return $apps;
	}
	
	public function getApp( $app_id ){
	       $query   = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`apps_info` WHERE `row_id` = ". $app_id ." LIMIT 1" );
	       $package = $query->result();
	       return $package[0];
	}

	public function enableApp( $app_id ){
		//@todo santize $app_id
		$this->db->query( "UPDATE `". DB_NAME ."`.`apps_info` SET `enabled` = 1 WHERE `row_id` = '$app_id'" );
	}

	public function disableApp( $app_id ){
		//@todo santize $app_id
		$this->db->query( "UPDATE `". DB_NAME ."`.`apps_info` SET `enabled` = 0 WHERE `row_id` = '$app_id'" );
	}

	public function getAppID( $app_slug ){
		$query  = $this->db->query( "SELECT * FROM `". DB_NAME . "`.apps_info WHERE `slug_name` = '" . $app_slug . "' LIMIT 1"  );
		$return = $query->result();
		return $return[0]->row_id;
	}

	public function getEnabledAppsForUser( $user_id ){
	       $query = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`user_apps_settings` WHERE `setting_name` = 'enabled' AND `setting_value` = '1' AND `user_id` = ". $user_id ." AND `app_id` IN( ". $this->getEnabledAppsCommaSeperated() ." )" );
	       //echo "<pre>"; print_r($query); die();
	       $apps = array();
	       foreach( $query->result() as $row ){
	       		$apps[] = $this->getApp( $row->app_id );	
	       }
	       return $apps;
	}

	public function getUserAppSettings( $app_id, $user_id ){
		$query = $this->db->query( "SELECT * FROM `". DB_NAME . "`.user_apps_settings WHERE `user_id` = ". $user_id ." AND `app_id` = ". $app_id ) ;
		$user_settings = array();
		foreach ($query->result() as $row){
			$user_settings[$row->setting_name] = $row;
		}
		if( count( $query->result() ) == 0 ){
			$row = $query->result();
			$user_settings['enabled'] = '';
		}

		return $user_settings;
	}	

	public function enableUserApp( $app_id, $user_id ){
		$query  = $this->db->query( "SELECT * FROM `". DB_NAME . "`.user_apps_settings WHERE `user_id` = " . $user_id . " AND `app_id` = " . $app_id . " AND `setting_name` = 'enabled'" );
		$result = $query->result();
		if( isset( $result[0]->setting_id ) ){
			$this->db->query( "UPDATE `". DB_NAME . "`.`user_apps_settings` SET `setting_value` = 1 WHERE `setting_id` = " . $result[0]->setting_id );
		} else {
			$this->db->query( "INSERT INTO `". DB_NAME . "`.`user_apps_settings` (`setting_name`, `setting_value`, `user_id`, `app_id`) VALUES( 'enabled', '1', ".$user_id.", ".$app_id." )"   );
		}
	}

	public function disableUserApp( $app_id, $user_id ){
		$query  = $this->db->query( "SELECT * FROM `". DB_NAME . "`.user_apps_settings WHERE `user_id` = " . $user_id . " AND `app_id` = " . $app_id . " AND `setting_name` = 'enabled'" );
		$result = $query->result();
		if( isset( $result[0]->setting_id ) ){
			$this->db->query( "UPDATE `". DB_NAME . "`.`user_apps_settings` SET `setting_value` = 0 WHERE `setting_id` = " . $result[0]->setting_id );
		} else {
			$this->db->query( "INSERT INTO `". DB_NAME . "`.`user_apps_settings` (`setting_name`, `setting_value`, `user_id`, `app_id`) VALUES( 'enabled', '0', ".$user_id.", ".$app_id." )"   );
		}
	}

	private function getEnabledAppsCommaSeperated(){
		$query = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`apps_info` WHERE `enabled` = 1 " );
		$apps = '';
		foreach ($query->result() as $row){
			$apps .= $row->row_id . ',';
		}
		return substr( $apps, 0, -1 );
	}

}
