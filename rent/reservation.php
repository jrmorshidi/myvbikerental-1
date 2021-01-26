<?php
$root = "../";
$subtitle = 'Reservation';
$nav = "rent";
include $root . 'header.php';

session_start();

include_once($root . "db.php");

$result = '';
$bike = null;
if (isset($_GET['bike']) && $_GET['bike'] != '') {
	$sql_models = "SELECT 
	models.ID AS id,
	models.model AS model,
	brands.brand AS brand, 
	models.product_code AS product_code,
	models.year_of_production AS year_of_production, 
	models.engine_volume AS engine_volume, 
	models.horsepower AS horsepower, 
	models.fuel_consumption AS fuel_consumption, 
	models.price AS price, 
	models.img AS img 
	FROM models 
	INNER JOIN brands ON models.brand = brands.id 
	WHERE models.product_code='$_GET[bike]'";
	

	$result_models = $connect->query($sql_models);
	$bike = $result_models->fetch_assoc();
	if (!$bike) {
		header('Location: ' . $root . 'rent');
	}

    $_SESSION['bikeID']     = $bike['id'];
    $_SESSION['bikePrice']  = $bike['price'];
    $_SESSION['bikeName']   = $bike['brand'] . " " . $bike['model'];
    $_SESSION['bikeImg']    = $bike['img'];


	$sql_available = "SELECT COUNT(id) AS count FROM bikes
	WHERE model='$bike[id]' AND status=1";
	$result_available = $connect->query($sql_available);
	$available = $result_available->fetch_assoc();
}
?>

<link rel="stylesheet" type="text/css" href="<?php echo $root ?>assets/css/form.css">

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<script>
	if (window.history.replaceState) {
		window.history.replaceState(null, null, window.location.href);
	}
</script>

<body>
	<?php include $root . 'navbar.php' ?>
	<section>
		<div class="container">
			<div class="main content-border">
				<div class="forecast">
					<?php include $root . 'forecast.php'; ?>
				</div>
			</div>
		</div>

		<?php include $root . 'sidenavigation.php' ?>
		<div class="container">
			<div class="main content-border">
				<form class="form-horizontal sub-content" method="post" action="<?php echo $root ?>rent/reserve.php">
					<div class="row">
						<div class="col-6 pl-0 form-group">
							<div class="img">
								<img src="<?php echo $root ?>assets/img/motorbike/<?php echo $bike['img']; ?>" class="w-100">
							</div>
							<div class="accordion" id="accordion">
								<div class="card">
									<div class="card-header" id="heading-overview">
										<h2 class="mb-0">
											<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-overview" aria-expanded="false" aria-controls="collapse-overview">Overview</button>
										</h2>
									</div>
									<div id="collapse-overview" class="collapse" aria-labelledby="heading-overview" data-parent="#accordion">
										<div class="card-body">
											<div id="detail">
												<div class="detail-row row">
													<div class="detail-label col-5 pl-0">Brand</div>
													<div class="detail-value col pr-0"><?php echo $bike['brand'] ?></div>
												</div>
												<div class="detail-row row">
													<div class="detail-label col-5 pl-0">Product Code</div>
													<div class="detail-value col pr-0"><?php echo $bike['product_code'] ?></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="heading-description">
										<h2 class="mb-0">
											<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-description" aria-expanded="true" aria-controls="description">Description</button>
										</h2>
									</div>
									<div id="collapse-description" class="collapse" aria-labelledby="heading-description" data-parent="#accordion">
										<div class="card-body">
											<div id="detail">
												<div class="detail-row row">
													<div class="detail-label col-5 pl-0">Year of Production</div>
													<div class="detail-value col pr-0"><?php echo $bike['year_of_production'] ?></div>
												</div>
												<div class="detail-row row">
													<div class="detail-label col-5 pl-0">Engine</div>
													<div class="detail-value col pr-0"><?php echo $bike['engine_volume'] ?> cc</div>
												</div>
												<div class="detail-row row">
													<div class="detail-label col-5 pl-0">Power</div>
													<div class="detail-value col pr-0"><?php echo $bike['horsepower'] ?> hp</div>
												</div>
												<div class="detail-row row">
													<div class="detail-label col-5 pl-0">Fuel Consumption</div>
													<div class="detail-value col pr-0"><?php echo $bike['fuel_consumption'] ?> L</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col pr-0 ">
							<div class="h2 mb-3"><?php echo $bike['brand'] . ' ' .  $bike['model'] ?></div>
							<div class="h2 mb-5">RM <?php echo $bike['price'] ?></div>
							<div id="detail" class="mb-5">
								<div class="detail-row row">
									<div class="detail-label col-5 pl-0">Availability</div>
									<div class="detail-value col pr-0">
										<?php
										if ($available['count'] > 0) {
											echo 'in stock';
										} else {
											echo 'out of stock';
										} ?>
									</div>
								</div>
							</div>
							<?php
								if ($available['count'] > 0) {
									echo '
								
									<div id="pick-up" class="mb-3">
										<label for="date-input" class="control-label">Pick up Date/Time</label>
										<div class="row">
											<div class="col pl-0" id="pick-up-date">
												<input class="custom-form-control" type="text" name="startDate" id="setDatePick">
											</div>
											<div class="col-4 pr-0" id="pick-up-time">
												<input class="custom-form-control" type="time" name="startTime" id="setTimePick">
											</div>
										</div>
									</div>
									<div id="drop-off" class="mb-3">
										<label for="date-input" class="control-label">Drop off Date/Time</label>
										<div class="row">
											<div class="col pl-0" id="drop-off-date">
												<input class="custom-form-control" type="text" name="endDate" id="setDateDrop">
											</div>
											<div class="col-4 pr-0" id="drop-off-time">
												<input class="custom-form-control" type="time" name="endTime" id="setTimeDrop">
											</div>
										</div>
									</div>
									<div id="message" class="my-3">
										<label for="message" class="control-label" id="message"> Message</label>
										<textarea class="custom-form-control custom-textarea" name="Coments" rows="3" cols="50" style="resize: none;"></textarea>
									</div>';

									include $root . 't&c.html';

									echo'<div class="form-group mt-4">
										<div id="sendButton">
											<button type="submit" id="submit" class="btn btn-warning" name="reserve">Place order</button>
										</div>';
								}
							?>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
	<?php include $root . 'footer.html' ?>
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
</body>

</html>