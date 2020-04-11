<?php
session_start();
include("header.php");
include("dbconnection.php");
if(isset($_POST[submit]))
{
	$filename = rand(). $_FILES[uploads][name];
	move_uploaded_file($_FILES["uploads"]["tmp_name"],"treatmentfiles/".$filename);
	if(isset($_GET[editid]))
	{
			$sql ="UPDATE treatment_records SET appointmentid='$_POST[select2]',treatmentid='$_POST[select4]',patientid='$_POST[patientid]',doctorid='$_POST[select5]',treatment_description='$_POST[textarea]',uploads='$filename',treatment_date='$_POST[treatmentdate]',treatment_time='$_POST[treatmenttime]',status='Active' WHERE appointmentid='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('treatment record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
		$sql ="INSERT INTO treatment_records(appointmentid,treatmentid,patientid,doctorid,treatment_description,uploads,treatment_date,treatment_time,status) values('$_POST[select2]','$_POST[select4]','$_POST[patientid]','$_POST[select5]','$_POST[textarea]','$filename','$_POST[treatmentdate]','$_POST[treatmenttime]','Active')";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con)>=1)
		{
			echo "<script>alert('Treatment record inserted successfully...');</script>";
		}
	$doctorid= $_POST[select5];
	$billtype = "Doctor Charge";
	
	$treatmentid= $_POST[select4];
	$billtype1="Treatment Cost";
	include("insertbillingrecord.php");	
}
}
if(isset($_GET[editid]))
{
	$sql="SELECT * FROM treatment_records WHERE appointmentid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
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
<!DOCTYPE html>
<html>
<style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  color: #071f44;
}
input[type=password], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=date], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=time], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
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
input[type=hidden], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  color: #071f44;
}
input[type=file], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  color: #071f44;
}
input[type=submit]:hover {
	background: linear-gradient(120deg,white,#071f44,#071f44);
}
body{
    min-height: 100vh;
    background-color:  white;
}
</style>
<body>
<div class="wrapper col4">
  <div id="container">
    <h1>Add new treatment records</h1>
    <form method="post" action="" name="frmtreatrec" onSubmit="return validateform()" enctype="multipart/form-data">
	Appointment ID
	
          <input type="text" readonly name="select2" value="<?php echo $_GET[appid]; ?>"  /> 
         
         
           Patient 
           
          <input type="hidden" name="patientid" value="<?php echo $_GET[patientid]; ?>" />
<?php
$sqlpatient= "SELECT * FROM patient WHERE status='Active' AND patientid='$_GET[patientid]'";
$qsqlpatient = mysqli_query($con,$sqlpatient);
$rspatient=mysqli_fetch_array($qsqlpatient);
?>			
          <input type="text" readonly name="select3" value="<?php echo $rspatient[patientname]; ?>"  />
 
         
        
         
           Select Treatment type 
                     
          <select name="select4" id="select4">
           <option value="">Select</option>
            <?php
		  	$sqltreatment= "SELECT * FROM treatment WHERE status='Active'";
			$qsqltreatment = mysqli_query($con,$sqltreatment);
			while($rstreatment=mysqli_fetch_array($qsqltreatment))
			{
				if($rstreatment[treatmentid] == $rsedit[treatmentid])
				{
				echo "<option value='$rstreatment[treatmentid]' selected>$rstreatment[treatmenttype]  - ( NGN $rstreatment[treatment_cost])</option>";
				}
				else
				{
					echo "<option value='$rstreatment[treatmentid]'>$rstreatment[treatmenttype]  - ( NGN $rstreatment[treatment_cost])</option>";
				}
				
			}
		  ?>
 </select> 
         
        
        
        <?php
		if(isset($_SESSION[doctorid]))
		{
		?>
         
           Doctor 
           
    		<?php
				$sqldoctor= "SELECT * FROM doctor INNER JOIN department ON department.departmentid=doctor.departmentid WHERE doctor.status='Active' AND doctor.doctorid='$_SESSION[doctorid]'";
				$qsqldoctor = mysqli_query($con,$sqldoctor);
				while($rsdoctor = mysqli_fetch_array($qsqldoctor))
				{
					echo "$rsdoctor[doctorname] ( $rsdoctor[departmentname] )";
				}
				?>
                <input type="hidden" name="select5" value="<?php echo $_SESSION[doctorid]; ?>"  />
           
        <?php
		}
		else
		{
		?>
         
           Doctor 
           
          <select name="select5" id="select5">
    		<option value="">Select</option>
    		<?php
				$sqldoctor= "SELECT * FROM doctor INNER JOIN department ON department.departmentid=doctor.departmentid WHERE doctor.status='Active'";
				$qsqldoctor = mysqli_query($con,$sqldoctor);
				while($rsdoctor = mysqli_fetch_array($qsqldoctor))
				{
					if($rsdoctor[doctorid] == $rsedit[doctorid])
					{
					echo "<option value='$rsdoctor[doctorid]' selected>$rsdoctor[doctorname] ( $rsdoctor[departmentname] ) </option>";
					}
					else
					{
					echo "<option value='$rsdoctor[doctorid]'>$rsdoctor[doctorname] ( $rsdoctor[departmentname] )</option>";				
					}
				}
		  		?>
          	</select>
           
        <?php
		}
		?>
          
       
         
         
         <br>  Treatment Description 
           <textarea name="textarea" id="textarea" cols="134" rows="2"><?php echo $rsedit[treatment_description] ; ?></textarea> 
         
         
          <br> Treatment files 
           <input type="file" name="uploads" id="uploads" value="<?php echo $rsedit[uploads]; ?>" /> 
         
         
           <br> date 
           <input type="date" max="<?php echo date("Y-m-d"); ?>" name="treatmentdate" id="treatmentdate" value="<?php echo $rsedit[treatment_date]; ?>" /> 
         
         
         
           Treatment Time 
           <input type="time" name="treatmenttime" id="treatmenttime" value="<?php echo $rsedit[treatment_time]; ?>" /> 
         
         
          <input type="submit" name="submit" id="submit" value="Submit" /> <center> <a href='patientreport.php?patientid=<?php echo $_GET[patientid]; ?>&appointmentid=<?php echo $_GET[appid]; ?>'><strong>View Patient Report>></strong></a> 
	</center>
    </form>
    <p>&nbsp;</p>
          <table width="692" border="3">
        <tbody>
           
            <td width="71">Treatment type 
            <td width="78">Doctor 
            <td width="82">Treatment Description 
            <td width="103">Uploads 
            <td width="43">Treatment date 
            <td width="43">Treatment time 
            <td width="54">Status 
            <td width="58">Action 
           
          <?php
		$sql ="SELECT * FROM treatment_records WHERE patientid='$_GET[patientid]' AND appointmentid='$_GET[appid]' ";
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
			
        echo " 
           &nbsp;$rstreatment[treatmenttype] 
		     &nbsp;$rsdoc[doctorname] 
			 &nbsp;$rs[treatment_description] 
			 &nbsp;<a href='treatmentfiles/$rs[uploads]'>Download</a> 
			  &nbsp;$rs[treatment_date] 
			   &nbsp;$rs[treatment_time] 
			     &nbsp;$rs[status] 
           &nbsp;
		  <a href='treatmentrecord.php?editid=$rs[appointmentid]&patientid=$_GET[patientid]&appid=$_GET[appid]'>Edit</a>| <a href='treatmentrecord.php?delid=$rs[appointmentid]&patientid=$_GET[patientid]&appointmentid=$_GET[appid]'>Delete</a>  
         ";
		}
		?>
        </tbody>
      </table>
  </div>
</div>
</div>
 <div class="clear"></div>
  </div>
</div>

<script type="application/javascript">
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform()
{
	if(document.frmtreatrec.select2.value == "")
	{
		alert("Appoitment ID should not be empty..");
		document.frmtreatrec.select2.focus();
		return false;
	}
	
	else if(document.frmtreatrec.select4.value == "")
	{
		alert("Treatment ID should not be empty..");
		document.frmtreatrec.select4.focus();
		return false;
	}
	else if(document.frmtreatrec.select3.value == "")
	{
		alert("Patient ID should not be empty..");
		document.frmtreatrec.select3.focus();
		return false;
	}
	else if(document.frmtreatrec.select5.value == "")
	{
		alert("Doctor ID should not be empty..");
		document.frmtreatrec.select5.focus();
		return false;
	}
	else if(document.frmtreatrec.textarea.value == "")
	{
		alert("Treatment Description should not be empty..");
		document.frmtreatrec.textarea.focus();
		return false;
	}
	else if(document.frmtreatrec.treatmentdate.value == "")
	{
		alert("Treatment date should not be empty..");
		document.frmtreatrec.treatmentdate.focus();
		return false;
	}
	else if(document.frmtreatrec.treatmenttime.value == "")
	{
		alert("Treatment time should not be empty..");
		document.frmtreatrec.treatmenttime.focus();
		return false;
	}
	else if(document.frmtreatrec.select.value == "" )
	{
		alert("Kindly select the status..");
		document.frmtreatrec.select.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>