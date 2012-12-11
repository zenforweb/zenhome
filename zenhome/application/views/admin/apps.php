<?php
	// ADMIN :: APPS :: CONTROL PANEL
?>

<div id="wrap" class="container-fluid">
	<!-- Page Title -->
	<div class="row-fluid">
		<div class="span4">
				<h3>Admin Apps Control Panel</h3>
		</div>
		<div class="span3 pull-right">
			<div class="dropdown pull-right">
	  		<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
	  			<i class="icon-white icon-chevron-down"></i> Options
	  		</a>
	  		<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
	    		<li><a href="#">Enabled Apps</a></li>
	    		<li><a href="#">All Apps</a></li>
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

		<div class="span9">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>App Name</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?
					foreach( $apps as $app ){
						?>
						<tr>
							<td>
								<a href="<? echo base_url( 'apps/' . $app->slug_name ); ?>">
								<? echo $app->pretty_name; ?>
							</td>
							<td></td>
							<td>
								<? 
								if( !$app->enabled ){
									?>
									<a class="btn btn-success btn-small" href="<? echo base_url() . 'app/enable/' . $app->row_id; ?>">
										Enable
									</a>
									<?
								} else {
									?>
									<a class="btn btn-danger btn-small" href="<? echo base_url() . 'app/disable/' . $app->row_id; ?>">
										Disable
									</a>
									<?
								}
								?>
							</td>
						</tr>
						<?
					}
					?>								
				<tbody>
			</table>
		</div>
		<div class="span4">
		</div>
	</div>
</div>