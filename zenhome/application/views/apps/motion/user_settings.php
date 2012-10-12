<?php
/*
*	MOTION :: USER SETTINGS
*
*/
?>

<div class="container-fluid">
	<div class="row-fluid">
		<div class="span4">
			<h4>Motion</h4>
		</div>
		<div class="span4 pull-right">
			<?
			if( is_object( $enabled ) && $enabled->setting_value == '1' ){
				?>
					<a href="<? echo base_url(); ?>app/user_disable/<? echo $app_info->row_id; ?>" class="btn btn-danger">Disable</a>
				<?
			} else {
				?>
				<a href="<? echo base_url(); ?>app/user_enable/<? echo $app_info->row_id; ?>" class="btn btn-success">Enable</a>
				<?
			}
			?>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			Camera 1: 
			<select name="motion_cam_1" class="ajax-form">
  			<option value="1">Show Widget</option>
  			<option value="0">Dont Show Widget</option>
			</select>
			<br />
			Camera 2: 
			<select name="motion_cam_1" class="ajax-form">
  			<option value="1">Show Widget</option>
  			<option value="0">Dont Show Widget</option>
			</select>			
		</div>
	</div>
</div>