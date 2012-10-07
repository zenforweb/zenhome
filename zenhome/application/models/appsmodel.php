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

	public function enableApp( $app_id ){
		//@todo santize $app_id
		$this->db->query( "UPDATE `". DB_NAME ."`.`apps_info` SET `enabled` = 1 WHERE `row_id` = '$app_id'" );
	}

	public function disableApp( $app_id ){
		//@todo santize $app_id
		$this->db->query( "UPDATE `". DB_NAME ."`.`apps_info` SET `enabled` = 0 WHERE `row_id` = '$app_id'" );
	}

	public function getApp( $app_slug ){
		$query  = $this->db->query( "SELECT * FROM `". DB_NAME . "`.apps_info WHERE `slug_name` = '" . $app_slug . "'"  );
		$return = $query->result();
		return $return[0]->row_id;
	}	

}
