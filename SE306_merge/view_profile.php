<?php include('server.php') ?>
<?php 
	$db = mysqli_connect('localhost', 'root', '999555aa', 'ridesrus');
	//session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
    }
    else{
		$username = $_SESSION['username'];
		if($_SESSION['role'] == 'customer'){
			$query = "SELECT * FROM Customer WHERE customerID='$username'";
		} else if($_SESSION['role'] == 'driver'){
			$query = "SELECT * FROM Driver WHERE driverID='$username'";
        } else if($_SESSION['role'] == 'admin'){
			$query = "SELECT * FROM Admin WHERE adminID='$username'";
		}
		$results = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($results);
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
	<title>View profile</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>View profile Page</h2>
	</div>
	<div class="content">

	<?php if($_SESSION['role'] == 'admin') : ?>
		<div class="input-group">
			<label>First name: 
            <?php 
            echo $row['firstName'];
            ?> </label>
		</div>
		<div class="input-group">
			<label>Last name:
			<?php 
            echo $row['lastName'];
            ?> </label>
		</div>
	<?php endif ?>
	
	<?php if($_SESSION['role'] == 'driver') : ?>
		<div class="input-group">
			<label>First name: 
            <?php 
            echo $row['firstName'];
            ?> </label>
		</div>
		<div class="input-group">
			<label>Last name:
			<?php 
            echo $row['lastName'];
            ?> </label>
		</div>
	<?php endif ?>

	<?php if($_SESSION['role'] == 'customer') : ?>
		<div class="input-group">
			<label>First name: 
            <?php 
            echo $row['firstName'];
            ?> </label>
		</div>
		<div class="input-group">
			<label>Last name:
			<?php 
            echo $row['lastName'];
            ?> </label>
		</div>
        <div class="input-group">
			<label>phone number: 
			<?php 
            echo $row['phoneNo'];
            ?> </label>
		</div>
        <div class="input-group">
			<label>email address:
			<?php 
            echo $row['emailAddr'];
            ?> </label>
		</div>
	<?php endif ?>
	
		<div class="input-group">
        <p> <a href="Change_profile.php" style="color: blue;">Edit profile</a> </p>
        <p> <a href="index.php" style="color: blue;">home page</a> </p>
		</div>

		
</body>
</html>