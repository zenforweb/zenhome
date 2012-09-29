<?php
	// ADMIN
?>

<div id="wrap" class="container-fluid">
	<!-- Example row of columns -->
	<h3>Admin</h3>
	<div class="row-fluid">
		<div class="span8">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>User Name</th>
						<th>Last IP</th>
						<th>Last Login</th>
					</tr>
				</thead>
				<?
				foreach ($users as $user) {
					?>
					<tr>
						<td><? echo $user['info']->user_id; ?></td>
						<td><? echo $user['info']->user_name; ?></td>
						<?
						if( isset($user['access']) ){
							?>
							<td><? echo $user['access']->ip; ?></td>
							<td><? echo $user['access']->login_ts; ?></td>
							<?
						} else {
							?>
							<td colspan="2">never logged in</td>
							<?
						}
						?>

						
					</tr>
					<?
				}
				?>
			</table>
		</div>
		<div class="span4">
			<form action="<? echo base_url(); ?>admin/add_user"/ method="POST">
			  <legend>Add User</legend>
			  <label>User</label>
			  <input type="text" name="user_name" placeholder="user name">
			  <span class="help-block">The ID you'll be using to login to the site</span>

			  <label>Password</label>
			  <input type="text" type="password" name="password_1" placeholder="password">
			  <br />
			  <input type="text" type="password" name="password_2" placeholder="password">
			  <span class="help-block">Your password, twice please</span>			  

			  <button type="submit" class="btn btn-primary">Add New User</button>
			</form>
		</div>
	</div>
</div>

</body>
</html>