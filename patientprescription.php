<?php
session_start();
include("headers.php");
include("dbconnection.php");
if(isset($_GET[delid]))
{
	$sql ="DELETE FROM prescription WHERE prescriptionid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('prescription deleted successfully..');</script>";
	}
}
?>

<div class="wrapper col4">
  <div id="container">
    <h1>View previous prescriptions</h1>
<?php
$sql ="SELECT * FROM prescription where patientid='$_SESSION[patientid]'";
$qsql = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($qsql))
{
	$sqlpatient = "SELECT * FROM patient WHERE patientid='$rs[patientid]'";
	$qsqlpatient = mysqli_query($con,$sqlpatient);
	$rspatient = mysqli_fetch_array($qsqlpatient);
	
	$sqldoctor = "SELECT * FROM doctor WHERE doctorid='$rs[doctorid]'";
	$qsqldoctor = mysqli_query($con,$sqldoctor);
	$rsdoctor = mysqli_fetch_array($qsqldoctor);
?>		
<style>
body{
    min-height: 100vh;
    background-color:  white;
}
#prescription {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#prescription td, #prescription th {
  border: 1px solid #ddd;
  padding: 8px;
}

#prescription tr:nth-child(even){background-color: #f2f2f2;}

#prescription tr:hover {background-color: #071f44;}

#prescription th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #071f44;
  color: white;
}
input[type=submit] {
  width: 100%;
  background-color: #071f44;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

</style>
<body>	
    <table width="200" border="3" id="prescription">
          <tbody>
            <tr>
              <td><strong>Doctor</strong></td>
              <td><strong>Patient</strong></td>
              <td><strong>Prescription Date</strong></td>
              <td><strong>Status</strong></td>
              
            </tr>
              <?php
            echo "<tr>
              <td>&nbsp;$rsdoctor[doctorname]</td>
              <td>&nbsp;$rspatient[patientname]</td>
               <td>&nbsp;$rs[prescriptiondate]</td>
            <td>&nbsp;$rs[status]</td>
            
            </tr>";
    
            ?>
          </tbody>
        </table>
        <table width="200" border="3" id="prescription">
          <tbody>
            <tr>
              <td><strong>Medicine</strong></td>
              <td><strong>Cost</strong></td>
              <td><strong>Unit</strong></td>
              <td><strong>Dosage</strong></td>
            </tr>
             <?php
             $sqlprescription_records ="SELECT * FROM prescription_records LEFT JOIN medicine ON prescription_records.medicine_name=medicine.medicineid WHERE prescription_records.prescription_id='$rs[0]'";
            $qsqlprescription_records = mysqli_query($con,$sqlprescription_records);
            while($rsprescription_records = mysqli_fetch_array($qsqlprescription_records))
            {
            echo "<tr>
              <td>&nbsp;$rsprescription_records[medicinename]</td>
              <td>&nbsp;$rsprescription_records[cost]</td>
               <td>&nbsp;$rsprescription_records[unit]</td>
                <td>&nbsp;$rsprescription_records[dosage]</td>
                  
            </tr>";
            }
            ?>
            <tr>
              <td colspan="6"><div align="center">
                <input type="submit" name="print" id="print" value="Print" onclick="myFunction()"/>
              </div></td>
              </tr>
          </tbody>
        </table>
<?php
}
?>        <p>&nbsp;</p>
  </div>
</div>
</div>
 <div class="clear"></div>
  </div>
</div>

<script>
function myFunction()
{
	window.print();
}
</script>