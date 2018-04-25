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
	<title>Add Location</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Add Location</h2>
	</div>
	
	<form method="post" action="add_location.php">
		<?php include('errors.php'); ?>
		<div class="input-group">
			<label>Location:</label>
			<input type="text" name="locationID">
		</div>
	
		<div class="input-group">
			<button type="submit" class="btn" name="add_location">submit</button>
		</div>
	</form>
	
		
</body>
</html>