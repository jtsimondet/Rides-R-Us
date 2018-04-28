<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Customer Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Customer Login</h2>
	</div>
	
	<form method="post" action="customer_login.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_customer">Login</button>
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="home_page">Return to Homepage</button>
		</div>
		<p>
			Not yet a member? <a href="customer_register.php">Sign up</a>
		</p>
	</form>


</body>
</html>