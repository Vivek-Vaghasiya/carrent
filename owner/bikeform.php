<?php
session_start();
error_reporting(0);
include('includes/config.php');

// echo $_SESSION['alogin'];
// $sql = "SELECT * from tblowner";
// $query = $dbh->query($sql);
//  echo $query["ownername"];
//  echo console.log( $query["ownerid"]);
// $query->bindParam(':ownerid',$ownerid, PDO::PARAM_STR);
// $query->execute();
// $results=$query->fetchAll(PDO::FETCH_OBJ);
if(strlen($_SESSION['alogin'])==0)
{
    header('location:index.php');
}

else{ 
    
    if(isset($_POST['submit']))
    {
        // $mailid=$_SESSION['alogin'];
        $vid=$_SESSION['vid'];
        $bname=$_POST['bikename'];
$bbrand=$_POST['bikebrand'];
$boview=$_POST['bikeoverview'];
$bppday=$_POST['priceperday'];
$bftype=$_POST['fueltype'];
$bmyear=$_POST['modelyear'];
$bscapacity=$_POST['seatingcapacity'];
$vimage1=$_FILES["img1"]["name"];
$vimage2=$_FILES["img2"]["name"];
$vimage3=$_FILES["img3"]["name"];
$oemail = $_SESSION['alogin'];
$msql ="SELECT ownerid FROM tblowner WHERE owneremail=:owneremail";
//echo $sql;
$querys= $dbh->prepare($msql);
$querys-> bindParam(':owneremail', $oemail, PDO::PARAM_STR);
$querys-> execute();
$results=$querys->fetchAll(PDO::FETCH_OBJ);
// print_r($querys->fetch(PDO::FETCH_OBJ));
// print_r($results);
if($querys->rowCount() > 0)
{
  $_SESSION['myid'] = $results[0]->ownerid;
$owner_id =$_SESSION['myid'];
} else{
echo "can not fetch logged in user email, please login";
}
move_uploaded_file($_FILES["img1"]["tmp_name"],"img/vehicleimages/".$_FILES["img1"]["name"]);
move_uploaded_file($_FILES["img2"]["tmp_name"],"img/vehicleimages/".$_FILES["img2"]["name"]);
move_uploaded_file($_FILES["img3"]["tmp_name"],"img/vehicleimages/".$_FILES["img3"]["name"]);

$sql="INSERT INTO tblbike(vehicleid,ownerid,bikename,bikebrand,bikeoverview,priceperday,fueltype,modelyear,seatingcapacity,bikeimage1,bikeimage2,bikeimage3) VALUES($vid,$owner_id,'$bname','$bbrand','$boview','$bppday','$bftype','$bmyear','$bscapacity','$vimage1','$vimage2','$vimage3')";
// echo $sql;
// die();
$query = $dbh->prepare($sql);
$query->bindParam(':vehicleid',$vid,PDO::PARAM_STR);
$query->bindParam(':ownerid',$owner_id,PDO::PARAM_STR);
$query->bindParam(':bikename',$bname,PDO::PARAM_STR);
$query->bindParam(':bikebrand',$bbrand,PDO::PARAM_STR);
$query->bindParam(':bikeoverview',$boview,PDO::PARAM_STR);
$query->bindParam(':priceperday',$bppday,PDO::PARAM_STR);
$query->bindParam(':fueltype',$bftype,PDO::PARAM_STR);
$query->bindParam(':modelyear',$bmyear,PDO::PARAM_STR);
$query->bindParam(':seatingcapacity',$bscapacity,PDO::PARAM_STR);
$query->bindParam(':vimage1',$vimage1,PDO::PARAM_STR);
$query->bindParam(':vimage2',$vimage2,PDO::PARAM_STR);
$query->bindParam(':vimage3',$vimage3,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Vehicle posted successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

 }


	?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Rent Smart | Owner Bike Add</title>

	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>

</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
    <div class="content-wrapper">
			<div class="container-fluid">
                        <div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
                                <div class="panel-heading">Basic Info For Bike</div>
                                    
                                    <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                                                    else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                                                                        <div class="panel-body">
                                    
<form method="post" class="form-horizontal" enctype="multipart/form-data">
<div class="form-group">
<label class="col-sm-2 control-label">Bike Name<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="bikename" class="form-control" required>
</div>
<label class="col-sm-2 control-label">Select Brand<span style="color:red">*</span></label>
<div class="col-sm-4">
<select class="selectpicker" name="bikebrand" required>
<option value=""> Select </option>
<option value="HERO MOTOCORP"> KTM </option>
<option value="HERO MOTOCORP"> HERO MOTOCORP </option>
<option value="BAJAJ"> BAJAJ </option>
<option value="ROYAL ENFIELD"> ROYAL ENFIELD </option>
<option value="TVS"> TVS </option>
<option value="YAMAHA"> YAMAHA </option>
<option value="SUZUKI BIKE"> SUZUKI BIKE </option>
<option value="HONDA BIKE"> HONDA BIKE </option>
<option value="OLA ELECTRIC"> OLA ELECTRIC </option>

</select>
</div>
</div>
											
<div class="hr-dashed"></div>
<div class="form-group">
<label class="col-sm-2 control-label">bike Overview<span style="color:red">*</span></label>
<div class="col-sm-10">
<textarea class="form-control" name="bikeoverview" rows="3" required></textarea>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Price Per Day(in USD)<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="priceperday" class="form-control" required>
</div>
<label class="col-sm-2 control-label">Select Fuel Type<span style="color:red">*</span></label>
<div class="col-sm-4">
<select class="selectpicker" name="fueltype" required>
<option value=""> Select </option>

<option value="Petrol">Petrol</option>
<option value="Diesel">Diesel</option>
<option value="LPG">LPG</option>
<option value="Electric">Electric</option>
</select>
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Model Year<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="modelyear" class="form-control" required>
</div>
<label class="col-sm-2 control-label">Seating Capacity<span style="color:red"></span></label>
<div class="col-sm-4">
<input type="text" name="seatingcapacity" class="form-control">
</div>
</div>
<div class="hr-dashed"></div>


<div class="form-group">
<div class="col-sm-12">
<h4><b>Upload Images</b></h4>
</div>
</div>


<div class="form-group">
<div class="col-sm-4">
Image 1 <span style="color:red">*</span><input type="file" name="img1" required>
</div>
<div class="col-sm-4">
Image 2<span style="color:red">*</span><input type="file" name="img2" required>
</div>
<div class="col-sm-4">
Image 3<span style="color:red">*</span><input type="file" name="img3" required>
</div>
</div>


<div class="form-group">
<div class="col-sm-4">
Image 4<input type="file" name="img4" >
</div>

</div>
                                          <div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<button class="btn btn-default" type="reset">Cancel</button>
													<button class="btn btn-primary" name="submit" type="submit">Submit</button>
												</div>
											</div>
<div class="hr-dashed"></div>									
</div>
</div>
</div>
</div>
							


											<!-- <div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<button class="btn btn-default" type="reset">Cancel</button>
													<button class="btn btn-primary" name="submit" type="submit">Save changes</button>
												</div>
											</div> -->

										</form>

					</div>
				</div>
           </div>

			</div>
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
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
<?php 
} 

?>