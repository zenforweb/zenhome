<?php
/*
*	Weather :: GENERIC INDEX TEMPLATE
*
*/
?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart_1);
  google.setOnLoadCallback(drawChart_2);
  function drawChart_1() {
    var data = google.visualization.arrayToDataTable([
      ['Day', 'Low', 'High', 'Avg'],
      <?
      foreach ($stats_overtime['data'] as $day => $stat) {
      	echo "['" . $stat['date_format'] . "', " . $stat['low'] . ", " . $stat['high'] . ", " . $stat['avg'] . "],";
      }
      ?>
    ]);

    var options = {
      title: 'Weather temps for the last <? echo $stats_overtime['count']; ?> days'
    };

    var chart = new google.visualization.LineChart(document.getElementById('chart_div_1'));
    chart.draw(data, options);
  }

  function drawChart_2() {
    var data = google.visualization.arrayToDataTable([
      ['Day', 'Today'],
      <?
      foreach ($stats_recent['last_24'] as $day => $stat) {
      	echo "['" . $stat['date_format'] . "', " . $stat['temp'] . " ],";
      }
      ?>
    ]);

    var options = {
      title: 'Weather temps for the last 24 hours'
    };

    var chart = new google.visualization.LineChart(document.getElementById('chart_div_2'));
    chart.draw(data, options);
  }  
</script>

<div id="wrap" class="container-fluid">
	<!-- Page Title -->
	<div class="row-fluid">
		<div class="span4">
			<h3>Weather</h3>
		</div>
		<div class="span3 pull-right">
			<div class="dropdown">
	  		<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
	  			<i class="icon-white icon-chevron-down"></i> Options
	  		</a>
	  		<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
	    		<li><a href="<? echo base_url(); ?>apps/weather">Weather</a></li>
	    		<li><a href="<? echo base_url(); ?>apps/weather/settings">Settings</a></li>
	  		</ul>
			</div>
		</div>
	</div>

	<div class="row-fluid">
		
		<div class="span3">
			<span class="app_weather_temp"><? echo $current->temp_f; ?>&deg;</span>
			@
			<span class="app_weather_humidity"><? echo $current->rel_humidity; ?></span> humidity
			<br />
			<? echo $current->weather; ?>
			<br />
			Feels like <b><? echo $current->feelslike_f; ?></b>
			<br />
			Wind at <b><? echo $current->wind_mph; ?></b> MPH to the <? echo $current->wind_direction; ?>
		</div>
	</div>
	
	<div class="row-fluid">
		<div class="span6">
			<div id="chart_div_1" style="width: 600px; height: 300px;"></div>
		</div>

		<div class="span6">
			<div id="chart_div_2" style="width: 600px; height: 300px;"></div>
		</div>

	</div>
	<div class="row-fluid">

	</div>


</div>