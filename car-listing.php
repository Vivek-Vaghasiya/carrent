<?php 
session_start();
include('includes/config.php');
error_reporting(0);
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Rent Smart | Car Listing</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<link href="assets/css/slick.css" rel="stylesheet">
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>


<?php include('includes/header.php');?>
<section class="page-header listing_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Car Listing</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="#">Home</a></li>
        <li>Car Listing</li>
      </ul>
    </div>
  </div>
    <div class="dark-overlay"></div>
</section>
<section class="listing-page">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-md-push-3">
        <div class="result-sorting-wrapper">
          <div class="sorting-count">
          <?php 
$sql = "SELECT carid from tblcar";
$query = $dbh -> prepare($sql);
$query->bindParam(':carid',$carid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=$query->rowCount();
?>
<p><span><?php echo htmlentities($cnt);?> Listings</span></p>
</div>
</div>

<?php
$sql1 = "SELECT ownerid from tblowner where status=1";
$quer1 = $dbh -> prepare($sql1);
$quer1->execute();
$result1=$quer1->fetchAll(PDO::FETCH_OBJ);
// print_r($result1);
foreach($result1 as $result)
{
  $var=$result->ownerid;
 $sql = "SELECT * from tblcar where ownerid='$var'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>
        <div class="product-listing-m gray-bg">
          <div class="product-listing-img"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->carimage1);?>" class="img-responsive" alt="Image" /> </a> 
          </div>
          <div class="product-listing-content">
            <h5><a href="car-details.php?carid=<?php echo htmlentities($result->carid);?>"><?php echo htmlentities($result->carbrand);?> , <?php echo htmlentities($result->carname);?></a></h5>
            <p class="list-price">Rs.<?php echo htmlentities($result->priceperday);?> Per Day</p>
            <ul>
              <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->seatingcapacity);?> seats</li>
              <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->modelyear);?> model</li>
              <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->fueltype);?></li>
            </ul>
            <a href="car-details.php?carid=<?php echo htmlentities($result->carid);?>" class="btn">View Details <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
          </div>
        </div>
        <?php }}} ?>
         </div>
      
      <!--Side-Bar-->
      <aside class="col-md-3 col-md-pull-9">
        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-filter" aria-hidden="true"></i> Find Your  Car </h5>
          </div>
          <div class="sidebar_filter">
            <form action="search-carresult.php" method="post">
              <div class="form-group select">
                <select class="form-control" name="brand">
                  <option>Select Brand</option> 
                  <option value="Audi"> AUDI </option>
                  <option value="BMW"> BMW </option>
                  <option value="TATA"> TATA </option>
<option value="MAHINDRA"> MAHINDRA </option>
<option value="TOYOTA"> TOYOTA </option>
<option value="VOLKSWAGEN"> VOLKSWAGEN </option>
<option value="MARUTI SUZUKI"> MARUTI SUZUKI </option>
<option value="HYUNDAI"> HYUNDAI </option>
<option value="HONDA"> HONDA </option>
<option value="NISSAN"> NISSAN </option>
<option value="RENEVLT"> RENEVLT </option>
<option value="MERCEDES-BENZ"> MERCEDES-BENZ </option>
<option value="KIA"> KIA </option>
<option value="SKODA"> SKODA </option>
<option value="BAJAJ"> BAJAJ </option>
<option value="FORCE"> FORCE </option>
<option value="FORD"> FORD </option>
<option value="TATA ELECTRIC"> TATA ELECTRIC </option>

                 
                </select>
              </div>
              <div class="form-group select">
                <select class="form-control" name="fueltype">
                  <option>Select Fuel Type</option>
                  <option value="Petrol">Petrol</option>
                  <option value="Diesel">Diesel</option>
<option value="CNG">CNG</option>
<option value="Electric">Electric</option>
                </select>
              </div>
             
              <div class="form-group">
                <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Search Car</button>
              </div>
            </form>
          </div>
        </div>

        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-car" aria-hidden="true"></i> Recently Listed Cars</h5>
          </div>
          <div class="recent_addedcars">
            <ul>
            <?php
            $sql1 = "SELECT ownerid from tblowner where status=1";
            $quer1 = $dbh -> prepare($sql1);
            $quer1->execute();
            $result1=$quer1->fetchAll(PDO::FETCH_OBJ);
            // print_r($result1);
            foreach($result1 as $result)
            {
              $var=$result->ownerid;
             $sql = "SELECT * from tblcar where ownerid=$var";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>
              <li class="gray-bg">
                <div class="recent_post_img"> <a href="car-details.php?carid=<?php echo htmlentities($result->carid);?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->carimage1);?>" alt="image"></a> </div>
                <div class="recent_post_title"> <a href="car-details.php?carid=<?php echo htmlentities($result->carid);?>"><?php echo htmlentities($result->carbrand);?> , <?php echo htmlentities($result->carname);?></a>
                  <p class="widget_price">Rs.<?php echo htmlentities($result->priceperday);?> Per Day</p>
                </div>
              </li>
              <?php }}} ?>
              
              
            </ul>
          </div>
        </div>
      </aside>
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
<script src="assets/js/interface.js"></script><script src="assets/switcher/js/switcher.js"></script>

<script src="assets/js/bootstrap-slider.min.js"></script> 

<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>
</html>
