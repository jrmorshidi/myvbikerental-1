<?php
include("adHeader.php");
include("db.php");
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE users SET username='$_POST[username]',email='$_POST[email]',password='$_POST[password]',mobileNo'$_POST[mobileNo]',address'$_POST[address]' WHERE userID='$_GET[editid]'";
		if($qsql = mysqli_query($connect,$sql))
		{
			echo "<div class='alert alert-success'>
			User Record updated successfully
			</div>";
		}
		else
		{
			echo mysqli_error($connect);
		}	
	}
	else
	{
		$sql ="INSERT INTO users(username,email,password,mobileNo,address) values('$_POST[username]','$_POST[email]','$_POST[password]','$_POST[mobileNo]','$_POST[address]')";
		if($qsql = mysqli_query($connect,$sql))
		{
			echo "<div class='alert alert-success'>
			User Record Inserted successfully
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
	$sql="SELECT * FROM users WHERE userID='$_GET[editid]' ";
	$qsql = mysqli_query($connect,$sql);
	$rsedit = mysqli_fetch_array($qsql);
	
}
?>

<div class="container-fluid">
	<div class="block-header">
		<h2> Add New User </h2>
	</div>
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">

				<form method="post" action="editUsers.php" name="frmuserprofile" onSubmit="return validateform()">


					<div class="body">
						<div class="row clearfix">
							<div class="col-sm-12">   
								<div class="form-group">
									<label> Username</label>
									<div class="form-line">
										<input type="text" class="form-control"  name="username" id="username" value="<?php echo $rsedit['username']; ?>"/>
									</div>
								</div>

							</div>	

						</div>
						<div class="row clearfix"> 
							<div class="col-sm-12">                           
								<div class="form-group">
									<label>Email</label>
									<div class="form-line">
										<input type="email" class="form-control" name="email" id="email" value="<?php echo $rsedit['email']; ?>" />
									</div>
								</div>    
							</div>                      
						</div>  
						<div class="row clearfix"> 
							<div class="col-sm-12">                              
								<div class="form-group">
									<label> User Password</label>
									<div class="form-line">
										<input type="password" class="form-control"  name="password" id="password" value="<?php echo $rsedit['password']; ?>"/>
									</div>
								</div>
							</div>                          
						</div> 
						<div class="row clearfix"> 
							<div class="col-sm-12">                              
								<div class="form-group">
									<label>Confirm User Password</label>
									<div class="form-line">
										<input type="password" class="form-control"  name="cnfirmpassword" id="cnfirmpassword" value="<?php echo $rsedit['confirmpassword']; ?>"/>
									</div>
								</div>
							</div>                          
						</div> 
						<div class="row clearfix"> 
							<div class="col-sm-12">                              
								<div class="form-group">
									<label>Mobile Number</label>
									<div class="form-line">
										<input type="text" class="form-control"  name="mobileNo" id="mobileNo" value="<?php echo $rsedit['mobileNo']; ?>"/>
									</div>
								</div>
							</div>                          
						</div> 
						<div class="row clearfix"> 
							<div class="col-sm-12">                              
								<div class="form-group">
									<label>Address</label>
									<div class="form-line">
										<input type="text" class="form-control"  name="address" id="address" value="<?php echo $rsedit['address']; ?>"/>
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
	if(document.frmuser.username.value == "")
	{
		alert("User name should not be empty..");
		document.frmuser.username.focus();
		return false;
	}
	else if(!document.frmuser.username.value.match(alphaspaceExp))
	{
		alert("User name not valid..");
		document.frmuser.username.focus();
		return false;
	}
	else if(document.frmuser.email.value == "")
	{
		alert("Login ID should not be empty..");
		document.frmuser.email.focus();
		return false;
	}
	else if(document.frmuser.password.value == "")
	{
		alert("Password should not be empty..");
		document.frmuser.password.focus();
		return false;
	}
	else if(document.frmuser.password.value.length < 8)
	{
		alert("Password length should be more than 8 characters...");
		document.frmadmin.password.focus();
		return false;
	}
	else if(document.frmuser.password.value != document.frmuser.cnfirmpassword.value )
	{
		alert("Password and confirm password should be equal..");
		document.frmuser.password.focus();
		return false;
	}
	else if(document.mobileNo.value == "" )
	{
		alert("Mobile Number should not be empty..");
		document.frmuser.mobileNo.focus();
		return false;
	}
	else if(document.address.value == "" )
	{
		alert("address Number should not be empty..");
		document.frmuser.address.focus();
		return false;
	}	
	else
	{
		return true;
	}
}
</script>