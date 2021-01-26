<?php
include("adFormHeader.php");
$root = "../";
include $root . 'db.php';
?>

<div class="container-fluid">
  <div class="block-header">
    View Models Record
  </div>
</div>
<div class="card">
  <section class="container">
   <table class="table table-bordered table-striped table-hover js-basic-example dataTable">

    <thead>
      <tr>
        <td>Model</td>
        <td>Product Code</td>
        <td>Brand</td>
        <td>Year of Production</td>
        <td>Engine Volume</td>
        <td>Horse Power</td>
        <td>Fuel Consumption</td>
        <td>Price</td>
        <td style = "width:auto">Action</td>
      </tr>
    </thead>
    <tbody>
     <?php          
     $sql ="SELECT * FROM models";
     $qsql = mysqli_query($connect,$sql);
     while($rs = mysqli_fetch_array($qsql))
     {
		$sqlpat = "SELECT * FROM brands WHERE ID='$rs[brand]'";
		$qsqlpat = mysqli_query($connect,$sqlpat);
        $rspat = mysqli_fetch_array($qsqlpat);             
        $brand = $rspat['brand'];   

      echo "<tr>
      <td>$rs[model]</td>
      <td>$rs[product_code]</td>
      <td>$brand</td>
      <td>$rs[year_of_production]</td>
      <td>$rs[engine_volume]</td>
      <td>$rs[horsepower]</td>
      <td>$rs[fuel_consumption]</td>
      <td>$rs[price]</td>
      <td>
      <a href='editModels.php?editid=$rs[ID]' class='btn btn-raised g-bg-cyan'>Edit</a>   
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