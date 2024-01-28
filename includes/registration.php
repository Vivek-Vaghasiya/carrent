<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['signup']))
{ 

  $fname=$_POST['fullname'];
  $email=$_POST['emailid']; 
  $password=md5($_POST['password']); 
  $mobile=$_POST['mobileno'];
  $sql="INSERT INTO tblcust(fullname,emailid,password,mobileno) VALUES(:fullname,:emailid,:password,:mobileno)";
  //echo $sql;
  $query = $dbh->prepare($sql);
  mysqli_query($conn, $sql);
  $query->bindParam(':fullname',$fname,PDO::PARAM_STR);
  $query->bindParam(':emailid',$email,PDO::PARAM_STR);
  $query->bindParam(':password',$password,PDO::PARAM_STR);
  $query->bindParam(':mobileno',$mobile,PDO::PARAM_STR);
  $query->execute();
  $lastInsertId = $dbh->lastInsertId($query);
  //echo 'console.log('. json_encode($query, JSON_HEX_TAG) .')';
  if($lastInsertId)
  {
    echo "<script>alert('Something went wrong. Please try again');</script>";
  }
  else 
  {
  echo "<script>alert('Registration successfull. Now you can login');</script>";
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
		$( "#signup" ).validate({
			rules: {
				fullname: {
					required: true,
					minlength: 2
				},
				mobileno: {
					required: true,
					number: true,
          minlength: 10,
          maxlength: 10
				},
        password: {
					required: true,
					minlength: 5
				},
				confirmpassword: {
					required: true,
					minlength: 5
				},
				emailid: {
					required: true,
					email: true
				}
			},
			messages: {
				fullname: {
					required: "* Please enter a username",
					minlength: "* Your username must consist of at least 2 characters"
				},
        mobileno: {
					required: "* Please enter a mobile number",
					minlength: "* Your mobile number must be 10 numbers",
          maxlength: "* Your mobile number must be 10 numbers"
				},
				password: {
					required: "* Please provide a password",
					minlength: "* Your password must be at least 5 characters long"
				},
				confirmpassword: {
					required: "* Please provide a password",
					minlength: "* Your password must be at least 5 characters long"
				},
				emailid: "* Please enter a valid email address"
			}
		});
	});
</script>


<div class="modal fade" id="signupform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Registration</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="signup_wrap">
            <div class="col-md-12 col-sm-6">

            <style>

	.error{
    color: red;
    font-weight: 600;
  }
	</style>
  

              <form  method="post" name="signup" id="signup">
                <div class="form-group">
               <p>
                  <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Full Name">
</p>
                 </div>
 
                      <div class="form-group">  
    <p>              <input type="text" class="form-control" name="mobileno" id="mobileno" placeholder="Mobile Number"  required >
</p>
                  
                </div>
                
                <div class="form-group">
    <p>              <input type="text" class="form-control" name="emailid" id="emailid" onBlur="checkAvailability()" placeholder="Email Address" required>
</p>
                </div>
                <div class="form-group">
                <p>
                <input type="password" class="form-control" name="password" id="password" placeholder="password" required>
</p>
                </div>
                <div class="form-group">
                  <p>
                  <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="confirm password" required>
</p>
                </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="terms_agree" required checked="">
                  <label for="terms_agree">I Agree with <a href="#">Terms and Conditions</a></label>
                </div>
                <div class="form-group">
                  <input type="submit" value="Sign Up" name="signup" id="submit" class="btn btn-block">
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>Already got an account? <a href="#loginform" data-toggle="modal" data-dismiss="modal">Login Here</a></p>
      </div>
    </div>
  </div>
</div>