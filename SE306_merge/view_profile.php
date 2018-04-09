<?php include('server.php') ?>
<?php 
	//session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
    }
    else if($_SESSION['role'] == 'customer'){
		$username = $_SESSION['username'];
        $db = mysqli_connect('localhost', 'root', '999555aa', 'ridesrus');
        $query = "SELECT * FROM Customer WHERE customerID='$username'";
        $results = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($results);
	} else if($_SESSION['role'] == 'driver'){
		$username = $_SESSION['username'];
        $db = mysqli_connect('localhost', 'root', '999555aa', 'ridesrus');
        $query = "SELECT * FROM Driver WHERE driverID='$username'";
        $results = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($results);
	} else if($_SESSION['role'] == 'admin'){
		$username = $_SESSION['username'];
        $db = mysqli_connect('localhost', 'root', '999555aa', 'ridesrus');
        $query = "SELECT * FROM Admin WHERE adminID='$username'";
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
		<div class="input-group">
        <p> <a href="Change_profile.php" style="color: blue;">Edit profile</a> </p>
        <p> <a href="index.php" style="color: blue;">home page</a> </p>
		</div>

		
</body>
</html>