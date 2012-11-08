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

		$('.widget .widget-controls .icon-remove').live('click', function(){
			var btn  		= $(this),
					widget  = btn.closest('.widget');
			widget.removeClass('shadow');
			widget.fadeOut(1000, function(){
				widget.remove();
			});
		});

		$('.widget .widget-controls .icon-chevron-up, .widget .widget-controls .icon-chevron-down' ).live('click', function(){
			var btn  			  	= $(this),
					widget_body   = btn.parent().parent().parent().find('.widget-body');
			widget_body.slideToggle();
			if( btn.hasClass('icon-chevron-up') ){
				btn.removeClass('icon-chevron-up');
				btn.addClass('icon-chevron-down');
			} else {
				btn.removeClass('icon-chevron-down');				
				btn.addClass('icon-chevron-up');
			}
		});

	});
</script>

<div id="wrap" class="container-fluid">
	<!-- Example row of columns -->
	<div id="widget_platter" class="row">
	</div>
</div>