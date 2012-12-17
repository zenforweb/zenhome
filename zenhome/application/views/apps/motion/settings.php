<?php
/*
*	MOTION :: SETTINGS
*
*/
?>

<div id="wrap" class="container-fluid">
	<!-- Page Title -->
	<div class="row-fluid">
		<div class="span4">
				<h3>Motion Settings</h3>
		</div>
		<div class="span2 pull-right">
			<div class="dropdown pull-right">
	  		<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
	  			<i class="icon-white icon-chevron-down"></i> Options
	  		</a>
	  		<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
	    		<li><a href="<? echo base_url(); ?>apps/motion/"; >Motion</a></li>
	    		<li><a href="#">Settings</a></li>
	  		</ul>
			</div>
		</div>		
	</div>

	<div class="row-fluid">

		<div class="span8 box shadow">
			<div class="box-header header-gradient">
				<h2>Motion Settings</h2>
			</div>
			<div class="box-body">
				<form action="<? echo base_url() . 'apps/motion/settings_save/'; ?>">
			    <fieldset>
					<div class="control-group">
					    
						<label class="control-label" for="device_name">Motion Config Url</label>
						<div class="controls">
							  <input name="motion_config_url" class="input-xlarge focused" id="device_name" type="text" 
							  	value="<? if( isset( $app_settings['motion_config_url'] ) ) { echo $app_settings['motion_config_url']; } ?>">
						    <span class="help-block"><small>Ex: 192.168.1.100:8080</small></span>
						</div>
				    
				    <label class="control-label" for="motion_config_user">Motion Config User</label>
						<div class="controls">
						    <input name="motion_config_user" class="input-xlarge" id="motion_config_user" type="text" 
						    value="<? if( isset( $app_settings['motion_config_user'] ) ) { echo $app_settings['motion_config_user']; } ?>">
						</div>

						<label class="control-label" for="motion_config_password">Motion Config Password</label>
						<div class="controls">
						    <input name="motion_config_password" class="input-xlarge " id="motion_config_password" type="password" 
						    	value="<? if( isset( $app_settings['motion_config_password'] ) ) { echo $app_settings['motion_config_password']; } ?>">
						</div>

						<label class="control-label" for="motion_security_path">Motion Archive Path</label>
					  <div class="controls">
					    <input name="motion_security_path" class="input-xlarge" id="motion_security_path" type="text" 
					    	value="<? if( isset( $app_settings['motion_security_path'] ) ) { echo $app_settings['motion_security_path']; } ?>">
					    <span class="help-block"><small>Ex: /media/Security</small></span>  
						</div>

						Cameras

						<div id="motion_cameras">
							<div class="controls row-fluid">
								<label class="control-label span2" for="motion_cam_1">Camera 1</label>
								<input name="motion_cam_1" class="input-xlarge span3" id="motion_cam_1" type="text" 
								value="<? if( isset( $app_settings['motion_cam_1'] ) ) { echo $app_settings['motion_cam_1']; } ?>">
							</div>
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<? if( $userACL->hasPermission( 'edit_apps' ) ){ ?>
						  	<button type="submit" class="btn btn-primary">Save</button>
						  <? } ?>
						  </div>
						</div>
				</form>
			</div>
		</div>
	</div>
</div>