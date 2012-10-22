<?
/*
*	WEATHER :: GENERIC PORTLET TEMPLATE
*
* 	// Weather custom user settings
* 		$widget_enabled 			@stdClass Obj
* 		$widget_graph					@stdClass Obj
* 		$temp_format					@string
*/

	// Alix {debug}
//echo "<pre>"; print_r( $widget_graph ); die();
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

<div id="app_weather_widget" class="portlet span4">
	<h2>Weather</h2>
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