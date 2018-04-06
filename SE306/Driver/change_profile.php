<?php include('server.php') ?>
<?php 
	session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
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
	<title>Edit profile</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Edit profile Page</h2>
	</div>
	<div class="content">

	<form method="post" action="change_profile.php">
		<?php include('errors.php'); ?>
		<div class="input-group">
			<label>First name</label>
			<input type="text" name="first_name">
		</div>
		<div class="input-group">
			<label>Last name</label>
			<input type="text" name="last_name">
		</div>
        <div class="input-group">
			<label>phone number</label>
			<input type="number" name="phone_number">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="change_profile">submit</button>
		</div>
	</form>
		
</body>
</html>