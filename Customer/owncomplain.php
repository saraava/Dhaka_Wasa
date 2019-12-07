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
    <title>Confirmation Message</title>
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


    


    
</div>


<h1 style="color:blue;" >Your Complain are </h1>


<?php
include "../config.php";


$accno ="";

 session_start();
 $user= $_SESSION['accno'];

$sql = oci_parse($conn,"create or replace view complain_information as select customer.account_no,complain.complain_id,complain_date,complain_type,status, cmp_solveddate from customer join has_complain on customer.account_no=has_complain.account_no join complain on has_complain.complain_id=complain.complain_id;");
        if (!$sql)
			{
			  echo "error";
			}			
        $sql = oci_parse($conn,"select * from complain_information where account_no='$user'");
        if(! $sql )
        {
        echo "error";
        }
        $rs = oci_execute($sql);
        if(!$rs)
        {
        exit("Error in sql");
        }
        
        echo "<table border = 3><tr>";
           
		    
            echo "<th>Your Account No</th>";
			echo "<th>Complain ID</th>";
			echo "<th>Complain Date</th>";
			echo "<th>Complain Type</th>";
			echo "<th>Status</th>";
            echo "<th>Complain Solved date</th>";
			 
			
            while ($row = oci_fetch_array($sql,OCI_ASSOC+OCI_RETURN_NULLS))
            {
            echo "<tr> \n";
                foreach ($row as $item)
                {
                print "<td>";
                    print $item;
                print "</td>";
                }
            echo "</tr>\n";
            }
            oci_close($conn);
        echo "</table>";
 ?>
 
 <a href="index.php" class="btn btn-lg btn-primary">Back</a>

</div>

	
	

		<div id="footer">
			
			<p>
			
Powered by 
<a href="Group-8" title="" target="blank"><strong>Group-8</strong></a>
   		</p>
				
		</div>	
    </body>
</html>
