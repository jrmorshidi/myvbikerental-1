<?php
include("adFormHeader.php");
$root = "../";
include $root . 'db.php';
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE models SET model='$_POST[model]',product_code='$_POST[product_code]',brand='$_POST[brand]',year_of_production='$_POST[year]',engine_volume='$_POST[engine]',horsepower='$_POST[power]',fuel_consumption='$_POST[fuel]',price='$_POST[price]' WHERE ID='$_GET[editid]'";
		if($qsql = mysqli_query($connect,$sql))
		{
			echo "<div class='alert alert-success'>
			Model updated successfully
			</div>";
			echo"<script>window.location.href = 'viewModels.php';</script>";
		}
		else
		{
			echo mysqli_error($connect);
		}	
	}
}
if(isset($_GET['editid']))
{
	$sql="SELECT * FROM models WHERE ID='$_GET[editid]' ";
	$qsql = mysqli_query($connect,$sql);
	$rsedit = mysqli_fetch_array($qsql);	
}
?>

<div class="container-fluid">
	<div class="block-header">
		<h2> Edit Model </h2>
	</div>
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">

				<form method="post" action="" name="frmbikesprofile" onSubmit="return validateform()">


					<div class="body">
                        <div class="row clearfix"> 
							<div class="col-sm-12">                              
								<div class="form-group">
									<label>Model</label>
									<div class="form-line">
										<input type="text" class="form-control"  name="model" id="model" value="<?php echo $rsedit['model']; ?>"/>
									</div>
								</div>
							</div>                          
                        </div>    
                        <div class="row clearfix"> 
							<div class="col-sm-12">                              
								<div class="form-group">
									<label>Product Code</label>
									<div class="form-line">
										<input type="text" class="form-control"  name="product_code" id="product_code" value="<?php echo $rsedit['product_code']; ?>"/>
									</div>
								</div>
							</div>                          
                        </div>                                                                       
						<div class="row clearfix">
							<div class="col-sm-3 col-xs-12">
								<div class="form-group drop-custum">
									<label>Brand</label>
									<select class="form-control show-tick" name="selectModel">
										<?php    
											$brandQuery ="SELECT * FROM brands";  
											$brandResult = mysqli_query($connect, $brandQuery); 
											while($row = mysqli_fetch_array($brandResult))  
											{                                                                                               
                                                if($row["ID"] == $rsedit["brand"]){
                                                    echo '  
													<option value ='.$row["ID"].' selected>'.$row["ID"].' - '.$row["brand"].'</option>  
												';                                                      
                                                }
                                                else{
												    echo '<option value ='.$row["ID"].'>'.$row["ID"].' - '.$row["brand"].'</option>';  
                                                }
											}	
										?>                                        
									</select>
								</div>
							</div>          
						</div>
						<div class="row clearfix"> 
							<div class="col-sm-12">                              
								<div class="form-group">
									<label>Year of Production</label>
									<div class="form-line">
										<input type="number" min="1950" max="2021" class="form-control"  name="year" id="year" value="<?php echo $rsedit['year_of_production']; ?>"/>
									</div>
								</div>
							</div>                          
						</div> 
						<div class="row clearfix"> 
							<div class="col-sm-12">                              
								<div class="form-group">
									<label>Engine Volume</label>
									<div class="form-line">
										<input type="number" step="0.01" min = "0" class="form-control"  name="engine" id="engine" value="<?php echo $rsedit['engine_volume']; ?>"/>
									</div>
								</div>
							</div>                          
                        </div> 
						<div class="row clearfix"> 
							<div class="col-sm-12">                              
								<div class="form-group">
									<label>Horse Power</label>
									<div class="form-line">
										<input type="number" step="0.01" min = "0" class="form-control"  name="power" id="power" value="<?php echo $rsedit['horsepower']; ?>"/>
									</div>
								</div>
							</div>                          
                        </div>       
						<div class="row clearfix"> 
							<div class="col-sm-12">                              
								<div class="form-group">
									<label>Fuel Consumption</label>
									<div class="form-line">
										<input type="number" step="0.01" min = "0" class="form-control"  name="fuel" id="fuel" value="<?php echo $rsedit['fuel_consumption']; ?>"/>
									</div>
								</div>
							</div>                          
                        </div> 
						<div class="row clearfix"> 
							<div class="col-sm-12">                              
								<div class="form-group">
									<label>Price</label>
									<div class="form-line">
										<input type="number" step="0.01" min = "0" class="form-control"  name="price" id="price" value="<?php echo $rsedit['price']; ?>"/>
									</div>
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
	if(document.frmbikes.selectModel.value == "" )
	{
		alert("Kindly select the Model..");
		document.frmbikes.selectModel.focus();
		return false;
	}
	else if(document.frmbikes.model.value == "")
	{
		alert("Model should not be empty..");
		document.frmbikes.model.focus();
		return false;
	}
	else if(document.frmbikes.product_code.value == "" )
	{
		alert("Product code should not be empty..");
		document.frmbikes.product_code.focus();
		return false;
    }
	else if(document.frmbikes.brand.value == "" )
	{
		alert("Brand should not be empty..");
		document.frmbikes.brand.focus();
		return false;
    }
	else if(document.frmbikes.year.value == "" )
	{
		alert("Year of production should not be empty..");
		document.frmbikes.year.focus();
		return false;
    }
	else if(document.frmbikes.engine.value == "" )
	{
		alert("Engine volume should not be empty..");
		document.frmbikes.engine.focus();
		return false;
    }       
	else if(document.frmbikes.power.value == "" )
	{
		alert("Horsepower should not be empty..");
		document.frmbikes.power.focus();
		return false;
    }   
	else if(document.frmbikes.fuel.value == "" )
	{
		alert("Fuel consumption should not be empty..");
		document.frmbikes.fuel.focus();
		return false;
    }   
	else if(document.frmbikes.price.value == "" )
	{
		alert("Price should not be empty..");
		document.frmbikes.price.focus();
		return false;
	}                    
	else
	{
		return true;
	}
}
</script>