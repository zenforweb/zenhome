<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AppsModel extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function getAllApps(){
		$this->load->database();
		$query = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`apps_info`" );
		$apps = array();
		foreach ($query->result() as $row){
			$apps[] = $row;
		}
		return $apps;
	}

	public function getEnabledApps(){
		$this->load->database();
		$query = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`apps_info` WHERE `enabled` = 1 " );
		$apps = array();
		foreach ($query->result() as $row){
			$apps[] = $row;
		}
		return $apps;
	}

	public function enableApp( $app_id ){
		$this->load->database();
		//@todo santize $app_id
		$this->db->query( "UPDATE `". DB_NAME ."`.`apps_info` SET `enabled` = 1 WHERE `row_id` = '$app_id'" );
	}

	public function disableApp( $app_id ){
		$this->load->database();
		//@todo santize $app_id
		$this->db->query( "UPDATE `". DB_NAME ."`.`apps_info` SET `enabled` = 0 WHERE `row_id` = '$app_id'" );
	}
}
