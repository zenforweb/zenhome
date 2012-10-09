<?php
/*
*	REMOTE :: GENERIC USER SETTINGS TEMPLATE
*
*/
?>

<div class="container-fluid">
	<div class="row-fluid">
		<div class="span4">
			<h4>Remote</h4>
		</div>
		<div class="span4 pull-right">
			<?
			if( isset( $enabled ) && $enabled->setting_value == 1 ){
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
		<label class="checkbox">
    	<input type="checkbox"> Display Volume Button
  	</label>	
		</div>
	</div>
</div>