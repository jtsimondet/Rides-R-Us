<?php include('server.php') ?>
<?php 
	//session_start(); 
	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
    }
    else if ($_SESSION['role'] != 'driver' && $_SESSION['role'] != 'admin')
    {
        $_SESSION['msg'] = "you don't have right to view this page";
		header('location: login.php');
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
	<title>Send notification page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Send notification page</h2>
	</div>
    <form method="post" action="send_notification.php">
    Customer ID: <input type="text" name="customer_id">
    <textarea rows="4" cols="50" name="comment">
    Enter message here...</textarea>

    <div class="input-group">
    <button type="submit" class="btn" name="send_message">submit</button>
	</div>
    <div class="input-group">
    <button type="submit" class="btn" name="cancel">cancel</button>
	</div>
    </form>
    <br>
	
		
</body>
</html>