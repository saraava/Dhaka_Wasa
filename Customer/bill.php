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
	$_SESSION['billno'] = $billno;
	
	if (empty(trim($_POST["billdate"]))) {
        $billdate_err = "Required";
    } else {
        $billdate = trim($_POST['billdate']);
        }
	$_SESSION['billdate'] = $billdate;

  if (empty($billno_err)) {
    $sql = oci_parse($conn, "INSERT INTO billview (account_no, bill_no, bill_date) VALUES (:buser,:bbillno,:bbilldate)");
    if (!$sql) {
      echo "error";
    }


    oci_bind_by_name($sql, ":bbillno", $billno);
    oci_bind_by_name($sql, ":buser", $user);
	oci_bind_by_name($sql, ":bbilldate", $billdate);


    $rs = oci_execute($sql);
	
	
	
   if ($rs) {
     header("location:billview.php");
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
<link rel="stylesheet" href="../css/style.css" type="text/css">
<link rel="stylesheet" href="../css/table/demo_table.css" type="text/css">
<link rel="stylesheet" href="../css/table/demo_page.css" type="text/css"	
<title>...::Dhaka Wasa Online Bill Payment::...</title>	
</head>
<body>
<div id="wrap">	
		<!--header -->
		<div id="header">				
			<h1 id="logo-text"><a href="index.html"></a></h1>		
			<p id="slogan"><img src="../img/wasa_text.gif"></p>		
			<div id="header-links">
			<p></p>		
		</div>		
		</div>
	
		<div id="menu">
			<ul>
				<li id="current"><a href="#">&nbsp;</a></li>
				<li><a href="#">&nbsp;</a></li>
				<li><a href="#">&nbsp;</a></li>
				<li><a href="#">&nbsp;</a></li>
				<li><a href="#">&nbsp;</a></li>	
			</ul>
		</div>					
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
			
			<div class="form-group <?php echo (!empty($billdate_err)) ? 'has-error' : ''; ?>">
				<label for="bill_no_in" class="leftt">Bill Date :</label>
					<input type="text" name="billdate"class="form-control" value="<?php echo $billdate; ?>">
					<span class="help-block"><?php echo $billdate_err; ?></span>
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