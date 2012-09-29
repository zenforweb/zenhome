<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DeviceModel extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
	public function addDevice( $device_name, $device_type, $device_user ){
		$this->load->database();
	    $this->db->query( "INSERT INTO `zenhome`.`device_info` ( `device_name`, `user_id`, `device_type` ) VALUES( '$device_name', '$device_user', '$device_type' )" );
	}

	public function getDevices(){
		$this->load->database();
		$query = $this->db->query( "SELECT * FROM `zenhome`.`device_info`" );
		$devices = array();
		foreach ($query->result() as $row){
			$devices[] = $row;
		}

		return $devices;
	}

}
