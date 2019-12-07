<?php

include "../config.php";

$rows = 0;
$cid = $cdate = $ctype = $csolve = $accno = $password ="";
$cid_err = $cdate_err = $ctype_err = $cstatus_err= $csolve_err = $accno_err = $password_err ="";
 $cstatus = "Pending";

session_start();
$user = $_SESSION['accno'];
//$username = $_SESSION['password'];



// validate Account No
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	       
  if (empty(trim($_POST["cid"]))) {
    $cid_err = "Please enter your Complain ID.";
  } 
   else {
        $cid = trim($_POST["cid"]);
        $check = "";
      }
  /* else {
    $check = trim($_POST["accno"]);
    $srt = "SELECT * from users where account_no= '$check'";

    $sql = oci_parse($conn, $srt);
    if (!$sql) {
      echo "error";
    }

    $rs = oci_execute($sql);

    oci_fetch($sql);
    $rows = oci_num_rows($sql);

    if ($rs) {
      if ($rows == 1) {
        $accno_err = "This account no already exist";
      }
    } else {
      echo "Oops! Something went wrong.";
    }

    oci_free_statement($sql);

  }
 */

  if (empty(trim($_POST['cid']))) {
    $cid_err = "Please enter your complain id.";
  } else {
    $cid = trim($_POST['cid']);
  }

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

  if (empty($cid_err) && empty($ctype_err) && empty($cdate_err)  && empty($cstatus_err)) {
    $sql = oci_parse($conn, "INSERT INTO  complain (complain_id, complain_type, complain_date, status, cmp_solveddate) VALUES (:bcid, :bctype,  :bcdate, :bcstatus, :bcsolve)");
    if (!$sql) {
      echo "error";
    }


    oci_bind_by_name($sql, ":bcid", $cid);
    oci_bind_by_name($sql, ":bctype", $ctype);
    oci_bind_by_name($sql, ":bcdate", $cdate);
    oci_bind_by_name($sql, ":bcstatus", $cstatus);
    oci_bind_by_name($sql, ":bcsolve", $csolve);
    


     oci_execute($sql);

    /* if ($rs) {
      header("location: login.php");
    } else {
      echo "Something went wrong. PLease try again later.";
    } */

    oci_free_statement($sql);
  }
   $rs = oci_parse($conn, "INSERT INTO  has_complain (account_no, complain_id) VALUES (:buser , :bcid)");
    if (!$rs) {
      echo "error";
    }


    oci_bind_by_name($rs, ":bcid", $cid);
    oci_bind_by_name($rs, ":buser", $user);
    


     oci_execute($rs);
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
		
		
		
		<div id="header" style="margin: auto;width: 50%; background">			
            <div id="header-links" >	
                <p id="logo-text">
                    <a href="https://dwasa.org.bd/"><img src="../img/wasa_logo.jpg" style="width:128px;height:128px"></a>
                    <img  src="../img/wasa_text.gif" style="width:500px;height:64px" >
                </p>		
                <p>
							</p>		
		      </div>		
		  </div>

<div class="wrapper">

    <h2>COMPLAIN</h2>
    <p>Please fill this to form to report a complain</p>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	
		<div class="form-group <?php echo (!empty($cid_err)) ? 'has-error' : ''; ?>">
            <label>Complain ID</label>
            <input type="text" name="cid"class="form-control" value="<?php echo $cid; ?>">
            <span class="help-block"><?php echo $cid_err; ?></span>
        </div>
		
        <div class="form-group <?php echo (!empty($ctype_err)) ? 'has-error' : ''; ?>">
            <label>Complain Type</label>
            <input type="text" name="ctype"class="form-control" value="<?php echo $ctype; ?>">
            <span class="help-block"><?php echo $ctype_err; ?></span>
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
    </div>

</body>
</html>



