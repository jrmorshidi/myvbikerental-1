<?php
include("adFormHeader.php");
$root = "../";
include $root . 'db.php';
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM users WHERE userID='$_GET[delid]'";
	$qsql=mysqli_query($connect,$sql);
	if(mysqli_affected_rows($connect) == 1)
	{
		echo "<script>alert('User record deleted successfully');</script>";
	}
}
?>

<div class="container-fluid">
  <div class="block-header">
    View User Record
  </div>
</div>
<div class="card">
  <section class="container">
   <table class="table table-bordered table-striped table-hover js-basic-example dataTable">


    <thead>
      <tr>
        <td>Username</td>
        <td>Email</td>
        <td>Mobile Number</td>
        <td width="20%">Address</td>
        <td width = "8%">Total Reservations</td>
    <td width="15%">Action</td>    
      </tr>
    </thead>
    <tbody>
     <?php          
     $sql ="SELECT * FROM users";
     $qsql = mysqli_query($connect,$sql);
     while($rs = mysqli_fetch_array($qsql))
     {
			$sqlpat = "SELECT COUNT(*) AS totalReservations FROM reservations WHERE userID='$rs[userID]'";
			$qsqlpat = mysqli_query($connect,$sqlpat);
			$rspat = mysqli_fetch_array($qsqlpat);

      echo "<tr>
      <td>$rs[username]</td>
      <td>$rs[email]</td>
      <td>$rs[mobileNo]</td>
    <td>$rs[address]</td>
    <td>$rspat[totalReservations]</td>
      <td style='min-width: 180px'>
      <a href='editUsers.php?editid=$rs[userID]' class='btn btn-raised g-bg-cyan'>Edit</a> 
      <a class='btn btn-raised g-bg-blush2' onClick=\"javascript: return confirm('Please confirm deletion');\" href='viewUsers.php?delid=$rs[userID]'>Delete</a>      
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