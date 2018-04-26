<?php include('server.php') ?>
<?php 
	//session_start(); 

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
	<title>Reset Password</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Reset Password</h2>
	</div>
	<div class="content">

	<form method="post" action="reset_password.php">
		<?php include('errors.php'); ?>
		<div class="input-group">
			<label>New Password</label>
			<input type="password" name="reset_password1">
		</div>
		<div class="input-group">
			<label>Confirm New Password</label>
			<input type="password" name="reset_password2">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="reset_password">submit</button>
		</div>
	</form>
		
</body>
</html>