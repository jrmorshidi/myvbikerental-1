<?php
$subtitle = 'Rent';
$nav = "bike";
$root = "../";
include $root . 'header.php';

include $root . 'db.php';

$sql_types = "SELECT DISTINCT 
models_types.type AS type
FROM models 
INNER JOIN brands ON models.brand = brands.id
INNER JOIN models_types ON models.type = models_types.id";

$sql_brands = "SELECT DISTINCT 
brands.brand AS brand
FROM models 
INNER JOIN brands ON models.brand = brands.id
INNER JOIN models_types ON models.type = models_types.id";

$sql_models = "SELECT 
models.model AS model, 
models_types.type AS types, 
brands.brand AS brand, 
models.product_code AS product_code, 
models.price AS price,
models.img AS img
FROM models 
INNER JOIN brands ON models.brand = brands.id
INNER JOIN models_types ON models.type = models_types.id";

$sql_models_count = "SELECT 
MIN(models.price) AS price_min,
MAX(models.price) AS price_max,
COUNT(models.ID) AS max_entity
FROM models 
INNER JOIN brands ON models.brand = brands.id
INNER JOIN models_types ON models.type = models_types.id";

$filter_sql_models = '';
$search = $sort = $type = $brand = $model = null;
$price_min = $price_max = $max_entity = 0;
if (isset($_GET['search'])) {
	$search = $_GET['search'];
	$filter_sql_models .= " WHERE models.model LIKE '%$search%' OR brands.brand LIKE '%$search%'";
}

if (isset($_GET['type'])) {
	$type = $_GET['type'];
	$_list = '';
	$count = count($type);
	if ($count >  0) {
		if ($count === 1) {
			$filter_sql_models .= " WHERE models_types.type = '$type[0]'";
		} else {
			$i = 0;
			foreach ($type as $t) {
				$_list .= "'$t'";
				if (++$i != $count) {
					$_list .= ',';
				}
			}
			$filter_sql_models .= " WHERE models_types.type IN ($_list)";
		}
	}
}

if (isset($_GET['brand'])) {
	$brand = $_GET['brand'];
	$_list = '';
	$count = count($brand);
	if ($count >  0) {
		if ($count === 1) {
			$filter_sql_models .= " WHERE brands.brand = '$brand[0]'";
		} else {
			$i = 0;
			foreach ($brand as $b) {
				$_list .= "'$b'";
				if (++$i != $count) {
					$_list .= ',';
				}
			}
			$filter_sql_models .= " WHERE brands.brand IN ($_list)";
		}
	}
}

if (isset($_GET['model'])) {
	$model = $_GET['model'];
	$_list = '';
	$count = count($model);
	if ($count >  0) {
		if ($count === 1) {
			$filter_sql_models .= " WHERE models.model = '$model[0]'";
		} else {
			$i = 0;
			foreach ($model as $m) {
				$_list .= "'$m'";
				if (++$i != $count) {
					$_list .= ',';
				}
			}
			$filter_sql_models .= " WHERE models.model IN ($_list)";
		}
	}
}

$result_types = $connect->query($sql_types . $filter_sql_models . ' ORDER BY models_types.type');
$result_brands = $connect->query($sql_brands . $filter_sql_models . ' ORDER BY brands.brand');
$result_models_list = $connect->query($sql_models . $filter_sql_models . ' ORDER BY brands.brand');
$result_models_count = $connect->query($sql_models_count . $filter_sql_models);

if (!empty($result_models_count) && $result_models_count->num_rows > 0) {
	$row = $result_models_count->fetch_assoc();
	$price_max = $row['price_max'];
	$price_min = $row['price_min'];
	$max_entity = $row['max_entity'];
}

if (isset($_GET['sort'])) {
	$sort = $_GET['sort'];
	if ($sort == 'price_asc') {
		$filter_sql_models .= " ORDER BY models.price";
	} else if ($sort == 'price_des') {
		$filter_sql_models .= " ORDER BY models.price DESC";
	} else if ($sort == 'name_asc') {
		$filter_sql_models .= " ORDER BY brands.brand, models.model";
	} else if ($sort == 'name_des') {
		$filter_sql_models .= " ORDER BY brands.brand DESC, models.model DESC";
	}
} else {
	$filter_sql_models .= " ORDER BY models.year_of_production DESC";
}

$page = $max_page = 1;
if (isset($_GET['page'])) {
	$page = $_GET['page'];
}

$entity = 2;
$start = ($page - 1) * $entity;
$result_models = $connect->query($sql_models . $filter_sql_models . " LIMIT $start,$entity");

?>

<link rel="stylesheet" type="text/css" href="<?php echo $root ?>assets/css/form.css">

<body>
	<?php include $root . 'navbar.php' ?>
	<section>
		<?php include $root . 'sidenavigation.php' ?>
		<div class="container my-4">
			<div class="row">
				<div class="col-lg-auto pl-0">
					<form onsubmit="disableEmptyInput(this)">
						<div class="content-nav sub-content">
							<div class="content-nav-section">
								<div class="content-nav-field">
									<input type="text" class="custom-form-control" name="search" placeholder="Search">
								</div>
							</div>
							<div class="content-nav-section">
								<div class="content-nav-title">Types</div>
								<div class="content-nav-list">
									<?php
									if (!empty($result_types) && $result_types->num_rows > 0) {
										// output data of each row
										while ($row = $result_types->fetch_assoc()) {
									?>
											<div class="custom-control custom-checkbox custom-checkbox-sunshine">
												<input type="checkbox" class="custom-control-input custom-control-input-sunshine" id="<?php echo $row['type'] ?>" name="type[]" value="<?php echo $row['type'] ?>" <?php if ($type && in_array($row['type'], $type)) {
																																																						echo 'checked';
																																																					} ?>>
												<label class="custom-control-label" for="<?php echo $row['type'] ?>"><?php echo $row['type'] ?></label>
											</div>
									<?php }
									} ?>
								</div>
							</div>
							<div class="content-nav-section">
								<div class="content-nav-title">Brands</div>
								<div class="content-nav-list">
									<?php
									if (!empty($result_brands) && $result_brands->num_rows > 0) {
										// output data of each row
										while ($row = $result_brands->fetch_assoc()) {
									?>
											<div class="custom-control custom-checkbox custom-checkbox-sunshine">
												<input type="checkbox" class="custom-control-input custom-control-input-sunshine" id="<?php echo $row['brand'] ?>" name="brand[]" value="<?php echo $row['brand'] ?>" <?php if ($brand && in_array($row['brand'], $brand)) {
																																																							echo 'checked';
																																																						} ?>>
												<label class="custom-control-label" for="<?php echo $row['brand'] ?>"><?php echo $row['brand'] ?></label>
											</div>
									<?php }
									} ?>
								</div>
							</div>
							<div class="content-nav-section">
								<div class="content-nav-title">Models</div>
								<div class="content-nav-list">
									<?php
									if (!empty($result_models_list) && $result_models_list->num_rows > 0) {
										// output data of each row
										while ($row = $result_models_list->fetch_assoc()) {
									?>
											<div class="custom-control custom-checkbox custom-checkbox-sunshine">
												<input type="checkbox" class="custom-control-input custom-control-input-sunshine" id="<?php echo $row['model'] ?>" name="model[]" value="<?php echo $row['model'] ?>" <?php if ($model && in_array($row['model'], $model)) {
																																																							echo 'checked';
																																																						} ?>>
												<label class="custom-control-label" for="<?php echo $row['model'] ?>"><?php echo $row['model'] ?></label>
											</div>
									<?php }
									} ?>
								</div>
							</div>
							<div class="content-nav-section">
								<div class="content-nav-title">Price Range</div>
								<div class="content-nav-field">
									<div class="row mb-3">
										<div class="col pl-0"><input type="number" step=".01" class="custom-form-control" name="min_price" placeholder="RM MIN" min='<?php echo $price_min ?>' max='<?php echo $price_max ?>' value="<?php echo $price_min ?>"></div>
										<div id="price-divider" class="col-auto px-0">-</div>
										<div class="col pr-0"><input type="number" step=".01" class="custom-form-control" name="max_price" placeholder="RM MAX" max='<?php echo $price_max ?>' value="<?php echo $price_max ?>"></div>
									</div>
									<div>
										<button type="submit" class="btn btn-warning w-100">APPLY</button>
									</div>
								</div>
							</div>
							<?php if (isset($_GET['search']) || isset($_GET['brand']) || isset($_GET['model']) || isset($_GET['type'])) { ?>
								<div class="content-nav-section">
									<a href="?" class="btn btn-warning w-100">CLEAR ALL</a>
								</div>
							<?php } ?>
						</div>
					</form>
				</div>
				<div class="col-lg pr-0">
					<div class="sub-content">
						<?php if ($search) { ?>
							<div class="row mb-4 search-result">
								<div>SEARCH RESULTS FOR '<?php echo $search ?>' </div>
							</div>
						<?php } ?>
						<div class="content-header d-flex justify-content-between">
							<div class="form-group row">
								<label for="colFormLabel" class="col-sm-auto col-form-label pl-0">Sort By</label>
								<div class="col-sm">
									<select id="sort" class="custom-form-control custom-form-select mr-sm-2" name="sort">
										<option value="">New arrivals</option>
										<option value="name_asc" <?php if ($sort == 'name_asc') {
																		echo 'selected';
																	} ?>>Name: Low to high</option>
										<option value="name_des" <?php if ($sort == 'name_des') {
																		echo 'selected';
																	} ?>>Name: High to low</option>
										<option value="price_asc" <?php if ($sort == 'price_asc') {
																		echo 'selected';
																	} ?>>Price: Low to high</option>
										<option value="price_des" <?php if ($sort == 'price_des') {
																		echo 'selected';
																	} ?>>Price: High to low</option>
									</select>
								</div>
							</div>
							<?php
							if ($max_entity > 0) {
							?>
							<div class="row">
								<nav aria-label="Page navigation">
									<ul class="pagination pagination-sm justify-content-end">
										<li class="page-item<?php if ($page === '1') {
																echo ' disabled';
															} ?>">
											<a class="page-link" href="javascript:void(0);" tabindex="-1" aria-disabled="true"><<</a>
										</li>
										<?php
										$max_page = round($max_entity / $entity, 0, PHP_ROUND_HALF_UP);
										for ($i = 1; $i < $max_page + 1; $i++) {
										?>
											<li class="page-item<?php if ($page === "$i") {
																							echo ' active';
																						} ?>"><a class="page-link" href="javascript:void(0);"><?php echo $i; ?></a></li>
										<?php } ?>
										<li class="page-item<?php if ($page == $max_page) {
																echo ' disabled';
															} ?>">
											<a class="page-link" href="javascript:void(0);">>></a>
										</li>
									</ul>
								</nav>
							</div>
							<?php } ?>
						</div>
						<?php
						if (!empty($result_models) && $result_models->num_rows > 0) {
						?>
							<div class="content-body list-item-row">
								<?php while ($row = $result_models->fetch_assoc()) { ?>
									<div class="list-item-col">
										<a href="<?php echo $root ?>rent/reservation.php?bike=<?php echo $row['product_code']; ?>">
											<div class="list-item-img">
												<img src="<?php echo $root ?>assets/img/motorbike/<?php echo $row['img']; ?>">
											</div>
											<div class="list-item-title"><?php echo $row['brand'] . ' ' . $row['model']; ?></div>
											<div class="list-item-price">RM <?php echo $row['price']; ?></div>
										</a>
									</div>
								<?php } ?>
							</div>
						<?php } else {
							echo 'No results found';
						} ?>

						<div class="content-header d-flex justify-content-between">
							<div class="form-group row">Showing <?php
							# start index
							if ($page === 1) { # first page
								echo 1;
							} else if ($max_entity > 0) { # has entities
								echo ($page - 1) * $entity + 1;
							} else {
								echo 0;
							} ?> to <?php 
							# last index
							if ($page * $entity < $max_entity) { # last page
								echo ($page * $entity);
							} else {
								echo $max_entity;
							} ?> of <?php echo $max_entity; ?> entries</div>
							<?php
							if ($max_entity > 0) {
							?>
								<div class="row">
									<nav aria-label="Page navigation">
										<ul class="pagination pagination-sm justify-content-end">
											<li class="page-item<?php if ($page === '1') {
																	echo ' disabled';
																} ?>">
												<a class="page-link" href="javascript:void(0);" tabindex="-1" aria-disabled="true"><<</a>
											</li>
											<?php
											$max_page = round($max_entity / $entity, 0, PHP_ROUND_HALF_UP);
											for ($i = 1; $i < $max_page + 1; $i++) {
											?>
												<li class="page-item<?php if ($page === "$i") {
																								echo ' active';
																							} ?>"><a class="page-link" href="javascript:void(0);"><?php echo $i; ?></a></li>
											<?php } ?>
											<li class="page-item<?php if ($page == $max_page) {
																	echo ' disabled';
																} ?>">
												<a class="page-link" href="javascript:void(0);">>></a>
											</li>
										</ul>
									</nav>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script>
		$("#sort").change(function() {
			var val = $(this).val();
			url = window.location.href;
			var url = new URL(url);
			if (val == '') {
				url.searchParams.delete('sort');
			} else {
				url.searchParams.set('sort', val);
			}
			window.location = url;
		});

		$(".page-link").click(function() {
			var val = $(this).text();
			if (val === '>>') {
				val = <?php echo $max_page; ?>;
			} else if (val === '<<') {
				val = 1;
			}
			url = window.location.href;
			var url = new URL(url);
			if (val == '') {
				url.searchParams.delete('page');
			} else {
				url.searchParams.set('page', val);
			}
			window.location = url;
		});

		function disableEmptyInput(form) {
			$(form).find(":input").filter(function() {
				return !this.value;
			}).attr("disabled", "disabled");
			return true;
		}
	</script>

	<?php include $root . 'footer.html' ?>
</body>

</html>