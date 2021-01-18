<?php
session_start();

?>
<?php
include_once("db.php");                                     
$result='';
if (isset($_POST['add']))                                   
{
if(!isset($_SESSION['userID']))
{
	echo '<script type="text/javascript">alert("You have to sign in to make reservation")</script>';
}
else{
	$userID  = $_SESSION['userID'];
	$bikeID  = strip_tags(trim($_POST['bike']));
    $startDate  = strip_tags(trim($_POST['startDate']));
    $endtDate  = strip_tags(trim($_POST['endDate']));
	$startTime	= strip_tags(trim($_POST['startTime']));
    $endTime    = strip_tags(trim($_POST['endTime']));
	//$totalPrice	= strip_tags(trim($_POST['totalPrice']));
    $comments    = strip_tags(trim($_POST['Coments']));

	$sql = "INSERT INTO reservations(userID,bikeID,startDate,endDate,startTime,endTime,totalPrice,Comments, status) 
                VALUES ('$userID','$bikeID','$startDate','$endtDate','$startTime','$endTime','90','$comments', '3')";
	$qsql = mysqli_query($connect,$sql);
	  
    
    $result='<div class="alert alert-success"><h3><span class="glyphicon glyphicon-ok"></span> Order complete!</h3><h4>We will get in touch with you soon.</h4></div>';
}}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>MY V Bike Rental</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="Bike rental" content="Booking page">
	<!-- css -->
	<link rel="stylesheet" type="text/css" href="reservation.css">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


	<!-- JQuery and JQuery UI -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>




	<!--<iframe src="http://free.timeanddate.com/clock/i5fpvar2/n1446/tct/pct/ftb/tt0/tw0/tm1/ts1/tb4" frameborder="0" width="90" height="34" allowTransparency="true"></iframe>-->
	<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

	<!--[if lt IE 9]>
			<script type="text/javascript">alert("Your browser does not support the canvas tag.");</script>
			<![endif]-->
	<script src="processing.js" type="text/javascript"></script>
	<script type="text/javascript">
		// convenience function to get the id attribute of generated sketch html element
		function getProcessingSketchId() {
			return 'sketch_grid';
		}
	</script>
</head>

<body>
	<header>

		<div id="content">
			<canvas id="sketch_grid" data-processing-sources="Sketch_for_Site.pde"></canvas>
		</div>

		<ul class="logoName" id="Name">
			<img src="imForSite/logo.png" alt="MY V Bike Rental logo">
		</ul>

		<a name="top"></a>

		<ul class="topnav" id="myTopnav">
			<li><a href="" class="closebtn">&times;</a></li>
			<li><a href="index.html" id="home"><strong>Home</strong></a></li>
			<li><a href="price.html" id="price"><strong>Prices</strong></a></li>
			<li><a class="active" href="reservation.php" id="reservation"><strong>Rent</strong></a></li>
			<li><a href="contact.php" id="contacts"><strong>Contact</strong></a></li>
		</ul>

		<a href="" class="toggle">
			<img src="imForSite/glyphicons-114-justify.png" alt="glyphicon menu">
		</a>


	</header>

	<section class="main">
		<div class="container-fluid text-center">
			<div class="col-sm-2 left">
				<a href="#top" class="goUpButton">
					<p><span class="glyphicon glyphicon-menu-up"></span> </p>
					<p><span class="glyphicon glyphicon-menu-up"></span> </p>
				</a>

				<div id="socialRowSide">
					<ul id="socialMediaSide">
						<li id="facebookSide">
							<a href="url">
								<img src="imForSite/facebook.png" alt="facebook logo">
							</a>
						</li>
						<li id="googleSide"><a href="url">
								<img src="imForSite/google-logo.png" alt="google logo">
							</a>
						</li>
						<li id="linkedinSide"><a href="https://www.linkedin.com/in/maksymsavin/">
								<img src="imForSite/linkedin-logo.png" alt="linkedin logo">
							</a>
						</li>
						<li id="skypeSide"><a href="url">
								<img src="imForSite/skype-logo.png" alt="skype logo">
							</a>
						</li>
						<li id="whatsappSide"><a href="url">
								<img src="imForSite/whatsapp-logo.png" alt="whatsapp logo">
							</a>
						</li>
						<li id="twitterSide"><a href="url">
								<img src="imForSite/twitter-logo.png" alt="twitter logo">
							</a>
						</li>
					</ul>
				</div>
			</div>



			<div class="col-sm-8 text-left">
				<?php
				include 'forecastData.php';
				?>
				<h3>Please fill in this form</h3>

				<form method="post" action="reservation.php">

					<div class="row selection">
						<div class="col-sm-3 selector">
							<!--By default, the first item in the drop-down list is selected.
								To define a pre-selected option, add the selected attribute to 
								the option:-->
							<label for="bike_id">Choose a bike</label>
							<select class="form-control" id="bike_id" name="bike">
								<?php

								$query = "SELECT * FROM `bikes`";
								$result1 = mysqli_query($connect, $query);
								while ($row1 = mysqli_fetch_array($result1)) :; ?>

									<option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>

								<?php endwhile; ?>

							</select>
						</div>

						<div class="col-sm-9 dates">
							<div class="col-sm-4" id="pick-up-date">
								<label for="date-input" class="col-sm-3 col-form-label">Pick up date</label>
								<input class="form-control" type="text" name="startDate" id="setDatePick">
								<!--!!!!!!1��������� ������� ���������� ���!!!-->
							</div>

							<div class="col-sm-1">
							</div>


							<div class="col-sm-4" id="pick-up-time">
								<label for="time-input" class="col-sm-4 col-form-label">Time</label>

								<input class="form-control" type="time" name="startTime" id="setTimePick">

							</div>
						</div>

					</div>



					<div class="row selection">
						<div class="col-sm-3">
						</div>

						<div class="col-sm-9 dates">
							<div class="col-sm-4" id="drop-off-date">
								<label for="date-input" class="col-sm-3 col-form-label">Drop off date</label>
								<input class="form-control" type="text" name="endDate" id="setDateDrop">
							</div>

							<div class="col-sm-1">
							</div>


							<div class="col-sm-4" id="drop-off-time">
								<label for="example-time-input" class="col-sm-4 col-form-label">Time</label>
								<input class="form-control" type="time" name="endTime" id="setTimeDrop">
							</div>

						</div>
					</div>

					<script>
						$('#setDatePick').datepicker({
							minDate: 0
						});
						$('#setDateDrop').datepicker({
							minDate: 0
						});

						$('#setDateDrop').change(function() {
							var diff = $('#setDatePick').datepicker("getDate") - $('#setDateDrop').datepicker("getDate");
							$('#diff').text(diff / (1000 * 60 * 60 * 24) * -1 + 1);
						});
					</script>

					<div class="row" id="pricing">
						<div class="col-sm-9" id="invisible">
						</div>

						<div class="col-sm-3">
							<label class="col-sm-12">
								<h4>Total Day(s)</h4>
							</label>
							<div class="col-sm-12 price">
								<h4 id='diff'></h4>
							</div>
						</div>
					</div>

					<!-- <label class="col-sm-12"><h4>bike_id_text</h4></label>
							<div class="col-sm-12 price"> 
								<h4 id='bike_id_text'></h4>
							</div> -->

					<div id="result"></div>

					<script>

						// $('#bike_id_text').text($('#bike_id').val());
						// $('#bike_id').change(function () {
						// 	$('#bike_id_text').text($('#bike_id').val());
						// });

						var bikeID = $('#bike_id').val();
						var diff = $('#diff').val();
						$('#bike_id').change(function () {
							var bikeID = $('#bike_id').val();
							$.ajax({
								url: 'reservationPrice.php',
								type: 'POST',
								data: {var1: bikeID, var2: diff},
								success: function(data) {
									console.log("success");
									$('#price_per_unit').html(data);
								}
							});
						});

						$.ajax({
							url: 'reservationPrice.php',
							type: 'POST',
							data: {var1: bikeID, var2: diff},
							success: function(data) {
								console.log("success");
								$('#price_per_unit').html(data);
							}
						});

					</script>


					<div class="row" id="pricing">
						<div class="col-sm-9" id="invisible">
						</div>
						
						<div class="col-sm-3" 	>						
							<label class="col-sm-12"><h4>Price Per Unit (RM)</h4></label>
							<div class="col-sm-12 price"> 
								<h4 id='price_per_unit'></h4>
							</div>
						</div>
					</div>

					<script>
						

						$('body').on('DOMSubtreeModified', '#diff', function(){
							console.log('changed');
							
							var diff = $('#setDatePick').datepicker("getDate") - $('#setDateDrop').datepicker("getDate");
							var diff2 = diff / (1000 * 60 * 60 * 24) * -1 + 1;
							console.log(diff2);

							var target = document.querySelector('#price_per_unit')
							// create an observer instance
							var observer = new MutationObserver(function(mutations) {
								console.log(target.innerText);   
							});
							
							var price_per_unit = $('#price_per_unit').html(data);
							console.log(price_per_unit);

							var total_price = diff2 * price_per_unit;
							$('#total_price').text(total_price);

							
						});
						
						
						





					</script>

					<div class="row" id="pricing">
						<div class="col-sm-9" id="invisible">
						</div>
						
						<div class="col-sm-3" 	>						
							<label class="col-sm-12"><h4>Total Price (RM)</h4></label>
							<div class="col-sm-12 price"> 
								<h4 id='total_price'></h4>
							</div>
						</div>
					</div>


					<div class="row col-sm-12 comment">	
						<div class="row" id="comment">
							<label for="message" class="col-sm-12 col-form-label" id="message"> Comments</label>
							<div class="col-sm-12" id="messageZone">
								<textarea class="form-control"  name="Coments" ></textarea>
							</div>
						</div>
					</div>

					<?php
						echo $result;
					?>


					<div class="col-sm-12 checkbox">

						<input type="checkbox" id="c1" name="cc" />
						<label for="c1"><span></span><a id="contract">I accept the conditions.</a></label>
					</div>




					<!-- The Modal -->
					<div id="myModal" class="modal">

						<!-- Modal content -->
						<div class="modal-content">

							<div class="modal-header">
								<span class="close">?</span>
								<h2><strong>Contract</strong></h2>
							</div>
							<div class="modal-body">
								<p><strong>General terms</strong></p>
								<p>1) Scope:</p>
								<p>MY V Bike Rental is a commercial trademark propriety of MY V Bike Rental,
									from now on MY V Bike Rental , with address in </p>
								<p>MY V Bike Rental, acts as a go-between for you as a rent-a-bike company and the final customer,
									according to the general conditions of contract and other appendixes, described in the documentation
									given to the provider. </p>

								<p>The terms and contracting general conditions described in MY V Bike Rental, as they are of a g
									eneral nature and are complementary with the leaseholder�s terms and conditions and subjected to
									any changes in the legislation of the country concern. MY V Bike Rental offers its clients and members
									an offer of contract and reserve of renting motorbikes by means of on-line booking through which the
									leaseholders offer their motorbikes with prices and availabilities.</p>


								<p>When formalizing a reservation or buying any service through MY V Bike Rental.com you come into a direct
									contract with MY V Bike Rental customers. From the moment the reservation is formalized, we act as mediators
									between you and the customers giving them your details and sending them a confirmation e-mail, according to
									the details provided by you as a provider in our intranet system.</p>

								<p>Read carefully the exclusions, limitations and responsibilities of MY V Bike Rental.</p>


								<p>2) Contract terms agreement:</p>

								<p>Your reservation is subject to your agreement of our contract terms, our privacy policy and our destiny
									leaseholder�s contract terms. If you don�t agree with our contract terms or have further questions about the
									terms, please contact our customer care department.</p>

								<p>3) Limited availability vehicles or under confirmation:</p>

								<p>MY V Bike Rental, works to offer the same bike model and make asked for in the chosen time and the location,
									although some models, due to their limited availability may not be available at the moment of booking. For limited
									availability bike models, you will receive a confirmation email up to 3 workdays from the moment of reservation.
									In case of no availability of the brand or model required, MY V Bike Rental will facility you a motorbike inside
									the same category, in case that the category will be a lower category than the client have chosen, will be solved
									with a proportional refund of the difference between both categories. </p>

								<p>Important note: remember that your pre-reserve is not valid until it has been sent as �starter voucher� and
									up to 72 hours from the moment of transaction.</p>

								<p>4) Lack of precision or information mistakes:</p>

								<p>MY V Bike Rental periodically reviews its business supplier�s information quality and reliability, although accurate
									information related to prices, availability and rent particular conditions, are the leaseholder�s responsibility. That
									keep their information updated trough an intranet connected to our website, therefore MY V Bike Rental can�t guarantee
									that all the information will be complete and exact. We are also not responsible about typographic mistakes or temporary
									server failures, maintenance, repairing tasks or updating of our website or other reasons.</p>
							</div>
							<div class="modal-footer">
								<p> this contract was taken from "http://www.rentalmotorbike.com/datos/datos" as a reference material for university project</p>
							</div>
						</div>

					</div>

					<div class="col-sm-12 submit">
						<div id="sendButton">
							<button type="submit" id="submit" name="add">Place order</button>
						</div>

					</div>

				</form>

				<div class="col-sm-2">
				</div>
			</div>
		</div>
	</section>

	<footer class="container-fluid" id="foot">

		<div class="col-sm-2">
		</div>
		<div class="col-sm-8 about">
			<div class="col-sm-4" id="siteMap">
				<h4><strong>Site map</strong></h4>
				<h5><a href="index.html">Home</a></h5>
				<h5><a href="price.html">Price list</a></h5>
				<h5><a href="reservation.html">Book a bike</a></h5>
				<h5><a href="contact.php">Contact</a></h5>
			</div>
			<div class="col-sm-4 " id="brands">
				<h4><strong>Partners</strong></h4>
				<h5><a id="Honda" href="http://powersports.honda.com/" target="_blank">Honda</a></h5>
				<h5><a id="Kawasaki" href="https://www.kawasaki.com/" target="_blank">Kawasaki</a></h5>
				<h5><a id="Suzuki" href="http://www.suzuki-moto.com/" target="_blank">Suzuki</a></h5>
				<h5><a id="Yamaha" href="https://www.yamahamotorsports.com/motorcycle" target="_blank">Yamaha</a></h5>
			</div>

			<div class="col-sm-4" id="contactInfo">
				<h4><strong>MY V Bike Rental</strong></h4>
				<h5><strong>Address:</strong> 20-250, I.Daszynskiego, 3a,</h5>
				<h5>Lublin, Poland</h5>
				<h5><strong>Business Hours:</strong> 10am-7pm Mon-Sat</h5>
				<h5>12pm-6pm Sun </h5>
				<h5><strong>E-mail:</strong> myvbikes@gmail.com</h5>
				<h5><strong>Tel:</strong> +12345678</h5>


			</div>
		</div>
		<div class="col-sm-2">
		</div>

		<div id="socialRow">
			<ul id="socialMedia">
				<li id="facebook">
					<a href="url">
						<img src="imForSite/facebook.png" alt="facebook logo">
					</a>
				</li>
				<li id="google"><a href="url">
						<img src="imForSite/google-logo.png" alt="google logo">
					</a>
				</li>
				<li id="linkedin"><a href="https://www.linkedin.com/in/maksymsavin/">
						<img src="imForSite/linkedin-logo.png" alt="linkedin logo">
					</a>
				</li>
				<li id="skype"><a href="url">
						<img src="imForSite/skype-logo.png" alt="skype logo">
					</a>
				</li>
				<li id="whatsapp"><a href="url">
						<img src="imForSite/whatsapp-logo.png" alt="whatsapp logo">
					</a>
				</li>
				<li id="twitter"><a href="url">
						<img src="imForSite/twitter-logo.png" alt="twitter logo">
					</a>
				</li>

			</ul>
		</div>
		<div id="rights">
			<h5>MY V Bike Rental &copy; 2016</h5>
			<a href="http://pydega.com/">
				<h5>Press this link to contact me.</h5>
			</a>
		</div>
	</footer>


	<!-- <script type='text/javascript' src='animation.js'></script>
				
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
			<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>  -->
</body>

</html>