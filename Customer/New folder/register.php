<?php

include "../config.php";


$accno = $password = $confirm_password = $name = $hno = $rno = $sector = $area = $city = $po = $email = $phone = "";
$accno_err = $password_err = $confirm_password_err = $name_err = $hno_err = $rno_err = $sector_err = $area_err = $city_err = $po_err = $email_err = $phone_err = "";



  $seq = oci_parse($conn,'SELECT account_no_seq.nextval from dual');
  oci_execute($seq);
  while($row = oci_fetch_array($seq))
  {
    $accno = $row[0];
  }
  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $emailTo = 'contact.shahidccr@gmail.com';
   if (empty(trim($_POST['name']))) {
    $name_err = "Enter your name.";
  } else {
    $name = trim($_POST['name']);
  }
  
  if (empty(trim($_POST['email']))) {
    $email_err = "Enter your email.";
  }else {
       $email = trim($_POST["email"]);
                $check = "";
            }
        
  
  
  if (empty(trim($_POST['password']))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST['password'])) < 4) {
        $password_err = "Password must have at least 4 character.";
    } else {
        $password = trim($_POST['password']);
    }


    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST['confirm_password']);
        if ($password != $confirm_password) {
            $confirm_password_err = "Password does not match.";
        }
    }

  

  if (empty(trim($_POST['hno']))) {
    $hno_err = "House no required";
  } else {
    $hno = trim($_POST['hno']);
  }


  $rno = trim($_POST['rno']);

  $sector = trim($_POST['sector']);

  if (empty(trim($_POST['area']))) {
    $area_err = "Area is required.";
  } else {
    $area = trim($_POST['area']);
  }

  if (empty(trim($_POST['city']))) {
    $city_err = "Name of the city";

  } else {
    $city = trim($_POST['city']);
  }

  if (empty(trim($_POST['po']))) {
    $po_err = "Enter the post code";

  } else {
    $po = trim($_POST['po']);
  }

  
  
  if (empty(trim($_POST['phone']))) {
    $phone_err = "Enter the phone number";

  } else {
    $phone = trim($_POST['phone']);
  }




  if (empty($accno_err) && empty($password_err) && empty($name_err) && empty($hno_err) && empty($area_err) && empty($city_err) && empty($po_err)) {
    $sql = oci_parse($conn, "INSERT INTO customer (account_no, cust_password, cust_name, cust_houseno, cust_roadno, cust_sector, cust_area, cust_city, cust_postal, cust_email) VALUES ($accno,:bpassword, :bname, :bhno, :brno, :bsector, :barea, :bcity, :bpo, :bemail)");
    if (!$sql) {
      echo "error";
    
  }

    oci_bind_by_name($sql, ":bname", $name);
	oci_bind_by_name($sql, ":bpassword", $password);
    oci_bind_by_name($sql, ":bhno", $hno);
    oci_bind_by_name($sql, ":brno", $rno);
    oci_bind_by_name($sql, ":bsector", $sector);
    oci_bind_by_name($sql, ":barea", $area);
    oci_bind_by_name($sql, ":bcity", $city);
    oci_bind_by_name($sql, ":bpo", $po);
    oci_bind_by_name($sql, ":bemail", $email);

     oci_execute($sql);
	 $sql=oci_parse($conn, "INSERT INTO meter_reading (METER_NO, PREVIOUS_READING, CURRENT_READING, METER_SETDATE) VALUES (meter_no_seq.nextval,0, 0, to_date(sysdate))");
	 
	 $rs= oci_execute($sql);
	 if ($rs) {
            header("location: confirm.php");
        } else {
            echo "Something went wrong. PLease try again later.";
        }
		
		oci_free_statement($sql);

}


    oci_close($conn);
  }
 
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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

    <h2>Customer Registration</h2>
    <p>Please fill this form to create your account.</p>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	
	
		<div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
            <label>Name<span style="color:red;">*</span></label>
            <input type="text" name="name"class="form-control" value="<?php echo $name; ?>">
            <span class="help-block"><?php echo $name_err; ?></span>
        </div>
		
		<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
            <label>Email<span style="color:red;">*</span></label>
            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
            <span class="help-block"><?php echo $email_err; ?></span>
        </div>
		
		<div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
            <label>Phone No<span style="color:red;">*</span></label>
            <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">
            <span class="help-block"><?php echo $phone_err; ?></span>
        </div>
		
		<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password<span style="color:red;">*</span></label>
            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>



        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <label>Confirm Password<span style="color:red;">*</span></label>
            <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
            <span class="help-block"><?php echo $confirm_password_err; ?></span>
        </div>
		

        <div class="form-group <?php echo (!empty($hno_err)) ? 'has-error' : ''; ?>">
            <label>House No<span style="color:red;">*</span></label>
            <input type="text" name="hno" class="form-control" value="<?php echo $hno; ?>">
            <span class="help-block"><?php echo $hno_err; ?></span>
        </div>



        <div class="form-group ">
            <label>Road No</label>
            <input type="text" name="rno" class="form-control" value="<?php echo $rno; ?>">
        </div>
		
        <div class="form-group ">
            <label>Sector</label>
            <input type="text" name="sector" class="form-control" value="<?php echo $sector; ?>">
        </div>
		
		<div class="form-group <?php echo (!empty($area_err)) ? 'has-error' : ''; ?>">
            <label>Area<span style="color:red;">*</span></label>
            <input type="text" name="area" class="form-control" value="<?php echo $area; ?>">
            <span class="help-block"><?php echo $area_err; ?></span>
        </div>       
		
		<div class="form-group <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>">
    <label for="exampleSelect1">CITY<span style="color:red;">*</span></label>
    <select  class="form-control" id="exampleSelect1"  name="city" input type="text" value="<?php echo $po; ?>">
      <option>Dhaka</option>
      <option>Narayanganj</option>
    </select>
  </div> 
		
		<div class="form-group <?php echo (!empty($po_err)) ? 'has-error' : ''; ?>">
            <label>Post Code<span style="color:red;">*</span></label>
            <input type="text" name="po" class="form-control" value="<?php echo $po; ?>">
            <span class="help-block"><?php echo $po_err; ?></span>
        </div>
		

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-default" value="Reset">
        </div>


        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </form>
</div>
<div id="footer">
			
			<p>Powered by <a href="Group-8" title="" target="blank"><strong>Group-8</strong></a></p>
	</div>	

</body>
</html>
