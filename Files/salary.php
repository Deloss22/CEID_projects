<?php
//daily salary to show in deliveryhome.php
session_start();

$srvname = "localhost";

$con = mysqli_connect($srvname, "root", "", "admindb");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($con,'utf8mb4');

$delusername = $_SESSION['deluser'];
$que = "SELECT `daily_hours`, `distance`, `orders_done` FROM `distributor` WHERE `username` = '$delusername' ";
$var = mysqli_query($con, $que);
$var2 = mysqli_fetch_assoc($var);
list($h, $m) = explode(':',$var2['daily_hours']);
$decimal = $m/60;
$hoursAsDecimal = $h+$decimal;
$distance = floatval($var2['distance']);
$total = $hoursAsDecimal*5+$distance*0.1;
$orders = $var2['orders_done'];
echo "Your daily salary: $total €";
echo "<br>";
echo "Orders done: $orders";
echo "<br>";
echo "Distance travelled: $distance km";
mysqli_close($con);

?>
