<?php
if(isset($_POST['update']))
  {
$aname=$_POST['aname'];
$newpassword=md5($_POST['newpassword']);
  $sql ="SELECT UserName FROM tblcust WHERE UserName=:aname";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update tblcust set password=:newpassword where emailid=:email and mobileno=:mobile";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':aname', $aname, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
echo "<script>alert('Your Password succesfully changed');</script>";
}
else {
echo "<script>alert('Email id or Mobile no is invalid');</script>"; 
}
}

?>
  <script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>
<!-- 
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
				username: {
					required: true,
					minlength: 2
				},
        password: {
					required: true,
					minlength: 3
				}
			},
			messages: {
				
				username: {
					required: "* Please enter a username",
					minlength: "* Your username must consist of at least 2 characters"
				},
				password: {
					required: "* Please provide a password",
					minlength: "* Your password must be at least 5 characters long"
				}
			}
		});
	});
</script> -->


<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Rent Smart | Admin Login</title>
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
						<h1 class="text-center text-bold text-light mt-4x">Admin Forgot Password</h1>
						<div class="well row pt-2x pb-3x bk-light">
							<div class="col-md-8 col-md-offset-2">


							<!-- <style>

.error{
  color: red;
  font-weight: 600;
}
</style> -->

<form name="chngpwd" method="post" onSubmit="return valid();" id="login">
                <div class="form-group">
                  <input type="text" name="aname" class="text-uppercase form-control" placeholder="Your Admin Name*" required="">
                </div>
  <div class="form-group">
                  <input type="password" name="newpassword" class="text-uppercase form-control" placeholder="New Password*" required="">
                </div>
  <div class="form-group">
                  <input type="password" name="confirmpassword" class="text-uppercase form-control" placeholder="Confirm Password*" required="">
                </div>
                <div class="form-group">
                  <input type="submit" value="Reset My Password" name="update" class="btn btn-primary btn-block">
                </div>
              </form>
							</div>
						</div>
                        
              <div class="text-center">
                <p class="text-light">For security reasons we don't store your password. Your password will be reset and a new one will be send.</p>
                <a href="index.php" class="text-light">Back to Login</a>
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