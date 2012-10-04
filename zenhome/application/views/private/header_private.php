<!DOCTYPE html>
<html>
	<head>
		<title>ZenHome</title>
		<!-- Bootstrap -->
		<link href="<?php echo base_url() . FRONT_END; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url() .FRONT_END; ?>bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="<?php echo base_url() . FRONT_END; ?>css/layout.css" rel="stylesheet">
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="<?php echo base_url() . FRONT_END; ?>bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url() . FRONT_END; ?>js/libs/jquery-1.8.2.min.js"></script>
	</head>
	<body>
	<div class="navbar">
		<div class="navbar-inner">
			<a class="brand" href="<? echo base_url(); ?>dashboard">ZenHome</a>
			<ul class="nav">
				<?
					if( isset( $menu ) ){
						foreach ( $menu as $item ) {
							?>
							<li class="<? if( $item[2] ) { echo 'active'; } ?>">
								<a href="<?php echo base_url() . $item[1]; ?>"><? echo $item[0]; ?></a>
							</li>
							<?
						}
					}
				?>
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
