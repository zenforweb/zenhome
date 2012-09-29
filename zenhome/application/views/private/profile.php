<?php
	// Profile
?>

<div id="wrap" class="container-fluid">
	<!-- Example row of columns -->
	<h3>Profile</h3>
	<div class="row-fluid">
		<div class="span4">

			<form action="<? echo base_url(); ?>profile/change_pass"/ method="POST">
			  <legend>Change Password</legend>
			  <label>Current Password</label>
			  <input type="text" name="current_password" placeholder="password" type="password">
			  <span class="help-block">Your current password.</span>

			  <label>New Password</label>
			  <input type="text" type="password" name="password_1" placeholder="password">
			  <br />
			  <input type="text" type="password" name="password_2" placeholder="password">
			  <span class="help-block">Your password, twice please</span>			  

			  <button type="submit" class="btn btn-primary">Change Password</button>
			</form>
		</div>
	</div>
</div>

</body>
</html>