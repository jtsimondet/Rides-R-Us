<?php 
	session_start();
	// variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', '999555aa', 'ridesrus');


	// REGISTER USER
	if (isset($_POST['cust_reg'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
		$first_name = mysqli_real_escape_string($db, $_POST['first_name']);
		$last_name = mysqli_real_escape_string($db, $_POST['last_name']);
		$phone_number = mysqli_real_escape_string($db, $_POST['phone_number']);
		// form validation: ensure that the form is correctly filled
		if (empty($email)) { array_push($errors, "Email is required"); }
		//if (empty($first_name)) { array_push($errors, "First name is required"); }
		//if (empty($last_name)) { array_push($errors, "last name is required"); }
		//if (empty($phone_number)) { array_push($errors, "phone number is required"); }
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}
		// first check the database to make sure 
		// a user does not already exist with the same username and/or email
		$user_check_query = "SELECT * FROM Customer WHERE customerID='$username' OR emailAddr='$email' LIMIT 1";
		$result = mysqli_query($db, $user_check_query);
		$user = mysqli_fetch_assoc($result);
		
		if ($user) { // if user exists
			if ($user['customerID'] === $username) {
			array_push($errors, "Username already exists");
			}
			if ($user['emailAddr'] === $email) {
			array_push($errors, "email already exists");
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
		if(strlen($password_1) < 6)
		{
			array_push($errors, "password should be greater than 6 characters");
		}
		if(strlen($first_name) > 20)
		{
			array_push($errors, "first name should be less than 20 characters");
		}
		if(strlen($last_name) > 20)
		{
			array_push($errors, "last name should be less than 20 characters");
		}
		if($phone_number > 10000000000 || $phone_number < 999999999 && !empty($phone_number))
		{
			array_push($errors, "error format of phone number");
		}
		if(strlen($email) > 40)
		{
			array_push($errors, "email should be less than 40 characters");
		}
		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO Customer (customerID, customerPWD, firstName, lastName, phoneNo, emailAddr) 
					  VALUES('$username', '$password', '$first_name', '$last_name', '$phone_number', '$email')";
			mysqli_query($db, $query);
			$_SESSION['username'] = $username;
			$_SESSION['role'] = 'customer';
			$_SESSION['success'] = "You are now logged in";
			header('location: index.php');
		}
	}
	// ... 
	//CUSTOMER LOGIN
	if (isset($_POST['login_customer'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		//error checking
		if (empty($username) and empty($password)){
			array_push($errors, "Username and password are required");
		} else if (empty($username)) {
			array_push($errors, "Username is required");
		} else if (empty($password)) {
			array_push($errors, "Password is required");
		}
		//end error checking
		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM Customer WHERE customerID='$username' AND customerPWD='$password'";
			$results = mysqli_query($db, $query);
			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['role'] = 'customer';
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}
	
	//DRIVER LOGIN
	if (isset($_POST['login_driver'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		//error checking
		if (empty($username) and empty($password)){
			array_push($errors, "Username and password are required");
		} else if (empty($username)) {
			array_push($errors, "Username is required");
		} else if (empty($password)) {
			array_push($errors, "Password is required");
		}
		//end error checking
		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM Driver WHERE driverID='$username' AND driverPWD='$password'";
			$results = mysqli_query($db, $query);
			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['role'] = 'driver';
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}
	
	//ADMIN LOGIN
	if (isset($_POST['login_admin'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		//error checking
		if (empty($username) and empty($password)){
			array_push($errors, "Username and password are required");
		} else if (empty($username)) {
			array_push($errors, "Username is required");
		} else if (empty($password)) {
			array_push($errors, "Password is required");
		}
		//end error checking
		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM Admin WHERE adminID='$username' AND adminPWD='$password'";
			$results = mysqli_query($db, $query);
			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['role'] = 'admin';
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}
	
	// merged change profile
	if(isset($_POST['profile_change']))
	{
		echo $_SESSION['role'];
		$username = $_SESSION['username'];
		$first_name = mysqli_real_escape_string($db, $_POST['first_name']);
		$last_name = mysqli_real_escape_string($db, $_POST['last_name']);
		if($_SESSION['role'] == 'customer' OR $_SESSION['role'] == 'driver'){
			$phone_number = mysqli_real_escape_string($db, $_POST['phone_number']);
			$email_address = mysqli_real_escape_string($db, $_POST['email_address']);
		}
		if (empty($first_name)) {
			array_push($errors, "first name is required");
		}
		if (empty($last_name)) {
			array_push($errors, "last name is required");
		}
		if($_SESSION['role'] == 'customer' OR $_SESSION['role'] == 'driver'){
			if (empty($phone_number)) {
				array_push($errors, "phone number is required");
			}
			if (empty($email_address)) {
				array_push($errors, "email address is required");
			}
		}
		
		if(strlen($first_name) > 20)
		{
			array_push($errors, "first name should be less than 20 characters");
		}
		if(strlen($last_name) > 20)
		{
			array_push($errors, "last name should be less than 20 characters");
		}
		
		if($_SESSION['role'] == 'customer' OR $_SESSION['role'] == 'driver'){
			if($phone_number > 10000000000 && $phone_number < 999999999)
			{
				array_push($errors, "error format of phone number");
			}
			if(strlen($email) > 40)
			{
				array_push($errors, "email should be less than 40 characters");
			}
		}
		if (count($errors) == 0) 
		{
			if($_SESSION['role'] == 'customer'){
				$query = "UPDATE Customer SET firstName = '$first_name', lastName = '$last_name' , phoneNo = '$phone_number', emailAddr = '$email_address' WHERE customerID = '$username'" ;
			} else if($_SESSION['role'] == 'driver'){
				$query = "UPDATE Driver SET firstName = '$first_name', lastName = '$last_name' , phoneNo = '$phone_number', emailAddr = '$email_address' WHERE driverID = '$username'" ;
			} else if($_SESSION['role'] == 'admin'){
				$query = "UPDATE Admin SET firstName = '$first_name', lastName = '$last_name' WHERE adminID = '$username'" ;
			}
			
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
			if($_SESSION['role'] == 'customer'){
				$query = "UPDATE Customer SET CustomerPWD = '$password' WHERE customerID = '$username'" ;
			} else if($_SESSION['role'] == 'driver'){
				$query = "UPDATE Driver SET driverPWD = '$password' WHERE driverID = '$username'" ;
			} else if($_SESSION['role'] == 'admin'){
				$query = "UPDATE Admin SET adminPWD = '$password' WHERE adminID = '$username'" ;
			}
			if (mysqli_query($db, $query)) {
				$_SESSION['success'] = "Reset password successfully";
				header('location: index.php');
			}else {
				array_push($errors, "can't reset your password, please contact the network administrator");
			}
		}
	}
	
	//SCHEDULE TRIP
	if (isset($_POST['schedule_trip'])) {
		$username = $_SESSION['username'];
		$start_addr = mysqli_real_escape_string($db, $_POST['start_addr']);
		$start_time = mysqli_real_escape_string($db, $_POST['start_time']);
		$end_addr = mysqli_real_escape_string($db, $_POST['end_addr']);
		$end_time = mysqli_real_escape_string($db, $_POST['end_time']);
		//$handicap = mysqli_real_escape_string($db, $_POST['handicap']);
		if(isset($_POST['handicap']) && $_POST['handicap'] == 'On'){
			echo "Need wheelchair access.";
		} else {
			echo "Do not need wheelchair access.";
		}   

		$seats = mysqli_real_escape_string($db, $_POST['seats']);
		//echo $handicap;
		$orderID = substr(md5(microtime()),rand(0,26),5);
		echo $orderID;
		
		if($username == null){
			echo 'Guest';
		} else if($username != null){
			echo 'Customer';
		}
		/*
		$query = "INSERT INTO Orders (orderID, customerID, busID, driverID, seatNum, emailAddr,
			startAddr, startTime, endAddr, endTime, payment) 
					  
					  VALUES('$username', '$password', '$first_name', '$last_name', '$phone_number', '$email')";
		*/
		/*orderID 	CHAR(5) NOT NULL, 
		customerID 	INT,
		busID 		INT NOT NULL,
		driverID 	INT NOT NULL, 
		seatNum 	INT NOT NULL,
		emailAddr	VARCHAR(255),
			startAddr	VARCHAR(255) NOT NULL,
			startTime	DATETIME NOT NULL,
			endAddr		VARCHAR(255) NOT NULL,
			endTime		DATETIME NOT NULL,
		payment 	DECIMAL(2,2) NOT NULL,
		handicap	BIT NOT NULL,
		seats		INT NOT NULL,
		PRIMARY KEY (OrderID), 
		FOREIGN KEY (emailAddr) REFERENCES Guest(emailAddr),
		FOREIGN KEY (busID) REFERENCES Bus(busID), 
		FOREIGN KEY (driverID) REFERENCES Driver(driverID), 
		FOREIGN KEY (customerID) REFERENCES Customer(customerID)
		*/
	}
	
	//VIEW BUSES
	if(isset($_POST['view_buses']))
	{
		$busID = mysqli_real_escape_string($db, $_POST['busID']);
		$seatNum = mysqli_real_escape_string($db, $_POST['seatNum']);
		$busRate = mysqli_real_escape_string($db, $_POST['busRate']);
		$maintStatus = mysqli_real_escape_string($db, $_POST['maintStatus']);
		
	}
	
	//ADD BUS
	if (isset($_POST['add_bus'])) {
		$busID = mysqli_real_escape_string($db, $_POST['busID']);
		$seatNum = mysqli_real_escape_string($db, $_POST['seatNum']);
		$busRate = mysqli_real_escape_string($db, $_POST['busRate']);
		//$maintStatus = mysqli_real_escape_string($db, $_POST['maintStatus']);
		//$handicap = mysqli_real_escape_string($db, $_POST['handicap']);
		if(isset($_POST['maintStatus']) && $_POST['maintStatus'] == 'On'){
			$maintStatus = 1;
		} else {
			$maintStatus = 0;;
		}   

		if (empty($busID)) { array_push($errors, "There must be a bus ID"); }
		elseif(strlen($busID) != 5){
			array_push($errors, "Bus ID must be exactly 5 characters");
		}
		if (empty($seatNum)) { array_push($errors, "Number of seats must be specified"); }
		if (empty($busRate)) { array_push($errors, "Bus rate must be specified"); }
		// first check the database to make sure 
		// that bus does not already exist
		$user_check_query = "SELECT * FROM Bus WHERE busID='$busID' LIMIT 1";
		$result = mysqli_query($db, $user_check_query);
		$user = mysqli_fetch_assoc($result);
		
		if ($user) {
			array_push($errors, "A bus with that ID already exists");
		} 
		if($seatNum < 1){
			array_push($errors, "A bus should have at least one seat");
		}
		if($busRate < 0){
			array_push($errors, "The bus rate cannot be negative");
		}
		// add bus if no errors
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO Bus (busID, seatNum, busRate, maintStatus) 
					  VALUES('$busID', '$seatNum', '$busRate', '$maintStatus')";
			mysqli_query($db, $query);
			header('location: view_buses.php');
		}
	}
	
	//ADD LOCATION
	if (isset($_POST['add_location'])) {
		$locationID = mysqli_real_escape_string($db, $_POST['locationID']);
		if(isset($_POST['maintStatus']) && $_POST['maintStatus'] == 'On'){
			$maintStatus = 1;
		} else {
			$maintStatus = 0;;
		}   

		if (empty($locationID)) { array_push($errors, "There must be a location ID"); }
		elseif(strlen($locationID) > 255){
			array_push($errors, "Location must be under 255 characters");
		}
		// first check the database to make sure 
		// that location does not already exist
		$user_check_query = "SELECT * FROM PickupLocation WHERE locationID='$locationID' LIMIT 1";
		$result = mysqli_query($db, $user_check_query);
		$user = mysqli_fetch_assoc($result);
		
		// add location if no errors
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO PickupLocation (locationID) 
					  VALUES('$locationID')";
			mysqli_query($db, $query);
			header('location: view_locations.php');
		}
	}
?>