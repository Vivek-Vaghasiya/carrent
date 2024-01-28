<?php
session_start();
include('includes/config.php');
if(isset($_POST['login']))
{
$email=$_POST['owneremail'];
$password=md5($_POST['password']);
$sql ="SELECT owneremail,password FROM tblowner WHERE owneremail=:owneremail and password=:password and status='1'";
$query= $dbh -> prepare($sql);
$query-> bindParam(':owneremail', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['alogin']=$_POST['owneremail'];
echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
} else{
  
  echo "<script>alert('Invalid Details');</script>";

}

}

?>


<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
$.validator.setDefaults({
		submitHandler: function(form) {
      form.submit();
			// alert("submitted!");
		}
	});

	$().ready(function() { 

		// validate signup form on keyup and submit
		$("#login").validate({
			rules: {
				owneremail: {
					required: true,
					email: true
				},
        password: {
					required: true,
					minlength: 5
				}
			},
			messages: {
				
				owneremail: "* Please enter a valid email address",
				password: {
					required: "* Please provide a password",
					minlength: "* Your password must be at least 5 characters long"
				}
			}
		});
	});
</script>



<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Rent Smart | Owner Login</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	
	<div class="login-page bk-img" style="background-image: url(img/login-bg.jpg);">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h1 class="text-center text-bold text-light mt-4x">Owner Sign in</h1>
						<div class="well row pt-2x pb-3x bk-light">
							<div class="col-md-8 col-md-offset-2">


							<style>

.error{
  color: red;
  font-weight: 600;
}
</style>


								<form method="post" name="login" id="login">

									<label for="" class="text-uppercase text-sm">Your Email </label>
									<input type="text" placeholder="Enter Email" name="owneremail" id="owneremail" class="form-control mb" required>
<br>
									<label for="" class="text-uppercase text-sm">Password</label>
									<input type="password" placeholder="Password" name="password" id="password" class="form-control mb" required>

								

									<button class="btn btn-primary btn-block" name="login" type="submit">LOGIN</button>

								</form>
							</div>
						</div>
						<div class="text-center text-light">
							<h5><a href="changepassword.php" class="text-light">Forgot password?</a></h5>
						</div>
						<div class="text-center text-light">
							<h4><a href="registration.php" class="text-light">Register Owner Here</a></h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- <script src="js/jquery.min.js"></script> -->
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

</body>

</html>