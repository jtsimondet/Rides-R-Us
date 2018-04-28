<?php include('server.php') ?>
<?php 
	//session_start(); 
	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}
	
	$busID = $_SESSION['busID'];
	$query = "SELECT * FROM bus WHERE busID='$busID' LIMIT 1";
	
	$results = mysqli_query($db, $query);
	$row = mysqli_fetch_array($results);
	
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
		<?php echo 'Bus: ', $row['busID']; ?>
	</div>
	
	
	<form method="post" action="add_bus.php">
		<?php include('errors.php'); ?>
		<div class="input-group">
			<label>Bus ID (5 characters)</label>
			<input type="text" name="busID" value=<?php echo $row['busID']; ?>>
		</div>
		<div class="input-group">
			<label>Number of seats:</label>
			<input type="text" name="seatNum" value=<?php echo $row['seatNum']; ?>>
		</div>
		<div class="input-group">
			<label>Bus Rate:</label>
			<input type="number" name="busRate" value=<?php echo $row['busRate']; ?>>
		</div>
		<div class="input-group">
			<label>Maintenance Mode</label>
			<input type="checkbox" name="maintStatus" value="On" <?php echo 'checked="checked"'?>>
		</div>
	
		<div class="input-group">
			<button type="submit" class="btn" name="edit_bus">Submit</button>
		</div>
	</form>
	
		
</body>
</html>