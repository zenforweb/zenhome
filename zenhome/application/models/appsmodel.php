<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AppsModel extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	/*
	*		@return array() of std objs
	* 	desc: gets all apps and info reguardless of being system enabled or not
	*/
	public function getAllApps(){
		$query = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`apps_info`" );
		$apps = array();
		foreach ($query->result() as $row){
			$apps[] = $row;
		}
		return $apps;
	}

	/*
	*		@return array() of std objs
	* 	desc: gets all system enabled apps.
	*/
	public function getEnabledApps(){
		$query = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`apps_info` WHERE `enabled` = 1 " );
		$apps = array();
		foreach ($query->result() as $row){
			$apps[] = $row;
		}
		return $apps;
	}

	/*
	*		@param $app_id
	*		@return array()
	* 	desc: gets an App's details by the id
	*/	
	public function getApp( $app_id ){
		$query   = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`apps_info` WHERE `row_id` = ". $app_id ." LIMIT 1" );
	  $package = $query->result();
		return $package[0];
	}

	public function enableApp( $app_id ){
		//@todo santize $app_id
		$this->db->query( "UPDATE `". DB_NAME ."`.`apps_info` SET `enabled` = 1 WHERE `row_id` = '$app_id'" );
	}

	public function disableApp( $app_id ){
		//@todo santize $app_id
		$this->db->query( "UPDATE `". DB_NAME ."`.`apps_info` SET `enabled` = 0 WHERE `row_id` = '$app_id'" );
	}

	/*
	*		@param $app_slug
	*		@return int
	* 	desc: gets an App ID by the slug title in app_info
	*/
	public function getAppID( $app_slug ){
		$query  = $this->db->query( "SELECT * FROM `". DB_NAME . "`.apps_info WHERE `slug_name` = '" . $app_slug . "' LIMIT 1"  );
		$return = $query->result();
		return $return[0]->row_id;
	}

	/*
	*		@param $app_slug
	*		@return int
	*/
	public function getEnabledAppsForUser( $user_id ){
		$query = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`user_apps_settings` WHERE `setting_name` = 'enabled' AND `setting_value` = '1' AND `user_id` = ". $user_id ." AND `app_id` IN( ". $this->getEnabledAppsCommaSeperated() ." )" );
		$apps = array();
		foreach( $query->result() as $row ){
				$apps[] = $this->getApp( $row->app_id );	
		}
		return $apps;
	}

	public function getUserAppSettings( $app_id, $user_id ){
		$query = $this->db->query( "SELECT * FROM `". DB_NAME . "`.user_apps_settings WHERE `user_id` = ". $user_id ." AND `app_id` = ". $app_id ) ;
		$user_settings = array();
		foreach ($query->result() as $row){
			$user_settings[$row->setting_name] = array(
				'setting_id' 		=> $row->setting_id,
				'setting_name'	=> $row->setting_name,
				'setting_value' => $row->setting_value,
				'user_id'				=> $row->user_id,
				'app_id'				=> $row->app_id,
			);
		}
		$full_details = array_merge( $this->getAllAppSettingsUser( $app_id, $user_id ), $user_settings );
		return $full_details;
	}

	public function update_user_setting( $app_id, $user_id, $setting_name, $setting_value){
		$query  = $this->db->query( "SELECT * FROM `". DB_NAME . "`.user_apps_settings WHERE `user_id` = " . $user_id . " AND `app_id` = " . $app_id . " AND `setting_name` = '" . $setting_name . "'" );
		$result = $query->result();
		if( isset( $result[0]->setting_id ) ){
			$this->db->query( "UPDATE `". DB_NAME . "`.`user_apps_settings` SET `setting_value` = '" . $setting_value . "' WHERE `setting_id` = " . $result[0]->setting_id );
		} else {
			$this->db->query( "INSERT INTO `". DB_NAME . "`.`user_apps_settings` (`setting_name`, `setting_value`, `user_id`, `app_id`) VALUES( '". $setting_name ."', '".$setting_value."', ".$user_id.", ".$app_id." )"   );			
		}
	}

	/*
	*		@param $user_id
	*		@return array() of app_id and widget_uris
	* 	desc: gets the users enabled dashboard widgets, returning the uri from the controller to load.
	*/
	public function getUserDashboard( $user_id ){
		$all_widgets = $this->getAllDashboardWidgets();
		$widgets_to_load = array();
		foreach ($all_widgets as $widget) {
			$query = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`user_apps_settings` WHERE `setting_name` = '$widget->setting_value' AND `app_id` = ".$widget->app_id . " AND `user_id` = " . $user_id );		
			if( count( $query->result() ) > 0 ){
				$result = $query->result();
				if( $result[0]->setting_value == 1 ){
					$widget_info = $this->getApp( $result[0]->app_id );
					$widgets_to_load[] = array(
						'app_name'    => $widget_info->pretty_name,
						'app_id'			=> $result[0]->app_id,
						'widget_uri'	=> $widget_info->slug_name .'/'. $result[0]->setting_name,
					);
				}
			}
		}
		return $widgets_to_load;
	}

	private function getAllDashboardWidgets(){
		$query = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`app_settings` WHERE `setting_name` = 'widget' AND `app_id` IN( " . $this->getEnabledAppsCommaSeperated() . " )" );
		$widgets = array();
		foreach ($query->result() as $row){
			$widgets[] = $row;
		}
		return $widgets;
	}

	private function getEnabledAppsCommaSeperated(){
		$query = $this->db->query( "SELECT * FROM `". DB_NAME ."`.`apps_info` WHERE `enabled` = 1 " );
		$apps = '';
		foreach ($query->result() as $row){
			$apps .= $row->row_id . ',';
		}
		return substr( $apps, 0, -1 );
	}

	/*
	*		@param 
	*			$app_id			int
	*			$user_id 		int
	*		@return array();
	* 	desc: gets all potential app settings for a user. 
	*					all possible app settings must be entered on install of app for the guest user ( id = 1 ).
	*/
	private function getAllAppSettingsUser( $app_id, $user_id ){
		$query = $this->db->query( "SELECT DISTINCT(`setting_name`) FROM ". DB_NAME . ".`user_apps_settings` WHERE `app_id` = $app_id" );
		$all_setting_types = array();
		foreach ($query->result() as $row){
			$all_setting_types[$row->setting_name] = array(
				'setting_id' 		=> '',
				'setting_name'	=> $row->setting_name,
				'setting_value' => '',
				'user_id'				=> $user_id,
				'app_id'				=> $app_id,				
			);
		}
		return $all_setting_types;
	}	

}