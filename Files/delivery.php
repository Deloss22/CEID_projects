<?php session_start(); ?>

<!DOCTYPE HTML>
<!--
	Dimension by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<script>
		function showorderdel() {
						// code for IE7+, Firefox, Chrome, Opera, Safari
						xmlhttp = new XMLHttpRequest();

						xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
							document.getElementById("sorddel").innerHTML = this.responseText;
					}
			};
						xmlhttp.open("GET","showorderdel.php",true);
						xmlhttp.send();
					}
					function accept() {
						$.get("deliveryaccept.php");
						alert("Έχετε παραγγελία προς παράδοση:");
						return false;
					}

					function done() {
							$.get("deliverydone.php");
							alert("H παραγγελία παράδωθηκε με επιτυχία:");
							return false;

					}
            </script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
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
					<header id="header" style="box-sizing:content-box;">
						<div class="logo">
							<span class="fa fa-coffee fa-2x" aria-hidden="true"></span>
						</div>
						<div class="content">
							<div class="inner">
								<h1>Coffee S.A.</h1>
								<p><?php echo $_SESSION['delus']?> ΤΏΡΑ ΕΊΣΤΕ ΕΝΕΡΓΌΣ/Ή.</p>
								<p id="sorddel"></p>
								<script type="text/javascript">
								var inter = setInterval(showorderdel, 1000);
								</script>
								<div  id="mapdel" style="margin: 25px 25px 25px 0px; width:100%; height:300px; border-radius: 5px;"></div>
							</div>
						</div>
						<nav>
                <button class="btn" id="accept" onclick="clearInterval(inter); accept()"><i class="fa fa-check"></i>Αποδοχή</button>
								<button class="btn" id="done" onclick="inter=setInterval(showorderdel, 1000); done()"><i class="fa fa-money"></i>Ολοκλήρωση</button>
								<button class="btn" onclick="window.location.href='deliveryexit.php';"><i class="fa fa-sign-out"></i>Έξοδος</button>
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

				<!-- Footer -->
					<footer id="footer">
						<p blah blah cc</p>
					</footer>
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
			// maps function
			function initmaps(){
				mapdel();
			}
			</script>
			<script>
			// global vars
					var mapdel;
					var markers = [];

					// map for user delivery
					function mapdel() {
						var myCenterdel = new google.maps.LatLng(38.238759, 21.743198);
						var mapCanvasdel = document.getElementById("mapdel");
						var mapOptionsdel = {center: myCenterdel, zoom: 12};
						var mapdel = new google.maps.Map(mapCanvasdel, mapOptionsdel);
						var geocoder = new google.maps.Geocoder();
						geocodeAddress(geocoder, mapdel);
					}

					//geocode
					function geocodeAddress(geocoder, resultsMap) {
						geocoder.geocode({'address': "<?php echo $_SESSION['orderlocation']; ?>"}, function(results, status) {
							if (status === 'OK') {
								var test = results[0].geometry.location;
								placeMarkerAndPanTo(test, resultsMap);
							} else {
								alert('Geocode was not successful for the following reason: ' + status);
							}
						});
					}

					// markers functions
					function placeMarkerAndPanTo(latLng, mapdel) {
						marker = new google.maps.Marker({
						position: latLng,
						mapdel: mapdel
						});
						marker.setMap(mapdel);
						mapdel.setZoom(16);
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
			</script>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHsh-ig63fRFRSwh17CpmRE_TT_6tG4HA&libraries=places&callback=initmaps"></script>
	</body>
</html>
