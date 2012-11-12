<?php
/*
*	FILESYSTEM :: INDEX
*
*/
?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart_totalSpace);
  function drawChart_totalSpace() {
    var data = google.visualization.arrayToDataTable([
      ['Drive', 'Gigabytes'],
      <?
      foreach ($disks as $disk) {
      	?>
      	[<? echo "'" . ucfirst( $disk['pretty_name'] ) . "' , ". $disk['used']; ?>],
      	<?
      }
      echo "['Free Space', " .  $disk_stats['total_free'] ."],";
      ?>
    ]);

    var options = {
      title: 'Total Space'
    };
    var chart = new google.visualization.PieChart(document.getElementById('chart_totalSpace'));
    chart.draw(data, options);
  }

  <?
  foreach( $disks as $disk ){
  	?>
		google.setOnLoadCallback(drawChart_<? echo $disk['slug_name']; ?>);

	  function drawChart_<? echo $disk['slug_name']; ?>() {
	    var data = google.visualization.arrayToDataTable([
	      ['Drive', 'Gigabytes'],
	      <?
	      echo "['Free Space', " . $disk['avail']  ."],";
	      echo "['Used', " . $disk['used']  ."],";
	      ?>
	    ]);

	    var options = {
	      title: '<? echo ucfirst( $disk["pretty_name"] ); ?>'
	    };
	    var chart = new google.visualization.PieChart(document.getElementById('chart_disk<? echo $disk["slug_name"]; ?>'));
	    chart.draw(data, options);
	  }
  	<?
  }
  ?>
</script>
<div id="wrap" class="container-fluid">
	<!-- Page Title -->
	<div class="row-fluid">
		<div class="span4">
			<h3>File System</h3>
		</div>
		<div class="span2 pull-right">
			<div class="dropdown pull-right">
	  		<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
	  			<i class="icon-white icon-chevron-down"></i> Options
	  		</a>
	  		<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
	    		<li><a href="<? echo base_url(); ?>apps/filesystem/settings">Settings</a></li>
	  		</ul>
			</div>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span6">
			<div class="header-gradient">
				<a href=""><h2>Disk Stats</h2></a>
			</div>
			<? 
			foreach( $disks as $disk ){
				?>
				<div id="chart_disk<? echo $disk['slug_name']; ?>" style="height:300px;"></div>
				<?
			}
			?>
		</div>

		<div id="chart_totalSpace" class="span6" style="height:400px;"></div>
	</div>
</div>