<?php
$root = "../";
include $root . 'db.php';

session_start();
error_reporting(0);
$dt = date("Y-m-d");
$tim = date("H:i:s");
if (isset($_SESSION['userID'])) {
	header('Location: ' . $root . 'account/userAccount.php');
}
?>
<!-- header section -->
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>MY V Bike Rental - Admin Login</title>
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
		$password = md5($_POST['password']);

		$sql = "SELECT * FROM users WHERE username = '$_POST[loginid]' OR email = '$_POST[email]'";
		$qsql = mysqli_query($connect, $sql);
		if (mysqli_num_rows($qsql) == 0) {
			$sql = "INSERT INTO users(username,password,email,mobileNo,address) values('$_POST[loginid]','$password','$_POST[email]','$_POST[mobileno]','$_POST[address]')";
			if ($qsql = mysqli_query($connect, $sql)) {
				echo '<script>';
				echo "alert(\"Signed up successfully! Please sign in now\")";
				echo '</script>';
				$link = $root . 'account/login.php';
				echo "<meta http-equiv='refresh' content='0;url='$link'>";
			} else {
				echo mysqli_error($connect);
			}
		} else {
			$err = "<div class='alert alert-danger'>
					<strong>Oh !</strong>Username/ Email already exist. Please try again.</div>";
		}	
	}

	?>


	<div class="container">
		<div class="login-container">
			<div id="err" class="content"><?php echo $err; ?></div>
			<div class="card-top content"></div>
			<div class="card content">
				<h1 class="title"><span>MY V BIKE RENTAL</span>SIGN UP</h1>
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
						<div class="input-group"> <span class="input-group-addon"> <i class="zmdi zmdi-lock"></i> </span>
							<div class="form-line">
								<input type="password" name="confirmedpassword" id="confirmedpassword" class="form-control" placeholder="Confirmed Password" />
							</div>
						</div>
						<div class="input-group"> <span class="input-group-addon"> <i class="zmdi zmdi-email"></i> </span>
							<div class="form-line">
								<input type="email" name="email" id="email" class="form-control" placeholder="Email" />
							</div>
						</div>
						<div class="input-group"> <span class="input-group-addon"> <i class="zmdi zmdi-phone"></i> </span>
							<div class="form-line">
								<input type="number" name="mobileno" id="mobileno" class="form-control" placeholder="Mobile No" />
							</div>
						</div>
						<div class="input-group"> <span class="input-group-addon"> <i class="zmdi zmdi-pin"></i> </span>
							<div class="form-line">
								<input type="text" name="address" id="address" class="form-control" placeholder="Address" />
							</div>
						</div>
						<div>
							<div class="text-center">
								<input type="submit" name="submit" id="submit" value="Signup" class="btn btn-raised waves-effect g-bg-gy" />
							</div>
							<div class="text-center"> <a href="login.php">Already have an account? Sign in</a></div>
						</div>
					</form>
				</div>
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
			document.getElementById("err").innerHTML = "<div class='alert alert-info'><strong>Heads up!</strong> Please enter a username</div>";
			document.frmadminlogin.loginid.focus();
			return false;
		} else if (!document.frmadminlogin.loginid.value.match(alphanumericExp)) {
			document.getElementById("err").innerHTML = "<div class='alert alert-Warning'><strong>Heads up!</strong> Invalid Password</div>";
			document.frmadminlogin.loginid.focus();
			return false;
		} else if (document.frmadminlogin.password.value == "") {
			document.getElementById("err").innerHTML = "<div class='alert alert-info'><strong>Heads up!</strong> Password should not be empty</div>";
			document.frmadminlogin.password.focus();
			return false;
		} else if (document.frmadminlogin.password.value.length < 8) {
			document.getElementById("err").innerHTML = "<div class='alert alert-info'><strong>Heads up!</strong> Length should be 8</div>";
			document.frmadminlogin.password.focus();
			return false;
		} else if (document.frmadminlogin.password.value != document.frmadminlogin.confirmedpassword.value) {
			alert("Password and confirm password should be equal..");
			document.frmadminlogin.password.focus();
			return false;
		} else if (document.frmadminlogin.email.value == "") {
			document.getElementById("err").innerHTML = "<div class='alert alert-info'><strong>Heads up!</strong> Email should not be empty</div>";
			document.frmadminlogin.email.focus();
			return false;
		} else if (document.frmadminlogin.mobileno.value == "") {
			document.getElementById("err").innerHTML = "<div class='alert alert-info'><strong>Heads up!</strong> Mobile No. should not be empty</div>";
			document.frmadminlogin.mobileno.focus();
			return false;
		} else if (document.frmadminlogin.address.value == "") {
			document.getElementById("err").innerHTML = "<div class='alert alert-info'><strong>Heads up!</strong> Address should not be empty</div>";
			document.frmadminlogin.address.focus();
			return false;
		} else {
			return true;
		}
	}
</script>