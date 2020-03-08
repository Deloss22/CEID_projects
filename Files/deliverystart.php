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
$quedist = "UPDATE distributor SET `location` = '$inputaddress', `available`=1, `shiftstart`= NOW(), `distance`=0.0, `orders_done`=0, `daily_hours`=00 WHERE username = '$user'";
$distback = mysqli_query($con, $quedist);
if ($distback){
    header('Location: delivery.php');
}else{
    echo("Error description: " . mysqli_error($con));
}

?>
