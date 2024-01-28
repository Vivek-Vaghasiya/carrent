<?php 
session_start();
include('includes/config.php');
error_reporting(0);
//print_r($_GET['bikeid']);
//$emailid=$_SESSION['login'];
//echo $emailid;
if(isset($_POST['submit']))
{
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate']; 
$message=$_POST['message'];
$emailid=$_SESSION['login'];
$carid=$_GET['carid'];
$bikeid=$_GET['bikeid'];
//echo $bikeid;
$msql ="SELECT customerid FROM tblcust WHERE emailid='$emailid'";
//print_r($msql);
$querys= $dbh->prepare($msql);
$querys-> bindParam(':emailid',$emailid, PDO::PARAM_STR);
$querys-> execute();
$results=$querys->fetchAll(PDO::FETCH_OBJ);
 //print_r($querys->fetch(PDO::FETCH_OBJ));
 //print_r($results);
if($querys->rowCount() > 0)
{
  $_SESSION['myid'] = $results[0]->customerid;
  $customid =$_SESSION['myid'];
} else{
echo "can not fetch logged in user email, please login";
}
$sql="INSERT INTO tblbooking(fromdate,todate,message,customerid,carid,bikeid) VALUES('$fromdate','$todate','$message',$customid,'0','$bikeid')";
//print_r($sql);
$query = $dbh->prepare($sql);
$query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
$query->bindParam(':carid',$carid,PDO::PARAM_STR);
$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query->bindParam(':todate',$todate,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->bindParam(':bikeid',$bikeid,PDO::PARAM_STR);
$query->execute();
//print_r($query);
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Booking successfull.');</script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}

}

?>


<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Rent Smart | Vehicle Details</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<link href="assets/css/slick.css" rel="stylesheet">
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">

<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>
<body>

<?php include('includes/header.php');?>

<?php 
$bikeid=intval($_GET['bikeid']);
// echo $bikeid;
$sql = "SELECT * from tblbike where bikeid=:bikeid";
$query = $dbh -> prepare($sql);
$query->bindParam(':bikeid',$bikeid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
//echo $results;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  
    $_SESSION['bikebrand']=$result->bikebrand;  
?>  

<section id="listing_img_slider">
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->bikeimage1);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->bikeimage2);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->bikeimage3);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <?php if($result->bikeimage4=="")
{

} else {
  ?>
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->bikeimage4);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <?php } ?>
</section>


<section class="listing-detail">
  <div class="container">
    <div class="listing_detail_head row">
      <div class="col-md-9">
        <h2><?php echo htmlentities($result->bikebrand);?> , <?php echo htmlentities($result->bikename);?></h2>
      </div>
      <div class="col-md-3">
        <div class="price_info">
          <p>Rs.<?php echo htmlentities($result->priceperday);?> </p>Per Day
         
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">
        <div class="main_features">
          <ul>
          
            <li> <i class="fa fa-calendar" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result->modelyear);?></h5>
              <p>Reg.Year</p>
            </li>
            <li> <i class="fa fa-cogs" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result->fueltype);?></h5>
              <p>Fuel Type</p>
            </li>
       
            <li> <i class="fa fa-user-plus" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result->seatingcapacity);?></h5>
              <p>Seats</p>
            </li>
          </ul>
        </div>
        <div class="listing_more_info">
          <div class="listing_detail_wrap"> 
            
            <ul class="nav nav-tabs gray-bg" role="tablist">
              <li role="presentation" class="active"><a href="#vehicle-overview " aria-controls="vehicle-overview" role="tab" data-toggle="tab">Bike Overview</a></li>
          </ul>
            
            
            <div class="tab-content"> 
              
              <div role="tabpanel" class="tab-pane active" id="vehicle-overview">
                
                <p><?php echo htmlentities($result->bikeoverview);?></p>
              </div>
              
              
             
    </div>
          </div>
          
        </div>
<?php }} ?>
   
      </div>
      
      
      <aside class="col-md-3">
      
        <div class="share_vehicle">
          <p>Share: <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a> </p>
        </div>
        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-envelope" aria-hidden="true"></i>Book Now</h5>
          </div>
          <?php
         echo "<form method='post'>";
           echo "<div class='form-group'>";
             echo "From Date<input type='date' class='form-control' name='fromdate' min='".date('Y-m-d')."' required>";
            echo "</div>";
            echo "<div class='form-group'>";
            $date1=date("Y-m-d");
            $date = new DateTime($date1);
            date_add($date,date_interval_create_from_date_string('15 days'));
            $final= date_format($date,"Y-m-d");
            echo "To Date<input type='date' class='form-control' name='todate' min='".date('Y-m-d')."' max='$final' required>";
            echo "</div>";
            echo "<div class='form-group'>";
            echo "Message<textarea rows='4' class='form-control' name='message' placeholder='Message' required></textarea>";
            echo "</div>";
          if($_SESSION['login'])
              {
                echo "<div class='form-group'>";
                echo "<input type='submit' class='btn'  name='submit' value='Book Now'>";
                echo "</div>";
              } else {
                echo "<a href='loginform' class='btn btn-xs uppercase' data-toggle='modal' data-dismiss='modal'>Login For Book</a>";

              }
              echo "</form>";
          ?>
        </div>
      </aside>
      
    </div>
    
    <div class="space-20"></div>
    <div class="divider"></div>
    
    
    <div class="similar_cars">
      <h3>Similar Bikes</h3>
      <div class="row">
<?php 
$bikeb=$_SESSION['bikebrand'];
$sql="SELECT * from tblbike where bikebrand=:bikebrand";
$query = $dbh -> prepare($sql);
$query->bindParam(':bikebrand',$bikeb, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>      
        <div class="col-md-3 grid_listing">
          <div class="product-listing-m gray-bg">
            <div class="product-listing-img"> <a href="vehical-details.php?vhid=<?php echo htmlentities($result->bikeid);?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->bikeimage1);?>" class="img-responsive" alt="image" /> </a>
            </div>
            <div class="product-listing-content">
              <h5><a href="vehical-details.php?vhid=<?php echo htmlentities($result->bikeid);?>"><?php echo htmlentities($result->bikebrand);?> , <?php echo htmlentities($result->bikename);?></a></h5>
              <p class="list-price">Rs.<?php echo htmlentities($result->priceperday);?></p>
          
              <ul class="features_list">
                
             <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->seatingcapacity);?> seats</li>
                <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->modelyear);?> model</li>
                <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->fueltype);?></li>
              </ul>
            </div>
          </div>
        </div>
 <?php }} ?>       

      </div>
    </div>
    
    
  </div>
</section>

<?php include('includes/footer.php');?>

<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>

<?php include('includes/login.php');?>

<?php include('includes/registration.php');?>

<?php include('includes/forgotpassword.php');?>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<script src="assets/switcher/js/switcher.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>
</html>