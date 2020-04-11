<?php
session_start();
include("headers.php");
include("dbconnection.php");
if(isset($_POST[submit]))
{
	if(isset($_SESSION[adminid]))
	{
			$sql ="UPDATE admin SET adminname='$_POST[adminname]',loginid='$_POST[loginid]',status='$_POST[select]' WHERE adminid='$_SESSION[adminid]'";
		if($qsql = mysqli_query($con,$sql))
		{
			echo "<script>alert('admin record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
	$sql ="INSERT INTO admin(adminname,loginid,status) values('$_POST[adminname]','$_POST[loginid]','$_POST[select]')";
	if($qsql = mysqli_query($con,$sql))
	{
		echo "<script>alert('Administrator record inserted successfully...');</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
}
if(isset($_SESSION[adminid]))
{
	$sql="SELECT * FROM admin WHERE adminid='$_SESSION[adminid]' ";
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
    <form method="post" action="" name="frmadminprofile" onSubmit="return validateform()">
   Admin Name
   <input type="text" name="adminname" id="adminname" value="<?php echo $rsedit[adminname]; ?>"/>
        Login ID
		 <input type="text" name="loginid" id="loginid"value="<?php echo $rsedit[loginid]; ?>" />
		  Status
			  <select name="select" id="select">
          <option value="">Select</option>
          <?php
		  $arr = array("Active","Inactive");
		  foreach($arr as $val)
		  {
			  if($val == $rsedit[status])
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
	if(document.frmadminprofile.adminname.value == "")
	{
		alert("Admin name should not be empty..");
		document.frmadminprofile.adminname.focus();
		return false;
	}
	else if(!document.frmadminprofile.adminname.value.match(alphaspaceExp))
	{
		alert("Admin name not valid..");
		document.frmadminprofile.adminname.focus();
		return false;
	}
	else if(document.frmadminprofile.loginid.value == "")
	{
		alert("Login ID should not be empty..");
		document.frmadminprofile.loginid.focus();
		return false;
	}
	else if(!document.frmadminprofile.loginid.value.match(alphanumericExp))
	{
		alert("Login ID not valid..");
		document.frmadminprofile.loginid.focus();
		return false;
	}
	else if(document.frmadminprofile.select.value == "" )
	{
		alert("Kindly select the status..");
		document.frmadminprofile.select.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>