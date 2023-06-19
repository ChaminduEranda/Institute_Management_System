<?php 
	$tid = base64_decode($_GET['tutor_id']);
	$cid = base64_decode($_GET['class_id']);
	
	if(mysqli_query($db_con,"DELETE FROM `tutor_enroll` WHERE `tutor_id` = '$tid' AND `class_id`='$cid';")){
		header('Location: admin.php?page=enroll-tutor&delete=succes');
	}else{
		header('Location: admin.php.php?page=enroll-tutor&delete=erro');
	}

?>