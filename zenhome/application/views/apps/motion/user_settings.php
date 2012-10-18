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
				<table>
					<tr>
						<td width="200px">Camera 1</td>
						<td>
							<select name="motion_cam_1" data-app-setting="motion_cam_1" class="ajax-format">
								<? 
								if( isset( $motion_cam_1 ) ){
									?>
									<option <? if( $motion_cam_1->setting_value == 1 ){ ?>selected="selected"<? }?> value="1">Show</option>
			            <option <? if( $motion_cam_1->setting_value == 0 ){ ?>selected="selected"<? }?> value="0">Don't Show</option>
									<?
								} else {
							  	?>
			  				 	<option value="1">Show</option>
			  				  <option value="0" selected="selected">Don't Show</option>
							  	<?
								}
								?>
							</select>							
						</td>
					</tr>
					<tr>
						<td>Camera 2</td>
						<td>
							<select name="motion_cam_2" data-app-setting="motion_cam_2" class="ajax-format">
								<? 
								if( isset( $motion_cam_2 ) ){
									?>
									<option <? if( $motion_cam_2->setting_value == 1 ){ ?>selected="selected"<? }?> value="1">Show</option>
			            <option <? if( $motion_cam_2->setting_value == 0 ){ ?>selected="selected"<? }?> value="0">Don't Show</option>
									<?
								} else {
							  	?>
			  				 	<option value="1">Show</option>
			  				  <option value="0" selected="selected">Don't Show</option>
							  	<?
								}
								?>
							</select>							
						</td>
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
							<td>Show Video Widget</td>
							<td>
								<div class="btn-group app-setting" data-toggle="buttons-radio" name="widget_enabled">
			  					<button type="button" class="btn <? if( isset( $widget_enabled ) && ( $widget_enabled->setting_value == 1 ) ){ ?>active<? } ?>" value="1">Show</button>
			 					  <button type="button" class="btn <? if( isset( $widget_enabled ) && ( $widget_enabled->setting_value  == 0) ){ ?>active<? } ?>" value="0">Hide</button>
								</div>
							</td>
						</tr>
						<tr>
							<td>Show Recent Images Widget</td>
							<td>
								<div class="btn-group app-setting" data-toggle="buttons-radio" name="widget_carosel_enabled">
			  					<button type="button" class="btn btn-small <? if( isset( $widget_carosel_enabled ) && ( $widget_carosel_enabled->setting_value == 1 ) ){ ?>active<? } ?>" value="1">Show</button>
			 					  <button type="button" class="btn btn-small <? if( isset( $widget_carosel_enabled ) && ( $widget_carosel_enabled->setting_value  == 0) ){ ?>active<? } ?>" value="0">Hide</button>
								</div>
							</td>
						</tr>						
					</tbody>
				</table>
		</form>
		</div>
	</div>
</div>