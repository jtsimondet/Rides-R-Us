<?php 
	session_start(); 

	/*if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: customer_login.php');
	}*/

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: customer_login.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Home Page</h2>
	</div>
	<div class="content">

		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- logged in customer information -->
		<?php if( isset($_SESSION['role']) and $_SESSION['role'] == 'customer') : ?>
			<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
			<p><?php echo $_SESSION['role']; ?>
			<p> <a href="schedule_trip.php" style="color: blue;">schedule a trip</a> </p>
			<!-- remove a trip -->
			<p> <a href="view_trips.php" style="color: blue;">view previous trips</a> </p>
			<p> <a href="TODO" style="color: blue;">view notifications</a> </p>
			<p> <a href="view_profile.php" style="color: blue;">view profile</a> </p>
			<p> <a href="reset_password.php" style="color: blue;">reset password</a> </p>
			<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
		<?php endif ?>
		
		<!-- logged in driver information -->
		<?php if(isset($_SESSION['role']) and $_SESSION['role'] == 'driver') : ?>
			<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
			<p><?php echo $_SESSION['role']; ?>
			<p> <a href="view_profile.php" style="color: blue;">view profile</a> </p>
			<p> <a href="TODO" style="color: blue;">message customer</a> </p>
			<p> <a href="TODO" style="color: blue;">view schedule</a> </p>
			<p> <a href="TODO" style="color: blue;">submit switch hours form</a> </p>
			<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
		<?php endif ?>
		
		<!-- logged in admin information -->
		<?php if(isset($_SESSION['role']) and $_SESSION['role'] == 'admin') : ?>
			<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
			<p><?php echo $_SESSION['role']; ?>
			<p> <a href="view_drivers" style="color: blue;">view drivers</a> </p>
			<p> <a href="view_profile.php" style="color: blue;">view profile</a> </p>
			<p> <a href="reset_password.php" style="color: blue;">reset password</a> </p>
			<p> <a href="TODO" style="color: blue;">view reports</a> </p>
			<p> <a href="view_locations" style="color: blue;">view pickup locations</a> </p>
			<!-- view pickup locations -->
			<p> <a href="view_buses.php" style="color: blue;">view buses</a> </p>
			<p> <a href="driver_register.php" style="color: blue;">add a driver</a> </p>
			<p> <a href="TODO" style="color: blue;">remove a driver</a> </p>
			<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
		<?php endif ?>
		
		<?php if(!isset($_SESSION['role'])): ?>
			<p>Welcome <strong>Guest</strong></p>
			<br>
			<p> <a href="customer_login.php" style="color: blue;">login</a> </p>
			<p> <a href="schedule_trip.php" style="color: blue;">schedule a trip</a> </p>
			<p> <a href="customer_register.php" style="color: blue;">register an account</a> </p>
		<?php endif ?>

		<?php  if (isset($_SESSION['username'])) : ?>
			
		<?php endif ?>
	</div>
		
</body>
</html>