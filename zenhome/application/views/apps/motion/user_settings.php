<?php
/*
*	MOTION :: USER SETTINGS
*
* $app_info			@stdClass Obj
*	$enabled 			@bool
* $temp_format	@string
*/
?>

<div class="container-fluid user_app_settings" data-app-id="<? echo $app_info->row_id; ?>">
	<div class="row-fluid">
		<div class="span4">
			<h4>Motion</h4>
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
				Camera 1: 
				<select name="motion_cam_1" class="ajax-form">
	  			<option value="1">Show Widget</option>
	  			<option value="0">Dont Show Widget</option>
				</select>
				<br />
				Camera 2: 
				<select name="motion_cam_2" class="ajax-form">
	  			<option value="1">Show Widget</option>
	  			<option value="0">Dont Show Widget</option>
				</select>
		</form>
		</div>
	</div>
</div>