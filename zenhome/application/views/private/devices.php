<?php
	// DEVICES index
?>

<div id="wrap" class="container-fluid">
	<!-- Page Title -->
	<div class="row-fluid">
		<div class="span4">
				<h3>Devices</h3>
		</div>
		<div class="span3 pull-right">
			<div class="dropdown">
	  		<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
	  			<i class="icon-white icon-chevron-down"></i> Options
	  		</a>
	  		<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
	    		<li><a href="#">All Devices</a></li>
	    		<li><a href="#">Your Devices</a></li>
	    		<li><a href="#add_device" data-toggle="modal">Add Device</a></li>
	  		</ul>
			</div>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span8">
			<table class="table table-striped">
				<thead>
					<tr>
						<th></th>
						<th>ID</th>
						<th>Device Name</th>
						<th>Last IP</th>
						<th>Last Seen</th>
					</tr>
				</thead>				
				<?
				if( isset( $devices ) && count( $devices ) > 0 ){
					foreach( $devices as $device ) {
						?>
						<tr>
							<td>
								<img width="50" src="<? echo base_url() . FRONT_END; ?>img/network_icons/<? echo $device->device_type; ?>.png"
							</td>
							<td><? echo $device->device_id; ?></td>
							<td><? echo $device->device_name; ?></td>
							<td></td>
							<td></td>
						</tr>
						<?
					}
				} else {
					?>
					<tr>
						<td colspan="4" style="text-align:center;">You currently don't have any registered devices, add one!</td>
					</tr>
					<?
				}
				?>
			</table>
		</div>
		<div class="span4">
		</div>
	</div>
</div>


<!-- MODEL: ADD DEVICE -->
<div class="modal fade" id="add_device">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">x</button>
    <h3>Add a New Device</h3>
  </div>

	<form action="<? echo base_url(); ?>devices/add_device" method="POST">
		<div class="modal-body">
	    <fieldset>
	      <div class="control-group">
	        <label class="control-label" for="device_name">Device Name</label>
	        <div class="controls">
	          <input name="device_name" class="input-xlarge focused" id="device_name" type="text" value="">
	        </div>
	      </div>

	      <div class="control-group">
	        <label class="control-label" for="focusedInput">Device Type</label>
	        <div class="controls">
	        	<select name="device_type">
	        		<option value="1">Desktop</option>
	        		<option value="2">Laptop</option>
	        		<option value="3">Tablet</option>
	        		<option value="4">Phone</option>
	        		<option value="5">Router</option>
	        		<option value="6">Camera</option>
	        		<option value="7">Tv</option>
	        		<option value="8">Reciever</option>
	        		<option value="9">Server</option>
	        		<option value="10">Micro Controller</option>
	        	</select>
	        </div>
	      </div>

	      <div class="control-group">
	        <label class="control-label" for="device_user">Usage</label>
	        <div class="controls">
	        	<select name="device_user" id="device_user">
	        		<option value="<? echo $user['user_id']; ?>">Personal Device</option>
	        		<option value="0">Shared</option>
	        	</select>
	        </div>
	      </div>  
	    </fieldset>
		</div>
	  <div class="modal-footer">
	    <a data-dismiss="modal" href="#" class="btn">Close</a>
	    <button type="submit" class="btn btn-primary">Save</button>
	  </div>
  </form>
</div>