<?php
/*
*	WEATHER :: USER SETTINGS
*	
* $app_info			@stdClass Obj
*	$enabled 			@bool
* $temp_format	@string
*
*/	

?>

<div class="container-fluid">
	<div class="row-fluid">
		<div class="span4">
			<h4>Outdoor Weather</h4>
		</div>
		<div class="span4 pull-right">
			<?
			if( isset( $enabled ) && $enabled->setting_value ){
				?>
					<a href="<? echo base_url(); ?>app/user_disable/<? echo $app_info->row_id; ?>" class="btn btn-danger">Disable</a>
				<?
			} else {
				?>
				<a href="<? echo base_url(); ?>app/user_enable/<? echo $app_info->row_id; ?>" class="btn btn-success">Enable</a>
				<?
			}
			?>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			Temperature Format
			<select name="app_weather_format" class="ajax-format">
				<? 
				if( isset( $temp_format ) ){
					?>
					<option></option>
					<?
				}
				?>
  			<option>Fahrenheit</option>
  			<option>Celcius</option>
			</select>
		</div>
	</div>
</div>