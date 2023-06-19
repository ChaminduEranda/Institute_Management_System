<?php 
	$cId = base64_decode($_GET['cId']);
	$schedule = base64_decode($_GET['schedule']);
	if(mysqli_query($db_con,"UPDATE `class` SET `schedule` = null WHERE `cId` = '$cId'")){
		unlink('../files/'.$schedule);
		header('Location: admin.php?page=schedule&delete=succes');
	}else{
		header('Location: admin.php?page=schedule&delete=erro');
	}
?>

