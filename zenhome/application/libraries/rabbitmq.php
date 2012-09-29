<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class RabbitMQ {

	function __construct(){

		$this->base_url = 'http://10.1.10.52/php-amqplib2/demo/amqp_publisher_zen.php?';
	}

	private function set_up(){

	}

    public function publisher( $routing_key, $message ){
		$full_url = $this->base_url . 'r=' . urlencode( $routing_key ) . '&m=' . urlencode( $message );
		file_get_contents( $full_url );
		exit();
    }



}

