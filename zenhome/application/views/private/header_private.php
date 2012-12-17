<!DOCTYPE html>
<html>
	<head>
		<title>ZenHome</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="<?php echo base_url() . FRONT_END; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url() .FRONT_END; ?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="<?php echo base_url() . FRONT_END; ?>css/helpers.css" rel="stylesheet">			
		<link href="<?php echo base_url() . FRONT_END; ?>css/layout.css" rel="stylesheet">	
				<!-- @todo dynamically load media files ie desktop, tablet, mobile-->
		<!-- <link href="<?php echo base_url() . FRONT_END; ?>css/media/phone.css" rel="stylesheet"> -->
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="<?php echo base_url() . FRONT_END; ?>bootstrap/js/bootstrap.js"></script>

		<script type="text/javascript">var base_url = '<? echo base_url(); ?>';</script>
		<script src="<?php echo base_url() . FRONT_END; ?>js/notify.js"></script>
		<script src="<?php echo base_url() . FRONT_END; ?>js/box-controls.js"></script>
		
		<style type="text/css">
		  body {
				background-image: url('<? echo base_url() . FRONT_END; ?>img/backgrounds/body-bg.png');
		  }
		</style>

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
							<img src="http://0.gravatar.com/avatar/<? echo $this->user['gravatar']; ?>?s=20&r=pg&d=mm"/>
						<? echo ucfirst( $this->user['user_name'] ); ?>
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="<? echo base_url(); ?>profile">Profile</a></li>
								<?
									if( $userACL->hasPermission( 'access_admin' ) ){
										?>
										<li><a tabindex="-1" href="<? echo base_url(); ?>admin/home">Admin</a></li>
										<?
									}
								?>
								<li class="divider"></li>
								<li><a href="<? echo base_url(); ?>outside/logout">Logout</a></li>  						
						</ul>
					</li>
				</ul>
			</div>
		</div>
		<style type="text/css">
			#notify{
				z-index: 10;
				position: fixed;
				right: 20px;
				width: 400px;
			}
			#notify ul {
				list-style: none;
			}
		</style>

		<div id="notify">
			<ul>
			<?
			  if( isset( $_SESSION['message'] ) ){
					?>
					<li class="alert alert-<? echo $_SESSION['message']['type']; ?>" style="display:none;">
						<? echo $_SESSION['message']['msg']; ?>
						<button type="button" class="close" data-dismiss="alert">x</button>
					</li>
			  <? } ?>
			</ul>
		</div>
