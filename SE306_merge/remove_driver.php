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

?>
<!DOCTYPE html>
<html>
<head>
	<title>Remove driver</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Remove driver Page</h2>
	</div>
	<div class="content">
	
	<!-- Customer profile -->
    The List of Drivers: </br>
			<?php include('errors.php'); ?>
                <?php
                        $query="SELECT * FROM Driver";
                        $results = mysqli_query($db, $query);

                        if (mysqli_num_rows($results) > 0) {
                            // output data of each row
                            while($row = mysqli_fetch_assoc($results)) {
                                echo "Driver ID: " . $row["driverID"]. " - Name: " . $row["firstName"]. " " . $row["lastName"]. "<br>";
                            }
                        } else {
                            echo "No Driver on the list";
                        }
                    ?>
    </br>
    </br>

    Enter Driver ID to Remove Driver
    <form method="post" action="remove_driver.php">
        <div class="input-group">
                <label>Driver ID</label>
                <input type="text" name="Driver_ID">
            </div>
        <div class="input-group">
			<button type="submit" class="btn" name="remove_driver">Submit</button>
		</div>
    </form>

    <p> <a href="index.php" style="color: blue;">home page</a> </p>


	
		
</body>
</html>