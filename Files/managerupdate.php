<?php

session_start();

$srvname = "localhost";
$tiropites = (isset($_POST['tiropites']) ? $_POST['tiropites'] : '');
$spanakopites = (isset($_POST['spanakopites']) ? $_POST['spanakopites'] : '');
$koulouria = (isset($_POST['koulouria']) ? $_POST['koulouria'] : '');
$tost = (isset($_POST['tost']) ? $_POST['tost'] : '');
$keik = (isset($_POST['keik']) ? $_POST['keik'] : '');
$manager = $_SESSION['manof'];

$con = mysqli_connect($srvname, "root", "", "admindb");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($con,'utf8mb4');

$qry = "UPDATE  `products` SET ".$manager." = ".$manager."+'$tiropites' WHERE `idprod` = 6;
     UPDATE  `products` SET ".$manager." = ".$manager."+'$spanakopites' WHERE `idprod` = 7;
     UPDATE  `products` SET ".$manager." = ".$manager."+'$koulouria' WHERE `idprod` = 8;
     UPDATE  `products` SET ".$manager." = ".$manager."+'$tost' WHERE `idprod` = 9;
     UPDATE  `products` SET ".$manager." = ".$manager."+'$keik' WHERE `idprod` = 10;";

if (mysqli_multi_query($con, $qry)) {
    $message = "Updated storage successfully";
    echo "<script type='text/javascript'>alert('$message');</script>";
} else {
  $message = "Failed to update, please try again";
  echo "<script type='text/javascript'>alert('$message');</script>";
}

mysqli_close($con);

?>
