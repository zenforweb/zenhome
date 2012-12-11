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
		<div class="span8">
			<form>
		    <fieldset>
				<div class="control-group">
				    
					<label class="control-label" for="device_name">Motion Config Url</label>
					<div class="controls">
						  <input name="motion_config_url" class="input-xlarge focused" id="device_name" type="text" value="10.1.10.52:8080">
					    <span class="help-block"><small>Ex: 192.168.1.100:8080</small></span>
					</div>
			    
			    <label class="control-label" for="device_name">Motion Config User</label>
					<div class="controls">
					    <input name="motion_config_user" class="input-xlarge focused" id="device_name" type="text" value="brian">
					</div>

					<label class="control-label" for="device_name">Motion Config Password</label>
					<div class="controls">
					    <input name="motion_config_password" class="input-xlarge focused" id="device_name" type="password" value="cleancut">
					</div>

					<label class="control-label" for="device_name">Motion Archive Path</label>
				  <div class="controls">
				    <input name="motion_security_path" class="input-xlarge focused" id="device_name" type="text" value="/media/colfax/Security">
				    <span class="help-block"><small>Ex: /media/Security</small></span>  
					</div>

				</div>

				<div class="control-group">
					<div class="controls">
					  <button type="submit" class="btn btn-primary">Save</button>
					  </div>
					</div>
			</form>
		</div>
	</div>
</div>