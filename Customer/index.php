<?php

include "../config.php";

session_start();

$user = $_SESSION['accno'];

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['accno']) || empty($_SESSION['accno'])){
  header("location: login.php");
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

    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Main Page</a>
            </div>
			<ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu dropdown-user">
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php"><i class="fa fa-home fa-fw"></i> HOME</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> View<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="bill.php">View Bill</a>
                                </li>
                                <li>
                                    <a href="#">Bill Payment</a>
                                </li>
								<li>
                                    <a href="complain.php">Complain</a>
                                </li>
								<li>
                                    <a href="owncomplain.php">Own Complain</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
</div>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" style="color:red;">CUSTOMER PAGE</h1>
                    
					 <h2 style="color:blue;" >Hi, <b><?php echo htmlspecialchars($custname); ?></b>. Welcome to DHAKA WASA</h2>
					 
					 <h4 style="color:blue;">Select a task to continue</h4>
					 <a href="bill.php" class="btn btn-lg btn-primary">View Bill <span class="glyphicon glyphicon-usd"></span></a>
					 <a href="#" class="btn btn-lg btn-success">Pay Bill <span class="glyphicon glyphicon-usd"></span></a>
					 <a href="complain.php" class="btn btn-lg btn-danger">Complain <span class="glyphicon glyphicon-wrench"></span></a>
					
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
