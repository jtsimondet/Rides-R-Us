<?php include('server.php') ?>
<?php 
	session_start(); 

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
	<title>Add bus form</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Add a bus</h2>
	</div>
	
	<form method="post" action="driver_register.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>busID</label>
			<input type="text" name="username">
		</div>
		<div class="input-group">
			<label>seatNum</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>busRate</label>
			<input type="password" name="password_2">
		</div>
		<div class="input-group">
			<label>maintStatus</label>
			<input type="text" name="first_name">
		</div>
	</form>
</body>
</html>