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
$id=intval($_GET['carid']);
$sql="UPDATE tblcar set vehicleid=$vid,ownerid=$owner_id,carname=$ctitle,carbrand=$cbname,caroverview=$coview,priceperday=$cppday,fueltype=$cftype,modelyear=$cmyear,seatingcapacity=$cscapacity,carimage1=$vimage1,carimage2=$vimage2,carimage3=$vimage3,carimage4=$vimage4,carimage5=$vimage5,aircondition=$airconditioner,powerdoorlocks=$powerdoorlocks,antilockbrakingsys=$antilockbrakingsys,brakassist=$brakeassist,powerstering=$powersteering,driverairbag=$driverairbag,passengerairbag=$passengerairbag,powerwindows=$powerwindow,cdplayer=$cdplayer,centrallocking=$centrallocking,crashsensor=$crashcensor,leatherseats=$leatherseats where carid=$id";
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
$msg="Data updated successfully";



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
                <?php 
$id=intval($_GET['carid']);
$sql ="SELECT * from tblcar where carid=:carid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':carid', $id, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{
    //echo $result->carname;	

    ?>
									<div class="panel-body">
<form method="post" class="form-horizontal" enctype="multipart/form-data">
<div class="form-group">
<label class="col-sm-2 control-label">Car Name<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" value="<?php echo htmlentities($result->carname)?>" name="carname" class="form-control" required>
</div>
<label class="col-sm-2 control-label">Select Brand<span style="color:red">*</span></label>
<div class="col-sm-4">
<select class="selectpicker" name="carbrand" required>
<option value="<?php echo htmlentities($result->carbrand);?>" > <?php echo htmlentities($result->carbrand);?> </option>
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
<textarea class="form-control" name="caroverview" rows="3" required><?php echo htmlentities($result->caroverview);?></textarea>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Price Per Day(in USD)<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="carpriceperday" class="form-control" value="<?php echo htmlentities($result->priceperday);?>" required>
</div>
<label class="col-sm-2 control-label">Select Fuel Type<span style="color:red">*</span></label>
<div class="col-sm-4">
<select class="selectpicker" name="carfueltype" required>
<option  value="<?php echo htmlentities($result->fueltype);?>" > <?php echo htmlentities($result->fueltype);?> </option>

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
<input type="text" name="carmodelyear" value="<?php echo htmlentities($result->modelyear);?>" class="form-control" required>
</div>
<label class="col-sm-2 control-label">Seating Capacity<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="carseatingcapacity" value="<?php echo htmlentities($result->seatingcapacity);?>" class="form-control" required>
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
Image 1 <img src="admin/img/vehicleimages/<?php echo htmlentities($result->carimage1);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage1.php?imgid=<?php echo htmlentities($result->carid)?>">Change Image 1</a> 
<span style="color:red">*</span><input type="file" value="<?php echo htmlentities($result->carid)?>" name="img1" required>
</div>
<div class="col-sm-4">
Image 2 <img src="admin/img/vehicleimages/<?php echo htmlentities($result->carimage2);?>" width="300" height="200" style="border:solid 1px #000">
<span style="color:red">*</span><input type="file" value="<?php echo htmlentities($result->carid)?>" name="img2" required>
</div>
<div class="col-sm-4">
Image 3 <img src="admin/img/vehicleimages/<?php echo htmlentities($result->carimage3);?>" width="300" height="200" style="border:solid 1px #000">
<span style="color:red">*</span><input type="file" value="<?php echo htmlentities($result->carid)?>" name="img3" required>
</div>
</div>


<div class="form-group">
<div class="col-sm-4">
Image 4 <img src="admin/img/vehicleimages/<?php echo htmlentities($result->carimage4);?>" width="300" height="200" style="border:solid 1px #000">
<span style="color:red">*</span><input type="file" value="<?php echo htmlentities($result->carid)?>" name="img4" required>
</div>
<div class="col-sm-4">
Image 5 <img src="admin/img/vehicleimages/<?php echo htmlentities($result->carimage5);?>" width="300" height="200" style="border:solid 1px #000">
<input type="file" value="<?php echo htmlentities($result->carid)?>" name="img5">
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
<?php if($result->aircondition==1)
{?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="inlineCheckbox1" name="airconditioner" checked value="1">
<label for="inlineCheckbox1"> Air Conditioner </label>
</div>
<?php } else { ?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="inlineCheckbox1" name="airconditioner" value="1">
<label for="inlineCheckbox1"> Air Conditioner </label>
</div>
<?php } ?>
</div>
<div class="col-sm-3">
<?php if($result->powerdoorlocks==1)
{?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="powerdoorlocks" name="powerdoorlocks" checked value="1">
<label for="powerdoorlocks"> Power Door Locks </label>
</div>
<?php } else { ?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="powerdoorlocks" name="powerdoorlocks" value="1">
<label for="powerdoorlocks"> Power Door Locks </label>
</div>
<?php } ?>
</div>
<div class="col-sm-3">
<?php if($result->antilockbrakingsys==1)
{?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="antilockbrakingsys" name="antilockbrakingsys" checked value="1">
<label for="antilockbrakingsys"> AntiLock Braking System </label>
</div>
<?php } else { ?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="antilockbrakingsys" name="antilockbrakingsys" value="1">
<label for="antilockbrakingsys"> AntiLock Braking System </label>
</div>
<?php } ?>
</div>
<?php if($result->brakassist==1)
{?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="brakeassist" name="brakeassist" checked value="1">
<label for="brakeassist"> Brake Assist </label>
</div>
<?php } else { ?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="brakeassist" name="brakeassist" value="1">
<label for="brakeassist"> Brake Assist </label>
</div>
<?php } ?>
</div>



<div class="form-group">
<div class="col-sm-3">
<?php if($result->powerstering==1)
{?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="powersteering" name="powersteering" checked value="1">
<label for="inlineCheckbox5"> Power Steering </label>
</div>
<?php } else { ?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="powersteering" name="powersteering" value="1">
<label for="inlineCheckbox5"> Power Steering </label>
</div>
<?php } ?>
</div>
<div class="col-sm-3">
<?php if($result->driverairbag==1)
{?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="driverairbag" name="driverairbag" checked value="1">
<label for="driverairbag">Driver Airbag</label>
</div>
<?php } else { ?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="driverairbag" name="driverairbag" value="1">
<label for="driverairbag">Driver Airbag</label>
</div>
<?php } ?>
</div>
<div class="col-sm-3">
<?php if($result->passengerairbag==1)
{?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="passengerairbag" name="passengerairbag" checked value="1">
<label for="passengerairbag"> Passenger Airbag </label>
</div>
<?php } else { ?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="passengerairbag" name="passengerairbag" value="1">
<label for="passengerairbag"> Passenger Airbag </label>
</div>
<?php } ?>
</div>
<?php if($result->powerwindows==1)
{?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="powerwindow" name="powerwindow" checked value="1">
<label for="powerwindow"> Power Windows </label>
</div>
<?php } else { ?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="powerwindow" name="powerwindow" value="1">
<label for="powerwindow"> Power Windows </label>
</div>
<?php } ?>
</div>


<div class="form-group">
<div class="col-sm-3">
<?php if($result->cdplayer==1)
{?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="cdplayer" name="cdplayer" checked value="1">
<label for="cdplayer"> CD Player </label>
</div>
<?php } else { ?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="cdplayer" name="cdplayer" value="1">
<label for="cdplayer"> CD Player </label>
</div>
<?php } ?>
</div>
<div class="col-sm-3">
<?php if($result->centrallocking==1)
{?>
<div class="checkbox h checkbox-inline">
<input type="checkbox" id="centrallocking" name="centrallocking" checked value="1">
<label for="centrallocking">Central Locking</label>
</div>
<?php } else { ?>
<div class="checkbox h checkbox-inline">
<input type="checkbox" id="centrallocking" name="centrallocking" value="1">
<label for="centrallocking">Central Locking</label>
</div>
<?php } ?>
</div>
<div class="col-sm-3">
<?php if($result->crashsensor==1)
{?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="crashcensor" name="crashcensor" checked value="1">
<label for="crashcensor"> Crash Sensor </label>
</div>
<?php } else { ?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="crashcensor" name="crashcensor" value="1">
<label for="crashcensor"> Crash Sensor </label>
</div>
<?php } ?>
</div>
<div class="col-sm-3">
<?php if($result->leatherseats==1)
{?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="leatherseats" name="leatherseats" checked value="1">
<label for="leatherseats"> Leather Seats </label>
</div>
<?php } else { ?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="leatherseats" name="leatherseats" value="1">
<label for="leatherseats"> Leather Seats </label>
</div>
<?php } ?>
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
                                    <?php }} ?>
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