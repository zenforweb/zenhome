<!DOCTYPE html>
<html>
	<head>
		<title>ZenHome</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="<?php echo base_url() . FRONT_END; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url() .FRONT_END; ?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="<?php echo base_url() . FRONT_END; ?>css/layout.css" rel="stylesheet">
				<!-- @todo dynamically load media files -->
		<link href="<?php echo base_url() . FRONT_END; ?>css/media/phone.css" rel="stylesheet">
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="<?php echo base_url() . FRONT_END; ?>bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url() . FRONT_END; ?>js/libs/jquery-1.8.2.min.js"></script>
		<script type="text/javascript">
			var base_url = '<? echo base_url(); ?>';
		</script>
	</head>
	<body>
		<div class="hidden-phone navbar">
			<div class="navbar-inner">
				<a class="brand" href="<? echo base_url(); ?>dashboard">ZenHome</a>
				<ul class="nav">
					<?
					if( isset( $menu ) ){
						foreach ( $menu as $item ) {
							if( $item[1] == 'apps' ){
								?>
								<li class="dropdown">
							    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
							      Apps
							      <b class="caret"></b>
							    </a>
						  		<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
						  			<?
					  				foreach ($item[3] as $app) {
					  					?>
					  					<li><a href="<?php echo base_url() .'apps/'. $app[1]; ?>"><? echo $app[0]; ?></a></li>		
					  					<?
					  				}
						  			?>
						  		</ul>
								</li>
								<?
							} else {
								?>
								<li class="<? if( $item[2] ) { echo 'active'; } ?>">
									<a href="<?php echo base_url() . $item[1]; ?>"><? echo $item[0]; ?></a>
								</li>
								<?
							}
						}
					}
					?>
				</ul>

				<ul class="nav pull-right">
  				<li class="dropdown">
    				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
      				<? echo ucfirst( $this->user['user_name'] ); ?>
      				<b class="caret"></b>
   	 				</a>
    				<ul class="dropdown-menu">
    					<li><a href="<? echo base_url(); ?>profile">Profile</a></li>
							<li><a tabindex="-1" href="<? echo base_url(); ?>admin/home">Admin</a></li>
 							<li class="divider"></li>
 							<li><a href="<? echo base_url(); ?>outside/logout">Logout</a></li>  						
    				</ul>
  				</li>
				</ul>

			</div>
		</div>

		<?
		// display messages
		if( isset( $_SESSION['message'] ) ){
			?>
			<div class="row-fluid">
				<div class="span4 offset4 alert alert-<? echo $_SESSION['message']['type']; ?>">
					<button type="button" class="close" data-dismiss="alert">x</button>
					<? echo $_SESSION['message']['msg']; ?>
				</div>
			</div>
			<?
		}
		?>
