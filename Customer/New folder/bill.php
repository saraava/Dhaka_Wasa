<?php

include "../config.php";

$rows = 0;
$billno = $billdate = "";
$billno_err = $billdate_err = "";

session_start();
$user = $_SESSION['accno'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["billno"]))) {
        $billno_err = "Please enter a billno.";
    } else {
        $billno = trim($_POST['billno']);
       
        }

  $srt = "SELECT bill_date from customer_bill where bill_no = '$billno'"; 
  $query=oci_parse($conn, $srt);
  oci_execute($query);
  oci_fetch($query);
  $billdate=oci_result($query,'BILL_DATE') ; 
 
 


  if (empty($billno_err)) {
    $sql = oci_parse($conn, "INSERT INTO bill_view (account_no, bill_no, bill_date) VALUES (:buser,:bbillno,:bbilldate)");
    if (!$sql) {
      echo "error";
    }


    oci_bind_by_name($sql, ":bbillno", $billno);
    oci_bind_by_name($sql, ":buser", $user);
	oci_bind_by_name($sql, ":bbilldate", $billdate);


    $rs = oci_execute($sql);

   if ($rs) {
      echo "successful ";
    } 
	else {
      echo "Something went wrong. PLease try again later.";
    } 

    oci_free_statement($sql);
  }
  

}

    oci_close($conn);

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta name="Description" content="#">
<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../css/style.css" type="text/css">
<link rel="stylesheet" href="../css/table/demo_table.css" type="text/css">
<link rel="stylesheet" href="../css/table/demo_page.css" type="text/css">
  
	
<title>...::Dhaka Wasa Online Bill Payment::...</title>
	
</head>

<body>
<!-- wrap starts here -->
<div id="wrap">
		
		<!--header -->
		<div id="header">			
			
			<p id="slogan"><a href="index.php" class="btn btn-lg btn-primary"> <span class="glyphicon glyphicon-home"></span></a>	<img src="http://app.dwasa.org.bd/epay/wasapay/img/wasa_text.gif"></p>		
			<div id="header-links">		
		</div>		
		</div>
		
		<!-- menu -->	
		<div id="menu">
			<ul>
				<li id="current"><a href="#">&nbsp;</a></li>
				<li><a href="#">&nbsp;</a></li>
				<li><a href="#">&nbsp;</a></li>
				<li><a href="#">&nbsp;</a></li>
				<li><a href="#">&nbsp;</a></li>
				
			</ul>
		</div>					
			
		<!-- content-wrap starts here -->
		<div id="content-wrap">
				
			<div id="sidebar">			
				
				<h3>Menu</h3>
				<ul class="sidemenu">		
					
					<li><a href="#">View Bill Info</a></li>
	
					
				</ul>					
					
			</div>				
			<div id="main">
				
				<h2>Customer Billing Information</h2>					
				
			  	<div class="contactform">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
			
              <fieldset><legend>&nbsp;WASA Bill &nbsp;</legend>
			                               			
            <div class="form-group <?php echo (!empty($billno_err)) ? 'has-error' : ''; ?>">
            <label for="bill_no_in" class="leftt">Your WASA Bill No :</label>
				<input type="text" name="billno"class="form-control" value="<?php echo $billno; ?>">
			<span class="help-block"><?php echo $billno_err; ?></span>
        </div>	
				<p> <input type="submit" name="submit" id="submit" class="button" value="Next" tabindex="6"></p>
				 </fieldset>
</form>
</div>	
				<br>	

			</div>
		
		
		</div>
					
		
		<div id="footer">	
			<p>Powered by <a href="Group-8" title="" target="blank"><strong>Group-8</strong></a></p>		
		</div>	
		</div>
</body>
</html>