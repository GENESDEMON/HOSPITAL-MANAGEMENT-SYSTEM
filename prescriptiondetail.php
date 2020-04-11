<table width="200" border="3">
      <tbody>
        <tr>
          <th><strong>Doctor</strong></th>
          <th><strong>Patient</strong></th>
          <th><strong>Prescription Date</strong></th>
          <th><strong>View</strong></th>              
        </tr>
<?php
$sql ="SELECT * FROM prescription WHERE patientid='$_GET[patientid]' AND appointmentid='$_GET[appointmentid]'";
$qsql = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($qsql))
{
	$sqlpatient = "SELECT * FROM patient WHERE patientid='$rs[patientid]'";
	$qsqlpatient = mysqli_query($con,$sqlpatient);
	$rspatient = mysqli_fetch_array($qsqlpatient);
	
	$sqldoctor = "SELECT * FROM doctor WHERE doctorid='$rs[doctorid]'";
	$qsqldoctor = mysqli_query($con,$sqldoctor);
	$rsdoctor = mysqli_fetch_array($qsqldoctor);

            echo "<tr>
              		<td>&nbsp;$rsdoctor[doctorname]</td>
              		<td>&nbsp;$rspatient[patientname]</td>
               		<td>&nbsp;$rs[prescriptiondate]</td>
					<td><a href='prescriptionrecord.php?prescriptionid=$rs[0]&patientid=$rs[patientid]' >View</td>
            </tr>";
}
?>    
  </tbody>
</table>
<?php
if(isset($_SESSION[doctorid]))
{
?>  
<hr>
	<table>
		<tr>
			<td>
			<div align="center"><strong><a href="prescription.php?patientid=<?php echo $_GET[patientid]; ?>&appid=<?php echo $rsappointment[appointmentid]; ?>">Add Prescription records</a></strong></div>
			</td>
		</tr>
	</table>
<?php
}
?>