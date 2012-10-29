<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FilesystemModel extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function checkForAppDiskSettings( $app_id ){
		$this->load->database();
		$query = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`app_settings` WHERE `app_id` = $app_id AND `setting_name` LIKE 'disk%'"  );
		if( count( $query->result() ) == 0 ){
			return False;
		} else {
			return True;
		}
	}

	public function scanDrives(){
		$shell = shell_exec('df -h');
		return $shell;
	}

}
