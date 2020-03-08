<!DOCTYPE HTML>
<!--
	Dimension by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Coffee S.A. Distributor</title>
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
								<p>Distributor log in page.</p>
							</div>
						</div>
						<nav>
								<button class="btn" onclick="window.location.href='#login'"><i class="fa fa-sign-in"></i>Είσοδος</button>
								<button class="btn" onclick="window.location.href='#locabout'"><i class="fa fa-info-circle"></i>Για εμάς</button>
						</nav>
					</header>

				<!-- Main -->
					<div id="main">
						<!-- login -->
							<article id="login">
								<h2 class="major">Είσοδος</h2>
								<span class="image main"><img src="images/pic05.jpg" alt="" /></span>
								<p> Κάντε login και ξεκινήστε να παραδίδετε παραγγελίες.</p>
								<form method="post" action="connectdel.php">
								  <div class="fields">
								    <div class="field half">
								      <label for="username">Username</label>
								      <input type="text" name="delusername" id="delusername" required="required"></input>
								    </div>
								    <div class="field half">
								      <label for="ps">Password</label>
								      <input type="password" name="delpswd" id="delpswd" required="required"></input>
								    </div>
								  </div>
								  <ul class="actions">
								    <button type="submit" class="btnlogsin"><i class="fa fa-sign-in"></i>Είσοδος</button>
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

								<script>
								function myMap() {
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

								<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHsh-ig63fRFRSwh17CpmRE_TT_6tG4HA&callback=myMap"></script>

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

	</body>
</html>
