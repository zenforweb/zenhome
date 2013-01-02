<?php
	// ADMIN :: SETTINGS :: BASIC
?>

<div id="wrap" class="container-fluid">
	<div class="row-fluid">
		<div class="span4">
			<h3>Admin Basic Settings</h3>
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
		<!-- Admin Menu -->
		<div class="span3">
			<div class="well sidebar-nav">
				<ul class="nav nav-list">
					<?
					foreach ($admin_menu as $title => $menu) {
						?>
						<li class="nav-header"><? echo $title; ?></li>
						<?
						foreach ($menu as $name => $link) {
							?>
							<li><a href="<? echo base_url() . $link ; ?>"><? echo $name; ?></a></li>
							<?
						}
					}
					?>
				</ul>
			</div>
		</div>

		<div class="span9 box">
			<div class="box-header header-gradient">
				<h2>Basic Settings</h2>
			</div>
			<div class="box-body">
				<form>
					<span class="span2"> Site Url:</span>
					<input value="<? echo $site_url; ?>" name="site_url" class="input input-xlarge span10" disabled>
				</form>
				here we will put the basic settings and junk
			</div>
		</div>
	</div>
</div>