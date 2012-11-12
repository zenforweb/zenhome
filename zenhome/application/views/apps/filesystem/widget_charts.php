<?
/*
*	FILESYSTEM :: CHART WIDGET
*
*/
?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawChart_totalSpace);
	function drawChart_totalSpace() {
		console.log( 'running now' );
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
</script>
<div id="app-widget-filesystem-chart" class="widget span4 shadow">	
	<div class="widget-header header-gradient">
		<a href="<? base_url(); ?>apps/filesystem" class="pull-left">
			<h2>Filesystem</h2>
		</a>
		<div class="widget-controls pull-right">
			<span class="icon-chevron-up"></span>
			<span class="icon-remove"></span>
		</div>	  
	</div>
	<div class="widget-body">
		<div id="chart_totalSpace" class="span6" style="height:400px;"></div>
	</div>
</div>