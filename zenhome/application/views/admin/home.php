<?php
	// ADMIN


?>

<div id="wrap" class="container-fluid">
	<div class="row-fluid">
		<div class="span4">
			<h3>Admin</h3>
		</div>

		<div class="span2 pull-right">
			<div class="dropdown pull-right">
	  		<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
	  			<i class="icon-white icon-chevron-down"></i> Options
	  		</a>
	  		<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
	    		<li><a href="#change_password" data-toggle="modal">Add User</a></li>
	  		</ul>
			</div>
		</div>
	</div>

	<div class="row-fluid">
		<!-- Admin Menu -->
		<div class="span3">
			<div class="well sidebar-nav">
				<ul class="nav nav-list">
					<?
					foreach ($admin_menu as $title => $menu) {
						?>
						<li class="nav-header"><? echo $title; ?></li>
						<?
						foreach ($menu as $name => $link) {
							?>
							<li><a href="<? echo base_url() . $link ; ?>"><? echo $name; ?></a></li>
							<?
						}
					}
					?>
				</ul>
      </div>
		</div>

		<div class="span9">
			<table class="table table-striped table-edit">
				<thead>
					<tr>
						<th>ID</th>
						<th>User Name</th>
						<th>Last IP</th>
						<th>Last Login</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?
					foreach ($users as $user) {
						?>
						<tr>
							<td><? echo $user['info']->user_id; ?></td>
							<td>
								<a href="<? echo base_url(); ?>admin/users/info/<? echo $user['info']->user_id; ?>">
									<? echo $user['info']->user_name; ?>
								</a>
							</td>
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
							<td class="table-hover">
								<!-- <button class="btn btn-small btn-primary">edit</button> -->
							</td>
						</tr>
						<?
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- MODEL: Add User -->
<div class="modal fade" id="change_password" style="display:none;">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">x</button>
    <h3>Change Password</h3>
  </div>
	<form action="<? echo base_url(); ?>admin/add_user"/ method="POST">
		<div class="modal-body">
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
		</div>
		<div class="modal-footer">
			<a data-dismiss="modal" href="#" class="btn">Close</a>
	  	<button type="submit" class="btn btn-primary">Save</button>
		</div>
  </form>
</div>