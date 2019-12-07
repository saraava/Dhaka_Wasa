<?php

include "../config.php";
$rows = 0;
$mno = $billno = $reading = $swerege = $vat = $billdate = $billissuedate = $fine =$arrear = "";
$mno_err = $billno_err = $reading_err = $swerege_err = $vat_err = $billdate_err = $billissuedate_err = $fine_err = $arrear_err = "";
$sql3= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["mno"]))) {
        $mno_err = "Enter the Meter No";
		} else {
        $mno = trim($_POST['mno']);
		}

 
  if (empty(trim($_POST['billno']))) {
        $billno_err = "Please enter a password.";
    } else {
        $billno = trim($_POST['billno']);
    }

  

 if (empty(trim($_POST['reading']))) {
    $reading_err = "Meter Reading of Current Month";
  } else {
    $reading = trim($_POST['reading']);
  }


  if (empty(trim($_POST['swerege']))) {
    $swerege_err = "Swerege Charge";
  } else {
    $swerege = trim($_POST['swerege']);
  }

 

   
   if (empty(trim($_POST['vat']))) {
    $vat_err = "VAT";

  } else {
    $vat = trim($_POST['vat']);
  }
  
  if (empty(trim($_POST['billdate']))) {
    $billdate_err = "Please enter your email";

  } else {
    $billdate = trim($_POST['billdate']);
  }
  
  if (empty(trim($_POST['billissuedate']))) {
    $billissuedate_err = "required";

  } else {
    $billissuedate = trim($_POST['billissuedate']);
  }
  
  
  if (empty(trim($_POST['fine']))) {
    $fine_err = "required";

  } else {
    $fine = trim($_POST['fine']);
  }
  
  if (empty(trim($_POST['arrear']))) {
    $arrear_err = "required";

  } else {
    $arrear = trim($_POST['arrear']);
  }




  if (empty($mno_err) && empty($reading_err) && empty($billno_err)  && empty($swerege_err) && empty($vat_err) && empty($billdate_err)) {
  $sql = oci_parse($conn, "INSERT INTO  customer_bill ( BILL_NO,BILL_SWARAGE,BILL_VAT,BILL_DATE,BILL_ISSUEDATE,BILL_FINE,BILL_ARREAR) VALUES (:bbillno,:bswerege,  :bvat, :bbilldate, :bbillissuedate,:bfine,:barrear)");
    if (!$sql) {
      echo "error";
    }
	}
    oci_bind_by_name($sql, ":bbillno", $billno);
	oci_bind_by_name($sql, ":bbilldate", $billdate);
	oci_bind_by_name($sql, ":bbillissuedate", $billissuedate);
    oci_bind_by_name($sql, ":bswerege", $swerege);
    oci_bind_by_name($sql, ":bvat", $vat);
	oci_bind_by_name($sql, ":bfine", $fine);
	oci_bind_by_name($sql, ":barrear", $arrear);
    
	$rs = oci_execute($sql);
    
	
    $sql1 = oci_parse($conn, "UPDATE meter_reading set PREVIOUS_READING = (select CURRENT_READING from meter_reading 
	where meter_no = '$mno'),current_reading = '$reading' WHERE meter_no = '$mno'");
	
	oci_execute($sql1);

    
    $sql2 = oci_parse($conn, "INSERT INTO  bill_process ( METER_NO,BILL_NO,BILL_DATE) VALUES (:bmno,:bbillno, :bbilldate)");
    oci_bind_by_name($sql2, ":bmno", $mno);
	oci_bind_by_name($sql2, ":bbillno", $billno);
	oci_bind_by_name($sql2, ":bbilldate", $billdate);
	
	

	
	oci_execute($sql2);
    
	

   if ($rs) {
      header("location:#");
    } 
	else {
      echo "Something went wrong. PLease try again later.";
    } 
    oci_free_statement($sql);
	oci_free_statement($sql1);
    oci_free_statement($sql2);
}
    oci_close($conn);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="../bootstrap-3.3.7-dist/css/bootstrap.min.css">
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
    <title>Bill Processing</title>
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
	</div>

<div class="wrapper">

    <h2>Meter Reading</h2>
    


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		
        <div class="form-group <?php echo (!empty($mno_err)) ? 'has-error' : ''; ?>">
            <label>Meter No</label>
            <input type="text" name="mno"class="form-control" value="<?php echo $mno; ?>">
            <span class="help-block"><?php echo $mno_err; ?></span>
        </div>


        <div class="form-group <?php echo (!empty($billno_err)) ? 'has-error' : ''; ?>">
            <label>Bill No</label>
            <input type="text" name="billno" class="form-control" value="<?php echo $billno; ?>">
            <span class="help-block"><?php echo $billno_err; ?></span>
        </div> 
		
		<div class="form-group <?php echo (!empty($reading_err)) ? 'has-error' : ''; ?> ">
            <label> Reading </label>
            <input type="text" name="reading" class="form-control" value="<?php echo $reading; ?>">
            <span class="help-block"><?php echo $reading_err; ?></span>
        </div>		

		
		<div class="form-group <?php echo (!empty($swerege_err)) ? 'has-error' : ''; ?>">
            <label>Swerege Bill </label>
            <input type="text" name="swerege" class="form-control" value="<?php echo $swerege; ?>">
            <span class="help-block"><?php echo $swerege_err; ?></span>
        </div> 
		
		
		<div class="form-group <?php echo (!empty($vat_err)) ? 'has-error' : ''; ?>">
            <label>VAT(%) </label>
            <input type="text" name="vat" class="form-control" value="<?php echo $vat; ?>">
            <span class="help-block"><?php echo $vat_err; ?></span>
        </div> 
		
		
		<div class="form-group <?php echo (!empty($billdate_err)) ? 'has-error' : ''; ?>">
            <label>Bill Date </label>
            <input type="text" name="billdate" class="form-control" value="<?php echo $billdate; ?>">
            <span class="help-block"><?php echo $billdate_err; ?></span>
        </div> 
		
		<div class="form-group <?php echo (!empty($billissuedate_err)) ? 'has-error' : ''; ?>">
            <label>Bill Issue Date </label>
            <input type="text" name="billissuedate" class="form-control" value="<?php echo $billissuedate; ?>">
            <span class="help-block"><?php echo $billissuedate_err; ?></span>
        </div> 

		<div class="form-group <?php echo (!empty($fine_err)) ? 'has-error' : ''; ?>">
            <label>FINE </label>
            <input type="text" name="fine" class="form-control" value="<?php echo $fine; ?>">
            <span class="help-block"><?php echo $fine_err; ?></span>
        </div> 
		
		<div class="form-group <?php echo (!empty($arrear_err)) ? 'has-error' : ''; ?>">
            <label>Arrear</label>
            <input type="text" name="arrear" class="form-control" value="<?php echo $arrear; ?>">
            <span class="help-block"><?php echo $arrear_err; ?></span>
        </div> 

       

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-default" value="Reset">
        </div>


       
    </form>
</div>
<div id="footer">
			
			<p>
			
Powered by 
<a href="Group-8" title="" target="blank"><strong>Group-8</strong></a>
   		</p>
				
		</div>	

</body>
</html>
