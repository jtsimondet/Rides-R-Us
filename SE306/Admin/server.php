<?php 
	session_start();

	// variable declaration
	$username = "";
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
			$query = "SELECT * FROM Admin WHERE adminID='$username' AND AdminPWD='$password'";
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

		if (empty($first_name)) {
			array_push($errors, "first name is required");
		}
		if (empty($last_name)) {
			array_push($errors, "last name is required");
		}

		if(strlen($first_name) > 20)
		{
			array_push($errors, "first name should be less than 20 characters");
		}
		if(strlen($last_name) > 20)
		{
			array_push($errors, "last name should be less than 20 characters");
		}

		if (count($errors) == 0) 
		{
			$query = "UPDATE Admin SET firstName = '$first_name', lastName = '$last_name' WHERE adminID = '$username'" ;

			if (mysqli_query($db, $query)) {
				$_SESSION['success'] = "Change profile successfully";
				header('location: index.php');
			}else {
				array_push($errors, "can't change your profile, please contact the network administrator");
			}

		}
	}

	// reset password
	if(isset($_POST['reset_password']))
	{
		$username = $_SESSION['username'];
		$reset_password1 = mysqli_real_escape_string($db, $_POST['reset_password1']);
		$reset_password2 = mysqli_real_escape_string($db, $_POST['reset_password2']);

		if (empty($reset_password1)) {
			array_push($errors, "Please enter your password");
		}
		if (empty($reset_password2)) {
			array_push($errors, "Please confirm your password");
		}

		if ($reset_password1 != $reset_password2) {
			array_push($errors, "The two passwords do not match");
		}
		else
		{
			if(strlen($reset_password1) > 20)
			{
				array_push($errors, "password should be less than 20 characters");
			}
			if(strlen($reset_password1) < 8)
			{
				array_push($errors, "password should be greater than 8 characters");
			}
		}



		if (count($errors) == 0) 
		{
			$password = md5($reset_password1);
			$query = "UPDATE Admin SET AdminPWD = '$password' WHERE adminID = '$username'" ;

			if (mysqli_query($db, $query)) {
				$_SESSION['success'] = "Reset password successfully";
				header('location: index.php');
			}else {
				array_push($errors, "can't change your profile, please contact the network administrator");
			}

		}
	}

	// driver registration
	if (isset($_POST['driver_register'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
		$first_name = mysqli_real_escape_string($db, $_POST['first_name']);
		$last_name = mysqli_real_escape_string($db, $_POST['last_name']);
		$phone_number = mysqli_real_escape_string($db, $_POST['phone_number']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }
		if (empty($password_2)) { array_push($errors, "Please confirm your password"); }
		if (empty($first_name)) { array_push($errors, "First name is required"); }
		if (empty($last_name)) { array_push($errors, "last name is required"); }
		if (empty($phone_number)) { array_push($errors, "phone number is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// first check the database to make sure 
		// a user does not already exist with the same username and/or email
		$user_check_query = "SELECT * FROM Driver WHERE driverID='$username' LIMIT 1";
		$result = mysqli_query($db, $user_check_query);
		$user = mysqli_fetch_assoc($result);
		
		if ($user) { // if user exists
			if ($user['driverID'] === $username) {
			array_push($errors, "Username already exists");
			}
		}

		// other fields error checking
		if(strlen($username) > 20)
		{
			array_push($errors, "username should be less than 20 characters");
		}
		if(strlen($username) < 6)
		{
			array_push($errors, "username should be greater than 6 characters");
		}
		if(strlen($password_1) > 20)
		{
			array_push($errors, "password should be less than 20 characters");
		}
		if(strlen($password_1) < 8)
		{
			array_push($errors, "password should be greater than 8 characters");
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
			array_push($errors, "error format of phone number");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO Driver (driverID, driverPWD, fristName, lastName, phoneNo) 
					  VALUES('$username', '$password', '$first_name', '$last_name', '$phone_number')";

			mysqli_query($db, $query);

			$_SESSION['success'] = "Driver registration successfully";
			header('location: index.php');
		}

	}

?>