<?php
$root = "../";
include $root . 'db.php';

include $root . "account/adFormHeader.php";
?>
<div class="container-fluid">
  <div class="block-header">
    <h2>Reservation Records</h2>
  </div>

  <div class="card">

    <section class="container">
      <table class="table table-bordered table-striped table-hover js-basic-example dataTable">

        <thead>
          <tr>
            <th>No.</th>
            <th>Start Date & Time</th>
            <th>End Date & Time</th>
            <th>Model</th>
            <th>Total Price (RM)</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM reservations WHERE ";
          if (isset($_SESSION['userID'])) {
            $sql  = $sql . "userID='$_SESSION[userID]'";
          }
          $qsql = mysqli_query($connect, $sql);
          $j = 0;
          while ($rs = mysqli_fetch_array($qsql)) {
            $j = $j + 1;
            $sqlpat = "SELECT * FROM users WHERE userID='$rs[userID]'";
            $qsqlpat = mysqli_query($connect, $sqlpat);
            $rspat = mysqli_fetch_array($qsqlpat);


            // $sqldept = "SELECT * FROM bikes WHERE ID='$rs[bikeID]'";
            // $qsqldept = mysqli_query($connect,$sqldept);
            //       $rsdept = mysqli_fetch_array($qsqldept);

            $sqldept = "SELECT bikes.ID, models.ID, models.model FROM bikes 
      INNER JOIN models ON bikes.ID = models.ID
      WHERE bikes.ID='$rs[bikeID]'";
            $qsqldept = mysqli_query($connect, $sqldept);
            $rsdept = mysqli_fetch_array($qsqldept);

            $sqlstat = "SELECT * FROM status WHERE statusID='$rs[status]'";
            $qsqlstat = mysqli_query($connect, $sqlstat);
            $rsstat = mysqli_fetch_array($qsqlstat);
            if (strtotime($rs['endDate']) < strtotime('now') && $rsstat['statusDescription'] == "Pending") {
              echo "<script>console.log('done')</script>";
              $rsstat['statusDescription'] = "Done";
              $rs['status'] = 3;

              $sql1 = "UPDATE reservations SET status= 3 WHERE reservationID='$rs[reservationID]'";
              if ($qsql1 = mysqli_query($connect, $sql1)) {
              }
            }

            echo "<tr>
          <td>" . $j . "</td>		 
             <td>&nbsp;" . date("d-M-Y", strtotime($rs['startDate'])) . " <br>" . date("H:i A", strtotime($rs['startTime'])) . "</td> 
			 <td>&nbsp;" . date("d-M-Y", strtotime($rs['endDate'])) . "<br> " . date("H:i A", strtotime($rs['endTime'])) . "</td>              
		    <td>&nbsp;$rsdept[model]</td>
                <td>&nbsp;$rs[totalPrice]</td>
			    <td>&nbsp;$rsstat[statusDescription]</td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </section>
  </div>
</div>
<?php include $root . "account/adFormFooter.php"; ?>