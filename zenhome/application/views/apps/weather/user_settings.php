<?php
/*
*	WEATHER :: USER SETTINGS
*	
* $app_info			@stdClass Obj
*	$enabled 			@bool
* $temp_format	@string
*
*/	

// echo "<pre>"; print_r( $temp_format ); die();
?>

<div class="container-fluid">
	<div class="row-fluid">
		<div class="span4">
			<h4>Outdoor Weather</h4>
		</div>
		<div class="span4 pull-right">
			<?
			if( is_object( $enabled ) && $enabled->setting_value == '1' ){
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
		     <form data-app-id="<? echo $app_info->row_id; ?>">
			Temperature Format
			<select name="app_weather_temp_format" data-app-setting="temp_format" class="ajax-format">
				<? 
				if( isset( $temp_format ) ){
					?>

					<option <? if( $temp_format->setting_value == "f" ){ ?>selected="selected"<? }?> value="f">Fahrenheit</option>
                        		<option <? if( $temp_format->setting_value == "c" ){ ?>selected="selected"<? }?> value="c">Celcius</option>
					<?
				} else {
				  ?>
  				  <option value="f">Fahrenheit</option>
  				  <option value="c">Celcius</option>
				  <?
				}
				?>
			</select>
		    </form>
		</div>
	</div>
</div>