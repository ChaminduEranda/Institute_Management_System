<?php 
	$tId = base64_decode($_GET['tId']);
	$nic = base64_decode($_GET['nic']);
	$key = rand(100, 100000);
	$password = $nic . '@' . $key;
	if(mysqli_query($db_con,"UPDATE `tutor` SET `password`  = '$password' WHERE `tId`='$tId';")){
		$abc = mysqli_query($db_con, "SELECT * FROM `tutor` WHERE  `tId`='$tId';");
		$def = mysqli_fetch_assoc($abc);
		echo '<h4>tutor New Password is <b> '.$def['password'].' </br></h4>';
		echo '<a class="btn btn-xs btn-warning" href="admin.php?page=password-reset">OK</a>';
	}else{
		header('Location: admin.php?page=password-reset&reset=error');
	}
?>