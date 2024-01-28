<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['register']))
{
  //echo "hii";

  $oname=$_POST['ownername'];
  $oemail=$_POST['owneremail'];
  $pack=$_POST['packageselect']; 
  $gid=$_POST['govermentid'];
  $paytype=$_POST['paymenttype'];
  $omobile=$_POST['ownermobile'];   
  $govfile=$_POST['filepath']; 
  $password=md5($_POST['password']); 
  $sql="INSERT INTO tblowner(ownername,owneremail,packageselect,govermentid,paymenttype,ownermobile,filepath,password) VALUES('$oname','$oemail','$pack','$gid','$paytype','$omobile','$govfile','$password')";
  
  
  $query = $dbh->prepare($sql);
  mysqli_query($conn, $sql);
  $query->bindParam(':ownername',$oname,PDO::PARAM_STR);
  $query->bindParam(':owneremail',$oemail,PDO::PARAM_STR);
  $query->bindParam(':packageselect',$pack,PDO::PARAM_STR);
  $query->bindParam(':govermentid',$gid,PDO::PARAM_STR);
  $query->bindParam(':paymenttype',$paytype,PDO::PARAM_STR);
  $query->bindParam(':ownermobile',$omobile,PDO::PARAM_STR);
  $query->bindParam(':filepath',$govfile,PDO::PARAM_STR);
  $query->bindParam(':password',$password,PDO::PARAM_STR);
  $query->execute();
  $lastInsertId = $dbh->lastInsertId($query);
//   echo 'console.log('. json_encode($query, JSON_HEX_TAG) .')';
  if($lastInsertId)
  {
    echo "<script>alert('Something went wrong. Please try again');</script>";
  }
  else 
  {
  echo "<script>alert('Registration successfull. Now you can login');</script>";
       //echo $oname;
  $sql1 ="SELECT ownerid,regdate from tblowner where ownername='$oname'";
  //print_r($sql1);
  $quer= $dbh->prepare($sql1);
  $quer->execute();
  $resuls=$quer->fetchAll(PDO::FETCH_OBJ);
 // print_r($resuls);
  foreach($resuls as $resut)
   {
    // echo $resut->ownerid;
    }

  $sql2 ="SELECT * from tblpackage where packagename='$pack'";
  $quy= $dbh->prepare($sql2);
  $quy->execute();
  $res=$quy->fetchAll(PDO::FETCH_OBJ);
  //echo $results[];
  //Print_r($res);
  foreach($res as $resu)
   {
     //echo $resu;
    }
    //$duration=$resu->duration;
  // $amount=$resu->amount;
    $rev=$resu->duration;
    
    $da=$resut->regdate;
   // echo $sum=$rev+$da;
   $date=new DateTime($da);
  
   date_add($date,date_interval_create_from_date_string($rev));
   $final=date_format($date,"Y-m-d");
    
  $sql3="INSERT INTO  tblpackagedetail(ownerid,packageid,date,amount,expiredate) VALUES($resut->ownerid,$resu->packageid,$resut->regdate,$resu->amount,$final)";
  $que = $dbh->prepare($sql3);
  //Print_r($que);
  //mysqli_query($conn, $sql1);
  $quey->bindParam(':ownername',$oname,PDO::PARAM_STR);
  $quey->bindParam(':owneremail',$oemail,PDO::PARAM_STR);
  
  $query->execute();
  $lastInsertId = $dbh->lastInsertId($query);

   

  }
  }
?>




<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
$.validator.setDefaults({
		submitHandler: function(form) {
      form.submit();
			// alert("submitted!");
		}
	});

	$().ready(function() { 

		// validate signup form on keyup and submit
		$( "#register" ).validate({
			rules: {
				ownername: {
					required: true,
					minlength: 2
				},
				owneremail: {
					required: true,
					email: true
				},
        packageselect: {
          required: true
        },
				paymenttype: {
					required: true,
					email: true,
          number: false
				},
				ownermobile: {
					required: true,
					number: true,
          minlength: 10,
          maxlength: 10
				},
        govermentid: {
          required: true
        };
        password: {
					required: true,
					minlength: 5
				}
			},
			messages: {
				ownername: {
					required: "* Please enter a ownername",
					minlength: "* Your username must consist of at least 2 characters"
				},
        owneremail: "* Please enter a valid email address",
        packageselect: "* Please select pakcage",
        paymenttype: {
					required: "* Please enter a valid payment type",
					minlength: "* Your username must not consist number."
				},
        ownermobile: {
					required: "* Please enter a mobile number",
					minlength: "* Your mobile number must be 10 numbers",
          maxlength: "* Your mobile number must be 10 numbers"
				},
        govermentid: "* Please select government id",
				password: {
					required: "* Please provide a password",
					minlength: "* Your password must be at least 5 characters long"
				}
			}
		});
	});

</script>



<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Rent Smart | Owner Login</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="login-page bk-img" style="background-image: url(img/login-bg.jpg);">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h1 class="text-center text-bold text-light mt-1x">Owner Registration</h1>
						<div class="well row pb-1x pt-1x bk-light" style="margin-left: -100px; margin-right: -100px;">
							<div class="col-md-8 col-md-offset-2">



              <style>

.error{
  color: red;
  font-weight: 600;
}
</style>
            

                            <form  method="post" name="register" id="register" onSubmit="return valid();">
                                <div class="row">
                                       <div class="col-md-6">
                                       <div class="form-group">
                                           <input type="text" class="form-control" name="ownername" id="ownername" placeholder="Full Name" required>
                                          </div>
                                       </div>
                                       <div class="col-md-6">
                                       <div class="form-group">
                                         
                                           <input type="text" class="form-control" name="owneremail" id="owneremail" placeholder="Enter Email" required>
                                       </div>
                                       </div>
                                </div>
                                <div class="row">
                                       <div class="col-md-12">
                                       <div class="form-group">
                                           <p3>Package Select<span style="color:red">*</span></p3>
                                        </div>
                                       </div>
                                </div>
                                <div class="row">
                                       <?php
                                                  $sql ="SELECT * from tblpackage where status='1'";
                                                  $query= $dbh->prepare($sql);
                                                  $query->execute();
                                                  //echo $query;
                                                  $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                  //echo $results[];
                                                  foreach($results as $result)
                                                   {
                                                   
                                                   
                                       ?>
                                            <div class="col-md-1">
                                                <input type="radio" value="<?php echo htmlentities($result->packagename);?>" class="form-control" name="packageselect" id="packageselect" required>
                                            </div>
                                            <div class="col-md-3">
                                                <p3><?php echo htmlentities($result->packagename);?></p3><br>
                                                <p3><?Php echo htmlentities($result->duration);?></p3><br>
                                                <p3><?php echo htmlentities($result->amount);?></p3><br>
                                            </div>
                                       
                                       <?php }?>
                                            
                                </div>
                                <br>
                
                                <div class="row">
                                       <div class="col-md-6">
                                       <div class="form-group">
                                        
                                           <input type="text" class="form-control" name="paymenttype" id="paymenttype" placeholder="Payment Type" required>
                                          
                                       </div>
                                       </div>
                                       <div class="col-md-6">
                                       <div class="form-group">
                                
                                           <input type="text" class="form-control" name="ownermobile" id="ownermobile" placeholder="Enter mobile number" required>
                                            
                                       </div>
                                       </div>
                                </div>

                
                <div class="row">
                                       <div class="col-md-12">
                                       <div class="form-group">
                                           <p3>Government id (choose anyone)<span style="color:red">*</span></p3>
                                        </div>
                                       </div>
                                </div>
                                <div class="row">
                                <div class="form-group">
<div class="col-sm-4">
Government ID: <select name="govermentid" id="govermentid" required>
    <option value="Driving Licence">Driving Licence</option>
    <option value="Aadhar Card">Aadhar Card</option>
    <option value="Pan Card">Pan Card</option>
  </select>
</div><br>
<div class="col-sm-4">
<input type="file" name="filepath" values="">
</div>
</div><br>
<div class="form-group">
                                           <input type="text" class="form-control" name="password" id="password" placeholder="Enter password" required>
                                      
                                       </div>

                                </div>
                <div class="form-group checkbox">
                    <input type="checkbox" id="terms_agree" required checked="">
                    <label for="terms_agree">I Agree with <a href="#">Terms and Conditions</a></label>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <input type="submit" value="Register" name="register" id="register" class="btn btn-dark btn-block">
                    </div>
                </div>
              </form>
								
							</div>
						</div>
						<div class="text-center text-light">
							<h4><a href="index.php" class="text-light">Login Owner Here</a></h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- <script src="js/jquery.min.js"></script> -->
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