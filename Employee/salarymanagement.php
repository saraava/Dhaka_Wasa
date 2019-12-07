<?php

include "../config.php";

$rows = 0;
$salid = $accno = $designation = "";
$salid_err = $accno_err = $designation_err  = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty(trim($_POST["salid"]))) {
        $salid_err = "Please enter a salary id for new employee.";
    } else {
        $salid = trim($_POST['salid']);
	}
/*         $srt = "SELECT * from employee where SAL_ID= '$check'";

        $sql2 = oci_parse($conn, $srt);
        if (!$sql) {
            echo "error";
        }

        $rs = oci_execute($sql);

        oci_fetch($sql);
        $rows = oci_num_rows($sql);

        if ($rs) {
                        if ($rows == 1) {
                $salid_err = "This salary id is already used";
            } else {
                $salid = trim($_POST["salid"]);
                $check = "";
            }
        } else {
            echo "Oops! Something went wrong.";
        }

        oci_free_statement($sql);

    } */

  
  if (empty(trim($_POST['accno']))) {
    $accno_err = "enter the salary account no of the employee";
  } else {
    $accno = trim($_POST['accno']);
  }

  if (empty(trim($_POST['designation']))) {
    $designation_err = "Designation of the employee";
  } else {
    $designation = trim($_POST['designation']);
  }



//check input error before inserting

  if (empty($salid_err) && empty($accno_err) && empty($designation_err)) {
    $sql = oci_parse($conn, "INSERT INTO  salary (SAL_ID, SAL_ACC_NO) VALUES (:bsalid, :baccno)");
    if (!$sql) {
      echo "error";
    }
	
	
	oci_bind_by_name($sql, ":bsalid", $salid);
    oci_bind_by_name($sql, ":baccno", $accno);
	
	$rs = oci_execute($sql);
	
	$sql1 = oci_parse($conn, "INSERT INTO  sal_dist (SAL_ID, DESIGNATION) VALUES (:bsalid, :bdesignation)");
    if (!$sql1) {
      echo "error";
    }

    
    oci_bind_by_name($sql1, ":bsalid", $salid);
    oci_bind_by_name($sql1, ":bdesignation", $designation);
    
    $pp=oci_execute($sql1);
	if ($pp) {
	  echo "Successful";
    } else {
      echo "Something went wrong. PLease try again later.";
    } 


    

	if ($rs) {
      
	  header("location: salarymanagement.php");
	  echo "Successful";
    } else {
      echo "Something went wrong. PLease try again later.";
    } 

    oci_free_statement($sql);
	oci_free_statement($sql1);
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
    <title>SIGN UP</title>
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
	<p>ACCOUNT DEPARTMENT</p>
    


    <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<fieldset>

<!-- Form Name -->
<legend>NEW EMPLOYEE REGISTRATION</legend>

<!-- Text input-->
<div class="form-group" <?php echo (!empty($salid_err)) ? 'has-error' : ''; ?>">
  <label class="col-md-4 control-label" for="Salaray_ID">Salaray ID</label>  
  <div class="col-md-5">
  <input id="Salaray_ID" name="salid" type="text" placeholder="ex:111111" class="form-control input-md" required="" value="<?php echo $salid; ?>">
     <span class="help-block"><?php echo $salid_err; ?></span>
  </div>
</div>

<!-- Text input-->
<div class="form-group" <?php echo (!empty($accno_err)) ? 'has-error' : ''; ?>">
  <label class="col-md-4 control-label" for="Account_NO">Account no</label>  
  <div class="col-md-5">
  <input id="Account_NO" name="accno" type="text" placeholder="20151454444" class="form-control input-md" required="" value="<?php echo $accno; ?>">
   <span class="help-block"><?php echo $accno_err; ?></span>  
  </div>
</div>


<div class="form-group" <?php echo (!empty($designation_err)) ? 'has-error' : ''; ?>">
  <label class="col-md-4 control-label" for="Designation">Designation</label>  
  <div class="col-md-5">
  <input id="Designation" name="designation" type="text" placeholder="Manager" class="form-control input-md" required="" value="<?php echo $designation; ?>">
    <span class="help-block"><?php echo $designation_err; ?></span> 
  </div>
</div>




<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-primary">Submit</button>
  </div>
</div>

</fieldset>
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



