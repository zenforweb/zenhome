<?php
	// DASHBOARD
	// app_weather
	// app_networkscan

?>

<script type="text/javascript">
	jQuery('document').ready(function($){
		<?
		foreach( $enabled as $app ){
			?>
			$.get("<? echo base_url() .'apps/'. $app->slug_name .'/portlet'; ?>", function(data) { $('#row_1').append(data); });
			<?
		}
		?>
	});
</script>

<div id="wrap" class="container-fluid">
	<!-- Example row of columns -->
	<div id="row_1" class="row-fluid">
	</div>
</div>