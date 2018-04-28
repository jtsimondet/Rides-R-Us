<?php include('server.php') ?>
<?php 
	//session_start(); 
	/*if ($_SESSION['role'] != 'admin') {
		$_SESSION['msg'] = "This page is only accessible by admins";
		header('location: index.php');
    }
    else{*/
		$query = "SELECT * FROM Bus";
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
			echo '<b>Bus ID: </b>', $row['busID'];
			echo "<br />";
			echo '<b>Number of Seats: </b>', $row['seatNum'];
			echo "<br />";
			echo '<b>Bus Rate: </b>', $row['busRate'];
			echo "<br />";
			if($row['maintStatus']){
				echo 'In Maintenance';
				echo "<br />";
			} else{
				//echo 'Operational';
			};
			echo "<br />";
		}?>
	</form>
	
		<div class="input-group">
        <p> <a href="add_bus.php" style="color: blue;">Add Bus</a> </p>
        <p> <a href="edit_bus.php" style="color: blue;">Edit Bus</a> </p>
        <p> <a href="index.php" style="color: blue;">home page</a> </p>
		</div>
	<!-- </div> -->
		
</body>
</html>