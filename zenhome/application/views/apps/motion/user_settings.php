<?php
/*
*	MOTION :: USER SETTINGS
*
* $app_info			@stdClass Obj
*	$enabled 			@bool
* 	
* Motion custom user settings
*/
?>
<? if( $userACL->hasPermission( 'access_motion' ) ){ ?>
	<div class="container box user_app_settings" data-app-id="<? echo $app_info->row_id; ?>">
		<div class="box-header header-gradient">
			<div class="span4">
				<h4>Motion</h4>
			</div>
			<div class="span3 pull-right">
			<div class="btn-group app-enable" data-toggle="buttons-radio">
				<button type="button" class="btn <? if( $enabled['setting_value'] == '1' ){ ?> active<? } ?>">Enable</button>
				<button type="button" class="btn <? if( $enabled['setting_value'] != '1' ){ ?> active<? } ?>">Disable</button>
			</div>
			</div>
		</div>
		<div class="box-body">
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
								<div class="btn-group app-setting" data-toggle="buttons-radio" name="widget_cams">
			  					<button type="button" class="btn <? if( $widget_cams['setting_value'] == 1 ){ ?>active<? } ?>" value="1">Show</button>
			 					  <button type="button" class="btn <? if( $widget_cams['setting_value']  == 0){ ?>active<? } ?>" value="0">Hide</button>
								</div>
							</td>
						</tr>
						<tr>
							<td>Show Recent Images Widget</td>
							<td>
								<div class="btn-group app-setting" data-toggle="buttons-radio" name="widget_carosel">
			  					<button type="button" class="btn <? if( $widget_carosel['setting_value'] == 1 ){ ?>active<? } ?>" value="1">Show</button>
			 					  <button type="button" class="btn <? if( $widget_carosel['setting_value']  == 0 ){ ?>active<? } ?>" value="0">Hide</button>
								</div>
							</td>
						</tr>						
					</tbody>
				</table>
			</form>
		</div>
	</div>
<?  } ?>