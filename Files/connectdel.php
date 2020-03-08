<?php

session_start();

$srvname = "localhost";
$inputuser = (isset($_POST['delusername']) ? $_POST['delusername'] : '');
$inputpswd = (isset($_POST['delpswd']) ? $_POST['delpswd'] : '');

// Connect to db..
$con = mysqli_connect($srvname, "root", "", "admindb");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($con,'utf8mb4');

$disque= "SELECT * FROM distributor WHERE username = '$inputuser' AND password = '$inputpswd'";
$discreds = mysqli_query($con, $disque);
$deliveryback = mysqli_fetch_assoc($discreds);
if ($deliveryback){
    $_SESSION['delus'] = $deliveryback['name'];
    $_SESSION['deluser'] = $deliveryback['username'];
    header('Location: deliveryhome.php');
  }else{
    header('Location: deliveryconn.php');
  }
?>
