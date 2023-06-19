<?php 
$user=  $_SESSION['user_login'];
  $corepage = explode('/', $_SERVER['PHP_SELF']);
    $corepage = end($corepage);
    if ($corepage!=='student.php') {
      if ($corepage==$corepage) {
        $corepage = explode('.', $corepage);
       header('Location: student.php?page='.$corepage[0]);
     }
    }


$sId = base64_decode($_GET['sId']);
  if (isset($_POST['userupdate'])) {
  	$name = $_POST['name']; 
  	$email = $_POST['email'];


  	$query = "UPDATE `student` SET `name`='$name', `email`='$email' WHERE `sId`= '$sId';";
  	if (mysqli_query($db_con,$query)) {
  		$datainsert['insertsucess'] = '<p style="color: green;">User Updated!</p>';
  		header('Location: student.php?page=student-user-profile&edit=success');
  	}else{
  		header('Location: student.php?page=student-user-profile&edit=error');
  	}
  }
?>
<h1 class="text-primary"><i class="fas fa-user-plus"></i>  Edit Your Profile!<small class="text-warning"> Edit Profile!</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="student.php">Dashboard </a></li>
     <li class="breadcrumb-item" aria-current="page"><a href="student.php?page=student-userprofile">User Profile </a></li>
     <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
  </ol>
</nav>

	<?php
		if (isset($sId)) {

			$query = "SELECT  *  FROM `student` WHERE `sId`='$sId';";
			$result = mysqli_query($db_con,$query);
			$row = mysqli_fetch_array($result);
		}
	 ?>
<div class="row">
<div class="col-sm-6">
	<form enctype="multipart/form-data" method="POST" action="">
		<div class="form-group">
		    <label for="name">Full Name</label>
		    <input name="name" type="text" class="form-control" id="name" value="<?php echo $row['name']; ?>" required="">
	  	</div>
	  	
        <div class="form-group">
		    <label for="email">Email</label>
		    <input name="email" type="email" class="form-control"  id="email" value="<?php echo $row['email']; ?>" required="">
	  	</div>
	  	 

	  	<div class="form-group text-center">
		    <input name="userupdate" value="Update Profile" type="submit" class="btn btn-danger">
	  	</div>
	 </form>
</div>
</div>