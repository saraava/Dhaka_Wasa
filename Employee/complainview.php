
<html>
    <head>
		<meta charset="UTF-8">
		  <meta name="viewport"
				content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		  <meta http-equiv="X-UA-Compatible" content="ie=edge">
		  <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
        <title>
        List of total complain according to area
        </title>
		<style>
		.info
        {
			width: 800px; 
			padding: 20px;
			padding-left: 250px;
			padding-right: 0px;
		}
		</style>
    </head>
    <body >
	<div class="container">
	<?php

        include 'config.php';
		$area = '';
		?>
	<div class="wrapper">
        <h2>Search</h2>
        <p>Please fill in area to search</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group ">
                <label>Area</label>
                <input type="text" name="area"class="form-control" value="<?php echo $area; ?>">
                
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary" value="Search">
</div>
</form>
<a href="areawisecomplainstatus.php" class="btn btn-lg btn-danger"><span class="glyphicon glyphicon-hand-left"></span> Back</a>
</div>
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
		<h1> Areawise Complain Detail </h1>
		<div class="info">

		
	
</div>


		</div>
<?php

        

			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				
				
					$area = trim($_POST['area']);
			}		
		$sql = oci_parse($conn,"create or replace view complain_view as select complain_id,cust_area, complain_type,complain_date,status,cmp_solveddate from complain join has_complain using(complain_id) join customer using(account_no)");
		if (!$sql)
			{
			  echo "error";
			}
		$chk = oci_execute($sql);
			if (!$chk)
			{
			  echo oci_error();
			}			
        $sql = oci_parse($conn,"SELECT * FROM complain_view where  upper(cust_area)='$area'");
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
            echo "<th>Complain ID</th>";
			echo "<th>Area</th>";
            echo "<th>Complain Type</th>";
			echo "<th>Complain Date</th>";
			echo "<th>Complain Status</th>";
            echo "<th>Solved Date</th>";
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


</div>

	
	

		<div id="footer">
			
			<p>
			
Powered by 
<a href="Group-8" title="" target="blank"><strong>Group-8</strong></a>
   		</p>
				
		</div>	
    </body>
</html>
