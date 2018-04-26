<?php include('server.php') ?>
<?php 
	if(isset($_SESSION['role']) and $_SESSION['role'] == 'customer'){
		$username = $_SESSION['username'];
		$query = "SELECT * FROM CustomerTrip WHERE customerID='$username'";
		$results = mysqli_query($db, $query);
	} /*else{
		$query = "SELECT * FROM GuestTrip";
		$results = mysqli_query($db, $query);
	}*/
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Trips</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>View Trips Page</h2>
	</div>
	<!--<div class="content"> -->

	<form method="post" action="view_trips.php">
		<?php if(isset($_SESSION['role']) and ($_SESSION['role'] == 'customer')){
			while($row = mysqli_fetch_array($results)){
			echo '<b>Bus ID: </b>', $row['busID'];
			echo "<br />";
			echo '<b>Driver ID: </b>', $row['driverID'];
			echo "<br />";
			echo '<b>Pickup: </b>', $row['startAddr'];
			echo "<br />";
			echo '<b>Destination: </b>', $row['endAddr'];
			echo "<br />";
			echo '<b>Handicap?: </b>', $row['handicap'];
			echo "<br />";
			echo '<b>Number of Seats: </b>', $row['seats'];
			echo "<br />";
			echo "<br />";
			}
		}
		?>
	</form>
	
		<div class="input-group">
        <p> <a href="index.php" style="color: blue;">home page</a> </p>
		</div>
	<!-- </div> -->
		
</body>
</html>