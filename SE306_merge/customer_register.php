<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Customer Registration Form</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Customer Register</h2>
	</div>
	
	<form method="post" action="customer_register.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Confirm password</label>
			<input type="password" name="password_2">
		</div>
		<div class="input-group">
			<label>First name</label>
			<input type="text" name="first_name">
		</div>
		<div class="input-group">
			<label>Last name</label>
			<input type="text" name="last_name">
		</div>
		<div class="input-group">
			<label>Phone number</label>
			<input type="number" name="phone_number">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="cust_reg">Register</button>
		</div>
		<p>
			Already a member? <a href="customer_login.php">Sign in</a>
		</p>
	</form>
</body>
</html>