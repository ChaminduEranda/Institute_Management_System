<?php
$user =  $_SESSION['user_login'];
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'admin.php') {
  if ($corepage == $corepage) {
    $corepage = explode('.', $corepage);
    header('Location: admin.php?page=' . $corepage[0]);
  }
}

$aId = base64_decode($_GET['aId']);
  if (isset($_POST['userupdate'])) {
  	$name = $_POST['name'];
  	$email = $_POST['email'];


  	$query = "UPDATE `admin` SET `name`='$name',`email`='$email' WHERE `aId`= $aId";
  	if (mysqli_query($db_con,$query)) {
  		$datainsert['insertsucess'] = '<p style="color: green;">User Updated!</p>';
  		header('Location: admin.php?page=admin-user-profile&edit=success');
  	}else{
  		header('Location: admin.php?page=admin-user-profile&edit=error');
  	}
  }
?>
<h1 class="text-primary"><i class="fas fa-user-plus"></i>  Edit Your Profile!<small class="text-warning"> Edit Profile!</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="admin.php">Dashboard </a></li>
     <li class="breadcrumb-item" aria-current="page"><a href="admin.php?page=admin-user-profile">User Profile </a></li>
     <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
  </ol>
</nav>

	<?php
		if (isset($aId)) {

			$query = "SELECT  `name`, `email`  FROM `admin` WHERE `aId`='$aId'";
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