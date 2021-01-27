<?php
include("adFormHeader.php");
$root = "../";
include $root . 'db.php';

if(isset($_POST['submit']))
{
	if(isset($_GET['revid']))
	{
        $sqlb="SELECT reservations.bikeID, bikes.ID
        FROM reservations 
        LEFT JOIN bikes 
        ON reservations.bikeID = bikes.ID
        WHERE reservations.reservationID='$_GET[revid]' ";
	    $qsqlb = mysqli_query($connect,$sqlb);
        $rsedit = mysqli_fetch_array($qsqlb);

		$sql ="UPDATE bikes SET status='$_POST[selectStatus]' WHERE ID='$rsedit[ID]'";
		if($qsql = mysqli_query($connect,$sql))
		{
			echo "<div class='alert alert-success'>
			Bike Status updated successfully
			</div>";
			// echo"<script>window.location.href = 'reviewReservation.php?revid=$_GET[revid]';</script>";
		}
		else
		{
			echo mysqli_error($connect);
		}	
	}
}
if(isset($_GET['revid']))
{
	$sql="SELECT reservations.*, bikes.ID, bikes.model, bikes.plate_no, bikes.status AS bikeStatus 
        FROM reservations 
        LEFT JOIN bikes 
        ON reservations.bikeID = bikes.ID
        WHERE reservations.reservationID='$_GET[revid]' ";
	$qsql = mysqli_query($connect,$sql);
    $rsedit = mysqli_fetch_array($qsql);

	$sqluser="SELECT * FROM users WHERE userID='$rsedit[userID]' ";
	$qsqluser = mysqli_query($connect,$sqluser);
    $rsuser = mysqli_fetch_array($qsqluser);    

	$sqlstatus="SELECT * FROM status WHERE statusID='$rsedit[status]' ";
	$qsqlstatus = mysqli_query($connect,$sqlstatus);
    $rsstatus = mysqli_fetch_array($qsqlstatus);        
}
?>

<div class="container-fluid">
	<div class="block-header">
		<h2> Review Reservation </h2>
	</div>

    <!-- comment -->

<div class="card">
<section class="container">
<br><h4>Reservation</h4><hr>
  <table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>Reservation ID</th>
            <td> <?php echo $rsedit['reservationID'];?> </td>
        </tr>
    </thead>
        <tr>
            <th>Start Date</th>
            <td> <?php echo $rsedit['startDate'];?> </td>
        </tr>  
        <tr>
            <th>Start Time</th>
            <td> <?php echo $rsedit['startTime'];?> </td>
        </tr>               
        <tr>
            <th>End Date</th>
            <td> <?php echo $rsedit['endDate'];?> </td>
        </tr>        
        <tr>
            <th>End Time</th>
            <td> <?php echo $rsedit['endTime'];?> </td>
        </tr>   
        <tr>
            <th>Price</th>
            <td> <?php echo $rsedit['totalPrice'];?> </td>
        </tr>                    
        <tr>
            <th>Comments</th>
            <td> 
                <?php
                if($rsedit['comments'] != ""){
                    echo $rsedit['comments'];
                }
                else{
                    echo "-";
                }
                ?> 
            </td>
        </tr>           
        <tr>
            <th>Status</th>
            <td> <?php echo $rsstatus['statusDescription'];?> </td>
        </tr>            
      </tbody>     
  </table>
</section>
</div>

<div class="card">
<section class="container">
<br><h4>User</h4><hr>
  <table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>Username</th>
            <td> <?php echo $rsuser['username'];?> </td>
        </tr>
    </thead>
        <tr>
            <th>Email</th>
            <td> <?php echo $rsuser['email'];?> </td>
        </tr>          
      </tbody>     
  </table>
</section>
</div>

<div class="card">
<section class="container">
<br><h4>Bike</h4><hr>
  <table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>Bike ID</th>
            <td> <?php echo $rsedit['ID'];?> </td>
        </tr>
    </thead>
        <tr>
            <th>Start Date</th>
            <td> <?php echo $rsedit['startDate'];?> </td>
        </tr>  
        <tr>
            <th>Bike Model</th>
            <td> <?php echo $rsedit['model'];?> </td>
        </tr>               
        <tr>
            <th>Plate Number</th>
            <td> <?php echo $rsedit['plate_no'];?> </td>
        </tr>        
        <tr>
            <th>Status</th>
            <!-- <td> <?php echo $rsedit['bikeStatus'];?> </td> -->
            <td>
            <form method="post" action="" name="frmbikesprofile" onSubmit="return validateform()">
            <div class="form-group drop-custum">
                <select class="form-control show-tick" name="selectStatus">
                <?php             
                        $statusQuery ="SELECT * FROM bikes_status";  
                        $statusResult = mysqli_query($connect, $statusQuery); 
                        while($row = mysqli_fetch_array($statusResult))  
                        {                                                                                               
                            if($row["ID"] == $rsedit["bikeStatus"]){
                                echo '  
                                <option value ='.$row["ID"].' selected>'.$row["ID"].' - '.$row["status"].'</option>  
                            ';                                                      
                            }
                            else{
                                echo '<option value ='.$row["ID"].'>'.$row["ID"].' - '.$row["status"].'</option>';  
                            }
                        }								                        	
                    ?>                                        
                </select>
            </div>
            </td>
        </tr>                                
      </tbody>     
  </table>
    <div class="col-sm-12">
        <input type="submit" class="btn btn-raised g-bg-cyan" name="submit" id="submit" value="Submit" style="float: right;"/>
    </div>
    </form>
</section>
</div>
    <!-- comment -->
</div>

<?php include("adFooter.php");?>