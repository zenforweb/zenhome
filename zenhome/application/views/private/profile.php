<?php
	// Profile
?>

<script type="text/javascript">
	jQuery('document').ready(function($){	
		var base_url = '<? echo base_url(); ?>app/update_user_setting/'

		function update_settings( app_id, setting_name, setting_value ){
			var update_url = base_url + app_id + '/' + setting_name + '/' + setting_value;
			$.ajax({ url: update_url, });
			console.log( update_url );
		}		
		
		// App enabled handler
    $('.app-enable button').click( function(){
			var button  = $(this),
					app_box = button.closest( '.user_app_settings' ),
					app_id  = app_box.attr( 'data-app-id' ),
			    value   = button.text();
			if( value == 'Enable'){
				value = 1;
			} else {
				value = 0;
			}
			update_settings( app_id, 'enabled', value);
    });

		// App settings handler
		$('select, input').change( function( event ){
			var form_element = $(this),
				 	app_id       = form_element.closest('form').attr('data-app-id'),
				 	name 				 = form_element.attr('name'),
				 	value 			 = form_element.val();
			console.log( value );
			update_settings( app_id, name, value );
		});
	});
</script>

<!-- MODEL: Change Password -->
<div class="modal fade" id="change_password">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">x</button>
    <h3>Change Password</h3>
  </div>
	<form action="<? echo base_url(); ?>profile/change_pass" method="POST">
		<div class="modal-body">
	    <fieldset>
	      <div class="control-group">
	      	<label>Current Password</label>
			  	<input type="text" name="current_password" placeholder="password" type="password">
			  	<span class="help-block">Your current password.</span>

				  <label>New Password</label>
				  <input type="text" type="password" name="password_1" placeholder="password">
				  <br />
				  <input type="text" type="password" name="password_2" placeholder="password">
				  <span class="help-block">Your password, twice please</span>	
			  </div>
	    </fieldset>
		</div>
	  <div class="modal-footer">
	    <a data-dismiss="modal" href="#" class="btn">Close</a>
	    <button type="submit" class="btn btn-primary">Save</button>
	  </div>
  </form>
</div>

<div id="wrap" class="container-fluid">
	<div class="row-fluid">
		<div class="span5">
			<h3><? echo ucfirst ( $user['user_name'] ); ?>'s Profile</h3>
		</div>
		<div class="span3 pull-right">
			<div class="dropdown">
	  		<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
	  			<i class="icon-white icon-chevron-down"></i> Options
	  		</a>
	  		<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
	    		<li><a href="#change_password" data-toggle="modal">Change Password</a></li>
	  		</ul>
			</div>
		</div>
	</div>

	<div id="general_settings" class="row-fluid">
		<h3>General Settings</h3>
		<div class="span12">
			<form>
				User Name: <input type="text" class="input" value="<? echo $user['user_name']; ?>">
				<br />
				Name: <input type="text" class="input input-small" value="<? echo $user['first_name']; ?>"> 
				<input type="text" class="input input-medium" value="<? echo $user['last_name']; ?>"> 
				<br />
				//@todo make this work 
				<br/>
				<button type="subit" class="btn btn-primary">Save</button>
			</form>
		</div>
	</div>

	<div id="app_settings" class="row-fluid">
		<h3>App Settings</h3>
		<div id="app_settings_list" class="span12">