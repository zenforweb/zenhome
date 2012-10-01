<?php
	// DASHBOARD
?>

<div id="wrap" class="container-fluid">

	<!-- Example row of columns -->
	<div class="row-fluid">
		<div class="span4">
			<h2>You're a guest!</h2>
			<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
			<p><a class="btn" href="#">View details &raquo;</a></p>
		</div>
		<div class="span4">
			<h2>Heading</h2>
			<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
			<p><a class="btn" href="#">View details &raquo;</a></p>
		</div>
		<div class="span4">
			<h2>Login</h2>
			<form action="<? echo base_url(); ?>outside/login/" method="POST" id="login_form">
				<input type='text' name="user_name" placeholder='Username' class='input'/> <br />
				<input type='password' name="password"  placeholder='Password' class='input'/> <br />
				<button type="submit" class="btn btn-primary" id="login_button">Submit</button>
			</form>
		</div>
	</div>

</div>