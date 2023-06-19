<?php 
	$tId = base64_decode($_GET['tId']);
	$photo = base64_decode($_GET['photo']);
	if(mysqli_query($db_con,"DELETE FROM `tutor` WHERE `tId` = '$tId'")){
		unlink('../userimages/'.$photo);
		header('Location: admin.php?page=admin-all-instructors&delete=success');
	}else{
		header('Location: admin.php?page=admin-all-instructors&delete=error');
	}
?>