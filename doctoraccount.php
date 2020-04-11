<?php
session_start();
if(!isset($_SESSION['doctorid']))
{
	echo "<script>window.location='doctorlogin.php';</script>";
}
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
  <h1>Hello,<span style="color:red"> DOCTOR</span> </h1>
     <h1>Number of Appointment Records : 
    <?php
	$sql = "SELECT * FROM appointment WHERE status='Active'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_num_rows($qsql);
	?>
    </h1>
    
   </div>
</div>
<center><a href="index.php"><img src="image/banner3.jpg"></a></center>
    <div class="clear"></div>
  </div>
</div>
