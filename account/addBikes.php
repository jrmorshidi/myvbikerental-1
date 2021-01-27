<?php
include("adHeader.php");
include("db.php");
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE bikes SET model='$_POST[selectModel]',plate_no='$_POST[plate_no]',status='$_POST[selectStatus]' WHERE ID='$_GET[editid]'";
		if($qsql = mysqli_query($connect,$sql))
		{
			echo "<div class='alert alert-success'>
			Bike Record updated successfully
			</div>";
			echo"<script>window.location.href = 'viewBikes.php';</script>";
		}
		else
		{
			echo mysqli_error($connect);
		}	
	}
	else
	{
		$sql ="INSERT INTO bikes(model,plate_no,status) values('$_POST[selectModel]','$_POST[plate_no]','$_POST[selectStatus]')";
		if($qsql = mysqli_query($connect,$sql))
		{
			echo "<div class='alert alert-success'>
			Bike Record Inserted successfully
			</div>";
		}
		else
		{
			echo mysqli_error($connect);
		}
	}
}
if(isset($_GET['editid']))
{
	$sql="SELECT * FROM bikes WHERE ID='$_GET[editid]' ";
	$qsql = mysqli_query($connect,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>

<div class="container-fluid">
	<div class="block-header">
		<h2> Add Bikes </h2>
	</div>
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">

				<form method="post" action="" name="frmbikesprofile" onSubmit="return validateform()">


					<div class="body">
						<div class="row clearfix">
							<div class="col-sm-3 col-xs-12">
								<div class="form-group drop-custum">
									<label>Bike Model</label>
									<select class="form-control show-tick" name="selectModel">
										<?php    
											$modelQuery ="SELECT * FROM models";  
											$modelResult = mysqli_query($connect, $modelQuery); 
											while($row = mysqli_fetch_array($modelResult))  
											{  
												echo '  
													<option value ='.$row["ID"].'>'.$row["ID"].' - '.$row["model"].'</option>  
												';  
											}	
										?>                                        
									</select>
								</div>
							</div>          
						</div>
						<div class="row clearfix"> 
							<div class="col-sm-12">                              
								<div class="form-group">
									<label>Plate Number</label>
									<div class="form-line">
										<input type="text" class="form-control"  name="plate_no" id="plate_no" value="<?php echo $rsedit['plate_no']; ?>"/>
									</div>
								</div>
							</div>                          
						</div> 
						<div class="row clearfix">                            
							<div class="col-sm-3 col-xs-12">
								<div class="form-group drop-custum">
									<label>Status</label>

									<select class="form-control show-tick" name="selectStatus">
										<?php             
											$statusQuery ="SELECT * FROM bikes_status";  
											$statusResult = mysqli_query($connect, $statusQuery); 
											while($row = mysqli_fetch_array($statusResult))  
											{  
												echo '  
													<option value ='.$row["ID"].'>'.$row["ID"].' - '.$row["status"].'</option>  
												';  
											}								                        	
										?>                                        
									</select>
								</div>
							</div>                            
						</div>                    

						<div class="col-sm-12">
							<input type="submit" class="btn btn-raised g-bg-cyan" name="submit" id="submit" value="Submit" />

						</div>
					</div>


				</form>
			</div>
		</div>
	</div>
</div>

				<?php
				include("adFooter.php");
				?>
				<script type="application/javascript">
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform()
{
	else if(document.frmbikes.selectModel.value == "" )
	{
		alert("Kindly select the Model..");
		document.frmbikes.selectModel.focus();
		return false;
	}
	else if(document.frmbikes.plate_no.value == "")
	{
		alert("Plate Number should not be empty..");
		document.frmbikes.plate_no.focus();
		return false;
	}
	else if(document.frmbikes.selectStatus.value == "" )
	{
		alert("Kindly select the status..");
		document.frmbikes.selectStatus.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>