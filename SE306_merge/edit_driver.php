<?php include('server.php') ?>
<?php 
	//session_start(); 
	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
		echo $_SESSION['role'];
		
	}
	$driverID = $_SESSION['driverID'];
	$query = "SELECT * FROM Driver WHERE driverID='$driverID' LIMIT 1";
	
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
	<title>Change Driver</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Change Driver Page</h2>
	</div>
	<div class="content">
	<!-- Driver profile -->
		<form method="post" action="change_profile.php">
			<?php include('errors.php'); ?>
			<div class="input-group">
				<label>First name</label>
				<input type="text" name="first_name" value=<?php echo $row['firstName']; ?>>
			</div>
			<div class="input-group">
				<label>Last name</label>
				<input type="text" name="last_name" value=<?php echo $row['lastName']; ?>>
			</div>
			<div class="input-group">
				<label>Phone number</label>
				<input type="number" name="phone_number" value=<?php echo $row['phoneNo']; ?>>
			</div><div class="input-group">
				<label>Pay rate</label>
				<input type="number" name="phone_number" value=<?php echo $row['payRate']; ?>>
			</div>
			<div class="input-group">
				<button type="submit" class="btn" name="profile_change">Submit</button>
			</div>
		</form>
	
		
</body>
</html>