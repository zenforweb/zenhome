<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ChatModel extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function writeChat( $user_id, $message ){
		$this->db->query( "INSERT INTO `". DB_NAME ."`.`app_chat` ( `user_id`, `message` ) VALUES( '$user_id', ". $this->db->escape( $message ) . " )" );
	}

	public function readChat( $id = Null, $limit = 7 ){
		$hours24 = date ( 'Y-m-d G:i:s', time() - 86400 );
		if( !isset( $id ) ){
			$query = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`app_chat` WHERE date > '$hours24' ORDER BY `id` DESC" );
		} else {
			$query = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`app_chat` WHERE `id` > '" . $id . "'" );
		}
		$chats = array();
		$i = 0;
		foreach ($query->result() as $row){
			$chats[$i]['id']   = $row->id;
			$chats[$i]['date'] = $row->date;
			$chats[$i]['msg']  = $row->message;
		  $chats[$i]['user'] = $this->getUser( $row->user_id );
			$i++;
		}
		$chats = array_reverse( $chats );
		return $chats;
	}

	private function getUser( $user_id ){
		$ci =& get_instance();
		$ci->load->model('AccountModel');
		return $ci->AccountModel->userInfo( $user_id ); 
	}

}