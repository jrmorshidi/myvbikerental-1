<?php
$root = "../";
include $root . 'db.php';

include $root . "account/adFormHeader.php";
?>
<div class="container-fluid">
  <div class="block-header">
    <h2>Reservation Records</h2>
  </div>

		<!-- Delete Product Data Modal -->
		<div class="modal fade" id="deleteProductData" name = "deleteProductData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Cancel Reservation</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				<form action = "cancelReservation.php" method = "post">
				  <input type="hidden" name = "deleteProductID" id = "deleteProductID">				  
				  <div class="form-group">
					<h5>Do you want to cancel this reservation?</h5>
					  <div class="form-group">						
						<input type="hidden" class="form-control" id="productNameDelete" name = "productNameDelete" readonly>
					  </div>
				  </div>				  			
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="submit" name ="cancelReservationButton" class="btn btn-primary">OK</button>
			  </div>
			  </form>
			</div>
		  </div>
		</div>  

<div class="card">

  <section class="container">
    <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id = "reservationData">

      <thead>
        <tr>
          <th>No.</th>
          <th>User</th>
          <th>Start Date &  Time</th>
          <th>End Date &  Time</th>
          <th>Model</th>
          <th>Total Price (RM)</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
          <?php
		$sql ="SELECT * FROM reservations";
        $qsql = mysqli_query($connect,$sql);
        $j = 0;
		while($rs = mysqli_fetch_array($qsql))
		{
      $j = $j + 1;
			$sqlpat = "SELECT * FROM users WHERE userID = '$rs[userID]'";
			$qsqlpat = mysqli_query($connect,$sqlpat);
			$rspat = mysqli_fetch_array($qsqlpat);
			
			
			// $sqldept = "SELECT * FROM bikes WHERE ID='$rs[bikeID]'";
			// $qsqldept = mysqli_query($connect,$sqldept);
      //       $rsdept = mysqli_fetch_array($qsqldept);

			$sqldept = "SELECT bikes.ID, models.ID, models.model, models.product_code FROM bikes 
      INNER JOIN models ON bikes.ID = models.ID
      WHERE bikes.ID='$rs[bikeID]'";
			$qsqldept = mysqli_query($connect,$sqldept);
      $rsdept = mysqli_fetch_array($qsqldept);       
            
			$sqlstat = "SELECT * FROM status WHERE statusID='$rs[status]'";
			$qsqlstat= mysqli_query($connect,$sqlstat);
      $rsstat = mysqli_fetch_array($qsqlstat);          
      if(strtotime($rs['endDate']) < strtotime('now') && $rsstat['statusDescription'] == "Pending"){
          echo"<script>console.log('done')</script>";
          $rsstat['statusDescription'] = "Done";
          $rs['status'] = 3;

          $sql1 ="UPDATE reservations SET status= 3 WHERE reservationID='$rs[reservationID]'";
          if($qsql1 = mysqli_query($connect,$sql1))
          {

          }          
      }
      
        echo "<tr>
          <td>".$j."</td>		
            <td>&nbsp;$rspat[username]<br>&nbsp;$rspat[email]</td>	 
             <td>&nbsp;" . date("d-M-Y",strtotime($rs['startDate'])) . " <br>" . date("H:i A",strtotime($rs['startTime'])) . "</td> 
			 <td>&nbsp;" . date("d-M-Y",strtotime($rs['endDate'])) . "<br> " . date("H:i A",strtotime($rs['endTime'])) . "</td>              
		    <td>&nbsp;$rsdept[model]</td>
                <td>&nbsp;$rs[totalPrice]</td>
                <td>&nbsp;$rsstat[statusDescription]</td>
                <td><div align='center'>";
                if($rs['status'] == 4)
                {
                      //  echo "  <a href='cancelReservation.php?delid=$rs[reservationID]'>Cancel</a>";
                       echo "<a onClick=\"javascript: return confirm('Please confirm deletion');\" href='cancelReservation.php?delid=$rs[reservationID]'>Cancel</a>"; //use double quotes for js inside php!                       
                      //  echo "<button type='button' class='deleteProductBtn'>Delete</button>";
                    //    echo "<form action='cancelReservation.php?delid=$rs[reservationID] method='POST'>
                    //    <input type='submit' class='deleteProductBtn' name='Cancel' value = 'Cancel'>
                    //  </form>";
                }
               echo "</center></td></tr>";
		}
		?>
      </tbody>
    </table>
</section>
</div>
</div>
<script>  
  $(document).ready(function(){  
      $('#reservationData').on('click', '.deleteProductBtn', function(){
      // $('#deleteProductData').modal();
      
      $tr = $(this).closest('tr');
      var data = $tr.children("td").map(function(){
        return $(this).text();
      }).get();
      
      console.log(data);
      
      $('#deleteProductID').val(data[0]);
      $('#productNameDelete').val(data[1]);			
    });
  });    
</script>  
<?php include $root . "account/adFormFooter.php"; ?>