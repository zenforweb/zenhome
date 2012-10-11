<?php
/*
*	NETWORKSCAN :: GENERIC USER SETTINGS TEMPLATE
*
* $app_info			@stdClass Obj
*	$enabled 			@bool
* $temp_format	@string
*/


?>

<div class="container-fluid">
	<div class="row-fluid">
		<div class="span4">
			<h4>Network Scan</h4>
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
		<label class="checkbox">
    	<input type="checkbox"> Display Volume Button
  	</label>	
		</div>
	</div>
</div>