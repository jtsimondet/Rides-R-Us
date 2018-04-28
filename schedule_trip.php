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
		<?php include('errors.php'); ?>
		
		<?php if (!isset($_SESSION['role']) or ($_SESSION['role'] != 'customer')) : ?>
				<div class="input-group">
				<label>Guest Email Address</label>
				<input type="text" name="email" >
				</div>
		<?php endif?>
		<div class="input-group">
			<label>Pickup Address</label>
			<input id= "origin-input" class="controls" type="text" placeholder="Pickup Address" name="start_addr" >
		</div>
		<div class="input-group">
			<label>Destination</label>
			<input id="destination-input" class="controls" type="text" placeholder="Destination" name="end_addr">
		</div>
		<div id="map"></div>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxXH4mhMRJIT6Mwy35A0mK7fdaG1JF8lI&libraries=places&callback=initMap" async defer>
		</script>
		<div class="input-group">
			<label>Start time</label>
			<input type="datetime-local" name="start_time" >
		</div>
		<div class="input-group">
			<label>Number of seats</label>
			<input type="number" name="seat_num" value=1>
		</div>
		<div class="input-group">
			<label>Handicap</label>
			<input type="checkbox" name="handicap" value="On">
		</div>
			
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="schedule_trip">Schedule Trip</button>
		</div>
		
		<form>
    <script>
		function initMap() {
			var map = new google.maps.Map(document.getElementById('map'), {
				mapTypeControl: false,
				center: {lat: 44.311, lng: -96.798},
				zoom: 15,
				mapTypeId: 'roadmap'
			});
					
			new AutocompleteDirectionsHandler(map);
		}
				
		function AutocompleteDirectionsHandler(map) {
			this.map = map;
			this.originPlaceId = null;
			this.destinationPlaceId = null;
			this.travelMode = 'DRIVING';
			var originInput = document.getElementById('origin-input');
			var destinationInput = document.getElementById('destination-input');
			this.directionsService = new google.maps.DirectionsService;
			this.directionsDisplay = new google.maps.DirectionsRenderer;
			this.directionsDisplay.setMap(map);
					
			var originAutocomplete = new google.maps.places.Autocomplete(
				originInput, {placeIdOnly: true});
			var destinationAutocomplete = new google.maps.places.Autocomplete(
				destinationInput, {placeIdOnly: true});
						
			this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
			this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');
						
			this.map.controls.push(originInput);	
			this.map.controls.push(destinationInput);
		}
				
		AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(autocomplete, mode) {
			var me = this;
			autocomplete.bindTo('bounds', this.map);
			autocomplete.addListener('place_changed', function() {
				var place = autocomplete.getPlace();
				if(!place.place_id) {
					window.alert("Please select an option from the dropdown list.");
					return;
				}
				if(mode === 'ORIG') {
					me.originPlaceId = place.place_id;
				}else {
					me.destinationPlaceId = place.place_id;
				}
				me.route();
			});
		};
				
		AutocompleteDirectionsHandler.prototype.route = function() {
			if(!this.originPlaceId || !this.destinationPlaceId) {
				return;
			}
			var me = this;
					
			this.directionsService.route({
				origin: {'placeId': this.originPlaceId},
				destination: {'placeId': this.destinationPlaceId},
				travelMode: this.travelMode
			}, function(response, status) {
				if (status === 'OK') {
					me.directionsDisplay.setDirections(response);
				} else {	
					window.alert('Directions request failed due to ' + status);
				}
			});
		};  
			</script>
        </form>
	</form>


</body>
</html>
