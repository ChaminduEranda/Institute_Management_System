<?php 
	$pId = base64_decode($_GET['pId']);
	
	if(mysqli_query($db_con,"DELETE FROM `payment` WHERE `pId` = '$pId'")){
		header('Location: admin.php?page=payment&delete=succes');
	}else{
		header('Location: admin.php?page=payment&delete=erro');
	}
?>