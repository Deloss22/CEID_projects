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
		// Ajax for showing orders
		function showorder() {
					xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
								document.getElementById("sord").innerHTML = this.responseText;
						}
					};
					xmlhttp.open("GET","showorder.php",true);
					xmlhttp.send();
		}
		</script>
		<title>Coffee S.A. Manager</title>
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
					<header id="header" style="box-sizing:content-box;">
						<div class="logo">
							<span class="fa fa-coffee fa-2x" aria-hidden="true"></span>
						</div>
						<div class="content">
							<div class="inner">
								<h1>Coffee S.A.</h1>
								<p>Welcome <?php echo $_SESSION['manus']?>.</p>
								<p>ΠΑΡΑΓΓΕΛΙΕΣ ΠΟΥ ΕΚΚΡΕΜΟΥΝ:</p>
								<p id="sord"></p>
								<script type="text/javascript">
								 setInterval(showorder, 1000);
								</script>
							</div>
						</div>
						<nav>
								<button class="btn" onclick="window.location.href='#start'"><i class="fa fa-shopping-basket"></i>Απόθεμα</button>
								<button class="btn" onclick="window.location.href='managerconn.php'"><i class="fa fa-sign-out"></i>Έξοδος</button>
						</nav>
					</header>

				<!-- Main -->
					<div id="main">
						<!-- login -->
							<article id="start">
								<h2 class="major">Ενημέρωση Αποθέματος</h2>
								<p> Εισάγετε την ποσότητα του αποθέματος που παραλάβατε.</p>
								<form method="post" action="managerupdate.php">
								  <div class="fields">
								    <div class="field">
								      <label for="adress">Τυρόπιτες</label>
								      <input type="text" name="tiropites" id="tiropites" required="required" value="0"></input>
											<label for="adress">Σπανακόπιτες</label>
										 	<input type="text" name="spanakopites" id="spanakopites" required="required" value="0"></input>
										 	<label for="adress">Κουλούρια</label>
										  <input type="text" name="koulouria" id="koulouria" required="required" value="0"></input>
									 	  <label for="adress">Τοστ</label>
									 	  <input type="text" name="tost" id="tost" required="required" value="0"></input>
										  <label for="adress">Κέικ</label>
											<input type="text" name="keik" id="keik" required="required" value="0"></input>
									  </div>
								  </div>
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

	</body>
</html>
