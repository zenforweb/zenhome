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
<div id="app-widget-filesystem-chart" class="box span4 shadow">	
	<div class="box-header header-gradient">
		<a href="<? base_url(); ?>apps/filesystem" class="pull-left">
			<h2>Filesystem</h2>
		</a>
		<div class="box-controls pull-right">
			<span class="icon-chevron-up"></span>
			<span class="icon-remove"></span>
		</div>	  
	</div>
	<div class="box-body">
		Some work needs to be done to get charts loaded on the dashboard
		<div id="chart_totalSpace" class="span6" style="height:400px;"></div>
	</div>
</div>