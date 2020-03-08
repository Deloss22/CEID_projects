<?php

session_start();

$srvname = "localhost";
$inputcof = (isset($_POST['delcoffee']) ? $_POST['delcoffee'] : '');
$inputquacof = (isset($_POST['quacof']) ? $_POST['quacof'] : '');
$inputsnack = (isset($_POST['delsnack']) ? $_POST['delsnack'] : '');
$inputquasnack = (isset($_POST['quasnack']) ? $_POST['quasnack'] : '');
$inputname = (isset($_POST['delname']) ? $_POST['delname'] : '');
$inputfloor= (isset($_POST['delfloor']) ? $_POST['delfloor'] : '');
$inputadr = (isset($_POST['searchterm']) ? $_POST['searchterm'] : '');
$cliemail = $_SESSION['email'];

if ($cliemail){
    $con = mysqli_connect($srvname, "root", "", "admindb");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_set_charset($con,'utf8mb4');

    //calculate closest store
    $sortedstore = array();
    $geocodeData = getGeocodeData($inputadr);
    if($geocodeData) {
        $dellat = $geocodeData[0];
        $dellong = $geocodeData[1];
        $address = $geocodeData[2];
        $sortedstore = calculateDistance($dellat, $dellong, $con);
    }
    //calculate total
    // coffee
    $total = 0.00;
    $qcfpr = "SELECT `price` FROM `products` WHERE `prod`='$inputcof'";
    $pricecof = mysqli_query($con, $qcfpr);
    $cfpr = mysqli_fetch_assoc($pricecof);
    $cprice = floatval($cfpr['price']);
    $total += $cprice*$inputquacof;
    // snack
    $qsnpr = "SELECT `price` FROM `products` WHERE `prod`='$inputsnack'";
    $pricesn = mysqli_query($con, $qsnpr);
    $snpr = mysqli_fetch_assoc($pricesn);
    $sprice = floatval($snpr['price']);
    $total += $sprice*$inputquasnack;

    $counter = 0;
    foreach ($sortedstore as $store => $kmdist) {
        $qry = "SELECT * FROM `products` WHERE `prod` = '$inputsnack' ";
        $check = mysqli_query($con, $qry);
        $final = mysqli_fetch_assoc($check);
        $counter += 1;
        if ($final[$store]>=$inputquasnack) {
            $ordins = "INSERT INTO `orders`(`coffee`, `quacof`, `snack`, `quasnack`, `total`, `name`, `floor`, `address`, `storename`,
              `idorder`, `clientemail`, `date`, `distostore`) VALUES ('$inputcof', '$inputquacof', '$inputsnack', '$inputquasnack',
              '$total' ,'$inputname', '$inputfloor', '$inputadr', '$store', NULL, '$cliemail', NOW(), '$kmdist')";

            if (mysqli_query($con, $ordins)) {
                $produp = "UPDATE `products` SET ".$store." = ".$store." - '$inputquasnack' WHERE `prod` = '$inputsnack'";
                mysqli_query($con, $produp);
                $message = "New order created successfully";
                echo "<script type='text/javascript'>alert('$message'); location.href = 'home.php';</script>";
                break;
            } else {
               echo "Failed to create order, please try again";
            }
        } elseif ($counter == 4) {
        $message = "Λυπούμαστε αλλά δεν υπάρχει απάθεμα για την ολοκλήρωση της παραγγελίας σας.";
        echo "<script type='text/javascript'>alert('$message'); location.href = 'home.php';</script>";
        }
    }
    mysqli_close($con);
}else{
  echo "Please reconnect to order";
}

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
    //saripoulou latlong
    $storelat[0] = 38.229636;
    $storelong[0] = 21.733848;
    //konstantinoupoleos latlong
    $storelat[1] = 38.256016;
    $storelong[1] = 21.742959;
    //maizonos latlong
    $storelat[2] = 38.246877;
    $storelong[2] = 21.735396;
    //korinthou latlong
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
