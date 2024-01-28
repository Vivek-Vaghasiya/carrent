
<header>
  <div class="default-header">
    <div class="container">
      <div class="row">
        <div class="col-sm-3 col-md-2">
          <div class="logo"> <a href="index.php"><img style="margin-top: -28px;margin-bottom: -32px;" src="assets/images/Rentsmartlogo.png" height="100" width="130" alt="image"/></a> </div>
        </div>
        <div class="col-sm-9 col-md-10">
          <div class="header_info">
            <div class="header_widgets">
              <div class="circle_icon"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
              <p class="uppercase_text">For Support Mail us : </p>
              <a href="mailto:info@example.com">vivekvaghsiya@.com</a> </div>
              <div class="header_widgets">
                <div class="circle_icon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
                <p class="uppercase_text">Service Helpline Call Us: </p>
                <a href="tel:61-1234-5678-09">+91-982-528-6945</a> </div>
                <div class="social-follow">

                </div>
                <?php   if(strlen($_SESSION['login'])==0)
                {	
                  ?>
                  <div class="login_btn"> <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login / Register</a> </div>
                <?php }
                else{ 
      // echo $_SESSION['login'];
                 echo "Welcome To Car rental portal";
               } ?>
               <!-- <div class="login_btn"> <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login / Register</a> </div> -->

             </div>
           </div>
         </div>
       </div>
     </div>

     <!-- Navigation -->
     <nav id="navigation_bar" class="navbar navbar-default">
      <div class="container" style="width:1258px;">
        <div class="navbar-header">
          <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>

            <div class="row">

            <div class="col-md-8" style="width:59%;">

              <div class="collapse navbar-collapse" id="navigation">
                <ul class="nav navbar-nav">
                  <li><a href="index.php">Home</a></li>

                  <li><a href="aboutus.php">About Us</a></li>

                  <li class="dropdown"><a href="car-listing.php" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Vehicle</a> 
                   <ul class="dropdown-menu">
                    <li><a href="car-listing.php">Four Wheeles Details</a></li>
                    <li><a href="bike-listing.php">Two Wheeles Details</a></li>
                  </ul>
                </li>
                <li><a href="condition.php">Tearms & Condition</a></li>
                <li><a href="contactmanage.php">Contact Us</a></li>

              </ul>
            </div>
          </div>

                  <div class="header_wrap" style="float:left;">
          <div class="user_login">
            <ul>
              <li class="dropdown"><a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i></a>
                <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php 
                  $email=$_SESSION['login'];
                  $sql ="SELECT fullname FROM tblcust WHERE emailid=:emailid ";
                  $query= $dbh->prepare($sql);
                  $query->bindParam(':emailid', $email, PDO::PARAM_STR);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);
                  if($query->rowCount() > 0)
                  {
                    foreach($results as $result)
                    {
                     echo htmlentities($result->fullname); }}?><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                     
                     <?php if($_SESSION['login']){?>
                      <ul class="dropdown-menu">
                        <li><a href="profile.php">Profile Settings</a></li>
                        <li><a href="update-password.php">Update Password</a></li>
                        <li><a href="my-booking.php">My Booking</a></li>
                        <li><a href="logout.php">Sign Out</a></li>
                      </ul>
                    <?php } else { ?>
                    <?php } ?>
                    
                  </li>
                </ul>
              </div>
            </div>
                          <div class="col-md-4" style="float:right;margin-top:10px;width:25%;">
                <div class="input-group">
                 <div class="input-group-btn search-panel">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span id="search_concept">All</span> <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu scrollable-dropdown" role="menu">
                    <li><a href="#">Car</a></li>
                    <li><a href="#">Bike</a></li>
                  </ul>
                </div>
                <input type="hidden" name="search_param" value="all" id="search_param">
                <input type="text" class="form-control" name="x" id="search" placeholder="Search">
                <span class="input-group-btn">
                  <button class="btn btn-default" type="button">
                    <span class="glyphicon glyphicon-search"></span>
                  </button>
                </span>
              </div>
            </div>

        </div>

      </nav>


    </header>