<?php

include "../config.php";
$rows = 0;
$eid = $epass = $conf_pass = $ename = $edob = $eadd = $ephone = $eemail  = $edesig  = $earea = $eaccno = "";
$eid_err = $epass_err = $conf_pass_err = $ename_err = $edob_err = $eadd_err = $ephone_err = $eemail_err  = $edesig_err   = $earea_err = $eaccno_err= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["eid"]))) {
        $eid_err = "Please enter a employee id.";
    } else {
        $check = trim($_POST['eid']);
        $srt = "SELECT * from employee where emp_id = '$check'";

        $sql = oci_parse($conn, $srt);
        if (!$sql) {
            echo "error";
        }

        $rs = oci_execute($sql);

        oci_fetch($sql);
        $rows = oci_num_rows($sql);

        if ($rs) {
                        if ($rows == 1) {
                $eid_err = "This emp_id is already taken";
            } else {
                $eid = trim($_POST["eid"]);
                $check = "";
            }
        } else {
            echo "Oops! Something went wrong.";
        }

        oci_free_statement($sql);

    }
 
  if (empty(trim($_POST['epass']))) {
        $epass_err = "Please enter a password.";
    } elseif (strlen(trim($_POST['epass'])) < 4) {
        $epass_err = "Password must have at least 4 character.";
    } else {
        $epass = trim($_POST['epass']);
    }


    if (empty(trim($_POST["conf_pass"]))) {
        $conf_pass_err = "Please confirm password.";
    } else {
        $conf_pass = trim($_POST['conf_pass']);
        if ($epass != $conf_pass) {
            $conf_pass_err = "Password does not match.";
        }
    }

  

 if (empty(trim($_POST['ename']))) {
    $ename_err = "Please enter your name";
  } else {
    $ename = trim($_POST['ename']);
  }


  if (empty(trim($_POST['edob']))) {
    $edob_err = "Please enter your Date of birth.";
  } else {
    $edob = trim($_POST['edob']);
  }

 
   $eadd = trim($_POST['eadd']);
   
   if (empty(trim($_POST['ephone']))) {
    $ephone_err = "Please enter your phone no";

  } else {
    $ephone = trim($_POST['ephone']);
  }
  
  if (empty(trim($_POST['eemail']))) {
    $eemail_err = "Please enter your email";

  } else {
    $eemail = trim($_POST['eemail']);
  }

  if (empty(trim($_POST['edesig']))) {
    $edesig_err = "Please enter your designation";

  } else {
    $edesig = trim($_POST['edesig']);
  }


  
  if (empty(trim($_POST['earea']))) {
    $earea_err = "Please enter your designation";

  } else {
    $earea = trim($_POST['earea']);
  }
  
  if (empty(trim($_POST['eaccno']))) {
    $eaccno_err = "Please enter your account no";

  } else {
    $eaccno = trim($_POST['eaccno']);
  }




  if (empty($eid_err) && empty($ename_err) && empty($edob_err)  && empty($edesig_err) && empty($epass_err) && empty($conf_pass_err) && empty($eaarea_err)) {
    $sql = oci_parse($conn, "INSERT INTO  employee (emp_id,emp_password, emp_name, emp_dob , emp_add, emp_email, emp_desigation,emp_assigned_area,emp_acc_no) VALUES (:beid, :bepass, :bename,  :bedob, :beadd, :beemail, :bedesig,  :bearea, :beaccno )");
    if (!$sql) {
      echo "error";
    }
  }

    oci_bind_by_name($sql, ":beid", $eid);
	oci_bind_by_name($sql, ":bepass", $epass);
    oci_bind_by_name($sql, ":bename", $ename);
    oci_bind_by_name($sql, ":bedob", $edob);
    oci_bind_by_name($sql, ":beadd", $eadd);
	oci_bind_by_name($sql, ":beemail", $eemail);
    oci_bind_by_name($sql, ":bedesig", $edesig);	
	oci_bind_by_name($sql, ":bearea", $earea);
	oci_bind_by_name($sql, ":beaccno", $eaccno);
   

	$rs = oci_execute($sql);
    
	
    $sql1 = oci_parse($conn, "INSERT INTO  emp_phones(emp_id,emp_phn) VALUES (:beid, :bephone)");

	oci_bind_by_name($sql1, ":beid", $eid);
	oci_bind_by_name($sql1, ":bephone", $ephone);
	
	

	
	oci_execute($sql1);

   if ($rs) {
      header("location:login.php");
    } 
	else {
      echo "Something went wrong. PLease try again later.";
    } 
    oci_free_statement($sql);
	oci_free_statement($sql1);
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
	</div>

<div class="wrapper">

    <h2>New Employee Registration</h2>
    <p>Please fill this form to create your account.</p>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	
		<div class="form-group <?php echo (!empty($eid_err)) ? 'has-error' : ''; ?>">
            <label>Employee ID</label>
            <input type="text" name="eid"class="form-control" value="<?php echo $eid; ?>">
            <span class="help-block"><?php echo $eid_err; ?></span>
        </div>
		
		<div class="form-group <?php echo (!empty($epass_err)) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input type="password" name="epass" class="form-control" value="<?php echo $epass; ?>">
            <span class="help-block"><?php echo $epass_err; ?></span>
        </div>



        <div class="form-group <?php echo (!empty($conf_pass_err)) ? 'has-error' : ''; ?>">
            <label>Confirm Password</label>
            <input type="password" name="conf_pass" class="form-control" value="<?php echo $conf_pass; ?>">
            <span class="help-block"><?php echo $conf_pass_err; ?></span>
        </div>
		
        <div class="form-group <?php echo (!empty($ename_err)) ? 'has-error' : ''; ?>">
            <label>Name</label>
            <input type="text" name="ename"class="form-control" value="<?php echo $ename; ?>">
            <span class="help-block"><?php echo $ename_err; ?></span>
        </div>


        <div class="form-group <?php echo (!empty($edob_err)) ? 'has-error' : ''; ?>">
            <label>Date of birth</label>
            <input type="text" name="edob" class="form-control" value="<?php echo $edob; ?>">
            <span class="help-block"><?php echo $edob_err; ?></span>
        </div>

		
		<div class="form-group ">
            <label> Address </label>
            <input type="text" name="eadd" class="form-control" value="<?php echo $eadd; ?>">
            
        </div>    
		
		<div class="form-group <?php echo (!empty($ephone_err)) ? 'has-error' : ''; ?> ">
            <label> Phone No </label>
            <input type="text" name="ephone" class="form-control" value="<?php echo $ephone; ?>">
            <span class="help-block"><?php echo $ephone_err; ?></span>
        </div>		
		
		<div class="form-group ">
            <label>Email</label>
            <input type="text" name="eemail" class="form-control" value="<?php echo $eemail; ?>">
            
        </div>
		
		<div class="form-group <?php echo (!empty($edesig_err)) ? 'has-error' : ''; ?>">
            <label>Designation </label>
            <input type="text" name="edesig" class="form-control" value="<?php echo $edesig; ?>">
            <span class="help-block"><?php echo $edesig_err; ?></span>
        </div> 
		
		
		<div class="form-group <?php echo (!empty($earea_err)) ? 'has-error' : ''; ?>">
            <label>Assigned Area </label>
            <input type="text" name="earea" class="form-control" value="<?php echo $earea; ?>">
            <span class="help-block"><?php echo $earea_err; ?></span>
        </div> 
		
		
		<div class="form-group <?php echo (!empty($eaccno_err)) ? 'has-error' : ''; ?>">
            <label>Account No </label>
            <input type="text" name="eaccno" class="form-control" value="<?php echo $eaccno; ?>">
            <span class="help-block"><?php echo $eaccno_err; ?></span>
        </div> 
		
		


       

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-default" value="Reset">
        </div>


        <p>Already have an account? <a href="login.php">Login here</a>.</p>
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
