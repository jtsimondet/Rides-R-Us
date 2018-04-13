<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Schedule a Trip</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>Schedule a Trip</h2>
	</div>
	
	<form method="post" action="schedule_trip.php">
		still need driver and bus integration
		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Start address</label>
			<input type="text" name="start_addr" >
		</div>
		<div class="input-group">
			<label>Start time</label>
			<input type="datetime-local" name="start_time" >
		</div>
		<div class="input-group">
			<label>End address</label>
			<input type="text" name="end_addr">
		</div>
		<div class="input-group">
			<label>End time</label>
			<input type="datetime-local" name="end_time" >
		</div>
		<div class="input-group">
			<label>Handicap</label>
			<input type="checkbox" name="handicap" >
		</div>
		<div class="input-group">
			<label>Number of seats</label>
			<input type="number" name="seats" >
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="schedule_trip">Schedule Trip</button>
		</div>
		<p>
			Not yet a member? <a href="customer_register.php">Sign up</a>
		</p>
	</form>


</body>
</html>