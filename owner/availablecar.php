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
$sql = "delete from tblcar  WHERE carid=:carid";
$query = $dbh->prepare($sql);
$query -> bindParam(':carid',$id, PDO::PARAM_STR);
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
	
	<title>Rent Smart |Owner Manage</title>

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

						<h2 class="page-title">Dispaly Available Car Details</h2>

						<div class="panel panel-default">
							<div class="panel-heading">Available Car Details</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
										<th>Car Brand</th>
										<th>Car Image</th>
									    <th>Fuel Type</th>
									    <th>Model Year</th>
                                        <th>Seating Capacity</th>
										<th>Per Date Rate</th>
										<th>Car Overview</th>
										<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
										<th>#</th>
										<th>Car Brand</th>
										<th>Car Image</th>
									    <th>Fuel Type</th>
									    <th>Model Year</th>
                                        <th>Seating Capacity</th>
										<th>Per Date Rate</th>
										<th>Car Overview</th>
										<th>Action</th>
										</tr>
										</tr>
									</tfoot>
									<tbody>

									<?php 
									$var=$_SESSION['alogin'];
									$sql1="select ownerid from tblowner where owneremail='$var'";
									$query1 = $dbh -> prepare($sql1);
                                    $query1->execute();
									$resul=$query1->fetchAll(PDO::FETCH_OBJ);
									$cnt=1;
                                   if($query->rowCount() > 0)
                                   {
									foreach($resul as $resut)
                                    { 
										//echo ($resut->ownerid);
									}
									$sq1="select vehicleid from tblvehicle1 where statu=1";
									$que1 = $dbh -> prepare($sq1);
                                    $que1->execute();
									$resu=$que1->fetchAll(PDO::FETCH_OBJ);
									foreach($resu as $resu1)
                                    { 
									   $var1=$resu1->vehicleid;
									
									//echo ($resu1->vehicleid);
									//Print_r($resul);
									$sql = "SELECT * from  tblcar where vehicleid=$var1 and ownerid=$resut->ownerid";
									//Print_r($sql);
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
//print_r($results);

foreach($results as $result)
{
	//print_r($result);				?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result->carbrand);?></td>
											<td><img src="admin/img/vehicleimages/<?php echo htmlentities($result->carimage1);?>" class="img-responsive" alt="image"></td>
											<td><?php echo htmlentities($result->fueltype);?></td>
											<td><?php echo htmlentities($result->modelyear);?></td>
	                                        <td><?php echo htmlentities($result->seatingcapacity);?></td>
											<td><?php echo htmlentities($result->priceperday);?></td>
											<td><?php echo htmlentities($result->caroverview);?></td>
		<td><a href="edit-car.php?carid=<?php echo $result->carid;?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
<a href="availablecar.php?del=<?php echo $result->carid;?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-close"></i></a></td>
										</tr>
										<?php $cnt=$cnt+1; } }} ?>
										
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
