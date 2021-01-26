<?php
include("adFormHeader.php");
$root = "../";
include $root . 'db.php';

if(isset($_GET['delid']))
{
	$sql ="DELETE FROM bikes WHERE ID='$_GET[delid]'";
	$qsql=mysqli_query($connect,$sql);
	if(mysqli_affected_rows($connect) == 1)
	{
		echo "<script>alert('Bike record deleted successfully');</script>";
	}
}
?>

<div class="container-fluid">
  <div class="block-header">
    View Bikes
  </div>
</div>
<div class="card">
  <section class="container">
   <table class="table table-bordered table-striped table-hover js-basic-example dataTable">

    <thead>
      <tr>
        <td>ID</td>
        <td>Model</td>
        <td>Plate Number</td>
        <td>Status</td>
        <td>Action</td>
      </tr>
    </thead>
    <tbody>
     <?php          
     $sql ="SELECT * FROM Bikes";
     $qsql = mysqli_query($connect,$sql);
     while($rs = mysqli_fetch_array($qsql))
     {
			$sqlpat = "SELECT * FROM bikes_status WHERE ID='$rs[status]'";
			$qsqlpat = mysqli_query($connect,$sqlpat);
      $rspat = mysqli_fetch_array($qsqlpat);             
      $status = $rspat['status'];

			$sqlmodel = "SELECT * FROM models WHERE ID='$rs[model]'";
			$qsqlmodel = mysqli_query($connect,$sqlmodel);
      $rsmodel = mysqli_fetch_array($qsqlmodel);             
      $model = $rsmodel['model'];      

      echo "<tr>
      <td>$rs[ID]</td>
      <td>$model</td>
      <td>$rs[plate_no]</td>
      <td>$status</td>
      <td style='min-width: 180px'>
      <a href='editBikes.php?editid=$rs[ID]' class='btn btn-raised g-bg-cyan'>Edit</a>
      <a class='btn btn-raised g-bg-blush2' onClick=\"javascript: return confirm('Please confirm deletion');\" href='viewBikes.php?delid=$rs[ID]'>Delete</a>        
      </td>
      </tr>";
    }
    ?>
  </tbody>
</table>
</section>

</div>
</div>



<?php
include("adFormFooter.php");
?>