<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AccountModel extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function userInfo( $user_id ){
		$this->load->database();
		$result  = $this->db->query( "SELECT * FROM `zenhome`.`user_information` WHERE `user_id` = '$user_id'" );
		$user = $result->row();
		return array(
			'user_id' 	 => $user->user_id,
			'user_name'  => $user->user_name,
			'first_name' => $user->first_name,
			'last_name'  => $user->last_name,
		);
	}


}
