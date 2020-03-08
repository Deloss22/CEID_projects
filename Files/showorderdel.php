<!DOCTYPE html>
<html>
  <head>
      <style>
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

$delusername = $_SESSION['deluser'];
$que = "SELECT `location` FROM distributor WHERE `username` = '$delusername' ";
$loccont = mysqli_query($con, $que);
$loc = mysqli_fetch_assoc($loccont);
$delocation = $loc['location'];
$geocodeData = getGeocodeData($delocation);
if($geocodeData) {
    $dellat = $geocodeData[0];
    $dellong = $geocodeData[1];
    $sortedstore = calculateDistance($dellat, $dellong, $con);
}

foreach ($sortedstore as  $storeback => $values) {
    $queord = "SELECT * FROM `orders` WHERE `storename` = '$storeback' AND `complete` = 0 AND `sentflag` = 0";
    $ord = mysqli_query($con, $queord);
    if($ordback = mysqli_fetch_array($ord)){
        $_SESSION['distance'] = $values;
        $_SESSION['idpass'] = $ordback['idorder'];
        $_SESSION['orderlocation'] = $ordback['address'];
        echo  "<table>";
        echo "<tr>";
        echo  "<th>Store:</th>";
        echo "<td>" . $ordback['storename'] . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo  "<th>Total:</th>";
        echo "<td>" . $ordback['total'] . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo  "<th>Name:</th>";
        echo "<td>" . $ordback['name'] . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo  "<th>Floor:</th>";
        echo "<td>" . $ordback['floor'] . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<th>Address:</th>";
        echo "<td>" . $ordback['address'] . "</td>";
        echo "</tr>";
        echo "</table>";
        break;
    }
}
echo "</table>";

mysqli_close($con);


function getGeocodeData($address) {
    $address = urlencode($address);
    $googleMapUrl = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyDHsh-ig63fRFRSwh17CpmRE_TT_6tG4HA";
    $geocodeResponseData = file_get_contents($googleMapUrl);
    $responseData = json_decode($geocodeResponseData, true);
    if($responseData['status']=='OK') {
        $latitude = isset($responseData['results'][0]['geometry']['location']['lat']) ? $responseData['results'][0]['geometry']['location']['lat'] : "";
        $longitude = isset($responseData['results'][0]['geometry']['location']['lng']) ? $responseData['results'][0]['geometry']['location']['lng'] : "";
        $formattedAddress = isset($responseData['results'][0]['formatted_address']) ? $responseData['results'][0]['formatted_address'] : "";
        if($latitude && $longitude && $formattedAddress) {
            $geocodeData = array();
            array_push($geocodeData, $latitude, $longitude, $formattedAddress);
            return $geocodeData;
        } else {
            return false;
        }
    } else {
        echo "ERROR: {$responseData['status']}";
        return false;
    }
}

function calculateDistance($dellat, $dellong, $con){
    $storelat = array();
    $storelong = array();
    $storelat[0] = 38.229636;
    $storelong[0] = 21.733848;
    $storelat[1] = 38.256016;
    $storelong[1] = 21.742959;
    $storelat[2] = 38.246877;
    $storelong[2] = 21.735396;
    $storelat[3] = 38.238927;
    $storelong[3] = 21.728368;
    $kmdist = array();
    for ($i = 0; $i < 4; $i++){
        $theta = $dellong - $storelong[$i];
        $dist = sin(deg2rad($dellat)) * sin(deg2rad($storelat[$i])) +  cos(deg2rad($dellat)) * cos(deg2rad($storelat[$i])) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $kmdist[$i] = $dist * 60 * 1.1515 * 1.609344;
    }
    $idstore = array("saripoulou"=>$kmdist[0],
      "konstantinoupoleos"=>$kmdist[1],
      "maizonos"=>$kmdist[2],
      "korinthou"=>$kmdist[3]);
    asort($idstore);
    return $idstore;
}

?>

</body>
</html>
