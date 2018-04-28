<?php 
	session_start(); 

	/*if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: customer_login.php');
	}*/

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: index.php");
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
			<br>
			<p> <a href="schedule_trip.php" style="color: blue;">Schedule a Trip</a> </p>
			<!-- remove a trip -->
			<p> <a href="view_trips.php" style="color: blue;">View Previous Trips</a> </p>
			<!--<p> <a href="TODO" style="color: blue;">View Notifications</a> </p>-->
			<p> <a href="view_profile.php" style="color: blue;">View Profile</a> </p>
			<p> <a href="reset_password.php" style="color: blue;">Reset Password</a> </p>
			<p> <a href="index.php?logout='1'" style="color: red;">Logout</a> </p>
		<?php endif ?>
		
		<!-- logged in driver information -->
		<?php if(isset($_SESSION['role']) and $_SESSION['role'] == 'driver') : ?>
			<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
			<br>
			<p> <a href="view_profile.php" style="color: blue;">View Profile</a> </p>
			<p> <a href="send_notification.php" style="color: blue;">Message Customer</a> </p>
			<p> <a href="reset_password.php" style="color: blue;">Reset Password</a> </p>
			<p> <a href="index.php?logout='1'" style="color: red;">Logout</a> </p>
		<?php endif ?>
		
		<!-- logged in admin information -->
		<?php if(isset($_SESSION['role']) and $_SESSION['role'] == 'admin') : ?>
			<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
			<br>
			<p> <a href="view_drivers.php" style="color: blue;">View Drivers</a> </p>
			<p> <a href="view_profile.php" style="color: blue;">View Profile</a> </p>
			<p> <a href="view_buses.php" style="color: blue;">View Buses</a> </p>
			<p> <a href="driver_register.php" style="color: blue;">Add a Driver</a> </p>
			<p> <a href="admin_register.php" style="color: blue;">Add an Admin</a> </p>
			<p> <a href="reset_password.php" style="color: blue;">Reset Password</a> </p>
			<p> <a href="index.php?logout='1'" style="color: red;">Logout</a> </p>
		<?php endif ?>
		
		<?php if(!isset($_SESSION['role'])): ?>
			<p>Welcome <strong>Guest</strong></p>
			<br>
			<p> <a href="schedule_trip.php" style="color: blue;">Schedule a Trip</a> </p>
			<p> <a href="customer_login.php" style="color: blue;">Login</a> </p>
			<p> <a href="driver_login.php" style="color: blue;">Driver Login</a> </p>
			<p> <a href="admin_login.php" style="color: blue;">Admin Login</a> </p>
			<p> <a href="customer_register.php" style="color: blue;">Register an Account</a> </p>
		<?php endif ?>

		<?php  if (isset($_SESSION['username'])) : ?>
			
		<?php endif ?>
	</div>
		
</body>
</html>