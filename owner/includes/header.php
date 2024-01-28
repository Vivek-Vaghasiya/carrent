<?php
$sql = "SELECT * from tblowner";
$query = $dbh->query($sql);
//echo $query["ownername"];
$query->bindParam(':ownerid',$ownerid, PDO::PARAM_STR);
$query->execute();
//echo $query;
$results=$query->fetchAll(PDO::FETCH_OBJ);
// echo $results;
?>
<div class="brand clearfix">
	<a href="dashboard.php" style="font-size:42px;margin-left: 50px;"><?php 
	echo $_SESSION['alogin'];?></a>  
		<span class="menu-btn"><i class="fa fa-bars"></i></span>
		<ul class="ts-profile-nav">
			
			<li class="ts-account">
				<a href="#"><img src="img/ts-avatar.jpg" class="ts-avatar hidden-side" alt=""> Account <i class="fa fa-angle-down hidden-side"></i></a>
				<ul>
					<li><a href="change-password.php">Change Password</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>

	

