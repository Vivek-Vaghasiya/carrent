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

	if(isset($_POST['submit1']))
   {
	$mailid=$_SESSION['alogin'];
	$vtype=$_POST['vehicletype'];
	$vmodel=$_POST['vehiclemodel'];
	$postadddate=$_POST['adddate'];
	// echo $postadddate;
	
	// $date = date('Y-m-d', strtotime($postadddate));

	$date=$postadddate;
	// echo "<br>mysql date is ". $date;


	// die();
//	$owner_id=$_POST['ownerid'];
	$puc=$_FILES["puc"]["name"];
	$rcbook=$_FILES["rcbook"]["name"];



	
$oemail = $_SESSION['alogin'];
// $get_id="SELECT ownerid FROM tblowner WHERE owneremail=maheshbhai@gmail.com";
// $query = $dbh->prepare($get_id);
// // $query->bind_param("i", $owneremail);
// $query->execute();
// $result = $query->get_result();
// $owner_id = $result->fetch_assoc();
// echo "Owner ID IS ". $owner_id;



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




	// $ownermail=trim($mailid);
	
//echo $query["ownername"];
//echo $get_id;
//$query2->bindParam('i',$mailid, PDO::PARAM_STR);
//$query2->execute();
//echo $query;
//$results=$query2->fetchAll(PDO::FETCH_OBJ);
//echo $results;
//echo $results;
//echo $results;
	move_uploaded_file($_FILES["puc"]["tmp_name"],"img/vehicleimages/".$_FILES["puc"]["name"]);
	move_uploaded_file($_FILES["rcbook"]["tmp_name"],"img/vehicleimages/".$_FILES["rcbook"]["name"]);
	$sql="INSERT INTO tblvehicle1(vehicletype,vehiclemodel,adddate,puc,rcbook,ownerid) VALUES('$vtype','$vmodel','$date','$puc','$rcbook',$owner_id)";
    // echo $sql;
	$query = $dbh->prepare($sql);
	// $query->bindParam(':ownerid',$vr,PDO::PARAM_STR);
    $query->bindParam(':vehicletype',$vtype,PDO::PARAM_STR);
    $query->bindParam(':vehiclemodel',$vmodel,PDO::PARAM_STR);
	$query->bindParam(':adddate',$date,PDO::PARAM_STR);
	$query->bindParam(':puc',$puc,PDO::PARAM_STR);
	$query->bindParam(':rcbook',$rcbook,PDO::PARAM_STR);
	$query->bindParam(':ownerid',$owner_id,PDO::PARAM_STR);
	$query->execute();
	//print_r($query);
    $lastInsertId = $dbh->lastInsertId();
	//print_r($lastInsertId);
    if($lastInsertId)
    {
        //$msg="Vehicle posted successfully";
		
		$msql1 ="SELECT vehicletype FROM tblvehicle1 WHERE vehicleid='$lastInsertId'";
        $quers= $dbh->prepare($msql1);
        $quers-> bindParam(':vid', $vehicleid, PDO::PARAM_STR);
        $quers-> execute();
        
        $resuls=$quers->fetchAll(PDO::FETCH_OBJ);
		//print_r($resuls);
		//print_r($resuls[0]->vehicletype);
	   if($resuls[0]->vehicletype == "bike")
       {
		  $_SESSION['vid'] = $lastInsertId;
          $vehicleid =$_SESSION['vid'];
		  header('location:bikeform.php');
		  //echo $_SESSION['vid'];
           //echo "bike";
      } 
	 else{
		//echo $results[0]->vehicletype;
		  $_SESSION['vid'] = $lastInsertId;
          $vehicleid =$_SESSION['vid'];
		//echo $_SESSION['vid'];
		//echo "car";
		 header('location:carform.php');
	 }
		// die();
    }
   else 
   {
        $error="Something went wrong. Please try again ". $mysqli -> connect_error;
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
	
	<title>Rent Smart | Owner Post Vehicle</title>

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
					
						<h2 class="page-title">Post A Vehicle</h2>

		
						<div class="row Vehicle">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Add Vehicle</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                             <div class="panel-body">
                                   
							 <form method="post" class="form-horizontal" enctype="multipart/form-data">
<div class="form-group">
                        <div class="row">
						        <label class="col-sm-2 control-label">Vehicle Type</label>
							    <label class="col-md-1"><h4><input type="radio" name="vehicletype" class="label-control" value="car"> Car</h4></label>
                                <label class="col-md-1"><h4><input type="radio" name="vehicletype" class="label-control" value="bike"> Bike</h4></label>
                        </div>


</div>
											
<?php


?>



<div class="form-group">
<label class="col-sm-2 control-label">Add Date</label>
<div class="col-sm-4">
<input type="date" name="adddate" class="form-control" required>
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Vehicle Model</label>
<div class="col-sm-4">
<input type="text" name="vehiclemodel" class="form-control" required>
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
PUC <span style="color:red">*</span><input type="file" name="puc" required>
</div>
<div class="col-sm-4">
RC Book<span style="color:red">*</span><input type="file" name="rcbook" required>
</div>

</div>
<div>
	<input type="hidden" name="hidden_ownerid" value="">
</div>
<div class="hr-dashed"></div>
<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<button class="btn btn-default" type="reset">Cancel</button>
													<button class="btn btn-primary" name="submit1" type="submit">Submit and next</button>
												</div>
											</div>									
</div>
</div>
</div>
</div>
							
													
<!-- 
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-body"> -->


										</form>
<!--                            
							</div>
                          </div>
                          </div>
                         </div> -->

            
<!-- <div class="car selectt">
			<?php 
			//  include('includes/carform.php');
			 ?>			
</div>
<div class="bike selectt">
         <?php 
		//   include('includes/bikeform.php');
		  ?>	
</div> -->

			</div>
		</div>
	</div>
<script type="text/javascript">
	$(document).ready(function(){
		//alert ("hii");
		$('input[type="radio"]').click(function() {
			var inputValue = $(this).attr("value");
			var targetBox = $("." + inputValue);
			$(".selectt").not(targetBox).hide();
			$(targetBox).show();
			//alert("Radio button " + inputValue + " is selected");
		});
	});  
</script>
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