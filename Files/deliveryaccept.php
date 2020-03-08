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
$quedist = "UPDATE distributor SET `available` = 0 WHERE `username` = '$user';
UPDATE `orders` SET `sentflag` = 1 WHERE `idorder` = ".$id.";";
mysqli_multi_query($con, $quedist);
?>
