<?php
session_start();
if(!isset($_SESSION['adminid']))
{
	echo "<script>window.location='adminlogin.php';</script>";
}
include("dbconnection.php");
include("headers.php");
?>
 <style>
body{
    min-height: 100vh;
    background-color:  white;
}
  </style>
<div class="wrapper col4">
  <div id="container">
	<h1>Welcome <?php echo $rsadmin[adminname]; ?> </h1>
</div>
</div>
<center><a href="index.php"><img src="image/banner2.jpg"></a></center>