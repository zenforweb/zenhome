<?php
/*
*	WEATHER :: USER SETTINGS
*	
* $app_info							@stdClass Obj
*	$enabled 							@bool
*
* | Weather custom user settings
* 		$widget_enabled 			@stdClass Obj
* 		$widget_graph					@stdClass Obj
* 		$temp_format					@string
*/
?>

<div class="container-fluid user_app_settings" data-app-id="<? echo $app_info->row_id; ?>">
	<div class="row-fluid">
		<div class="span4">
			<h4>Weather</h4>
		</div>
		<div class="span4 pull-right">
	    <div class="btn-group app-enable" data-toggle="buttons-radio">
	    	<button type="button" class="btn <? if( $enabled['setting_value'] == 1 ){ ?> active<? } ?>">Enable</button>
	    	<button type="button" class="btn <? if( $enabled['setting_value'] == 0 ){ ?> active<? } ?>">Disable</button>
	    </div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<form data-app-id="<? echo $app_info->row_id; ?>">
				<table>
					<tr>
						<td width="200px">Temperature Format</td>
						<td>
							<select name="temp_format" data-app-setting="temp_format" class="ajax-format">
								<? 
								if( isset( $temp_format ) ){
									?>
									<option <? if( $temp_format['setting_value'] == "f" ){ ?>selected="selected"<? }?> value="f">Fahrenheit</option>
			            <option <? if( $temp_format['setting_value'] == "c" ){ ?>selected="selected"<? }?> value="c">Celcius</option>
									<?
								} else {
							  	?>
			  				 	<option value="f">Fahrenheit</option>
			  				  <option value="c">Celcius</option>
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
							<td>Show Weather Widget</td>
							<td>
								<div class="btn-group app-setting" data-toggle="buttons-radio" name="widget">
			  					<button type="button" class="btn <? if( $widget['setting_value'] == 1 ){ ?>active<? } ?>" value="1">Show</button>
			 					  <button type="button" class="btn <? if( $widget['setting_value']  == 0){ ?>active<? } ?>" value="0">Hide</button>
								</div>
							</td>
						</tr>
						<tr>
							<td>Show 12 Hour Graph</td>
							<td>
								<div class="btn-group  app-setting" data-toggle="buttons-radio" name="widget_graph">
			  					<button type="button" class="btn btn-small <? if( $widget_graph['setting_value']  == 1 ){ ?>active<? } ?>" value="1">Show</button>
			 					  <button type="button" class="btn btn-small <? if( $widget_graph['setting_value']  == 0 ){ ?>active<? } ?>"value="0">Hide</button>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<br />
		   </form>
		</div>
	</div>
</div>