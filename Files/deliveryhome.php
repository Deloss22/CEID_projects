<?php session_start();?>

<!DOCTYPE HTML>
<!--
	Dimension by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<script>
		function salary() {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp = new XMLHttpRequest();

						xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
							document.getElementById("SAL").innerHTML = this.responseText;
					}
			};
						xmlhttp.open("GET","salary.php",true);
						xmlhttp.send();
					}
		</script>
		<title>Coffee S.A. Distributor</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel='shortcut icon' type='image/x-icon' href='favicon.png' />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<style>
			.btn {
    		background-color: none;
    		border: 0.2px solid white;
    		color: white;
				text-align: center;
				width: 140px;
    		font-size: 12px;
    		cursor: pointer;
				margin-left: 0px;
				padding: 0px;
			}
			.btnlogsin {
    		background-color: none;
    		border: 0.2px solid white;
    		text-decoration-color: grey;
				text-align: center;
				width: 140px;
    		font-size: 12px;
    		cursor: pointer;
				margin-left: 16px;
				padding: 0px;
			}
			.btnres {
				background-color: none;
				border: 0.2px solid white;
				color: white;
				text-align: center;
				width: 140px;
				font-size: 12px;
				cursor: pointer;
				margin-left: 10px;
				padding: 0px;
			}
/* Darker background on mouse-over */
			.btn:hover {
    		opacity: 0.5;
			}
			.btnlogsin:hover {
				opacity: 0.5;
			}
			.btnres:hover {
				opacity: 0.5;
			}
		</style>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="logo">
							<span class="fa fa-coffee fa-2x" aria-hidden="true"></span>
						</div>
						<div class="content">
							<div class="inner">
								<h1>Coffee S.A.</h1>
								<p>Welcome <?php echo $_SESSION['delus']?>.</p>
								<span id="SAL">
								<script type="text/javascript">
								var inter = setInterval(salary, 1000);
								</script>
							</span>
							</div>
						</div>
						<nav>
								<button class="btn" onclick="window.location.href='#start'"><i class="fa fa-sign-in"></i>Εκκίνηση</button>
								<button class="btn" onclick="window.location.href='deliveryconn.php'"><i class="fa fa-sign-out"></i>Έξοδος</button>
						</nav>
					</header>

				<!-- Main -->
					<div id="main">
						<!-- login -->
							<article id="start">
								<h2 class="major">Φόρμα διεύθυνσης</h2>
								<p> Εισάγετε τοποθεσία.</p>
								<form method="post" action="deliverystart.php">
								  <div class="fields">
								    <div class="field half">
								      <label for="adress">Διεύθυνση</label>
								      <input type="text" name="location" id="location" required="required"></input>
								    </div>
								  </div>
									<div  id="mapdel" style="margin: 25px 25px 25px 0px; width:95%; height:300px; border-radius: 5px;"></div>
								  <ul class="actions">
								    <button type="submit" class="btnlogsin"><i class="fa fa-sign-in"></i>Αποστολή</button>
								    <button type="reset" class="btnres"><i class="fa fa-eraser"></i>Επαναφορά</button>
								  </ul>
								</form>
							</article>

					</div>
			<!--div for wrapper -->
			</div>

		<!-- BG -->
			<div id="bg"></div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script>
			function initmaps(){
				activatePlacesSearch();
				mapdel();
				}
			</script>
			<script>
					var mapdel;
					var markers = [];
					function activatePlacesSearch(){
						var input = document.getElementById('location');
						var autocomplete = new google.maps.places.Autocomplete(input);
					}

					function mapdel() {
						var myCenterdel = new google.maps.LatLng(38.238759, 21.743198);
						var mapCanvasdel = document.getElementById("mapdel");
						var mapOptionsdel = {center: myCenterdel, zoom: 12};
						var mapdel = new google.maps.Map(mapCanvasdel, mapOptionsdel);
						var geocoder = new google.maps.Geocoder();
						var infowindow = new google.maps.InfoWindow;
						document.getElementById('location').addEventListener('change', function() {
							geocodeAddress(geocoder, mapdel);
						});
						mapdel.addListener('dblclick', function(pos) {
							geocodeLatLng(geocoder, mapdel, infowindow, pos.latLng);
						 });
					}

					//geodecode
					function geocodeLatLng(geocoder, map, infowindow, latlng) {
						geocoder.geocode({'location': latlng}, function(results, status) {
							if (status === 'OK') {
								if (results[0]) {
									placeMarkerAndPanTo(latlng, map);
									var pass = results[0].formatted_address;
									document.getElementById('location').value = pass;
								} else {
									window.alert('No results found');
								}
							} else {
								window.alert('Geocoder2 failed due to: ' + status);
							}
						});
					}


					//geocode
					function geocodeAddress(geocoder, resultsMap) {
						var address = document.getElementById('location').value;
						geocoder.geocode({'address': address}, function(results, status) {
							if (status === 'OK') {
								var test = results[0].geometry.location;
								placeMarkerAndPanTo(test, resultsMap);
							} else {
								alert('Geocode was not successful for the following reason: ' + status);
							}
						});
					}

					function placeMarkerAndPanTo(latLng, mapdel) {
						marker = new google.maps.Marker({
						draggable: true,
						position: latLng,
						mapdel: mapdel
						});
						marker.setMap(mapdel);
						mapdel.panTo(latLng);
						ClearMarkers();
						markers.push(marker);
					}
					function ClearMarkers(mapdel) {
						for (var i = 0; i < markers.length; i++) {
							markers[i].setMap(null);
						}
						markers = [];
					}

					function maploc() {
						var myCenterloc = new google.maps.LatLng(38.238759, 21.743198);
						var katast1loc = new google.maps.LatLng(38.229636, 21.733848);
						var katast2loc = new google.maps.LatLng(38.256016, 21.742959);
						var katast3loc = new google.maps.LatLng(38.246877, 21.735396);
						var katast4loc = new google.maps.LatLng(38.238927, 21.728368);
						var mapCanvasloc = document.getElementById("maploc");
						var mapOptionsloc = {center: myCenterloc, zoom: 12};
						var maploc = new google.maps.Map(mapCanvasloc, mapOptionsloc);
						var marker1 = new google.maps.Marker({position:katast1loc});
						var marker2 = new google.maps.Marker({position:katast2loc});
						var marker3 = new google.maps.Marker({position:katast3loc});
						var marker4 = new google.maps.Marker({position:katast4loc});
						marker1.setMap(maploc);
						marker2.setMap(maploc);
						marker3.setMap(maploc);
						marker4.setMap(maploc);
					}
			</script>

			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHsh-ig63fRFRSwh17CpmRE_TT_6tG4HA&libraries=places&callback=initmaps"></script>

	</body>
</html>
