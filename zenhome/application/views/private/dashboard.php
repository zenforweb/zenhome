<?php
	// DASHBOARD
	// app_weather



?>

<script type="text/javascript">
	jQuery('document').ready(function($){
		var app_url = "<? echo base_url(); ?>apps/app_weather/portlet";
		console.log( app_url );
		$('#row_1').load( app_url ); 
	});
	
	
</script>


<div id="wrap" class="container-fluid">

	<!-- Example row of columns -->
	<div id="row_1" class="row-fluid">

	</div>

</div>

</body>
</html>