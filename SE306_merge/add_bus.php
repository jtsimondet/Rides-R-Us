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
	<title>Add bus</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Add bus</h2>
	</div>
	
	<form method="post" action="add_bus.php">
		<?php include('errors.php'); ?>
		<div class="input-group">
			<label>Bus ID (5 characters)</label>
			<input type="text" name="busID">
		</div>
		<div class="input-group">
			<label>Number of seats:</label>
			<input type="text" name="seatNum">
		</div>
		<div class="input-group">
			<label>Bus Rate:</label>
			<input type="number" name="busRate">
		</div>
		<div class="input-group">
			<label>Maintenance Mode</label>
			<input type="checkbox" name="maintStatus" value="Off" >
		</div>
	
		<div class="input-group">
			<button type="submit" class="btn" name="add_bus">Submit</button>
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="home_page">Return to Homepage</button>
		</div>
	</form>
	
		
</body>
</html>