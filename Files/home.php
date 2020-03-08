<?php session_start(); ?>


<!DOCTYPE HTML>
<!--
	Dimension by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Coffee S.A. Delivery</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel='shortcut icon' type='image/x-icon' href='favicon.png' />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<style>
		/* Button stylings */
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
				margin-left: 40px;
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
								<p>Welcome</p>
								<p><?php echo $_SESSION['email']?>.</p>
							</div>
						</div>
						<nav>
								<button class="btn" onclick="window.location.href='#delivery'"><i class="fa fa-truck"></i>παραγγελία</button>
								<button class="btn" onclick="location.href='index.html'"><i class="fa fa-times-circle"></i>Έξοδος</button>
								<button class="btn" onclick="window.location.href='#locabout'"><i class="fa fa-info-circle"></i>Για εμάς</button>
								<button class="btn" onclick="window.location.href='#contact'"><i class="fa fa-comment"></i>Επικοινωνία</button>
						</nav>
					</header>

				<!-- Main -->
					<div id="main">

						<!-- delivery -->
							<article id="delivery" style="margin: 0 0 0 0;">
								<h2 class="major">παραγγελία</h2>
								<span class="image main"><img src="images/pic04.jpg" alt="" /></span>
								<p>Ώρα για ένα λαχταριστό καφέ.</p>
								<form method="POST" action="/order.php" style="margin: 0 0 0 0;">
									<div class="fields" style="margin: 0 0 0 -1.5rem;">
										<div class="half field">
											<label for="cof">Ο καφές σας</label>
											<select name="delcoffee" id="delcoffee">
												<option value="none">None</option>
												<option value="greek">Ελληνικός</option>
 												<option value="frappe">Φραπέ</option>
 												<option value="espresso">Εσπρέσο</option>
												<option value="cappuccino">Καπουτσίνο</option>
												<option value="filter">Φίλτρου</option>
											</select>
										</div>
										<div class="half field">
											<label for="dname">Ποσότητα</label>
											<input type="text" name="quacof" id="quacof"></input>
										</div>

										<div class="half field">
											<label for="snack">Το σνάκ σας</label>
											<select name="delsnack" id="delsnack">
												<option value="none">None</option>
												<option value="cheese">Τυρόπιτα</option>
												<option value="spinach">Χορτόπιτα</option>
												<option value="koulouri">Κουλούρι</option>
	 											<option value="tost">Τοστ</option>
	 											<option value="cake">Κέικ</option>
											</select>
										</div>
										<div class="half field">
											<label for="dname">Ποσότητα</label>
											<input type="text" name="quasnack" id="quasnack"></input>
										</div>

										<div class="half field">
											<label for="dname">Όνομα</label>
											<input type="text" name="delname" id="delname" required="required"></input>
										</div>
										<div class="half field">
											<label for="floor">Όροφος</label>
											<input type="text" name="delfloor" id="delfloor" required="required"></input>
										</div>

										<div class="half field">
											<label for="email">Διεύθυνση</label>
											<input type="text" name="searchterm" id="searchterm" required="required"/>
										</div>

									<div id="mapdel" style="margin: 25px; width:95%; height:300px; border-radius: 5px;"></div>

									<ul class="actions"	style="margin: 0 0 0 -1rem;">
										<button type="submit" class="btnlogsin"><i class="fa fa-list-alt"></i>Καταχώρηση</button>
								    <button type="reset" class="btnres"><i class="fa fa-eraser"></i>Επαναφορά</button>
									</ul>
								</form>
							</article>

						<!-- locate/about -->
							<article id="locabout">
								<h2 class="major">Για εμάς</h2>
								<span class="image main"><img src="images/pic03.jpg" alt="" /></span>
								<p>Established in Patras. 2018.</p>
								<h2 class="major">Τα καταστήματα μας</h2>
								<div id="storelocation" style="width:100%;height:400px; border-radius: 5px;"></div>
							</article>

						<!-- contact -->
							<article id="contact">
								<h2 class="major">Επικοινωνία</h2>
								<form method="post" action="#">
									<div class="fields">
										<div class="field half">
											<label for="name">Name</label>
											<input type="text" name="Name" id="name" />
										</div>
										<div class="field half">
											<label for="email">Email</label>
											<input type="text" name="Email" id="email" />
										</div>
										<div class="field">
											<label for="message">Message</label>
											<textarea name="message" id="Message" rows="4"></textarea>
										</div>
									</div>
									<ul class="actions" style="margin: 0 0 0 -2.5rem;">
										<button type="submit" class="btnlogsin"><i class="fa fa-share-square"></i>Αποστολή</button>
										<button type="reset" class="btnres"><i class="fa fa-eraser"></i>Επαναφορά</button>
									</ul>
								</form>
								<ul class="icons">
									<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
									<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
									<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
									<li><a href="#" class="icon fa-github"><span class="label">GitHub</span></a></li>
								</ul>
							</article>

					 </div> <!--  divmain -->
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
				activatePlacesSearch();
				mapdel();
				maploc();
				}
			</script>
			<script>
					// global vars
					var mapdel;
					var markers = [];
					// autocomplete geocodeAddress
					function activatePlacesSearch(){
						var input = document.getElementById('searchterm');
						var autocomplete = new google.maps.places.Autocomplete(input);
					}
					// map for user delivery
					function mapdel() {
					  var myCenterdel = new google.maps.LatLng(38.238759, 21.743198);
					  var mapCanvasdel = document.getElementById("mapdel");
					  var mapOptionsdel = {center: myCenterdel, zoom: 12};
					  var mapdel = new google.maps.Map(mapCanvasdel, mapOptionsdel);
					  var geocoder = new google.maps.Geocoder();
						var infowindow = new google.maps.InfoWindow;
						document.getElementById('searchterm').addEventListener('change', function() {
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
									document.getElementById('searchterm').value = pass;
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
					  var address = document.getElementById('searchterm').value;
					  geocoder.geocode({'address': address}, function(results, status) {
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
					// map for stores
					function maploc() {
						var myCenter = new google.maps.LatLng(38.238759, 21.743198);
						var store1 = new google.maps.LatLng(38.229636, 21.733848);
						var store2 = new google.maps.LatLng(38.256016, 21.742959);
						var store3 = new google.maps.LatLng(38.246877, 21.735396);
						var store4 = new google.maps.LatLng(38.238927, 21.728368);
						var mapCanvas = document.getElementById("storelocation");
						var mapOptions = {center: myCenter, zoom: 12};
						var map = new google.maps.Map(mapCanvas, mapOptions);
						var marker1 = new google.maps.Marker({position:store1});
						var marker2 = new google.maps.Marker({position:store2});
						var marker3 = new google.maps.Marker({position:store3});
						var marker4 = new google.maps.Marker({position:store4});
						marker1.setMap(map);
						marker2.setMap(map);
						marker3.setMap(map);
						marker4.setMap(map);
					}
			</script>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHsh-ig63fRFRSwh17CpmRE_TT_6tG4HA&libraries=places&callback=initmaps"></script>
	</body>
</html>
