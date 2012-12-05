<?php
	// ADMIN USER INFO
?>

<div id="wrap" class="container-fluid">
	<div class="row-fluid">
		<div class="span4">
			<h3>Admin: User Roles</h3>
		</div>

		<div class="span2 pull-right">
			<div class="dropdown pull-right">
	  		<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
	  			<i class="icon-white icon-chevron-down"></i> Options
	  		</a>
	  		<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
	    		<!-- 
	    		<li><a href="<? echo base_url() . 'admin/users/become_user/'. $user_id; ?>" data-toggle="modal">Become User</a></li>
	  			-->
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

		<div class="box span9">
			<div class="box-header header-gradient">
				<h2>Roles</h2>
			</div>
			<div class="box-body">
				here goes the rolls
			</div>
		</div>
	</div>

</div>