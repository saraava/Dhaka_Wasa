<?php

include "../config.php";


$cid = $cdate = $ctype = $csolve = $accno = $password ="";
$cid_err = $cdate_err = $ctype_err = $cstatus_err= $csolve_err = $accno_err = $password_err ="";
 $cstatus = "Pending";

session_start();
$user = $_SESSION['accno'];


  $seq = oci_parse($conn,'SELECT cmp_id_seq.nextval from dual');
  oci_execute($seq);
  while($row = oci_fetch_array($seq))
  {
    $cid = $row[0];
  }
 
  




if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
  if (empty(trim($_POST['ctype']))) {
    $ctype_err = "Please enter your type";
  } else {
    $ctype = trim($_POST['ctype']);
  }

  if (empty(trim($_POST['cdate']))) {
    $edob_err = "Please enter the Date.";
  } else {
    $cdate = trim($_POST['cdate']);
  }



//check input error before inserting

  if ( empty($ctype_err) && empty($cdate_err)  && empty($cstatus_err)) {
    $sql = oci_parse($conn, "INSERT INTO  complain (complain_id, complain_type, complain_date, status, cmp_solveddate) VALUES ('$cid', :bctype,  :bcdate, :bcstatus, :bcsolve)");
    if (!$sql) {
      echo "error";
    }



    oci_bind_by_name($sql, ":bctype", $ctype);
    oci_bind_by_name($sql, ":bcdate", $cdate);
    oci_bind_by_name($sql, ":bcstatus", $cstatus);
    oci_bind_by_name($sql, ":bcsolve", $csolve);
    


    oci_execute($sql);


    oci_free_statement($sql);
  }
   $rs = oci_parse($conn, "INSERT INTO  has_complain (account_no, complain_id) VALUES (:buser , '$cid')");
    if (!$rs) {
      echo "error";
    }


   
    oci_bind_by_name($rs, ":buser", $user);
    


    $pp = oci_execute($rs);
	if($pp)
	{
		 header("location:index.php");
	
	}
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
    <title>CUSTOMER COMPLAIN</title>
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

    <h2>COMPLAIN</h2>
    <p>Please fill this to form to report a complain</p>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	
		
		<div class="form-group <?php echo (!empty($ctype_err)) ? 'has-error' : ''; ?>">
    <label for="exampleSelect1">Complain Type<span style="color:red;">*</span></label>
    <select  class="form-control" id="exampleSelect1"  name="ctype" input type="text" value="<?php echo $ctype; ?>"required="" >
      <option>Construction Problem</option>
      <option>Repair Problem</option>
	   <option>Connection Problem</option>
    </select>
  </div> 


        <div class="form-group <?php echo (!empty($cdate_err)) ? 'has-error' : ''; ?>">
            <label>Date of complain</label>
            <input type="text" name="cdate" class="form-control" value="<?php echo $cdate; ?>">
            <span class="help-block"><?php echo $cdate_err; ?></span>
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



