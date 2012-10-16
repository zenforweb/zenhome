<?php
/*
*	WEATHER :: USER SETTINGS
*	
* $app_info			@stdClass Obj
*	$enabled 			@bool
* $temp_format	@string
*/	
?>

<div class="container-fluid user_app_settings" data-app-id="<? echo $app_info->row_id; ?>">
	<div class="row-fluid">
		<div class="span4">
			<h4>Outdoor Weather</h4>
		</div>
		<div class="span4 pull-right">
	    <div class="btn-group app-enable" data-toggle="buttons-radio">
	    	<button type="button" class="btn <? if( is_object( $enabled ) && $enabled->setting_value == '1' ){ ?> active<? } ?>">Enable</button>
	    	<button type="button" class="btn <? if( !is_object( $enabled ) || $enabled->setting_value == '0' ){ ?> active<? } ?>">Disable</button>
	    </div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<form data-app-id="<? echo $app_info->row_id; ?>">
				Temperature Format
				<select name="temp_format" data-app-setting="temp_format" class="ajax-format">
					<div class="btn-group" data-toggle="buttons-radio">
  					     <button type="button" class="btn">Left</button>
 					     <button type="button" class="btn">Middle</button>
 					     <button type="button" class="btn">Right</button>
					</div>
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