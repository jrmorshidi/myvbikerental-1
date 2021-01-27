<?php
$root = "../";
include $root . 'db.php';

session_start();
error_reporting(0);
$dt = date("Y-m-d");
$tim = date("H:i:s");

if (isset($_SESSION['userID'])) {
	if (isset($_GET['next']) && $_GET['next'] == 'payment'){
		header('Location: ' . $root . 'rent/payment.php');
	} else {
		header('Location: ' . $root . 'account/userAccount.php');
	}
}
else if (isset($_SESSION['adminID'])){
	include 'logout.php';
}
?>
<!-- header section -->
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>MY V Bike Rental - User Login</title>
	<link href="<?php echo $root ?>assets/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="icon" href="favicon.ico" type="image/x-icon">	
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
	<!-- Custom Css -->
	<link href="<?php echo $root ?>assets/css/main.css" rel="stylesheet">
	<link href="<?php echo $root ?>assets/css/login.css" rel="stylesheet">

	<!-- Swift Themes. You can choose a theme from css/themes instead of get all themes -->
	<link href="<?php echo $root ?>assets/css/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-deep-orange login-page authentication">
	<!-- header section -->
	<?php
	if (isset($_POST['submit'])) {
		$err = '';
		$username = $_POST['loginid'];
		$password = $_POST['password'];
		$password = md5($password);
		
		// Verify that user is in database
		$sql = "SELECT * FROM users WHERE username = '$username'";
		$qsql = mysqli_query($connect, $sql);
		if (mysqli_num_rows($qsql) == 1) {
			$rslogin = mysqli_fetch_array($qsql);
			$_SESSION['userID'] = $rslogin['userID'];
			if (isset($_GET['next']) && $_GET['next'] == 'payment'){
				header('Location: ' . $root . 'rent/payment.php');
			} else {
				header('Location: ' . $root . 'account/userAccount.php');
			}
		} else {
			$err = "<div class='alert alert-danger'>
					<strong>Oh !</strong> Change a few things up and try submitting again.</div>";
		}
	}

	?>
	<div class="container">
		<div class="login-container">
		<div id="err" class="content"><?php echo $err; ?></div>
		<div class="card-top content"></div>
		<div class="card content">
			<h1 class="title"><span>MY V BIKE RENTAL</span>User Login</h1>
			<div class="col-md-12">
				<form method="post" action="" name="frmadminlogin" id="sign_in" onSubmit="return validateform()">
					<div class="input-group"> <span class="input-group-addon"> <i class="zmdi zmdi-account"></i> </span>
						<div class="form-line">
							<input type="text" name="loginid" id="loginid" class="form-control" placeholder="Username" />
						</div>
					</div>
					<div class="input-group"> <span class="input-group-addon"> <i class="zmdi zmdi-lock"></i> </span>
						<div class="form-line">
							<input type="password" name="password" id="password" class="form-control" placeholder="Password" />
						</div>
					</div>
					<div>
						<div class="text-center">
							<input type="submit" name="submit" id="submit" value="Login" class="btn btn-raised waves-effect g-bg-gy" />
						</div>
						<div class="text-center"><a href="forgot-password.html">Forgot Password?</a></div>
						<div class="text-center"><a href="signup.php">Don't have an account? Sign up now</a></div>
						<br>
						<div class="text-center"><a href="loginAdmin.php">Sign in as Admin</a></div>		
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Jquery Core Js -->
	<script src="<?php echo $root ?>assets/script/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
	<script src="<?php echo $root ?>assets/script/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->

	<script src="<?php echo $root ?>assets/scipt/mainscripts.bundle.js"></script><!-- Custom Js -->
</body>

</html>
<script type="application/javascript">
	var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
	var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
	var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
	var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

	function validateform() {
		if (document.frmadminlogin.loginid.value == "") {
			document.getElementById("err").innerHTML = "<div class='alert alert-info'><strong>Heads up!</strong> Please enter Password</div>";
			document.frmadminlogin.loginid.focus();
			return false;
		} else if (!document.frmadminlogin.loginid.value.match(alphanumericExp)) {
			document.getElementById("err").innerHTML = "<div class='alert alert-Warning'><strong>Heads up!</strong> Invalid Password</div>";
			document.frmadminlogin.loginid.focus();
			return false;
		} else if (document.frmadminlogin.password.value == "") {
			document.getElementById("err").innerHTML = "<div class='alert alert-info'><strong>Heads up!</strong> Should not be empty</div>";
			document.frmadminlogin.password.focus();
			return false;
		} else if (document.frmadminlogin.password.value.length < 8) {
			document.getElementById("err").innerHTML = "<div class='alert alert-info'><strong>Heads up!</strong> Length should be 8</div>";
			document.frmadminlogin.password.focus();
			return false;
		} else {
			return true;
		}
	}
</script>