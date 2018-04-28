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
		<form method="post" action="remove_driver.php">
        <div class="input-group">
			<button type="submit" class="btn" name="add_driver_redirect">Add Driver</button>
			<button type="submit" class="btn" name="edit_driver_redirect">Edit Driver</button>
			<button type="submit" class="btn" name="remove_driver">Remove Driver</button>
			<button class="btn" name="home_page">Homepage</button>
		</div>
		</form>
	</form>
</body>
</html>