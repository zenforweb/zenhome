<?php
/*
*	REMOTE :: GENERIC USER SETTINGS TEMPLATE
*
* $app_info			@stdClass Obj
*	$enabled 			@bool
* $display_vol	@string
*/
?>

<div class="container-fluid user_app_settings" data-app-id="<? echo $app_info->row_id; ?>">
	<div class="row-fluid">
		<div class="span4">
			<h4>Remote</h4>
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
				<label class="checkbox">
		    	<input type="checkbox" name="display_vol"> Display Volume Button
		  	</label>
		  </form>
		</div>
	</div>
</div>