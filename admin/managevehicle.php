<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_REQUEST['eid']))
	{
$eid=intval($_GET['eid']);
$status="0";
$sql = "UPDATE tblvehicle1 SET statu=:statu WHERE  vehicleid=:eid";
$query = $dbh->prepare($sql);
$query -> bindParam(':statu',$status, PDO::PARAM_STR);
$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
$query -> execute();

$msg="Vehicle Successfully Inactive";
}


if(isset($_REQUEST['aeid']))
	{
$aeid=intval($_GET['aeid']);
$status=1;

$sql = "UPDATE tblvehicle1 SET statu=:statu WHERE  vehicleid=:aeid";
$query = $dbh->prepare($sql);
$query -> bindParam(':statu',$status, PDO::PARAM_STR);
$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
$query -> execute();

$msg="Vehicle Successfully Active";
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
	
	<title>Rent Smart |Admin Manage Vehicle  </title>

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

						<h2 class="page-title">Manage Vehicle Details</h2>

						<div class="panel panel-default">
							<div class="panel-heading">Vehicle Info</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
                                        <th>Owner Name</th>
										<th>Vehicle Type</th>
										<th>Vehicle Model</th>
										<th>Reg Date</th>
										<th>PUC</th>
										<th>RC Book</th>
                                        <th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
										<th>#</th>
                                        <th>Owner Name</th>
										<th>Vehicle Type</th>
										<th>Vehicle Model</th>
										<th>Reg Date</th>
										<th>PUC</th>
										<th>RC Book</th>
                                        <th>Action</th>
										</tr>
									</tfoot>
									<tbody>

									<?php 
									$sql = "SELECT * from tblvehicle1 INNER JOIN tblowner ON tblvehicle1.ownerid=tblowner.ownerid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
	//echo $cnt;
foreach($results as $result)
{			
	//echo $result->vehicleid;	?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result->ownername);?></td>
											<td><?php echo htmlentities($result->vehicletype);?></td>
											<td><?php echo htmlentities($result->vehiclemodel);?></td>
											<td><?php echo htmlentities($result->adddate);?></td>
											<td><?php echo htmlentities($result->puc);?></td>
											<td><?php echo htmlentities($result->rcbook);?></td>
										<td><?php if($result->statu=="" || $result->statu==0)
{
	?><a href="managevehicle.php?aeid=<?php echo htmlentities($result->vehicleid);?>" onclick="return confirm('Do you really want to Active')"> Inactive</a>
<?php } else {?>

<a href="managevehicle.php?eid=<?php echo htmlentities($result->vehicleid);?>" onclick="return confirm('Do you really want to Inactive')"> Active</a>
</td>
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

