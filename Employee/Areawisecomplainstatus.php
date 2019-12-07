<html>
    <head>
	<meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="../bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .table
        {
			padding: 20px;
			padding-left: 20px;
			padding-right:20px;
		}
	
		table, th, td
		{
			border: 1px solid black;
			width: 100%;
			border-collapse: collapse;
		}
		th
		{
			background-color: #91aade;
			height: 50 px;
			color: white;
			text-align: centre;
		} 
		td
		{
			height: 50px;
			vertical-align: centre;
		}
		th, td 
		{
			padding: 15px;
			text-align: left;
		}
    </style>
    <title>Areawise Complain Status</title>
    </head>
    <body>
	
	<div id="header">			
				
			<h1 id="logo-text"><a href="index.html"></a></h1>		
			<p id="slogan"><img src="http://app.dwasa.org.bd/epay/wasapay/img/wasa_text.gif"></p>		
			
			<div id="header-links">
			<p>
							</p>		
		</div>		
		</div>
       <div class="table"> <?php
        include '../config.php';
        
        $sql = oci_parse($conn,"SELECT  cust_area,count(complain_id) from customer join has_complain using(account_no) group by cust_area ");
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
            echo "<th>Area</th>";
            echo "<th>No of Complain</th>";
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
        ?></div>
		<a href="complaindetails.html" class="btn btn-block btn-primary btn-danger">Complain Details <span class="glyphicon glyphicon-circle-arrow-right"></span></a>
		
		<a href="welcome.php" class="btn btn-lg btn-danger"><span class="glyphicon glyphicon-hand-left"></span> Back</a>
	<div id="footer">

			
			
			<p>
			
Powered by 
<a href="Group-8" title="" target="blank"><strong>Group-8</strong></a>
   		</p>
				
		</div>	
    </body>
</html>