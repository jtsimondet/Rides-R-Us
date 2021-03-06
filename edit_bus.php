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
	<title>Edit bus</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Edit bus</h2>
	</div>
	
	<form method="post" action="add_bus.php">
		<?php include('errors.php'); ?>
		<div class="input-group">
			<label>Bus ID (5 characters)</label>
			<input type="text" name="busID" value="12345">
		</div>
		<div class="input-group">
			<label>Number of seats:</label>
			<input type="text" name="seatNum" value="50">
		</div>
		<div class="input-group">
			<label>Bus Rate:</label>
			<input type="number" name="busRate" value="50.00">
		</div>
		<div class="input-group">
			<label>Maintenance Mode</label>
			<input type="checkbox" name="maintStatus" value="On" <?php echo 'checked="checked"'?>>
		</div>
	
		<div class="input-group">
			<button type="submit" class="btn" name="add_bus">submit</button>
			<button type="submit" class="btn" name="cancel">cancel</button>
		</div>
	</form>
	
		
</body>
</html>