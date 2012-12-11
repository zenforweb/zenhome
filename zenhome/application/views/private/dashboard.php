<?php
	// DASHBOARD
	// app_weather
	// app_networkscan

?>

<script type="text/javascript">
	jQuery('document').ready(function($){
		<?
		foreach( $widgets as $widget ){
			?>
			$.get("<? echo base_url() .'apps/'. $widget['widget_uri']; ?>", function(data) { $('#widget_platter').append(data); });
			<?
		}
		?>
	});
</script>

<div id="wrap" class="container-fluid">
	<div id="widget_platter" class="row-fluid"></div>
</div>