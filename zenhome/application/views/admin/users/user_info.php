<?php
	// ADMIN USER INFO
?>
<script type="text/javascript">
	jQuery('document').ready(function($){	
		$('#add_role').change( function(){
			window.location = base_url + 'admin/users/update_acl/add/' + '<? echo $user['user_id']; ?>/' + $(this).val();
		});

	});
</script>
<div id="wrap" class="container-fluid">
	<div class="row-fluid">
		<div class="span4">
			<h3>Admin: User Info</h3>
		</div>

		<div class="span2 pull-right">
			<div class="dropdown pull-right">
				<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="icon-white icon-chevron-down"></i> Options
				</a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					<li><a href="<? echo base_url() . 'admin/users/become_user/'. $user['user_id']; ?>" data-toggle="modal">Become User</a></li>
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

		<div class="span4 box">
			<div class="box-header header-gradient">
				<h2><? echo ucfirst( $user['user_name'] ); ?>'s Info</h2>
			</div>
			<div class="box-body">
				<h3>User Permissions</h3>
				<? if( $userACL->hasPermission( 'edit_acl' ) ){ ?>
					<ul class="box-list">
						<?
						foreach( $allPerms as $perm ){
							?>
							<li style="height:30px;">
								<span class"pull-left"><? echo $perm['name']; ?></span>
								<?
								if( $perm['user_access'] == '1'){
									?>
									<a href="<? echo base_url(); ?>admin/users/update_acl/delete/perm/<? echo $user['user_id'] . '/' . $perm['id'] . '/';?>" 
										class="pull-right btn btn-danger btn-small"><span class="icon-white icon-ban-circle"></a>
									<?
								} else {
									?>
									<a href="<? echo base_url(); ?>admin/users/update_acl/add/perm/<? echo $user['user_id'] . '/' . $perm['id']  ;?>" 
										class="pull-right btn btn-success btn-small"><span class="icon-white icon-ok-circle"></span></a>								
									<?
								}
								?>
							</li>
							<?
						}
						?>
					</ul>
				<? } else { ?>
					<ul>
						<?
						foreach( $editUserACL->perms as $perm ){
	 						if ($perm['value'] === false) { continue; }
							echo "<li>" . $perm['Name'];  
	        		if ($perm['inheritted']) { echo "  (inheritted)"; } 						
						}
						?>
					</ul>
				<? } ?>

				<? if( $userACL->hasPermission( 'dev_feats' ) ){ ?>
					<h3>User's Roles</h3>
					<ul class="box-list">
						<?
						foreach( $userACL->getUserRoles() as $role_id ){
							?>
							<li style="height:30px">
								<? echo $userACL->getRoleNameFromID( $role_id ); ?>
								<a href="<? echo base_url(); ?>admin/users/update_acl/delete/<? echo $user['user_id'] . '/' . $role_id  ;?>" class="pull-right btn btn-danger btn-small">X</a>
							</li>
							<?
						}
						?>
						<li style="height:30px">
							<span class="pull-left">
								<select id="add_role" name="">
									<option>Pick Roll</option>
									<?
									foreach ( $userACL->getAllRoles() as $role_id ){
										?>
										<option value="<? echo $role_id; ?>"><? echo $userACL->getRoleNameFromID( $role_id ); ?></option>	
										<?
									}
									?>
								</select>
							</span>
							<a href="" class="pull-right btn btn-small btn-success">+</a>
						</li>
					</ul>
				<? } ?>

			</div>
		</div>

		<div class="span3 box">
			<div class="box-header header-gradient">
				<h2>Recent Connections</h2>
			</div>
			<div class="box-body">
				<table class="table table-striped table-edit">
					<thead>
						<tr>
							<th>IP</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						<?
						foreach ($logins as $login) {
							?>
							<tr>
								<td><? echo $login->ip; ?></td>
								<td><? echo $login->login_ts; ?></td>
							</tr>
							<?
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>