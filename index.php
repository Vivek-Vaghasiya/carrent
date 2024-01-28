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
<title>Rent Smart</title>

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



<section id="banner" class="banner-section">
  <div class="container">
    <div class="div_zindex">
      <div class="row">
        <div class="col-md-5 col-md-push-7">
          <div class="banner_content">
            <h1>Find the right Vehicle for you.</h1>
            <p>We have more than a thousand vehicles for you to choose. </p>
            <a href="#findvehicle" class="btn">Read More <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a> </div>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="section-padding gray-bg" id="findvehicle">
  <div class="container">
    <div class="section-header text-center">
      <h2>Find the Best <span>VehicleForYou</span></h2>
      <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
    </div>
    <div class="row"> 
      
      <div class="recent-tab">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#resentnewcar" role="tab" data-toggle="tab">New Car</a></li>
        </ul>
      </div>
      
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="resentnewcar">

        <?php
        $sql1 = "SELECT ownerid from tblowner where status=1";
        $quer1 = $dbh -> prepare($sql1);
        $quer1->execute();
        $result1=$quer1->fetchAll(PDO::FETCH_OBJ);
        // print_r($result1);
        foreach($result1 as $result)
        {
          $var=$result->ownerid;
         //$sql = "SELECT * from tblvehicle1 INNER JOIN tblcar ON tblvehiclel.vehicleid=tblcar.vehicleid and tblvehicle1.statu=1 and tblcar.ownerid='$var'";
         //Print_r($sql2);
         $sql = "SELECT * from tblcar where ownerid='$var' limit 0,6";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  
?>  

<div class="col-list-3">
<div class="recent-car-list">
<div class="car-info-box"> <a href="car-details.php?carid=<?php echo htmlentities($result->carid);?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->carimage1);?>" class="img-responsive" alt="image"></a>
<ul>
<li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->fueltype);?></li>
<li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->modelyear);?> Model</li>
<li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->seatingcapacity);?> seats</li>
</ul>
</div>
<div class="car-title-m">
<h6><a href="car-details.php?carid=<?php echo htmlentities($result->carid);?>"><?php echo htmlentities($result->carbrand);?> , <?php echo htmlentities($result->carname);?></a></h6>
<span class="price">Rs.<?php echo htmlentities($result->priceperday);?> /Day</span> 
</div>
<div class="inventory_info_m">
<p><?php echo substr($result->caroverview,0,70);?></p>
</div>
</div>
</div>
<?php }}}?>
</div>
</div>
</div>
<br>
<div class="row"> 

<div class="recent-tab">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#resentnewcar" role="tab" data-toggle="tab">New Bike</a></li>
        </ul>
      </div>
      
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="resentnewbike">

        <?php
        $sql1 = "SELECT ownerid from tblowner where status=1";
        $quer1 = $dbh -> prepare($sql1);
        $quer1->execute();
        $result1=$quer1->fetchAll(PDO::FETCH_OBJ);
        // print_r($result1);
        foreach($result1 as $result)
        {
          $var=$result->ownerid; 
        $sql = "SELECT * from tblbike where ownerid='$var' limit 0,6";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  
?>  

<div class="col-list-3">
<div class="recent-car-list">
<div class="car-info-box"> <a href="bike-details.php?bikeid=<?php echo htmlentities($result->bikeid);?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->bikeimage1);?>" class="img-responsive" alt="image"></a>
<ul>
<li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->fueltype);?></li>
<li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->modelyear);?> Model</li>
<li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->seatingcapacity);?> seats</li>
</ul>
</div>
<div class="car-title-m">
<h6><a href="bike-details.php?bikeid=<?php echo htmlentities($result->bikeid);?>"><?php echo htmlentities($result->bikebrand);?> , <?php echo htmlentities($result->bikename);?></a></h6>
<span class="price">Rs.<?php echo htmlentities($result->priceperday);?> /Day</span> 
</div>
<div class="inventory_info_m">
<p><?php echo substr($result->bikeoverview,0,70);?></p>
</div>
</div>
</div>
<?php }}}?>
</div>
</div>



</div>
 </div>
</section>

<section class="fun-facts-section">
  <div class="container div_zindex">
    <div class="row">
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-calendar" aria-hidden="true"></i>40+</h2>
            <p>Years In Business</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-car" aria-hidden="true"></i>1200+</h2>
            <p>New Vehicle For Rent</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-car" aria-hidden="true"></i>1000+</h2>
            <p>Used Vehicle For Rent</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6 col-sm-3">
        <div class="fun-facts-m">
          <div class="cell">
            <h2><i class="fa fa-user-circle-o" aria-hidden="true"></i>600+</h2>
            <p>Satisfied Customers</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="dark-overlay"></div>
</section>

<section class="section-padding testimonial-section parallex-bg">
  <div class="container div_zindex">
    <div class="section-header white-text text-center">
      <h2>Our Satisfied <span>Customers</span></h2>
    </div>
    <div class="row">
      <div id="testimonial-slider">
      <?php 
$tid=0;
$sql = "SELECT * from tblreview where status=:tid";
$query = $dbh -> prepare($sql);
$query->bindParam(':tid',$tid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>

        <div class="testimonial-m">
          <div class="testimonial-img"> <img src="assets/images/cat-profile.png" alt="" /> </div>
          <div class="testimonial-content">
            <div class="testimonial-heading">
              <h5><?php echo htmlentities($result->customername);?></h5>
            <p><?php echo htmlentities($result->message);?></p>
          </div>
          </div>
        </div>
        <?php }} ?>
       
       
  
      </div>
    </div>
  </div>
  
  <div class="dark-overlay"></div>
</section>

<?php include('includes/footer.php');?>

<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>

<?php include('includes/login.php');?>

<?php include('includes/ownerform.php');?>

<?php include('includes/registration.php');?>


<?php include('includes/forgotpassword.php');?>


<!-- <script src="assets/js/jquery.min.js"></script> -->
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 

<script src="assets/switcher/js/switcher.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script> 

<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>

</html>