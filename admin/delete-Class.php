<?php 
	$cId = base64_decode($_GET['cId']);
	
	if(mysqli_query($db_con,"DELETE FROM `class` WHERE `cId` = '$cId'")){
		header('Location: admin.php?page=addClass&delete=succes');
	}else{
		header('Location: admin.php.php?page=addClass&delete=erro');
	}

?>