<?php
/*
*	CHAT :: USER SETTINGS
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
			<h4>Chat</h4>
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
				<table>
					<tr>
						<td width="200px">Chat Timestamp</td>
						<td><input type="text" name="" /></td>
					</tr>					
				</table>

				<table>
					<thead>
						<tr>
							<td width="200px"><h5>Widget Options</h5></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Show Chat Widget</td>
							<td>
								<div class="btn-group app-setting" data-toggle="buttons-radio" name="widget_enabled">
			  					     <button type="button" class="btn <? if( isset( $widget_enabled ) && ( $widget_enabled->setting_value == 1 ) ){ ?>active<? } ?>" value="1">Show</button>
			 					     <button type="button" class="btn <? if( isset( $widget_enabled ) && ( $widget_enabled->setting_value  == 0) ){ ?>active<? } ?>" value="0">Hide</button>
								</div>
							</td>
						</tr>					
					</tbody>
				</table>
		</form>
		</div>
	</div>
</div>