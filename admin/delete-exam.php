
<?php 
session_start();
if (isset($_SESSION['user_login'])) {
	$exam_id = base64_decode($_GET['exam_id']);
	
	if(mysqli_query($db_con,"DELETE FROM `exam` WHERE `exam_id` = '$exam_id'")){
		header('Location: admin.php?page=add-exam&delete=succes');
	}else{
		header('Location: admin.php.php?page=add-exam&delete=erro');
	}
}else{
	header('Location: login.php');
 }
