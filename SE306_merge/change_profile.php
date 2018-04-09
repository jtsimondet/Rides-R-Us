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
	<title>Change profile</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Change profile Page</h2>
	</div>
	<div class="content">
	
	<!-- Customer profile -->
	<?php if($_SESSION['role'] == 'customer') : ?>
		<form method="post" action="change_profile.php">
			<?php include('errors.php'); ?>
			<div class="input-group">
				<label>First name</label>
				<input type="text" name="first_name">
			</div>
			<div class="input-group">
				<label>Last name</label>
				<input type="text" name="last_name">
			</div>
			<div class="input-group">
				<label>phone number</label>
				<input type="number" name="phone_number">
			</div>
			<div class="input-group">
				<label>email address</label>
				<input type="email" name="email_address">
			</div>
			<div class="input-group">
				<button type="submit" class="btn" name="customer_change_profile">submit</button>
			</div>
		</form>
	<?php endif ?>
	
	<!-- Admin profile -->
	<?php if($_SESSION['role'] == 'admin') : ?>
		<form method="post" action="change_profile.php">
			<?php include('errors.php'); ?>
			<div class="input-group">
				<label>First name</label>
				<input type="text" name="first_name">
			</div>
			<div class="input-group">
				<label>Last name</label>
				<input type="text" name="last_name">
			</div>
			<div class="input-group">
				<button type="submit" class="btn" name="admin_change_profile.php">submit</button>
			</div>
		</form>
	<?php endif ?>
	
	<!-- Driver profile -->
	<?php if($_SESSION['role'] == 'driver') : ?>
		<form method="post" action="change_profile.php">
			<?php include('errors.php'); ?>
			<div class="input-group">
				<label>First name</label>
				<input type="text" name="first_name">
			</div>
			<div class="input-group">
				<label>Last name</label>
				<input type="text" name="last_name">
			</div>
			<div class="input-group">
				<label>phone number</label>
				<input type="number" name="phone_number">
			</div>
			<div class="input-group">
				<label>email address</label>
				<input type="email" name="email_address">
			</div>
			<div class="input-group">
				<button type="submit" class="btn" name="driver_change_profile.php">submit</button>
			</div>
		</form>
	<?php endif ?>
	
		
</body>
</html>