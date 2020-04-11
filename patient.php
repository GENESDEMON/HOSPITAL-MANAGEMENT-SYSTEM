<?php
session_start();
include("header.php");
include("dbconnection.php");
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
			$sql ="UPDATE patient SET patientname='$_POST[patientname]',admissiondate='$_POST[admissiondate]',admissiontime='$_POST[admissiontme]',address='$_POST[address]',mobileno='$_POST[mobilenumber]',city='$_POST[city]',pincode='$_POST[pincode]',loginid='$_POST[loginid]',password='$_POST[password]',bloodgroup='$_POST[select2]',gender='$_POST[select3]',dob='$_POST[dateofbirth]',status='$_POST[select]' WHERE patientid='$_GET[editid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('patient record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
	$sql ="INSERT INTO patient(patientname,admissiondate,admissiontime,address,mobileno,city,pincode,loginid,password,bloodgroup,gender,dob,status) values('$_POST[patientname]','$dt','$tim','$_POST[address]','$_POST[mobilenumber]','$_POST[city]','$_POST[pincode]','$_POST[loginid]','$_POST[password]','$_POST[select2]','$_POST[select3]','$_POST[dateofbirth]','Active')";
	if($qsql = mysqli_query($con,$sql))
	{
		echo "<script>alert('patients record inserted successfully...');</script>";
		$insid= mysqli_insert_id($con);
		if(isset($_SESSION[adminid]))
		{
		echo "<script>window.location='appointment.php?patid=$insid';</script>";	
		}
		else
		{
		echo "<script>window.location='patientlogin.php';</script>";	
		}		
	}
	else
	{
		echo mysqli_error($con);
	}
}
}
if(isset($_GET[editid]))
{
	$sql="SELECT * FROM patient WHERE patientid='$_GET[editid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
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
}
body{
    min-height: 100vh;
    background-color:  white;
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

input[type=submit]:hover {
	background: linear-gradient(120deg,white,#071f44,#071f44);
}

div {
  border-radius: 5px;
  background-color: white;
  padding: 20px;
}
</style>
<body>
<div class="wrapper col4">
  <div id="container">
    <h1>Patient Registration</h1>
    <form method="post" action="" name="frmpatient" onSubmit="return validateform()">
          Patient Name<br>
          <input type="text" name="patientname" id="patientname"  value="<?php echo $rsedit[patientname]; ?>"/>
        
<?php
if(isset($_GET[editid]))
{
?>       
  	Admission Date<br>
           <input type="date" name="admissiondate" id="admissiondate" value="<?php echo $rsedit[admissiondate]; ?>" readonly /> 
       
         
           Admission Time 
           <input type="time" name="admissiontme" id="admissiontme" value="<?php echo $rsedit[admissiontime]; ?>" readonly /> 
         
<?php
}
?>
         
           Address 
           <input type="text" name="address" id="address" value="<?php echo $rsedit[address]; ?>" /> 
         
         
           Mobile Number 
           <input type="text" name="mobilenumber" id="mobilenumber" value="<?php echo $rsedit[mobileno]; ?>" /> 
         
         
           City 
           <input type="text" name="city" id="city" value="<?php echo $rsedit[city]; ?>" /> 
         
         
           PIN Code 
           <input type="text" name="pincode" id="pincode" value="<?php echo $rsedit[pincode]; ?>" /> 
         
         
           Login ID (Your Email Address)
           <input type="text" name="loginid" id="loginid"  value="<?php echo $rsedit[loginid]; ?>"/> 
         
         
           Password 
           <input type="password" name="password" id="password" value="<?php echo $rsedit[password]; ?>" /> 
         
         
           Confirm Password 
           <input type="password" name="confirmpassword" id="confirmpassword"  value="<?php echo $rsedit[confirmpassword]; ?>"/> 
         
         
           Blood Group 
           <select name="select2" id="select2">
           <option value="">Select</option>
          <?php
		  $arr = array("A+","A-","B+","B-","O+","O-","AB+","AB-");
		  foreach($arr as $val)
		  {
			  if($val == $rsedit[bloodgroup])
			  {
			  echo "<option value='$val' selected>$val</option>";
			  }
			  else
			  {
				  echo "<option value='$val'>$val</option>";			  
			  }
		  }
		  ?>
          </select> 
         
         
           Gender 
           <select name="select3" id="select3">
           <option value="">Select</option>
          <?php
		  $arr = array("MALE","FEMALE");
		  foreach($arr as $val)
		  {
			  if($val == $rsedit[gender])
			  {
			  echo "<option value='$val' selected>$val</option>";
			  }
			  else
			  {
				  echo "<option value='$val'>$val</option>";			  
			  }
		  }
		  ?>
          </select> 
         
         
           Date Of Birth 
           <input type="date" name="dateofbirth" max="<?php echo date("Y-m-d"); ?>" id="dateofbirth"  value="<?php echo $rsedit[dob]; ?>"/> 
         
       
          
         
          <td colspan="2" align="center"><input type="submit" class="logbtn" name="submit" id="submit" value="Submit" /> 
         
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
		</body>

<script type="application/javascript">
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform()
{
	if(document.frmpatient.patientname.value == "")
	{
		alert("Patient name should not be empty..");
		document.frmpatient.patientname.focus();
		return false;
	}
else if(!document.frmpatient.patientname.value.match(alphaspaceExp))
	{
		alert("Patient name not valid..");
		document.frmpatient.patientname.focus();
		return false;
	}
	else if(document.frmpatient.admissiondate.value == "")
	{
		alert("Admission date should not be empty..");
		document.frmpatient.admissiondate.focus();
		return false;
	}
	else if(document.frmpatient.admissiontme.value == "")
	{
		alert("Admission time should not be empty..");
		document.frmpatient.admissiontme.focus();
		return false;
	}
	else if(document.frmpatient.address.value == "")
	{
		alert("Address should not be empty..");
		document.frmpatient.address.focus();
		return false;
	}
	else if(document.frmpatient.mobilenumber.value == "")
	{
		alert("Mobile number should not be empty..");
		document.frmpatient.mobilenumber.focus();
		return false;
	}
	else if(!document.frmpatient.mobilenumber.value.match(numericExpression))
	{
		alert("Mobile number not valid..");
		document.frmpatient.mobilenumber.focus();
		return false;
	}
	else if(document.frmpatient.city.value == "")
	{
		alert("City should not be empty..");
		document.frmpatient.city.focus();
		return false;
	}
	else if(!document.frmpatient.city.value.match(alphaspaceExp))
	{
		alert("City not valid..");
		document.frmpatient.city.focus();
		return false;
	}
	else if(document.frmpatient.pincode.value == "")
	{
		alert("Pincode should not be empty..");
		document.frmpatient.pincode.focus();
		return false;
	}
	else if(!document.frmpatient.pincode.value.match(numericExpression))
	{
		alert("Pincode not valid..");
		document.frmpatient.pincode.focus();
		return false;
	}
	else if(document.frmpatient.loginid.value == "")
	{
		alert("Login ID should not be empty..");
		document.frmpatient.loginid.focus();
		return false;
	}
	else if(!document.frmpatient.loginid.value.match(alphanumericExp))
	{
		alert("Login ID not valid..");
		document.frmpatient.loginid.focus();
		return false;
	}
	else if(document.frmpatient.password.value == "")
	{
		alert("Password should not be empty..");
		document.frmpatient.password.focus();
		return false;
	}
	else if(document.frmpatient.password.value.length < 8)
	{
		alert("Password length should be more than 8 characters...");
		document.frmpatient.password.focus();
		return false;
	}
	else if(document.frmpatient.password.value != document.frmpatient.confirmpassword.value )
	{
		alert("Password and confirm password should be equal..");
		document.frmpatient.confirmpassword.focus();
		return false;
	}
	else if(document.frmpatient.select2.value == "")
	{
		alert("Blood Group should not be empty..");
		document.frmpatient.select2.focus();
		return false;
	}
	else if(document.frmpatient.select3.value == "")
	{
		alert("Gender should not be empty..");
		document.frmpatient.select3.focus();
		return false;
	}
	else if(document.frmpatient.dateofbirth.value == "")
	{
		alert("Date Of Birth should not be empty..");
		document.frmpatient.dateofbirth.focus();
		return false;
	}
	else if(document.frmpatient.select.value == "" )
	{
		alert("Kindly select the status..");
		document.frmpatient.select.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>