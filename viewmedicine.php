<?php
session_start();
include("headers.php");
include("dbconnection.php");
if(isset($_GET[delid]))
{
	$sql ="DELETE FROM medicine WHERE medicineid='$_GET[delid]'";
	$qsql=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Medicine redcord deleted successfully..');</script>";
	}
}
?>
<style>
  body{
    min-height: 100vh;
    background-color:  white;
}
 #medicine {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

 #medicine td,  #medicine th {
  border: 1px solid #ddd;
  padding: 8px;
}

 #medicine tr:nth-child(even){background-color: #f2f2f2;}

 #medicine tr:hover {background-color: #071f44;}

 #medicine th {
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
  
<section class="container">
<h2>Search- <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter" /></h2>

	<table class="order-table" id="medicine">
      <thead>
        <tr>
          <th>Medicine </th>
          <th>Cost</th>
          <th>Description</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
        </thead> 
        <tbody>
        
          <?php
		$sql ="SELECT * FROM medicine";
		$qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
        echo "<tr>
          <td>&nbsp;$rs[medicinename]</td>
          <td>&nbsp;$rs[medicinecost]</td>
          <td>&nbsp;$rs[description]</td>
			 <td>&nbsp;$rs[status]</td>
			 <td>&nbsp;
			  <a href='medicine.php?editid=$rs[medicineid]'>Edit</a> | <a href='viewmedicine.php?delid=$rs[medicineid]'>Delete</a> </td>
        </tr>";
		}
		?>
      </tbody>
    </table>
    </section>
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