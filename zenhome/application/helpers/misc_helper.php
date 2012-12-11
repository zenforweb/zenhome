<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('getIP')){
	function getIP(){
		foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_\FORWARDED', 'REMOTE_ADDR') as $key) {
			if (array_key_exists($key, $_SERVER) === true) {
				foreach (explode(',', $_SERVER[$key]) as $ip) {
					if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
						$explode = explode(".", $ip);
						
						if( $explode[0] == 10 ){
						  $local = True;
						} elseif( $explode[0] == 172 && $explode[0] <= 32 && $explode[0] >= 16 ){
						  $local = True;
						} elseif( $explode[0] == 192 && $explode == 168){
						  $local = True;
						} else {
						  $local = False;
						}

						if( $local ){
						    return array( $ip, 'local' );
						} else {
						  return array( $ip, 'outside' );
						}   
					}
				}
			}
		}
	}
}

if ( ! function_exists('format_time')){
	function format_time(  $time, $format = Null ){
		$stamp = strtotime( $time );
		if( $format == Null ){
			return date('D h:i:s', $stamp);
		} else {
			return date( $format, $stamp);	
		}
	}
}
?>

