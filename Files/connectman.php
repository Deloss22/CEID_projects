<?php

session_start();

$srvname = "localhost";
$inputuser = (isset($_POST['manusername']) ? $_POST['manusername'] : '');
$inputpswd = (isset($_POST['manpswd']) ? $_POST['manpswd'] : '');

// Connect to db..
$con = mysqli_connect($srvname, "root", "", "admindb");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($con,'utf8mb4');

$qcreds = "SELECT * FROM manager WHERE username = '$inputuser' AND password = '$inputpswd'";
$mancreds = mysqli_query($con, $qcreds);
$managerback = mysqli_fetch_assoc($mancreds);
if ($managerback){
    $_SESSION['manus'] = $managerback['name'];
    $_SESSION['manof'] = $managerback['managerof'];
    header('Location: managerhome.php');
  }else{
    header('Location: managerconn.php');
  }
?>
