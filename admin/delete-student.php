<?php 
	$sId = base64_decode($_GET['sId']);
	$photo = base64_decode($_GET['photo']);
	if(mysqli_query($db_con,"DELETE FROM `student` WHERE `sId` = '$sId'")){
		unlink('../userimages/'.$photo);
		header('Location: admin.php?page=all-student&delete=success');
	}else{
		header('Location: admin.php?page=all-student&delete=error');
	}
?>