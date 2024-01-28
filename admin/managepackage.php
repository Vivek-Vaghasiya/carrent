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
$sql = "UPDATE tblowner SET status=:status WHERE  ownerid=:eid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
$query -> execute();

$msg="Tblowner Successfully Inacrive";
}


if(isset($_REQUEST['aeid']))
	{
$aeid=intval($_GET['aeid']);
$status=1;

$sql = "UPDATE tblowner SET status=:status WHERE  ownerid=:aeid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
$query -> execute();

$msg="Tblowner Successfully Active";
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
	
	<title>Rent Smart |Admin Manage Package Details</title>

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

						<h2 class="page-title">Manage Package Details</h2>

						<div class="panel panel-default">
							<div class="panel-heading">Package Info</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
										<th>Package Name</th>
                                        <th>Package Duration</th>
										<th>Owner Name</th>
										<th>Package Amount</th>
                                        <th>Add Date</th>
										<th>Exp Date</th>
										<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
										<th>#</th>
                                        <th>Package Name</th>
                                        <th>Package Duration</th>
										<th>Owner Name</th>
										<th>Package Amount</th>
                                        <th>Add Date</th>
										<th>Exp Date</th>
										<th>Action</th>
										</tr>
									</tfoot>
									<tbody>

									<?php $sql = "SELECT * from tblowner";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	
	$paselct=$result->packageselect	;
	//echo $paselct;
    $sql1 = "SELECT * from tblpackage where packagename='$paselct'";
	$querys = $dbh -> prepare($sql1);
	$querys->execute();
	//print_r($querys);
	$resul=$querys->fetchAll(PDO::FETCH_OBJ);
	foreach($resul as $resuly)
	{		
		//print_r($resuly->duration);
	
	?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result->packageselect);?></td>
											<td><?php echo htmlentities($resuly->duration);?></td>
											<td><?php echo htmlentities($result->ownername);?></td>
											<td><?php echo htmlentities($resuly->amount);?></td>
											<td><?php echo htmlentities($result->regdate);?></td>
											<td>
												 	   <?php 
												    $rev=$resuly->duration;
												  
												  $da=$result->regdate;
												 // echo $sum=$rev+$da;
												 $date=new DateTime($da);
												
												 date_add($date,date_interval_create_from_date_string($rev));
												 echo date_format($date,"Y-m-d");
												?>
											  </td>
											
										<td><?php if($result->status=="" || $result->status==0)
{
	?><a href="managepackage.php?aeid=<?php echo htmlentities($result->ownerid);?>" onclick="return confirm('Do you really want to Active Package')"> Expired Package</a>
<?php } else { ?>

<a href="managepackage.php?eid=<?php echo htmlentities($result->ownerid);?>" onclick="return confirm('Do you really want to Expired Package')"> Active Package</a>
</td>
<?php } ?></td>																				
										</tr>
										<?php  $cnt=$cnt+1; }}} ?>
										
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




