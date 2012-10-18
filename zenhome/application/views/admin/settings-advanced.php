<?php
	// ADMIN :: SETTINGS :: ADVANCED
?>

<div id="wrap" class="container-fluid">
	<div class="row-fluid">
		<div class="span4">
			<h3>Admin Advanced Settings</h3>
		</div>

		<div class="span2 pull-right">
			<div class="dropdown pull-right">
	  		<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
	  			<i class="icon-white icon-chevron-down"></i> Options
	  		</a>
	  		<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
	    		<li><a href="#change_password" data-toggle="modal">Add User</a></li>
	  		</ul>
			</div>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span3">
			<div class="well sidebar-nav">
				<ul class="nav nav-list">
				  <li class="nav-header">General</li>
				  <li><a href="<? echo base_url(); ?>admin/settings/basic">Basic Settings</li>
				  <li><a href="<? echo base_url(); ?>admin/settings/advanced">Advanced Settings</a></li>
				  <li class="nav-header">Users</li>
				  <li><a href="<? echo base_url(); ?>admin/home">All Users</a></li>
				  <li class="nav-header">Apps</li>
				  <li><a href="<? echo base_url(); ?>admin/apps">Control Panel </a></li>		  
				  <li class="nav-header">Devices</li>
				  <li><a href="#">All Devices</a></li>
				</ul>
      </div>			
		</div>

		<div class="span9">
			here we will put the advanced settings and junk
		</div>
	</div>
</div>