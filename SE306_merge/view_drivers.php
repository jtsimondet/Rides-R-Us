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
		
		<?php 
		if(!isset($_POST['Edit_driver_pay_rate']))
		{ 
			while($row = mysqli_fetch_array($results)){
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
			}

			echo
			"<div class=\"input-group\">
			<button type=\"submit\" class=\"btn\" name=\"Remove_driver\">Remove Driver</button>
		</div>
		<div class=\"input-group\">
			<button type=\"submit\" class=\"btn\" name=\"Edit_driver_pay_rate\">Edit Driver Pay Rate</button>
		</div>";
		}
		else if(isset($_POST['Edit_driver_pay_rate']) && isset($_POST['driver_select']))
		{
			$count = 0;
			while($count < count($_POST['driver_select']))
			{	
				$driverID =  $_POST['driver_select'][$count];

				$query = "SELECT * FROM Driver WHERE driverID = '$driverID'";
				$results = mysqli_query($db, $query);
				$row = mysqli_fetch_array($results);

				echo "Driver ID: ". $driverID . "</br>";
				echo "Name: " . $row['firstName'] . " " . $row['lastName'] . "</br>";
				echo "Pay Rate: <input type=\"text\" name=\"driver_select_edit_pay_rate[]\" value = \"$driverID\"><br>";
				$count = $count + 1;
			}
		echo
		"<div class=\"input-group\">
			<button type=\"submit\" class=\"btn\" name=\"submit_Edit_driver_pay_rate\">Submit</button>
		</div>";
		}
		else
		{
			echo "<div class=\"error\">";
			echo "Please select driver!";
			echo"</div>";
			while($row = mysqli_fetch_array($results)){
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
				
			}
			echo
			"<div class=\"input-group\">
			<button type=\"submit\" class=\"btn\" name=\"Remove_driver\">Remove Driver</button>
		</div>
		<div class=\"input-group\">
			<button type=\"submit\" class=\"btn\" name=\"Edit_driver_pay_rate\">Edit Driver Pay Rate</button>
		</div>";

		}
		?>
	</form>
	
		<div class="input-group">
        <p> <a href="driver_register.php" style="color: blue;">Add Driver</a> </p>
        <p> <a href="index.php" style="color: blue;">home page</a> </p>
		</div>
		
</body>
</html>