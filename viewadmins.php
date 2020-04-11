<?php
session_start();
include("headers.php");
include("dbconnection.php");
if(isset($_GET[delid]))
{
	$sql ="DELETE FROM admin WHERE adminid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('admin record deleted successfully..');</script>";
	}
}
?>

<style>
 #admin {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

 #admin td,  #admin th {
  border: 1px solid #ddd;
  padding: 8px;
}

 #admin tr:nth-child(even){background-color: #f2f2f2;}


 #admin th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #071f44;
  color: white;
}
body{
    min-height: 100vh;
    background-color:  white;
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
  background-color: #202020;
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
   <section class="container">
   
<h2>SEARCH - <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter" /></h2>
    <table class="order-table" id="admin">
      <thead>
        <tr>
          <td width="12%" height="40">Admin Name</td>
          <td width="11%">Login ID</td>
          <td width="12%">Status</td>
          <td width="34%">Action</td>
        </tr>
        </thead>
       <tbody>
       <?php
		$sql ="SELECT * FROM admin";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
        echo "<tr>
          <td>&nbsp;$rs[adminname]</td>
          <td>&nbsp;$rs[loginid]</td>
          <td>&nbsp;$rs[status]</td>
          <td>&nbsp;
		  <a href='admin.php?editid=$rs[adminid]'>Edit</a>| <a href='viewadmin.php?delid=$rs[adminid]'>Delete</a> </td>
        </tr>";
		}
		?>
      </tbody>
    </table>
    </section>
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