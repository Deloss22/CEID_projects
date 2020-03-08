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
$quedist = "UPDATE distributor SET `location` = NULL, `available`=0, `daily_hours`= TIMEDIFF(NOW(), `shiftstart`) WHERE `username` = '$user'";
$updist = mysqli_query($con, $quedist);

//daily salary calculation...
$upd = "SELECT `daily_hours`,`distance` FROM distributor WHERE `username` = '$user' ";
$updq = mysqli_query($con, $upd);
$updback = mysqli_fetch_assoc($updq);
list($h, $m) = explode(':',$updback['daily_hours']);
$decimal = $m/60;
$hoursAsDecimal = $h+$decimal;
$distance = floatval($updback['distance']);
$total = $hoursAsDecimal*5+$distance*0.1;

//update total salary...
$sal = "UPDATE distributor SET `salary`=`salary`+'$total' WHERE `username` = '$user'";
$salq = mysqli_query($con, $sal);
if ($updist && $salq && $updq){
    header('Location: deliveryhome.php');
}else{
    echo("Error description: " . mysqli_error($con));
}

?>
