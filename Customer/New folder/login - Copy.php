<?php
include "../config.php";


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="../bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper
        {
			width: 800px; 
			padding: 20px;
			padding-left: 250px;
			padding-right: 0px;
		}
    </style>
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
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($accno_err)) ? 'has-error' : ''; ?>">
                <label>Account No</label>
                <input type="text" name="accno"class="form-control" value="<?php echo $accno; ?>">
                <span class="help-block"><?php echo $accno_err; ?></span>
</div>
<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
    <label>Password</label>
    <input type="password" name="password" class="form-control">
    <span class="help-block"><?php echo $password_err; ?></span>
</div>


<div class="form-group">
    <input type="submit" class="btn btn-primary" value="Login">
</div>
<p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
            
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
<?php
    
    $row1 = 0;

    $accno = $password = " ";
    $accno_err = $password_err = $password1_err= " ";

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["accno"]))
        {
            $accno_err = "Please enter Account no";
        }
        else
        {
            $accno = trim($_POST["accno"]);
        }

        if (empty($_POST['password']))
        {
            $password_err = "Please enter password.";
        }
        else
        {
            $password = trim($_POST['password']);
        }
    }

        $sql = oci_parse($conn,"SELECT * FROM customer where ACCOUNT_NO = '$accno' and CUST_PASSWORD='$password'");
        if (!$sql)
        {
            echo "error";
        }



        $rs = oci_execute($sql);
        oci_fetch($sql);
        if($rs){


            if (password_verify($password,password_hash(oci_result($sql,'CUST_PASSWORD'),PASSWORD_DEFAULT)))
                {

                        session_start();
                        $_SESSION['accno'] = $accno;       
                        header("location:index.php");

                }
            else
                {
                    header("location:login.php"); 
                }



         } 
    oci_free_statement($sql);
    oci_close($conn);
?>