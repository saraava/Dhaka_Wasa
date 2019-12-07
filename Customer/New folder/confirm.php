<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo htmlspecialchars($custname)?></title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php

include "../config.php";

session_start();

$user = $seq;

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['$seq']) || empty($_SESSION['$seq'])){
  header("location: register.php");
  exit;
}

$sql = oci_parse($conn,"SELECT * FROM customer where account_no = '$user'");
    if (!$sql)
    {
        echo "error";
    }

    $rs = oci_execute($sql);
    oci_fetch($sql);
	$custname=oci_result($sql,'CUST_NAME') ; 
	$row = 	oci_num_rows($sql);
	
	if (!$rs)
	{
			echo oci_error();
	}
	
   
    oci_free_statement($sql);
    oci_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo htmlspecialchars($custname)?></title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="wrap">
		<div id="header">			
			<h1 id="logo-text"><a href="index.html"></a></h1>		
			<p id="slogan"><img src="http://app.dwasa.org.bd/epay/wasapay/img/wasa_text.gif"></p>				
		</div>

  
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" style="color:red;">CUSTOMER PAGE</h1>
                    
					 <h2 style="color:blue;" >Hi, <b><?php echo htmlspecialchars($custname); ?></b>. Welcome to DHAKA WASA</h2>
					 <h2 style="color:blue;" >Hi, <b><?php echo htmlspecialchars($user); ?></b>. Your account number is</h2>
					 
					 
					
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->
		
		
		
		
		</div>	
		
				
<div id="footer">
		<p>Powered by <a href="Group-8" title="" target="blank"><strong>Group-8</strong></a></p>
	</div>	



    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>

</body>
</html>

     