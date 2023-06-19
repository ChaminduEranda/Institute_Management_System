<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'admin.php') {
	if ($corepage == $corepage) {
		$corepage = explode('.', $corepage);
		header('Location: admin.php?page=' . $corepage[0]);
	}
}

$tId = base64_decode($_GET['tId']);
$oldPhoto = base64_decode($_GET['photo']);

if (isset($_POST['updateinstructor'])) {
	$tId = $_POST['tId'];
	$titleName = $_POST['titleName'];
	$name = $_POST['name'];
	$address = $_POST['address'];
	$nic = $_POST['nic'];
	$phone = $_POST['phone'];
	$password = $_POST['password'];
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];

	if (!empty($_FILES['photo']['name'])) {
		$photo = $_FILES['photo']['name'];
		$photo = explode('.', $photo);
		$photo = end($photo);
		$photo = $tId . '.' . $photo;
	} else {
		$oldPhoto = base64_decode($_GET['photo']);
		$photo = $oldPhoto;
	}

	$email = $_POST['email'];
	

	$query = "UPDATE `tutor` SET `tId`='$tId',`titleName`='$titleName',`name`='$name',`address`='$address',`nic`='$nic',`phone`='$phone',`dob`='$dob',`gender`='$gender',`photo`='$photo',`email`='$email' WHERE `tId`= '$tId'";
	$query2 = "UPDATE `tutor_enroll` SET `tutor_id`='$tId' WHERE `tutor_id`= '$tId'";
	$result = mysqli_query($db_con, $query);
	$result = mysqli_query($db_con, $query2);
	if ($result) {
		$datainsert['insertsucess'] = '<p style="color: green;">Tutor Updated!</p>';
		if (!empty($_FILES['photo']['name'])) {
			move_uploaded_file($_FILES['photo']['tmp_name'], '../userimages/' . $photo);
			unlink('../userimages/' . $oldPhoto);
		}
		header('Location: admin.php?page=all-tutors&edit=success');
	} else {
		header('Location: admin.php?page=all-tutors&edit=error');
	}
}
?>
<h1 class="text-primary"><i class="fas fa-user-plus"></i> Edit Tutor Informations!<small class="text-warning"> Edit Tutor!</small></h1>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="admin.php">Dashboard </a></li>
		<li class="breadcrumb-item" aria-current="page"><a href="admin.php?page=all-tutors">All Tutors </a></li>
		<li class="breadcrumb-item active" aria-current="page">Add Tutor</li>
	</ol>
</nav>

<?php
if (isset($tId)) {
	$query = "SELECT * FROM `tutor` WHERE `tId`='$tId'";
	$result = mysqli_query($db_con, $query);
	$row = mysqli_fetch_array($result);
}
?>

<?php

$query = "SELECT * FROM `subject`";
$result1 = mysqli_query($db_con, $query);


?>

<div class="row">
	<div class="col-sm-6">
		<form enctype="multipart/form-data" method="POST" action="">

		
		<div class="form-group">
		    <label for="tId">Tutor ID</label>
		    <input name="tId" type="text" class="form-control" id="tId" value="<?php echo $row['tId']; ?>" required="">
	  	</div>

			<div class="form-group">
				<label for="titleName">Title</label>
				<select name="titleName" class="form-control" id="titleName" required="">
					<option value="<?php echo $row['titleName']; ?>"><?php echo $row['titleName']; ?></option>
					<option value="Mr.">Mr.</option>
					<option value="Ms.">Ms.</option>
					<option value="Mrs.">Mrs.</option>
				</select>
			</div>

			<div class="form-group">
				<label for="name">First Name</label>
				<input name="name" type="text" class="form-control" id="name" value="<?php echo $row['name']; ?>" required="">
			</div>

			<div class="form-group">
				<label for="address">Address</label>
				<input name="address" type="text" value="<?php echo $row['address']; ?>" class="form-control" id="address" required="">
			</div>


			<div class="form-group">
				<label for="nic">NIC</label>
				<input name="nic" type="text" class="form-control" id="nic" value="<?php echo $row['nic']; ?>" required="">
			</div>


			<div class="form-group">
				<label for="phone">Contact NO</label>
				<input name="phone" type="text" class="form-control" id="phone" pattern="[0-9]{10}" value="<?php echo $row['phone']; ?>" placeholder="01........." required="">
			</div>

		

			<div class="form-group">
				<label for="password">Password</label>
				<input name="password" type="text" class="form-control" id="password" value="<?php echo $row['password']; ?>" required="" readonly>
			</div>

			<div class="form-group">
				<label for="dob">Date Of Birth</label>
				<input name="dob" type="date" class="form-control" id="dob" value="<?php echo $row['dob']; ?>" required="">
			</div>


			<div class="form-group">
				<label for="gender">Gender</label>
				<select name="gender" class="form-control" id="gender" required="">
				    <option value="<?php echo $row['gender']; ?>"><?php echo $row['gender']; ?></option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
					<option value="Other">Other</option>
				</select>
			</div>


			<div class="form-group">
				<label for="photo">Photo</label><br>
				<a href="../userimages/<?php echo $row['photo']; ?>">
					<img class="img-thumbnail" id="imguser" src="../userimages/<?php echo $row['photo']; ?>" width="200px">
				</a>
			</div>

			<div class="form-group">

				<input name="photo" type="file" class="form-control" id="photo">
			</div>

			<div class="form-group">
				<label for="email">Email</label>
				<input name="email" type="text" class="form-control" id="email" value="<?php echo $row['email']; ?>" required="">
			</div>


			<div class="form-group text-center">
				<input name="updateinstructor" value="Update Tutor" type="submit" class="btn btn-danger">
			</div>
		</form>
	</div>
</div>