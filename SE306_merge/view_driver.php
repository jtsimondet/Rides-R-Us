<?php include('server.php') ?>
<?php 
	//session_start(); 

	if (!isset($_SESSION['username'] )) {
		$_SESSION['msg'] = "You must log in first";
		header('location: admin_login.php');
    }
    else if($_SESSION['role'] != "admin")
    {
        $_SESSION['msg'] = "You don't have privilige to view this page.";
        header('location: index.php');
    }

	// if (isset($_GET['logout'])) {
	// 	session_destroy();
	// 	unset($_SESSION['username']);
	// 	header("location: login.php");
	// }

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
    <form method="post" action="view_driver.php">
        <div class="content">
                <?php
                    $query="SELECT * FROM Driver";
                    $results = mysqli_query($db, $query);

                    if (mysqli_num_rows($results) > 0) {
                        // output data of each row
                        echo "<div class=\"input-group\">";
                        while($row = mysqli_fetch_assoc($results)) {
                            echo "Driver ID: " . $row["driverID"]. " - Name: " . $row["firstName"]. " " . $row["lastName"].  " -Phone number: " . $row["phoneNo"] . " -Pay Rate: ". $row["payRate"] . "<br>";
                        }
                    } else {
                        echo "No Driver on the list";
                    }
                ?>
        </div>
    </forrm>



		<div class="input-group">
        <p> <a href="index.php" style="color: blue;">home page</a> </p>
		</div>

		
</body>
</html>