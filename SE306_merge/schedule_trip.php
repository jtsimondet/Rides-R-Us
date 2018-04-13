<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta charset="UTF-8">
<style>
	#map{
		height: 300px;
	}
	html, body {
		height: 100%;
		margin: 0;
		padding: 0;
	}
	.controls{
		margin-top: 10px;
		border: 1px solid transparent;
		border-radius: 2px 0 0 2px;
		box-sizing: border-box;
		-moz-box-sizing: border-box;
		height: 32px;
		outline: none;
		box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
	}
	
	#origin-input,
	#destination-input {
		background-color: #fff;
		font-family: Roboto;
		font-size: 15px;
		font-weight: 300;
		margin-left: 12px;
		padding: 0 11px 0 13px;
		text-overflow: ellipsis;
		width: 200px;
	}
	#origin-input: focus,
	#destination-input: focus {
		border-color: #4d90fe;
	}
</style>
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
