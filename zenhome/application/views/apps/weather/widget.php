<?
/*
*	WEATHER :: GENERIC PORTLET TEMPLATE
*
* 	// Weather custom user settings
* 		$widget_enabled 			@stdClass Obj
* 		$widget_graph					@stdClass Obj
* 		$temp_format					@string
*/
?>

<style type="text/css">
	.app_weather_temp{
		font-size: 30px;
		font-weight: 900;
	}
	.app_weather_humidity{
		font-size: 26px;
		font-weight: 900;
	}
</style>

<div id="app-widget-weather" class="widget span4 shadow">
	<div class="widget-header">
		<a href="<? echo base_url(); ?>apps/weather" class="pull-left">
			<h2>Weather</h2>
		</a>
		<div class="widget-controls pull-right">
			<span class="icon-chevron-up"></span>
			<span class="icon-remove"></span>
		</div>
	</div>
	<div class="widget-body">
		<span class="app_weather_temp"><? echo $current->temp_f; ?>&deg;</span>
		@
		<span class="app_weather_humidity"><? echo $current->rel_humidity; ?></span> humidity
		<br />
		<? echo $current->weather; ?>
		<br />
		Feels like <b><? echo $current->feelslike_f; ?></b>
		<br />
		Wind at <b><? echo $current->wind_mph; ?></b> MPH to the <? echo $current->wind_direction; ?>
		<br />
		<p>
			<a class="btn" href="<? echo base_url(); ?>apps/weather">View details &raquo;</a>
		</p>
	</div>
</div>