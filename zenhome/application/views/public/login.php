<?php
	// PUBLIC INDEX
?>

<div id="wrap" class="container-fluid">

	<!-- Example row of columns -->
	<div class="row-fluid">
		<div class="span12" style="text-align: center">
			<h2>ZenHome</h2>
			<form action="<? echo base_url(); ?>outside/login/" method="POST" id="login_form">
				<input type='text' name="user_name" placeholder='Username' class='input input-large'/> <br />
				<input type='password' name="password"  placeholder='Password' class='input input-large'/> <br />
				<button type="submit" class="btn btn-primary btn-large" id="login_button">Login</button>
			</form>
		</div>
	</div>

</div>

</body>
</html>