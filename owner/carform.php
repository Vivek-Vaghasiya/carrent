<?php
session_start();
error_reporting(0);
include('includes/config.php');

//echo $_SESSION['vid'];
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
	$ctitle=$_POST['carname'];
$cbname=$_POST['carbrand'];
$coview=$_POST['caroverview'];
$cppday=$_POST['carpriceperday'];
$cftype=$_POST['carfueltype'];
$cmyear=$_POST['carmodelyear'];
$cscapacity=$_POST['carseatingcapacity'];
$vimage1=$_FILES["img1"]["name"];
$vimage2=$_FILES["img2"]["name"];
$vimage3=$_FILES["img3"]["name"];
$vimage4=$_FILES["img4"]["name"];
$vimage5=$_FILES["img5"]["name"];
$airconditioner=$_POST['airconditioner'];
$powerdoorlocks=$_POST['powerdoorlocks'];
$antilockbrakingsys=$_POST['antilockbrakingsys'];
$brakeassist=$_POST['brakeassist'];
$powersteering=$_POST['powersteering'];
$driverairbag=$_POST['driverairbag'];
$passengerairbag=$_POST['passengerairbag'];
$powerwindow=$_POST['powerwindow'];
$cdplayer=$_POST['cdplayer'];
$centrallocking=$_POST['centrallocking'];
$crashcensor=$_POST['crashcensor'];
$leatherseats=$_POST['leatherseats'];


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
move_uploaded_file($_FILES["img4"]["tmp_name"],"img/vehicleimages/".$_FILES["img4"]["name"]);
move_uploaded_file($_FILES["img5"]["tmp_name"],"img/vehicleimages/".$_FILES["img5"]["name"]);

$sql="INSERT INTO tblcar(vehicleid,ownerid,carname,carbrand,caroverview,priceperday,fueltype,modelyear,seatingcapacity,carimage1,carimage2,carimage3,carimage4,carimage5,aircondition,powerdoorlocks,antilockbrakingsys,brakassist,powerstering,driverairbag,passengerairbag,powerwindows,cdplayer,centrallocking,crashsensor,leatherseats) VALUES($vid,$owner_id,'$ctitle','$cbname','$coview','$cppday','$cftype','$cmyear','$cscapacity','$vimage1','$vimage2','$vimage3','$vimage4','$vimage5','$airconditioner','$powerdoorlocks','$antilockbrakingsys','$brakeassist','$powersteering','$driverairbag','$passengerairbag','$powerwindow','$cdplayer','$centrallocking','$crashcensor','$leatherseats')";
// echo $sql;
// die();
$query = $dbh->prepare($sql);

$query->bindParam(':vehicleid',$vid,PDO::PARAM_STR);
$query->bindParam(':ownerid',$owner_id,PDO::PARAM_STR);
$query->bindParam(':carname',$ctitle,PDO::PARAM_STR);
$query->bindParam(':carbrand',$cbname,PDO::PARAM_STR);
$query->bindParam(':caroverview',$coview,PDO::PARAM_STR);
$query->bindParam(':priceperday',$cppday,PDO::PARAM_STR);
$query->bindParam(':fueltype',$cftype,PDO::PARAM_STR);
$query->bindParam(':modelyear',$cmyear,PDO::PARAM_STR);
$query->bindParam(':seatingcapacity',$cscapacity,PDO::PARAM_STR);
$query->bindParam(':carimage1',$vimage1,PDO::PARAM_STR);
$query->bindParam(':carimage2',$vimage2,PDO::PARAM_STR);
$query->bindParam(':carimage3',$vimage3,PDO::PARAM_STR);
$query->bindParam(':carimage4',$vimage4,PDO::PARAM_STR);
$query->bindParam(':carimage5',$vimage5,PDO::PARAM_STR);
$query->bindParam(':aircondition',$airconditioner,PDO::PARAM_STR);
$query->bindParam(':powerdoorlocks',$powerdoorlocks,PDO::PARAM_STR);
$query->bindParam(':antilockbrakingsys',$antilockbrakingsys,PDO::PARAM_STR);
$query->bindParam(':brakeassist',$brakeassist,PDO::PARAM_STR);
$query->bindParam(':powersteering',$powersteering,PDO::PARAM_STR);
$query->bindParam(':driverairbag',$driverairbag,PDO::PARAM_STR);
$query->bindParam(':passengerairbag',$passengerairbag,PDO::PARAM_STR);
$query->bindParam(':powerwindows',$powerwindow,PDO::PARAM_STR);
$query->bindParam(':cdplayer',$cdplayer,PDO::PARAM_STR);
$query->bindParam(':centrallocking',$centrallocking,PDO::PARAM_STR);
$query->bindParam(':crashcensor',$crashcensor,PDO::PARAM_STR);
$query->bindParam(':leatherseats',$leatherseats,PDO::PARAM_STR);
$query->execute();
// print_r($query);
// die();

$lastInsertId = $dbh->lastInsertId();
// print_r($lastInsertId);
// die();
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
	
	<title>Rent Smart | Owner Car Add</title>

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
									<div class="panel-heading">Basic Info For Car</div>
                                    
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
									<div class="panel-body">
<form method="post" class="form-horizontal" enctype="multipart/form-data">
<div class="form-group">
<label class="col-sm-2 control-label">Car Name<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="carname" class="form-control" required>
</div>
<label class="col-sm-2 control-label">Select Brand<span style="color:red">*</span></label>
<div class="col-sm-4">
<select class="selectpicker" name="carbrand" required>
<option value=""> Select </option>
<option value="TATA"> BMW </option>
<option value="TATA"> Audi </option>
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
</div>
											
<div class="hr-dashed"></div>
<div class="form-group">
<label class="col-sm-2 control-label">Car Overview<span style="color:red">*</span></label>
<div class="col-sm-10">
<textarea class="form-control" name="caroverview" rows="3" required></textarea>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Price Per Day(in USD)<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="carpriceperday" class="form-control" required>
</div>
<label class="col-sm-2 control-label">Select Fuel Type<span style="color:red">*</span></label>
<div class="col-sm-4">
<select class="selectpicker" name="carfueltype" required>
<option value=""> Select </option>

<option value="Petrol">Petrol</option>
<option value="Diesel">Diesel</option>
<option value="CNG">CNG</option>
<option value="Electric">Electric</option>
</select>
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Model Year<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="carmodelyear" class="form-control" required>
</div>
<label class="col-sm-2 control-label">Seating Capacity<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="carseatingcapacity" class="form-control" required>
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
Image 4<span style="color:red">*</span><input type="file" name="img4" required>
</div>
<div class="col-sm-4">
Image 5<input type="file" name="img5">
</div>

</div>
<div class="hr-dashed"></div>									
</div>
</div>
</div>
</div>
							

<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">Accessories</div>
<div class="panel-body">


<div class="form-group">
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="airconditioner" name="airconditioner" value="1">
<label for="airconditioner"> Air Conditioner </label>
</div>
</div>
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="powerdoorlocks" name="powerdoorlocks" value="1">
<label for="powerdoorlocks"> Power Door Locks </label>
</div></div>
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="antilockbrakingsys" name="antilockbrakingsys" value="1">
<label for="antilockbrakingsys"> AntiLock Braking System </label>
</div></div>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="brakeassist" name="brakeassist" value="1">
<label for="brakeassist"> Brake Assist </label>
</div>
</div>



<div class="form-group">
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="powersteering" name="powersteering" value="1">

<label for="inlineCheckbox5"> Power Steering </label>
</div>
</div>
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="driverairbag" name="driverairbag" value="1">
<label for="driverairbag">Driver Airbag</label>
</div>
</div>
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="passengerairbag" name="passengerairbag" value="1">
<label for="passengerairbag"> Passenger Airbag </label>
</div></div>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="powerwindow" name="powerwindow" value="1">
<label for="powerwindow"> Power Windows </label>
</div>
</div>


<div class="form-group">
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="cdplayer" name="cdplayer" value="1">
<label for="cdplayer"> CD Player </label>
</div>
</div>
<div class="col-sm-3">
<div class="checkbox h checkbox-inline">
<input type="checkbox" id="centrallocking" name="centrallocking" value="1">
<label for="centrallocking">Central Locking</label>
</div></div>
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="crashcensor" name="crashcensor" value="1">
<label for="crashcensor"> Crash Sensor </label>
</div></div>
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="leatherseats" name="leatherseats" value="1">
<label for="leatherseats"> Leather Seats </label>
</div>
</div>
</div>




											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<button class="btn btn-default" type="reset">Cancel</button>
													<button class="btn btn-primary" name="submit" type="submit">Submit</button>
												</div>
											</div>

										</form>
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
<?php } 
?>