<?php

$username = '';
require "config.php";
session_start();
  

$username = $_SESSION['accno'];

if(!isset($_SESSION['accno']) || empty($_SESSION['accno'])){
  header("location: bill.php");
  exit;
}
if (session_status() == PHP_SESSION_NONE  || session_id() == '') {
            session_start();
        }
    $billno = $_SESSION["billno"];
	$billdate = $_SESSION["billdate"];

$sql = oci_parse($conn,"select bill_no,bill_swarage,bill_vat,(CURRENT_READING-PREVIOUS_READING)*10 ,bill_swarage+bill_vat+(CURRENT_READING-PREVIOUS_READING)*10
from customer_bill join bill_process using (bill_no,bill_date) join meter_reading using (meter_no)
where bill_no='$billno' and bill_date='$billdate'");

if (!$sql)
{
  echo "error";
}

$rs = oci_execute($sql);
if (!$rs)
{
  echo oci_error();
}

$sql


?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?></title>
  <link rel="stylesheet" href="../bootstrap-3.3.7-dist/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-inverse">

  <div class="container-fluid">

    <ul class="nav navbar-nav">

      <li><a href="index.php" class="glyphicon glyphicon-home">HOME</a> </li>

    </ul>

    <ul class="nav navbar-nav navbar-right">

      <li><a href="../login/logout.php">Logout</a> </li>

    </ul>

  </div>

</nav>

<div class="container">

    <h1><?php echo " Bill of"." ".$username ?></h1>
   <!-- <p ><span style="font-weight: bold">Meter No: </span> <?php echo oci_result($sql,"Meter_no")?></p> -->
    <p ><span style="font-weight: bold">Bill No: </span> <?php echo oci_result($sql,"bill_no")?></p>
    <p ><span style="font-weight: bold">Sewerage Bill: </span> <?php echo oci_result($sql,"bill_swarage")?></p>
    <p ><span style="font-weight: bold">VAT: </span> <?php echo oci_result($sql,"bill_vat")?></p>
    <p ><span style="font-weight: bold">Water Bill: </span> <?php echo oci_result($sql,"(CURRENT_READING-PREVIOUS_READING)*10 ")?></p>
    <p ><span style="font-weight: bold">Total Bill: </span> <?php echo oci_result($sql,"bill_swarage+bill_vat+(CURRENT_READING-PREVIOUS_READING)*10")?></p>
    


</div>


</body>
</html>