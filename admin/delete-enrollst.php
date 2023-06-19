<?php 
	$sid = base64_decode($_GET['student_id']);
	$cid = base64_decode($_GET['class_id']);
	
	if(mysqli_query($db_con,"DELETE FROM `student_enroll` WHERE `student_id` = '$sid' AND `class_id`='$cid';")){
		header('Location: admin.php?page=enroll-student&delete=succes');
	}else{
		header('Location: admin.php.php?page=enroll-student&delete=erro');
	}

?>