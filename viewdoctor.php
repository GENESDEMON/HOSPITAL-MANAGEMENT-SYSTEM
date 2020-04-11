<?php
session_start();
include("headers.php");
include("dbconnection.php");
if(isset($_GET[delid]))
{
	$sql ="DELETE FROM doctor WHERE doctorid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('doctor record deleted successfully..');</script>";
	}
}
?>
<style>
  body{
    min-height: 100vh;
    background-color:  white;
}
#doctor  {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#doctor  td, #doctor  th {
  border: 1px solid #ddd;
  padding: 8px;
}

#doctor  tr:nth-child(even){background-color: #f2f2f2;}



#doctor  th {
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
input[type=search] {
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
<div class="wrapper col4">
  <div id="container">

<section class="container">
<h2>Search- <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter" /></h2>

	<table class="order-table">
      <thead>
   
    <table style="width:100%;" border="3" id="doctor">
      <tbody>
        <tr>
          <td>Doctor Name</td>
          <td>Mobile Number</td>
          <td>Department</td>
          <td>Login ID</td>
          <td>Consultancy Charge</td>
          <td>Education</td>
          <td>Experience</td>
          <td>Status</td>
          <td>Action</td>
        </tr>
          <?php
		$sql ="SELECT * FROM doctor";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			
			$sqldept = "SELECT * FROM department WHERE departmentid='$rs[departmentid]'";
			$qsqldept = mysqli_query($con,$sqldept);
			$rsdept = mysqli_fetch_array($qsqldept);
        echo "<tr>
          <td>&nbsp;$rs[doctorname]</td>
          <td>&nbsp;$rs[mobileno]</td>
		   <td>&nbsp;$rsdept[departmentname]</td>
			<td>&nbsp;$rs[loginid]</td>
			<td>&nbsp;$rs[consultancy_charge]</td>
			 <td>&nbsp;$rs[education]</td>
			<td>&nbsp;$rs[experience]</td>
          <td>$rs[status]</td>
           <td>&nbsp;
		   <a href='doctor.php?editid=$rs[doctorid]'>Edit</a> | <a href='viewdoctor.php?delid=$rs[doctorid]'>Delete</a> </td>
        </tr>";
		}
		?>      </tbody>
    </table>
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