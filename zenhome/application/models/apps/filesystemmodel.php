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

	public function scanDrives( $allDisks = False ){
		$shell      = shell_exec('df -P');
		$shell_line = explode("\n", $shell);

		$disks = array();

		foreach ( $shell_line as $num => $line) {
			if( strpos( $line, 'lesystem' ) === False ){
				if( ! $line == ''  ){
					$disks[] =  $line;	
				}
			}	
		}

		$disk_details = array();
		foreach ( $disks as $num => $disk) {
			$details = explode( ' ', $disk );
			$disk_formated = array();
			foreach ( $details as $detail ){
				if( $detail == '' ){
					continue;
				} 
				$disk_formated[] = $detail;
			}
			$disk = array( 
				'name' 				=> $disk_formated[0],
				'size' 				=> round( $disk_formated[1] / (1024*1024), 2),	//kbytes to gigbytes //@todo: update so users can change the display size
				'used' 				=> round( $disk_formated[2] / (1024*1024), 2),
				'avail' 			=> round( $disk_formated[3] / (1024*1024), 2),
				'use' 				=> $disk_formated[4],
				'mount' 			=> $disk_formated[5],
			);

			$disk_details[] = $disk;
		}

		if( $allDisks ){
			return $disk_details;
		}

		$registeredDisks = array();
		foreach ($disk_details as $disk) {
			foreach ( $this->getDiskList() as $registered_disk_name ) {
				if( strpos( $disk['name'], $registered_disk_name ) ){
					$disk['pretty_name'] = $registered_disk_name;
					$disk['slug_name'] = $registered_disk_name;
					$registeredDisks[] = $disk;
				}
			}
		}

		return $registeredDisks;
	}

	private function getDiskList(){
		return array(
			'englewood', 'colfax', 'hoyt', 'lisbon'
		);
	}

	public function getDiskStats( $disks ){
		$total_free = '';
		$total_used = '';
		foreach ( $disks as $stat ) {
			$total_free = $total_free + $stat['avail'];
			$total_used = $total_used + $stat['used'];
		}

		return array( 
			'total_free' => $total_free,
			'total_used' => $total_used,
		);
	}

}