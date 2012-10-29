<?php
	// ADMIN USER INFO
?>

<div id="wrap" class="container-fluid">
	<div class="row-fluid">
		<div class="span4">
			<h3>Admin: User Info</h3>
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

		<div class="span3">
			<h4>Recent Connections</h4>
			<table class="table table-striped table-edit">
				<thead>
					<tr>
						<th>IP</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
					<?
					foreach ($logins as $login) {
						?>
						<tr>
							<td><? echo $login->ip; ?></td>
							<td><? echo $login->login_ts; ?></td>
						</tr>
						<?
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>