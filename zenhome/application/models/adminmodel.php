<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminModel extends CI_Model {

  function __construct() {
  	parent::__construct();
		$this->load->database();
  }
	
	public function getUserLogins( $user_id ){
	    $query = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`user_access` WHERE `user_id` = $user_id ORDER BY `row_id` DESC LIMIT 50" );
	    $logins = array();
			foreach ($query->result() as $row){
				$logins[] = $row;
			}
			return $logins;
	}

}
