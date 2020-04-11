<?php
session_start();
include("headers.php");
include("dbconnection.php");
if(isset($_POST[submit]))
{
	if(isset($_SESSION[doctorid]))
	{
			$sql ="UPDATE doctor SET doctorname='$_POST[doctorname]',mobileno='$_POST[mobilenumber]',departmentid='$_POST[select3]',loginid='$_POST[loginid]',education='$_POST[education]',experience='$_POST[experience]',consultancy_charge='$_POST[consultancy_charge]' WHERE doctorid='$_SESSION[doctorid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('Doctor profile updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
	$sql ="INSERT INTO doctor(doctorname,mobileno,departmentid,loginid,password,status,education,experience) values('$_POST[doctorname]','$_POST[mobilenumber]','$_POST[select3]','$_POST[loginid]','$_POST[password]','$_POST[select]','$_POST[education]','$_POST[experience]')";
	if($qsql = mysqli_query($con,$sql))
	{
		echo "<script>alert('Doctor record inserted successfully...');</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
}
if(isset($_SESSION[doctorid]))
{
	$sql="SELECT * FROM doctor WHERE doctorid='$_SESSION[doctorid]' ";
	$qsql = mysqli_query($con,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>
<!DOCTYPE html>
<html>
<style>
	body{
    min-height: 100vh;
    background-color:  white;
}
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
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

input[type=submit]:hover {
	background: linear-gradient(120deg,white,#071f44,#071f44);
}


</style>
<body>
<div class="wrapper col4">
  <div id="container">
    <h1>Add new Doctor record</h1>
   <form method="post" action="" name="frmdoctprfl" onSubmit="return validateform()">
          Doctor Name  
          <input type="text" name="doctorname" id="doctorname" value="<?php echo $rsedit[doctorname]; ?>" />  
        
            Mobile Number  
            <input type="text" name="mobilenumber" id="mobilenumber" value="<?php echo $rsedit[mobileno]; ?>"/>  
          
          
            <p>Department</p>  
            <select name="select3" id="select3" class="form-control">
          <option value="">Select</option>
            <?php
		  	$sqldepartment= "SELECT * FROM department WHERE status='Active'";
			$qsqldepartment = mysqli_query($con,$sqldepartment);
			while($rsdepartment=mysqli_fetch_array($qsqldepartment))
			{
				if($rsdepartment[departmentid] == $rsedit[departmentid])
				{
	echo "<option value='$rsdepartment[departmentid]' selected>$rsdepartment[departmentname]</option>";
				}
				else
				{
  echo "<option value='$rsdepartment[departmentid]'>$rsdepartment[departmentname]</option>";
				}
				
			}
		  ?>
          </select>  
          
          
            Login ID  
            <input type="text" name="loginid" id="loginid" value="<?php echo $rsedit[loginid]; ?>"/>  
          
          
            Education  
            <input type="text" name="education" id="education" value="<?php echo $rsedit[education]; ?>" />  
          
          
            Experience (Years)
            <input type="text" name="experience" id="experience" value="<?php echo $rsedit[experience]; ?>"/>  
          
          
            Consultancy charge  (NGN)
            
            <input type="text" name="consultancy_charge" id="consultancy_charge" value="<?php echo $rsedit[consultancy_charge]; ?>"/>  
          
          
         <input type="submit" name="submit" id="submit" value="Submit" />  
          
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
if(document.frmdoctprfl.doctorname.value == "")
	{
		alert("Doctor name should not be empty..");
		document.frmdoctprfl.doctorname.focus();
		return false;
	}
	else if(!document.frmdoctprfl.doctorname.value.match(alphaspaceExp))
	{
		alert("Doctor name not valid..");
		document.frmdoctprfl.doctorname.focus();
		return false;
	}
	else if(document.frmdoctprfl.mobilenumber.value == "")
	{
		alert("Mobile number should not be empty..");
		document.frmdoctprfl.mobilenumber.focus();
		return false;
	}
	else if(!document.frmdoctprfl.mobilenumber.value.match(numericExpression))
	{
		alert("Mobile number not valid..");
		document.frmdoctprfl.mobilenumber.focus();
		return false;
	}
	else if(document.frmdoctprfl.select3.value == "")
	{
		alert("Department ID should not be empty..");
		document.frmdoctprfl.select3.focus();
		return false;
	}
	else if(document.frmdoctprfl.loginid.value == "")
	{
		alert("Login ID should not be empty..");
		document.frmdoctprfl.loginid.focus();
		return false;
	}
	else if(!document.frmdoctprfl.loginid.value.match(alphanumericExp))
	{
		alert("loginid not valid..");
		document.frmdoctprfl.loginid.focus();
		return false;
	}
	else if(document.frmdoctprfl.password.value == "")
	{
		alert("Password should not be empty..");
		document.frmdoctprfl.password.focus();
		return false;
	}
	else if(document.frmdoctprfl.password.value.length < 8)
	{
		alert("Password length should be more than 8 characters...");
		document.frmdoctprfl.password.focus();
		return false;
	}
	else if(document.frmdoctprfl.password.value != document.frmdoctprfl.cnfirmpassword.value )
	{
		alert("Password and confirm password should be equal..");
		document.frmdoctprfl.password.focus();
		return false;
	}
	else if(document.frmdoctprfl.education.value == "")
	{
		alert("Education should not be empty..");
		document.frmdoctprfl.education.focus();
		return false;
	}
	else if(!document.frmdoctprfl.education.value.match(alphaExp))
	{
		alert("Education not valid..");
		document.frmdoctprfl.education.focus();
		return false;
	}
	else if(document.frmdoctprfl.experience.value == "")
	{
		alert("Experience should not be empty..");
		document.frmdoctprfl.experience.focus();
		return false;
	}
	else if(!document.frmdoctprfl.experience.value.match(numericExpression))
	{
		alert("Experience not valid..");
		document.frmdoctprfl.experience.focus();
		return false;
	}
	else if(document.frmdoctprfl.select.value == "" )
	{
		alert("Kindly select the status..");
		document.frmdoctprfl.select.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>