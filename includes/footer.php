
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submitreview']))
{
$cname=$_POST['customername'];
$mess=$_POST['message'];
$sql="INSERT INTO tblreview(customername,message) VALUES(:customername,:message)";
//echo $sql;
$query = $dbh->prepare($sql);
$query->bindParam(':customername',$cname,PDO::PARAM_STR);
$query->bindParam(':message',$mess,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Review successfully.');</script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}
}
?>

<footer>
  <div class="footer-top">
    <div class="container">
      <div class="row">
      
        <div class="col-md-6">
          <h6>About Us</h6>
          <ul>

        
          <li><a href="aboutus.php">About Us</a></li>
            <li><a href="privacy.php">Privacy</a></li>
          <li><a href="condition.php">Terms of use</a></li>
               <li><a href="admin/">Admin Login</a></li>
               <li><a href="owner/">Add Owner</a></li>
          </ul>
        </div>
  
        <div class="col-md-3 col-sm-6">
          <h6>Review</h6>
          <div class="newsletter-form">
            <form method="post">
              <div class="form-group">
                <input type="text" style="border: 1px solid white;" name="customername" class="form-control newsletter-input" required placeholder="Enter Name" />
              </div>
              <div class="form-group">
                <textarea name="message" style="background-color:#00000000; border: 1px solid white;" class="form-control newsletter-input" required placeholder="What do you think about this side" /></textarea>
              </div>
              <button type="submit" name="submitreview" class="btn btn-block">Submit <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
            </form>
            <p class="subscribed-text">We send great deals and latest auto news to our Review users very week.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-push-6 text-right">
          <div class="footer_widget">
            <p>Connect with Us:</p>
            <ul>
              <li><a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-6 col-md-pull-6">
          <p class="copy-right">Copyright &copy; 2022 Car Rental Portal. All Rights Reserved</p>
        </div>
      </div>
    </div>
  </div>
</footer>