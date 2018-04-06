<?php 
	session_start();

	// variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('127.0.0.1', 'root', 'sunMINXUAN-', 'SE_306');


	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM Driver WHERE driverID='$username' AND driverPWD='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

		// change profile
	if(isset($_POST['change_profile']))
	{
		$username = $_SESSION['username'];
		$first_name = mysqli_real_escape_string($db, $_POST['first_name']);
		$last_name = mysqli_real_escape_string($db, $_POST['last_name']);
		$phone_number = mysqli_real_escape_string($db, $_POST['phone_number']);


		if (empty($first_name)) {
			array_push($errors, "first name is required");
		}
		if (empty($last_name)) {
			array_push($errors, "last name is required");
		}
		if (empty($phone_number)) {
			array_push($errors, "phone number is required");
		}
		

		if(strlen($first_name) > 20)
		{
			array_push($errors, "first name should be less than 20 characters");
		}
		if(strlen($last_name) > 20)
		{
			array_push($errors, "last name should be less than 20 characters");
		}
		if($phone_number > 10000000000 && $phone_number < 999999999)
		{
			array_push($errors, "phone number must be 10 digits");
		}

		if (count($errors) == 0) 
		{
			$query = "UPDATE Driver SET firstName = '$first_name', lastName = '$last_name' , phoneNo = '$phone_number' WHERE driverID = '$username'" ;

			if (mysqli_query($db, $query)) {
				$_SESSION['success'] = "Edit profile successfully";
				header('location: index.php');
			}else {
				array_push($errors, "can't edit your profile, please contact the network administrator");
			}

		}
	}

?>