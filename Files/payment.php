<?php
$year = $_GET['year'];
$month = $_GET['month'];

$con = mysqli_connect("localhost", "root", "", "admindb");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($con,'utf8mb4');

$writetemp = xmlwriter_open_memory();
xmlwriter_set_indent($writetemp, 1);
$res = xmlwriter_set_indent_string($writetemp, '  ');
xmlwriter_start_document($writetemp);
xmlwriter_start_element($writetemp, 'xml');
xmlwriter_start_element($writetemp, 'header');
xmlwriter_start_element($writetemp, 'transaction');
xmlwriter_start_element($writetemp, 'period');
xmlwriter_start_attribute($writetemp, 'month');
xmlwriter_text($writetemp, "$month");
xmlwriter_start_attribute($writetemp, 'year');
xmlwriter_text($writetemp, "$year");
xmlwriter_end_attribute($writetemp);
xmlwriter_end_attribute($writetemp);
xmlwriter_end_element($writetemp); // period
xmlwriter_end_element($writetemp); //trans
xmlwriter_end_element($writetemp); //header
xmlwriter_start_element($writetemp, 'body');
xmlwriter_start_element($writetemp, 'employees');

$que = "SELECT * FROM `manager`";
$man = mysqli_query($con, $que);

while ($manager = mysqli_fetch_assoc($man)) {
    xmlwriter_start_element($writetemp, 'employee');
    $total = 0.0;
    $manof = $manager['managerof'];
    $firstname = $manager['name'];
    $surname = $manager['surname'];
    $amka = $manager['amka'];
    $afm = $manager['afm'];
    $iban = $manager['iban'];
    $que2 = "SELECT * FROM `orders` WHERE `storename`= '$manof' AND `date` LIKE '$year-$month-%'";
    $ord = mysqli_query($con, $que2);

    while ($orders = mysqli_fetch_assoc($ord)) {
        $total += floatval($orders['total']);
    }
    $total = $total*0.02 +800;
    xmlwriter_start_element($writetemp, 'firstName');
    xmlwriter_text($writetemp, "$firstname");
    xmlwriter_end_element($writetemp); //fname
    xmlwriter_start_element($writetemp, 'lastName');
    xmlwriter_text($writetemp, "$surname");
    xmlwriter_end_element($writetemp); //lname
    xmlwriter_start_element($writetemp, 'amka');
    xmlwriter_text($writetemp, "$amka");
    xmlwriter_end_element($writetemp); //amka
    xmlwriter_start_element($writetemp, 'afm');
    xmlwriter_text($writetemp, "$afm");
    xmlwriter_end_element($writetemp); //afm
    xmlwriter_start_element($writetemp, 'iban');
    xmlwriter_text($writetemp, "$iban");
    xmlwriter_end_element($writetemp); //iban
    xmlwriter_start_element($writetemp, 'ammount');
    xmlwriter_text($writetemp, "$total");
    xmlwriter_end_element($writetemp); //ammount
    xmlwriter_end_element($writetemp); //employee
}

$dque = "SELECT * FROM `distributor`";
$dis = mysqli_query($con, $dque);
while ($distributor = mysqli_fetch_assoc($dis)) {
    xmlwriter_start_element($writetemp, 'employee');
    $duname = $distributor['username'];
    $dfirstname = $distributor['name'];
    $dsurname = $distributor['surname'];
    $damka = $distributor['amka'];
    $dafm = $distributor['afm'];
    $diban = $distributor['iban'];
    $sal = $distributor['salary'];
    xmlwriter_start_element($writetemp, 'firstName');
    xmlwriter_text($writetemp, "$dfirstname");
    xmlwriter_end_element($writetemp); //fname
    xmlwriter_start_element($writetemp, 'lastName');
    xmlwriter_text($writetemp, "$dsurname");
    xmlwriter_end_element($writetemp); //lname
    xmlwriter_start_element($writetemp, 'amka');
    xmlwriter_text($writetemp, "$damka");
    xmlwriter_end_element($writetemp); //amka
    xmlwriter_start_element($writetemp, 'afm');
    xmlwriter_text($writetemp, "$dafm");
    xmlwriter_end_element($writetemp); //afm
    xmlwriter_start_element($writetemp, 'iban');
    xmlwriter_text($writetemp, "$diban");
    xmlwriter_end_element($writetemp); //iban
    xmlwriter_start_element($writetemp, 'ammount');
    xmlwriter_text($writetemp, "$sal");
    xmlwriter_end_element($writetemp); //ammount
    xmlwriter_end_element($writetemp); //employee
    //zero distributor total(start of month)
    $zerodis = "UPDATE `distributor` SET `salary` = 0 WHERE `username` = '$duname'";
    mysqli_query($con, $zerodis);
    echo("Error description: " . mysqli_error($con));
}

xmlwriter_end_element($writetemp); //employees
xmlwriter_end_element($writetemp); //body
xmlwriter_end_element($writetemp); //xml
xmlwriter_end_document($writetemp);
$file = "payroll-$month-$year.xml";
file_put_contents($file, xmlwriter_output_memory($writetemp));

?>
