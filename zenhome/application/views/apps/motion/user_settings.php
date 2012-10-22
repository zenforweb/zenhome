<?php
/*
*	MOTION :: USER SETTINGS
*
* $app_info			@stdClass Obj
*	$enabled 			@bool
* 	// Motion custom user settings
* 		$widget_enabled 			@stdClass Obj
*/
?>
<script type="text/javascript">
	jQuery('document').ready(function($){	
		console.log( 'stuff' );
	});
</script>

<div class="container-fluid user_app_settings" data-app-id="<? echo $app_info->row_id; ?>">
	<div class="row-fluid">
		<div class="span4">
			<h4>Motion</h4>
		</div>
		<div class="span4 pull-right">
	    <div class="btn-group app-enable" data-toggle="buttons-radio">
	    	<button type="button" class="btn <? if( $enabled['setting_value'] == '1' ){ ?> active<? } ?>">Enable</button>
	    	<button type="button" class="btn <? if( $enabled['setting_value'] == '0' ){ ?> active<? } ?>">Disable</button>
	    </div>
		</div>
	</div>
	<div class="row-fluid app-settings">
		<div class="span6">
			<form data-app-id="<? echo $app_info->row_id; ?>">
				<table>
					<thead>
						<tr>
							<td width="200px"><h5>Widget Options</h5></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Show Video Widget</td>
							<td>
								<div class="btn-group app-setting" data-toggle="buttons-radio" name="widget_enabled">
			  					<button type="button" class="btn <? if( $widget_enabled['setting_value'] == 1 ){ ?>active<? } ?>" value="1">Show</button>
			 					  <button type="button" class="btn <? if( $widget_enabled['setting_value']  == 0){ ?>active<? } ?>" value="0">Hide</button>
								</div>
							</td>
						</tr>
						<tr>
							<td>Show Recent Images Widget</td>
							<td>
								<div class="btn-group app-setting" data-toggle="buttons-radio" name="widget_carosel_enabled">
			  					<button type="button" class="btn <? if( $widget_carosel_enabled['setting_value'] == 1 ){ ?>active<? } ?>" value="1">Show</button>
			 					  <button type="button" class="btn <? if( $widget_carosel_enabled['setting_value']  == 0 ){ ?>active<? } ?>" value="0">Hide</button>
								</div>
							</td>
						</tr>						
					</tbody>
				</table>
		</form>
		</div>
	</div>
</div>