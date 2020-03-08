<?php

session_start();

$srvname = "localhost";
$inputtel = (isset($_POST['lteln']) ? $_POST['lteln'] : '');
$inputpswd = (isset($_POST['lpswd']) ? $_POST['lpswd'] : '');

// Connect to db..
$con = mysqli_connect($srvname, "root", "", "userdb");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($con,'utf8mb4');

$qcreds = "SELECT * FROM users WHERE `tel` = '$inputtel' AND `passwd` = '$inputpswd'";
$creds = mysqli_query($con, $qcreds);
$retcreds = mysqli_fetch_assoc($creds);
if ($retcreds){
    $_SESSION['email'] = $retcreds['email'];
    header('Location: home.php');
}else{
    header('Location: index.html');
}
?>
