<?php
/*
*	Books :: User Settings
*
*	$app_info			@stdClass Obj
*	$enabled 			@bool
* 	// Chat custom user settings
* 		$widget_enabled		@stdClass Obj
*/
?>

<div class="container box user_app_settings" data-app-id="<? echo $app_info->row_id; ?>">
	<div class="box-header header-gradient">
		<div class="span4">
			<h4>Books</h4>
		</div>
		<div class="span3 pull-right">
		    <div class="btn-group app-enable" data-toggle="buttons-radio">
		    	<button type="button" class="btn <? if( $enabled['setting_value'] == '1' ){ ?> active<? } ?>">Enable</button>
		    	<button type="button" class="btn <? if( $enabled['setting_value'] != '1' ){ ?> active<? } ?>">Disable</button>
		    </div>
		</div>
	</div>
	<div class="row-fluid app-settings">
		<form data-app-id="<? echo $app_info->row_id; ?>">
			<? /*
			<table>
				<thead>
					<tr>
						<td width="200px"><h5>Widget Options</h5></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Show Xbmc Widget</td>
						<td>
							<div class="btn-group app-setting" data-toggle="buttons-radio" name="widget">
		  					<button type="button" class="btn <? if( $widget['setting_value'] == 1 ){ ?>active<? } ?>" value="1">Show</button>
		 					  <button type="button" class="btn <? if( $widget['setting_value']  == 0){ ?>active<? } ?>" value="0">Hide</button>
							</div>
						</td>
					</tr>				
				</tbody>
			</table>
			*/ ?>
			<p style="margin-top:10px">There are no other options for you to adjust currently!</p>
		</form>
	</div>
</div>