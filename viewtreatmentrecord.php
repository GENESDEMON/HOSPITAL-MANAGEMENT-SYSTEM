<?php
session_start();
include("headers.php");
include("dbconnection.php");
if(isset($_GET[delid]))
{
	$sql ="DELETE FROM treatment_records WHERE appointmentid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('appointment record deleted successfully..');</script>";
	}
}
?>
<style>
  body{
    min-height: 100vh;
    background-color:  white;
}
#treatment {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#treatment td, #treatment th {
  border: 1px solid #ddd;
  padding: 8px;
}

#treatment tr:nth-child(even){background-color: #f2f2f2;}

#treatment tr:hover {background-color: #071f44;}

#treatment th {
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

<div class="wrapper col4">
  <div id="container">
    <h1>View treatment records</h1>
    <form method="post" action="">
      <table width="692" border="3" id="treatment">
        <tbody>
          <tr>
            <td width="71">Treatment</td>
            <td width="52">Patient</td>
            <td width="78">Doctor</td>
            <td width="82">Description</td>
            <td width="43">Date</td>
            <td width="43">Time</td>
     
          </tr>
          <?php
		$sql ="SELECT * FROM treatment_records where status='Active'";
		if(isset($_SESSION[patientid]))
		{
			$sql = $sql . " AND patientid='$_SESSION[patientid]'"; 
		}
		if(isset($_SESSION[doctorid]))
		{
			$sql = $sql . " AND doctorid='$_SESSION[doctorid]'";
		}
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			$sqlpat = "SELECT * FROM patient WHERE patientid='$rs[patientid]'";
			$qsqlpat = mysqli_query($con,$sqlpat);
			$rspat = mysqli_fetch_array($qsqlpat);
			
			$sqldoc= "SELECT * FROM doctor WHERE doctorid='$rs[doctorid]'";
			$qsqldoc = mysqli_query($con,$sqldoc);
			$rsdoc = mysqli_fetch_array($qsqldoc);
			
			$sqltreatment= "SELECT * FROM treatment WHERE treatmentid='$rs[treatmentid]'";
			$qsqltreatment = mysqli_query($con,$sqltreatment);
			$rstreatment = mysqli_fetch_array($qsqltreatment);
			
        echo "<tr>
          <td>&nbsp;$rstreatment[treatmenttype]</td>
		   <td>&nbsp;$rspat[patientname]</td>
		    <td>&nbsp;$rsdoc[doctorname]</td>
			<td>&nbsp;$rs[treatment_description]</td>
			 <td>&nbsp;$rs[treatment_date]</td>
			  <td>&nbsp;$rs[treatment_time]</td>";  
	
       echo " </tr>";
		}
		?>
        </tbody>
      </table>
    </form>
    <p>&nbsp;</p>
  </div>
</div>
</div>
 <div class="clear"></div>
  </div>
</div>
<?php
include("footers.php");
?>