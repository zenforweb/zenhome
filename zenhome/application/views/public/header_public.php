<!DOCTYPE html>
<html>
	<head>
		<title>ZenHome</title>
		<!-- Bootstrap -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="<?php echo base_url() . FRONT_END ; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="a/css/bootstrap-responsive.css" rel="stylesheet">
		<link href="<?php echo base_url() . FRONT_END; ?>css/layout.css" rel="stylesheet">
		<!-- @todo dynamically load media files -->
		<link href="<?php echo base_url() . FRONT_END; ?>css/media/phone.css" rel="stylesheet">
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="<?php echo base_url() . FRONT_END; ?>bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body>

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