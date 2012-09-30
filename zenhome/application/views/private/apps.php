<?php
	// APPS index
?>

<div id="wrap" class="container-fluid">
	<!-- Page Title -->
	<div class="row-fluid">
		<div class="span4">
				<h3>Apps</h3>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span12">
			Enabled Apps, All Apps,
		</div>
	</div>
	<div class="row-fluid">
		<div class="span8">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>App Name</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Network Monitor</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td><a href="<? echo base_url(); ?>apps/app_weather">Weather</a></td>
						<td></td>
						<td><a href="<? echo base_url(); ?>apps/app_weather/settings" class="btn btn-primary btn-small"><i class="icon-cog icon-white"></i></a></td>
					</tr>
					<tr>
						<td>Remote</td>
						<td></td>
						<td></td>
					</tr>										
				<tbody>
			</table>
		</div>
		<div class="span4">
		</div>
	</div>
</div>







</body>
</html>