<?php include('server.php') ?>
<?php 
	//session_start(); 
	/*if ($_SESSION['role'] != 'admin') {
		$_SESSION['msg'] = "This page is only accessible by admins";
		header('location: index.php');
    }
    else{*/
		$query = "SELECT * FROM Driver";
		$results = mysqli_query($db, $query);
        //$row = mysqli_fetch_array($results);
	//}
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Bus</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>View Bus Page</h2>
	</div>
	<!--<div class="content"> -->

	<form method="post" action="view_buses.php">
		
		<?php while($row = mysqli_fetch_array($results)){
			echo '<b>Driver ID: </b>', $row['driverID'];
			echo "<br />";
			echo '<b>First Name: </b>', $row['firstName'];
			echo "<br />";
			echo '<b>Last Name: </b>', $row['lastName'];
			echo "<br />";
			echo '<b>Phone #: </b>', $row['phoneNo'];
			echo "<br />";
			echo '<b>Pay Rate: </b>', $row['payRate'];
			echo "<br />";
		}?>
	</form>
	
		<div class="input-group">
        <p> <a href="driver_register.php" style="color: blue;">Add Driver</a> </p>
        <p> <a href="edit_driver.php" style="color: blue;">Edit Driver</a> </p>
        <p> <a href="index.php" style="color: blue;">home page</a> </p>
		</div>
	<!-- </div> -->
		
</body>
</html>