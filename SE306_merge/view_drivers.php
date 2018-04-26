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
	<title>View Driver</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>View Driver Page</h2>
	</div>
	<!--<div class="content"> -->

	<form method="post" action="view_drivers.php">

	<?php include('errors.php'); ?>
		
		<?php while($row = mysqli_fetch_array($results)){
			echo "<input type=\"checkbox\" name=\"driver_select[]\" value=\"" . $row['driverID'] .  "\">";
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
		<div class="input-group">
			<button type="submit" class="btn" name="Remove_driver">Remove Driver</button>
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="Edit_driver_pay_rate">Edit Driver Pay Rate</button>
		</div>
	</form>
	
		<div class="input-group">
        <p> <a href="driver_register.php" style="color: blue;">Add Driver</a> </p>
        <p> <a href="index.php" style="color: blue;">home page</a> </p>
		</div>
	<!-- </div> -->
		
</body>
</html>