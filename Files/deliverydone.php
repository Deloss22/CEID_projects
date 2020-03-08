<?php

session_start();

$srvname = "localhost";
$inputaddress = (isset($_POST['location']) ? $_POST['location'] : '');

$con = mysqli_connect($srvname, "root", "", "admindb");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($con,'utf8mb4');

$user = $_SESSION['deluser'];
$id = $_SESSION['idpass'];
$loc = $_SESSION['orderlocation'];
$distance = $_SESSION['distance'];
$qfinddist = "SELECT `distostore` FROM `orders` WHERE `id` = '$id'";
$dist = mysqli_query($con, $qfinddist);
$tostore = mysqli_fetch_assoc($dist);
$finaldist = $dist['distostore'];
$quedist = "UPDATE distributor SET `available`=1, `location` = '$loc', `distance`= `distance` + '$distance' + '$finaldist' ,`orders_done`= `orders_done` + 1 WHERE username = '$user';
UPDATE `orders` SET `complete` = 1 WHERE `idorder` = '$id';";
mysqli_multi_query($con, $quedist);

?>
