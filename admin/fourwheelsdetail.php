<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql = "delete from tblbrands  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$msg="Page data updated  successfully";

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
	
	<title>Rent Smart |Admin Manage testimonials   </title>

	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
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

						<h2 class="page-title">Dispaly Bike Details</h2>

						<div class="panel panel-default">
							<div class="panel-heading">Bike Details</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
										<th>Car Name</th>
									    <th>Car images</th>
                                        <th>Car Brand</th>
										<th>Car Model</th>
										<th>Fuel type</th>
										<th>Seating Capcity</th>
										<th>Accessories</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
										<th>#</th>
										<th>Car Name</th>
									    <th>Car images</th>
                                        <th>Car Brand</th>
										<th>Car Model</th>
										<th>Fuel type</th>
										<th>Seating Capcity</th>
										<th>Accessories</th>
										</tr>
										</tr>
									</tfoot>
									<tbody>

									<?php $sql = "SELECT * from  tblcar ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result->carname);?></td>
											<td><?php echo htmlentities($result->carimage1);?></td>
											<td><?php echo htmlentities($result->carbrand);?></td>
	                                        <td><?php echo htmlentities($result->modelyear);?></td>
											<td><?php echo htmlentities($result->fueltype);?></td>
											<td><?php echo htmlentities($result->seatingcapacity);?></td>
											<td>
											<?php if($result->AirConditioner==1)
{
?>
<?php } else { ?> 
   <?php } ?>
AntiLock Braking System
<?php if($result->AntiLockBrakingSystem==1)
{
?>
<?php } else {?>
<?php } ?>
   
,Power Steering
<?php if($result->PowerSteering==1)
{
?>
<?php } else { ?>
<?php } ?>
,Power Windows

<?php if($result->PowerWindows==1)
{
?>
<?php } else { ?>
<?php } ?>
                   
,CD Player
<?php if($result->CDPlayer==1)
{
?>
<?php } else { ?>
<?php } ?>
,Leather Seats
<?php if($result->LeatherSeats==1)
{
?>
<?php } else { ?>
<?php } ?>
,Central Locking
<?php if($result->CentralLocking==1)
{
?>
<?php } else { ?>
<?php } ?>
,Power Door Locks
<?php if($result->PowerDoorLocks==1)
{
?>
<?php } else { ?>
<?php } ?>
,Brake Assist
<?php if($result->BrakeAssist==1)
{
?>
<?php  } else { ?>
<?php } ?>
,Driver Airbag
<?php if($result->DriverAirbag==1)
{
?>
<?php } else { ?>
<?php } ?>

,Passenger Airbag
 <?php if($result->PassengerAirbag==1)
{
?>
<?php } else {?>
<?php } ?>
,Crash Sensor
<?php if($result->CrashSensor==1)
{
?>
<?php } else { ?>
<?php } ?></td>
										</tr>
										<?php $cnt=$cnt+1; }} ?>
										
									</tbody>
								</table>

						

							</div>
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
<?php } ?>
