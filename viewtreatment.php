<?php
session_start();
include("headers.php");
include("dbconnection.php");
if(isset($_GET[delid]))
{
	$sql ="DELETE FROM treatment WHERE treatmentid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('treatment deleted successfully..');</script>";
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
    <h1>View treatment record</h1>
    <table width="200" border="3" id="treatment">
      <tbody>
        <tr>
          <td><strong>Treatment For</strong></td>
          <td><strong>Cost (NGN)</strong></td>
          <td><strong>Description</strong></td>
          <td><strong>Status</strong></td>
          <?php
		  		if(isset($_SESSION[adminid]))
		{
		?>
          <td><strong>Action</strong></td>
          <?php
		}
		?>
        </tr>
          <?php
		$sql ="SELECT * FROM treatment";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
        echo "<tr>
          <td>&nbsp;$rs[treatmenttype]</td>
		  <td>&nbsp;NGN. $rs[treatment_cost]</td>
          <td>&nbsp;$rs[note]</td>
			 <td>&nbsp;$rs[status]</td>";
		if(isset($_SESSION[adminid]))
		{
		echo "<td>&nbsp;
			  <a href='treatment.php?editid=$rs[treatmentid]'>Edit</a> | <a href='viewtreatment.php?delid=$rs[treatmentid]'>Delete</a> </td>";
			}
        echo "</tr>";
		}
		?>
      </tbody>
    </table>
    <h1>&nbsp;</h1>
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