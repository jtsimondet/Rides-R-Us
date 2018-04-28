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
			echo "<input type=\"checkbox\" name=\"bus_select[]\" value=\"" . $row['busID'] .  "\">";
			echo '<b>Bus ID: </b>', $row['busID'];
			echo "<br />";
			echo '<b>Number of Seats: </b>', $row['seatNum'];
			echo "<br />";
			echo '<b>Bus Rate: </b>', $row['busRate'];
			echo "<br />";
			if($row['maintStatus'] == 1){
				echo 'In Maintenance';
				echo "<br />";
			} else{
				//echo 'Operational';
			};
			echo "<br />";
		}?>
		<div class="input-group">
			<button type="submit" class="btn" name="add_bus_redirect">Add Bus</button>
			<button type="submit" class="btn" name="edit_bus_redirect">Edit Bus</button>
			<button type="submit" class="btn" name="remove_bus">Remove Bus</button>
			<button class="btn" name="home_page">Homepage</button>
		</div>
	</form>
</body>
</html>