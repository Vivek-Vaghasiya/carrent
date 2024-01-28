<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
	//echo $_REQUEST['eid'];

if(isset($_REQUEST['eid']))
	{
$eid=intval($_GET['eid']);
$status="0";
$sql = "UPDATE tblbooking SET status=:status WHERE  bookingid=:eid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
$query -> execute();

$msg="Booking Cancle Successfully";
}
//echo $_REQUEST['aeid'];

if(isset($_REQUEST['aeid']))
{
$aeid=intval($_GET['aeid']);
$status=1;

$sql = "UPDATE tblbooking SET status=:status WHERE bookingid=:aeid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
$query -> execute();
$msg="Booking Confirm Successfully";
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

						<h2 class="page-title">Manage Car Details</h2>

						<div class="panel panel-default">
							<div class="panel-heading">Car Details</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
										<th>Customer Name</th>
										<th>Posting Date</th>
										<th>Car Brand</th>
									    <th>Car images</th>
                                        <th>From Date</th>
										<th>To Date</th>
									    <th>Status</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
										<th>#</th>
										<th>Customer Name</th>
										<th>Posting Date</th>
										<th>Car Brand</th>
									    <th>Car images</th>
                                        <th>From Date</th>
										<th>To Date</th>
										<th>Status</th>
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
									
									$sql = "SELECT * FROM tblcar where ownerid=$resut->ownerid";
									// $sql = "SELECT * FROM tblbooking JOIN tblcar ON tblbooking.carid = tblcar.carid";
$query = $dbh -> prepare($sql);
$query->execute();
//Print_r($query);
$results=$query->fetchAll(PDO::FETCH_OBJ);

foreach($results as $result)
{	
	//echo $result->carid;	
	$sql1 = "SELECT fromdate,todate,postingdate,status,bookingid,customerid from tblbooking where carid='$result->carid'";
	//print_r($sql1);
	$query1 = $dbh -> prepare($sql1);
    $query1->execute();
    $results1=$query1->fetchAll(PDO::FETCH_OBJ); 
    foreach($results1 as $result1)
    {
		$sql2 = "SELECT fullname from tblcust where customerid='$result1->customerid'";
		//print_r($sql2);
		$query2 = $dbh -> prepare($sql2);
		$query2->execute();
		$results2=$query2->fetchAll(PDO::FETCH_OBJ); 
		foreach($results2 as $result2)
		{
	?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result2->fullname);?></td>
											<td><?php echo htmlentities($result1->postingdate);?></td>
											<td><?php echo htmlentities($result->carbrand);?></td>
											<td><img style="" src="admin/img/vehicleimages/<?php echo htmlentities($result->carimage1);?>" alt="image"></td>
	                                        <td><?php echo htmlentities($result1->fromdate);?></td>
											<td><?php echo htmlentities($result1->todate);?></td>
											<td><?php
											//$new=$result->status;
											 if($result1->status==0)
{
	?><a href="bookingcar.php?aeid=<?php echo htmlentities($result1->bookingid);?>" onclick="return confirm('Do you really want to Cancel')">Confirm</a>
<?php } 
if($result1->status==1){
?>

<a href="bookingcar.php?eid=<?php echo htmlentities($result1->bookingid);?>" onclick="return confirm('Do you really want to Confirm')"> Cancel</a>
</td>
<?php } ?></td>
										</tr>
										<?php   $cnt=$cnt+1;} }}} ?>
										
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
