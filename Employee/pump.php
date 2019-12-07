<?php

include "config.php";

$pid = $pcap = $pde = $pdat = "";
$pid_err = $pcap_err = $pde_err = $pdat_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

 
  if (empty(trim($_POST['pid']))) {
        $pid_err = "Pump ID is required.";
    } else {
        $pid = trim($_POST['pid']);
    }

  if (empty(trim($_POST['pcap']))) {
    $pcap_err = "Daily Supply is required.";
  } else {
    $pcap = trim($_POST['pcap']);
  }

  if (empty(trim($_POST['pde']))) {
    $pde_err = "Daily Expense is required.";
  } else {
    $pde = trim($_POST['pde']);
  }

  if (empty($pid_err) && empty($pcap_err) && empty($pde_err)) {
   $sql = oci_parse($conn, "INSERT INTO  pump (pump_id,supply_cap,pump_daily_expense,dat) VALUES (:bpid,:bpcap, :bpde,to_date(sysdate))");}
    if (!$sql) {
      echo "error";
    }


    oci_bind_by_name($sql, ":bpid", $pid);
    oci_bind_by_name($sql, ":bpcap", $pcap);
	oci_bind_by_name($sql, ":bpde", $pde);
    


  /*    $rs=oci_execute($sql); */
	 
	

	 if($rs=oci_execute($sql))
	 {
		header("location:#");
	 }
	 else{
		 echo "kkkkk";
	 }
	 
	 
	 
	 oci_free_statement($sql);
	 

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



    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	
	
		<div class="form-group <?php echo (!empty($pid_err)) ? 'has-error' : ''; ?>">
       <label for="exampleSelect1">Pup ID<span style="color:red;">*</span></label>
       <select  class="form-control" id="exampleSelect1"  name="pid" input type="text" value="<?php echo $pid; ?>"required="" >
      <option>P000001</option>
	  <option>P000002</option>
	  <option>P000003</option>
	  <option>P000004</option>
	  <option>P000005</option>
	   </select>
	  </div>
		
       <div class="form-group <?php echo (!empty($pcap_err)) ? 'has-error' : ''; ?>">
            <label>Daily Supply<span style="color:red;">*</span></label>
            <input type="text" name="pcap" class="form-control" value="<?php echo $pcap; ?>"required="" >
            <span class="help-block"><?php echo $pcap_err; ?></span>
        </div>
		
		<div class="form-group <?php echo (!empty($pde_err)) ? 'has-error' : ''; ?>">
            <label>Daily Expense<span style="color:red;">*</span></label>
            <input type="text" name="pde" class="form-control" value="<?php echo $pde; ?>"required="">
            <span class="help-block"><?php echo $pde_err; ?></span>
        </div>
		
		

         <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-default" value="Reset">
        </div>

        
    </form>
</div>
<div id="footer">
			
			<p>Powered by <a href="Group-8" title="" target="blank"><strong>Group-8</strong></a></p>
	</div>	

</body>
</html>