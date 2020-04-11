


<?php
session_start();
include("dbconnection.php");
if(!isset($_SESSION['patientid']))
{
	echo "<script>window.location='patientlogin.php';</script>";
}
include("headers.php");

$sqlpatient = "SELECT * FROM patient WHERE patientid='$_SESSION[patientid]' ";
$qsqlpatient = mysqli_query($con,$sqlpatient);
$rspatient = mysqli_fetch_array($qsqlpatient);

$sqlpatientappointment = "SELECT * FROM appointment WHERE patientid='$_SESSION[patientid]' ";
$qsqlpatientappointment = mysqli_query($con,$sqlpatientappointment);
$rspatientappointment = mysqli_fetch_array($qsqlpatientappointment);
?>
<style>
body{
    min-height: 100vh;
    background-color:  white;
}
  </style>
<div class="wrapper col2">
  <div id="breadcrumb">
    <ul>
      
    <h1>Welcome, <?php echo $rspatient[patientname]; ?> </h1>
    Registered:<u><?php echo $rspatient[admissiondate]; ?> <?php echo $rspatient[admissiontime]; ?></u>
<?php
if(mysqli_num_rows($qsqlpatientappointment) == 0)
{
?>
	<h1>Appointment records not found.. </h1>
<?php
}
else
{
?>    
<br>Last Appointment:<u><?php echo $rspatientappointment[appointmentdate]; ?> 
<?php echo $rspatientappointment[appointmenttime]; ?></u>
<?php
}
?>      
    </ul>
  </div>
</div>

<center><a href="index.php"><img src="image/banner.jpg"></a></center>
    <div class="clear"></div>
  </div>
</div>
