<?php 

	$aId = base64_decode($_GET['aId']);
	$photo = base64_decode($_GET['photo']);
	if(mysqli_query($db_con,"DELETE FROM `admin` WHERE `aId` = '$aId'")){
		unlink('../userimages/'.$photo);
		header('Location: admin.php?page=admin-all-admins&delete=success');
	}else{
		header('Location: admin.php?page=admin-all-admins&delete=error');
	}
?>