<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <style type="text/css">
        body
        {
			
			font: 14px sans-serif;
		
		}

        .wrapper
        {
			width: 800px; 
			padding: 20px;
			padding-left: 250px;
			padding-right: 0px;
		}
    </style>
    <title>Confirmation Message</title>
</head>
<body>
<div id="wrap">
		
		<!--header -->
		<div id="header">			
				
			<h1 id="logo-text"><a href="index.html"></a></h1>		
			<p id="slogan"><img src="http://app.dwasa.org.bd/epay/wasapay/img/wasa_text.gif"></p>		
			
			<div id="header-links">
			<p>
							</p>		
		</div>		
		</div>

<div class="wrapper">


    


    
</div>
<?php

include "../config.php";

  session_start();
 $user= $_SESSION['account_no'];


  
$sql = oci_parse($conn,"SELECT * FROM customer where account_no ='$user'");
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


<h2 style="color:blue;" >Hi, <b><?php echo htmlspecialchars($custname); ?></b>. Welcome to DHAKA WASA</h2>
<h5 style="color:blue;" >Your Account no is <b><?php echo htmlspecialchars($user); ?></b></h5>
<div id="footer">
			
			
			
			
			 <p><a href="login.php">Login</a>.</p>
			
Powered by 
<a href="Group-8" title="" target="blank"><strong>Group-8</strong></a>
   		</p>
				
		</div>	

</body>
</html>