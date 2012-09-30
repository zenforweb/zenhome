<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model {
    function __construct() {
        parent::__construct();
    }

	public function verify_user( $user_name, $password, $log = True ){
		$this->load->database();
		$result  = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`user_secure` WHERE `user_name`='$user_name' AND `user_pass`='$password'" );
		$success = $result->row();
		if( $success ){
			if ( $log )
				$this->logAccess( $success->user_id );
			return $success->user_id;
		} else {
			//@todo log_failure();
			return False;
		}
	}

	public function logAccess( $user_id ){
		$ip_info = getIP();
		$this->db->query( "INSERT INTO `". DB_NAME ."`.`user_access` ( `user_id`, `ip` ) VALUES( '$user_id', '$ip_info[0]' )" );
	}
	
	public function addUser( $user_name, $user_pass ){
		$this->load->database();
	    $this->db->query( "INSERT INTO `". DB_NAME ."`.`user_secure` ( `user_name`, `user_pass` ) VALUES( '$user_name', '$user_pass' )" );
	    $query = $this->db->query( "SELECT `user_id` FROM `". DB_NAME ."`.`user_secure` ORDER BY `user_id` DESC LIMIT 1" );
	    $user = $query->row();
	    $user_id = $user->user_id;
		$this->db->query( "INSERT INTO `". DB_NAME ."`.`user_information` ( `user_id`, `user_name` ) VALUES( '$user_id', '$user_name' )" );
	}

	public function getUsers(){
		$this->load->database();
		$query = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`user_information`" );
		$users = array();
		$i = 0;
		foreach ($query->result() as $row){
			if( ! ALLOW_GUESTS && $row->user_id == 1)
				continue;
			$users[$i]['info'] = $row;
			$query = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`user_access` WHERE `user_id` = '$row->user_id' ORDER BY `row_id` DESC LIMIT 1");			
			$access = $query->result();
			if( count($access) > 0 )
				$users[$i]['access'] =  $access[0];
			$i++;
		}

			// Alix {debug}
		//echo "<pre>"; print_r( $users ); die();
		return $users;
	}

	public function change_password( $user_id, $new_password ){
		$this->load->database();
		$this->db->query( "UPDATE `". DB_NAME ."`.`user_secure` SET `user_pass` = '$new_password' WHERE `user_id` = '$user_id' " );
	}

	public function get_logs(){
  	// "select * from user_access where ip NOT LIKE '10%' AND ip NOT LIKE '192%'"
	}

}
