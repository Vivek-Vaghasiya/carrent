<?php
if(isset($_POST['login']))
{
$email=$_POST['emailid'];
$password=md5($_POST['password']);
//echo $password;
$sql ="SELECT emailid,password,fullname FROM tblcust WHERE emailid=:emailid and password=:password and status='1'";
//echo $sql;
$query= $dbh->prepare($sql);
$query-> bindParam(':emailid', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['login']=$_POST['emailid'];
$_SESSION['fullname']=$results->fullname;
$currentpage=$_SERVER['REQUEST_URI'];
echo "<script type='text/javascript'> document.location = '$currentpage'; </script>";
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
				emailid: {
					required: true,
					email: true
				},
        password: {
					required: true,
					minlength: 5
				}
			},
			messages: {
				
				emailid: "* Please enter a valid email address",
				password: {
					required: "* Please provide a password",
					minlength: "* Your password must be at least 5 characters long"
				}
			}
		});
	});
</script>



<div class="modal fade" id="loginform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Customer Login</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="login_wrap">
            <div class="col-md-12 col-sm-6">


            <style>

.error{
  color: red;
  font-weight: 600;
}
</style>
              <form method="post" name="login" id="login">
                <div class="form-group">
                  <input type="email" class="form-control" name="emailid" id="emailid" placeholder="Email address*" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" id="password" placeholder="Password*" required>
                </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="remember" >
               
                </div>
                <div class="form-group">
                  <input type="submit" name="login" value="Login" class="btn btn-block" >
                </div>
              </form>
            </div>
           
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>Don't have an account? <a href="#signupform" data-toggle="modal" data-dismiss="modal">Signup Here</a></p>
        <p><a href="#forgotpassword" data-toggle="modal" data-dismiss="modal">Forgot Password ?</a></p>
      </div>
    </div>
  </div>
</div>