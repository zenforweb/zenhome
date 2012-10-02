<?php
/*
*	Weather :: GENERIC INDEX TEMPLATE
*
*/
?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Day', 'Avg', 'High', 'Low'],
      <?
      foreach ($stats as $day => $stat) {
      	echo "['" . $day . "', " . $stat['avg'] . ", " . $stat['high'] . ", " . $stat['low'] . "],";
      }
      ?>
    ]);

    var options = {
      title: 'Weather'
    };

    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
</script>

<div id="wrap" class="container-fluid">
	<!-- Page Title -->
	<div class="row-fluid">
		<div class="span4">
				<h3>Outdoor Weather</h3>
		</div>
		<div class="span3 pull-right">
			<div class="dropdown">
	  		<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
	  			<i class="icon-white icon-chevron-down"></i> Options
	  		</a>
	  		<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
	    		<li><a href="#">Enable</a></li>
	    		<li><a href="<? echo base_url(); ?>apps/app_weather/settings">Settings</a></li>
	  		</ul>
			</div>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span8">
			Let's do some stats!
			<div id="chart_div" style="width: 600px; height: 300px;"></div>
		</div>
	</div>
</div>