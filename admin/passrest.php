<?php 
	$sId = base64_decode($_GET['sId']);
	$key = rand(100, 100000);
	$password = $key . '@' . $key;
	if(mysqli_query($db_con,"UPDATE `student` SET `password`  = '$password',`status` = '-1' WHERE `sId`='$sId';")){
		$abc = mysqli_query($db_con, "SELECT * FROM `student` WHERE  `sId`='$sId';");
		$def = mysqli_fetch_assoc($abc);
		echo '<h4>Student New Password is <b> '.$def['password'].' </br></h4>';
		echo '<a class="btn btn-xs btn-warning" href="admin.php?page=password-reset">OK</a>';
	}else{
		header('Location: admin.php?page=password-reset&reset=error');
	}
?>