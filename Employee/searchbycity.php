
<html>
    <head>
		<meta charset="UTF-8">
		  <meta name="viewport"
				content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		  <meta http-equiv="X-UA-Compatible" content="ie=edge">
		  <link rel="stylesheet" href="../bootstrap-3.3.7-dist/css/bootstrap.min.css">
        <title>
        List of Customer
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

        include '../config.php';
		$city = '';
		?>
	<div class="wrapper">
        <h2>Search</h2>
        <p>Please fill in city to search</p>
		 <p>Please fill in city in uppercase letter</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group ">
                <label>City</label>
                <input type="text" name="city"class="form-control" value="<?php echo $city; ?>">
                
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary" value="Search">
</div>
<a href="customersearch.html" class="btn btn-lg btn-danger"><span class="glyphicon glyphicon-hand-left"></span> Back</a>
</form>
</div>
	<div id="wrap">
		
		
		<div id="header">			
				
			<h1 id="logo-text"><a href="index.html"></a></h1>		
			<p id="slogan"><img src="http://app.dwasa.org.bd/epay/wasapay/img/wasa_text.gif"></p>		
			
			<div id="header-links">
			<p>
							</p>		
		</div>		
		</div>
		<h1> Customer Information </h1>
		<div class="info">

		
	
</div>


		</div>
<?php

        

			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				
				
					$city = trim($_POST['city']);
			}		
		$sql = oci_parse($conn,"create or replace view customer_info as select cust_name, cust_houseno, cust_roadno, cust_sector , cust_area , cust_city from customer ");
		if (!$sql)
			{
			  echo "error";
			}
		$chk = oci_execute($sql);
			if (!$chk)
			{
			  echo oci_error();
			}			
        $sql = oci_parse($conn,"SELECT * FROM customer_info where upper(cust_city)='$city'");
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
            echo "<th>Name</th>";
            echo "<th>House No</th>";
			echo "<th>Road No</th>";
			echo "<th>SECTOR</th>";
            echo "<th>AREA</th>";
			echo "<th>CITY</th>";
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
