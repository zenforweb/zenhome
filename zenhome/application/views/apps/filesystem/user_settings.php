<?php
/*
*	FILESYSTEM :: USER SETTINGS
*
*	$app_info			@stdClass Obj
*	$enabled 			@bool
* 	// Chat custom user settings
* 		$widget_enabled		@stdClass Obj
*/
?>

<div class="container-fluid user_app_settings" data-app-id="<? echo $app_info->row_id; ?>">
	<div class="row-fluid">
		<div class="span4">
			<h4>File System</h4>
		</div>
		<div class="span4 pull-right">
	  	<div class="btn-group app-enable" data-toggle="buttons-radio">
	    	<button type="button" class="btn <? if( $enabled['setting_value'] == 1 ){ ?> active<? } ?>">Enable</button>
	    	<button type="button" class="btn <? if( $enabled['setting_value'] == 0 ){ ?> active<? } ?>">Disable</button>
	    </div>
		</div>
	</div>
</div>