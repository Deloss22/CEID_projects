<?php

session_start();

$srvname = "localhost";
$inputtel = (isset($_POST['steln']) ? $_POST['steln'] : '');
$inputpswd = (isset($_POST['spswd']) ? $_POST['spswd'] : '');
$inputemail = (isset($_POST['semail']) ? $_POST['semail'] : '');
$_SESSION['email'] = $inputemail;

// Connect to db..
$con = mysqli_connect($srvname, "root", "", "userdb");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($con,'utf8mb4');

// Check if email exists..
$result = "SELECT * FROM `users` WHERE `email`='$inputemail'";
$ret = mysqli_query($con, $result);
$check = mysqli_fetch_assoc($ret);
if ($check){
    echo "Το email που συμπληρώσατε υπάρχει ήδη, μήπως έχετε λογαριασμό?";
}else {
    // Email check done, pass user info to db..
    $uinfo = "INSERT INTO `users`(id, tel, passwd, email) VALUES (NULL, '$inputtel', '$inputpswd', '$inputemail')";
    if (mysqli_query($con, $uinfo) && $inputtel != NULL && $inputpswd != NULL && $inputemail != NULL) {
        header('Location: home.php');
    } else {
        echo "Η εγγραφή απέτυχε, παρακαλώ προσπαθήστε ξανά";
    }
}
mysqli_close($con);
?>
