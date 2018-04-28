<?php include('server.php') ?>
<?php 
	//session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Driver Registration Form</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Driver Register</h2>
	</div>
	
	<form method="post" action="driver_register.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
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
			<label>Pay Rate</label>
			<input type="number" name="pay_rate">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="driver_reg">Register</button>
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="home_page">Return to Homepage</button>
		</div>
	</form>
</body>
</html>