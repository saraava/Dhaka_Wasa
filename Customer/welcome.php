<?php

echo "Welcome";
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['accno']) || empty($_SESSION['accno'])){
    header("location:login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
   
    <link rel="stylesheet" href="../bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
<div class="page-header">
    <h1>Hi, <b><?php echo htmlspecialchars($_SESSION['accno']); ?></b>. Welcome to Dhaka WASA.</h1>
</div>
<p><a href="logout.php" class="btn btn-danger">Sign Out</a></p>
</body>
</html>
