<!DOCTYPE html>
<html>
<head>
<style>
  table {
    width: 100%;
    border-collapse: collapse;
    overflow: hidden; */
  }

  table, td, th {
    border: 1px solid black;
    padding: 5px;
  }
th {text-align: left;}
</style>
</head>
<body>

<?php
$srvname = "localhost";

session_start();

$con = mysqli_connect($srvname, "root", "", "admindb");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($con,'utf8mb4');

$store = $_SESSION['manof'];
$queord = "SELECT * FROM `orders` WHERE `storename` = '$store' AND `complete` = 0 ";
$ordercont = mysqli_query($con, $queord);

echo "<table>
<tr>
<th>Store</th>
<th>Coffee</th>
<th>Quantity</th>
<th>Snack</th>
<th>Quantity</th>
<th>Name</th>
<th>Floor</th>
<th>Address</th>
<th>ID</th>
</tr>";
while($row = mysqli_fetch_array($ordercont)) {
    echo "<tr>";
    echo "<td>" . $row['storename'] . "</td>";
    echo "<td>" . $row['coffee'] . "</td>";
    echo "<td>" . $row['quacof'] . "</td>";
    echo "<td>" . $row['snack'] . "</td>";
    echo "<td>" . $row['quasnack'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['floor'] . "</td>";
    echo "<td>" . $row['address'] . "</td>";
    echo "<td>" . $row['idorder'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>

</body>
</html>
