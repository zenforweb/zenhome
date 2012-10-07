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
				<h3>Weather Settings</h3>
		</div>
		<div class="span3 pull-right">
			<div class="dropdown">
	  		<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
	  			<i class="icon-white icon-chevron-down"></i> Options
	  		</a>
	  		<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
	    		<li><a href="#">Weather</a></li>
	    		<li><a href="<? echo base_url(); ?>apps/app_weather/settings">Settings</a></li>
	  		</ul>
			</div>
		</div>		
	</div>

	<div class="row-fluid">
		<div class="span8">
			<form>
		    <fieldset>
					<div class="control-group">
					  <label class="control-label" for="device_name">Api Key</label>
					  <div class="controls">
					    <input name="device_name" class="input-xlarge focused" id="device_name" type="text" value="">
					  </div>
					</div>
					<div class="control-group">
					  <div class="controls">
					    <button type="submit" class="btn btn-primary">Submit</button>
					  </div>
					</div>

			</form>
		</div>
	</div>
</div>