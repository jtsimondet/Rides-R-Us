<?php include('server.php') ?>
<?php 
	//session_start(); 
	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
		echo $_SESSION['role'];
		
	}
	
	$username = $_SESSION['username'];
	if(isset($_SESSION['role']) and $_SESSION['role'] == 'customer'){
		$query = "SELECT * FROM Customer WHERE customerID='$username' LIMIT 1";
	} else if(isset($_SESSION['role']) and $_SESSION['role'] == 'driver'){
		$query = "SELECT * FROM Driver WHERE driverID='$username' LIMIT 1";
	} else if(isset($_SESSION['role']) and $_SESSION['role'] == 'admin'){
		$query = "SELECT * FROM Admin WHERE adminID='$username' LIMIT 1";
	}
	
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
				<input type="text" name="first_name" value=<?php echo $row['firstName']; ?>>
			</div>
			<div class="input-group">
				<label>Last name</label>
				<input type="text" name="last_name" value=<?php echo $row['lastName']; ?>>
			</div>
			<div class="input-group">
				<label>Phone number</label>
				<input type="number" name="phone_number" value=<?php echo $row['phoneNo']; ?>>
			</div>
			<div class="input-group">
				<label>Email address</label>
				<input type="email" name="email_address" value=<?php echo $row['emailAddr']; ?>>
			</div>
			<div class="input-group">
				<button type="submit" class="btn" name="profile_change">Submit</button>
			</div>
		</form>
	<?php endif ?>
	
	<!-- Admin profile -->
	<?php if($_SESSION['role'] == 'admin') : ?>
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
				<button type="submit" class="btn" name="profile_change">submit</button>
			</div>
		</form>
	<?php endif ?>
	
	<!-- Driver profile -->
	<?php if($_SESSION['role'] == 'driver') : ?>
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
				<label>phone number</label>
				<input type="number" name="phone_number" value=<?php echo $row['phoneNo']; ?>>
			</div>
			<div class="input-group">
				<button type="submit" class="btn" name="profile_change">submit</button>
			</div>
		</form>
	<?php endif ?>
	
		
</body>
</html>