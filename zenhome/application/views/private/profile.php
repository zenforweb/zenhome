<?php
	// Profile
?>

<script type="text/javascript">
	jQuery('document').ready(function($){	
		var base_url = '<? echo base_url(); ?>app/update_user_setting/'

		function update_settings( app_id, setting_name, setting_value ){
			var update_url = base_url + app_id + '/' + setting_name + '/' + setting_value;
			$.ajax({ 
			   url: update_url,
			   success: add_notification('success', 'Your setting has been saved'), 
		        });
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
		$('select, input').change( function(){
			var form_element = $(this),
				 	app_id       = form_element.closest('form').attr('data-app-id'),
				 	name 				 = form_element.attr('name'),
				 	value 			 = form_element.val();
			update_settings( app_id, name, value );
		});
		// App settings handler for btn-groups
		$('.app-setting button').click( function(){
			var form_element = $(this),
				 	app_id       = form_element.closest('form').attr('data-app-id'),
				 	name 				 = form_element.parent('.app-setting').attr('name'),
				 	value 			 = form_element.val();
			update_settings( app_id, name, value );
		});

		$('.user_app_settings .header').addClass('header-gradient');

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


	<h3>General Settings</h3>
	<div id="general_settings" class="row-fluid">
		<div class="span2">
			<img src="http://0.gravatar.com/avatar/<? echo $this->user['gravatar']; ?>?s=150&r=pg&d=mm"/>
		</div>
		<div class="span9"
			<form>
				User Name: <input type="text" class="input" value="<? echo $user['user_name']; ?>">
				<br />
				Name: <input type="text" class="input input-small" value="<? echo $user['first_name']; ?>"> 
				<input type="text" class="input input-medium" value="<? echo $user['last_name']; ?>"> 
				<br />
				Email: <input type="text" class="input" value="<? echo $user['user_name']; ?>">				
				<br/>
				<button type="subit" class="btn btn-primary">Save</button>
			</form>
		</div>
	</div>

	<div class="row-fluid">
		<h3>Appearance</h3>
	</div>

	<div class="row-fluid">
		<h3> Notifications</h3>
	</div>

	<div id="app_settings" class="row-fluid">
		<h3>App Settings</h3>
		<div id="app_settings_list" class="span12">