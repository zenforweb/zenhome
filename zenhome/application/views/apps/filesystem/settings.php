<?php
/*
*	FILE SYSTEM :: GENERIC SETTINGS TEMPLATE
*
*/
?>

<div id="wrap" class="container-fluid">
	<!-- Page Title -->
	<div class="row-fluid">
		<div class="span4">
				<h3>File System Settings</h3>
		</div>
		<div class="span2 pull-right">
			<div class="dropdown pull-right">
				<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="icon-white icon-chevron-down"></i> Options
				</a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li><a href="<? echo base_url(); ?>apps/filesystem">File System</a></li>
					<li><a href="<? echo base_url(); ?>apps/filesystem/settings">Settings</a></li>
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
									<input name="device_name" class="input-xlarge focused" id="device_name" type="text" value="52342342342423423424243234">
							<span class="help-block"><small>Get your key from <a href="http://www.wunderground.com/weather/api/">Weather Undground</a></small></span>
							 </div>
							 <label class="control-label" for="device_name">Zipcode</label>
							 <div class="controls">
									<input name="device_name" class="input-small focused" id="device_name" type="text" value="80401">
							</div>
					</div>					
					<div class="control-group">
						<div class="controls">
								 <label class="control-label" for="current_weather">Run Current Weather</label>
								 <div class="btn-group" data-toggle="buttons-radio">
												<button type="button" class="btn active">On</button>
									<button type="button" class="btn">Off</button>
								</div>
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
								 <label class="control-label" for="current_weather">Run Weather Alerts</label>
								 <div class="btn-group" data-toggle="buttons-radio">
											<button type="button" class="btn">On</button>
											<button type="button" class="btn active">Off</button>
								</div>
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
								 <div class="btn-group" data-toggle="buttons-radio">
										<button type="submit" class="btn btn-primary">Submit</button>
								</div>
						</div>
					</div>

				</fieldset>
			</form>
		</div>
	</div>
</div>