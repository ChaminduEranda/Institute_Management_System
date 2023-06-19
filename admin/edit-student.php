<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'admin.php') {
	if ($corepage == $corepage) {
		$corepage = explode('.', $corepage);
		header('Location: admin.php?page=' . $corepage[0]);
	}
}

$sId = base64_decode($_GET['sId']);
$oldPhoto = base64_decode($_GET['photo']);

if (isset($_POST['updatestudent'])) {
	$sId = $_POST['sId'];
	$titleName = $_POST['titleName'];
	$name = $_POST['name'];
	$address = $_POST['address'];
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
	$nic = $_POST['nic'];
	$phone = $_POST['phone'];

	if (!empty($_FILES['photo']['name'])) {
		$photo = $_FILES['photo']['name'];
		$photo = explode('.', $photo);
		$photo = end($photo);
		$photo = $sId . '.' . $photo;
	} else {
		$oldPhoto = base64_decode($_GET['photo']);
		$photo = $oldPhoto;
	}

	$key = rand(100, 100000);
	$email = $_POST['email'];
	$query = "UPDATE `student` SET `sId`='$sId',`titleName`='$titleName',`name`='$name',`address`='$address',`dob`='$dob',`gender`='$gender',`nic`='$nic',`phone`='$phone',`photo`='$photo',`email`='$email' WHERE `sId`= '$sId'";
	$query2 = "UPDATE `student_enroll` SET `student_id`='$sId' WHERE `student_id`= '$sId'";
	$result = mysqli_query($db_con, $query);
	$result = mysqli_query($db_con, $query2);
	if ($result) {
		$datainsert['insertsucess'] = '<p style="color: green;">Student Updated!</p>';
		if (!empty($_FILES['photo']['name'])) {
			move_uploaded_file($_FILES['photo']['tmp_name'], '../userimages/' . $photo);
			unlink('../userimages/' . $oldPhoto);
		}
		else{
			move_uploaded_file($_FILES['photo']['tmp_name'], '../userimages/' . $photo);
		}
		header('Location:admin.php?page=all-student&edit=success');
	} else {
		header('Location: admin.php?page=all-student&edit=error');
	}
}

?>

<h1 class="text-primary"><i class="fas fa-user-plus"></i> Edit Student Informations!<small class="text-warning"> Edit Student!</small></h1>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="admin.php">Dashboard </a></li>
		<li class="breadcrumb-item" aria-current="page"><a href="admin.php?page=all-student">All Students </a></li>
		<li class="breadcrumb-item active" aria-current="page">Add Student</li>
	</ol>
</nav>

<?php

if (isset($sId)) {
	$query = "SELECT * FROM `student` WHERE `sId`='$sId'";
	$result = mysqli_query($db_con, $query);
	$row = mysqli_fetch_array($result);
}

?>

<div class="row">
	<div class="col-sm-6">
		<form enctype="multipart/form-data" method="POST" action="">

			<div class="form-group">
				<label for="sId">Student ID</label>
				<input name="sId" type="text" class="form-control" id="sId" value="<?php echo $row['sId']; ?>" required="">
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
				<label for="name">Name</label>
				<input name="name" type="text" class="form-control" id="name" value="<?php echo $row['name']; ?>" required="">
			</div>



			<div class="form-group">
				<label for="address">Address</label>
				<input name="address" type="text" value="<?php echo $row['address']; ?>" class="form-control" id="address" required="">
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
				<label for="nic">NIC</label>
				<input name="nic" type="text" class="form-control" id="nic" value="<?php echo $row['nic']; ?>" >
			</div>

			<div class="form-group">
				<label for="phone">Phone</label>
				<input name="phone" type="text" class="form-control" id="phone" pattern="[0-9]{10}" value="<?php echo $row['phone']; ?>" placeholder="01........." required="">
			</div>


			<div class="form-group">
				<label for="password">Password</label>
				<input name="password" type="text" class="form-control" id="password" value="<?php echo $row['password']; ?>" required="" readonly>
			</div>

			<div class="form-group">
				<label for="photo">Photo</label><br>
				<a href="../userimages/<?php echo $row['photo']; ?>">
					<img class="img-thumbnail" id="imguser" src="../userimages/<?php echo $row['photo']; ?>" width="200px">
				</a>
			</div>

			<div class="form-group">
				<label for="photo">Photo</label>
				<input name="photo" type="file" class="form-control" id="photo">
			</div>

			<div class="form-group">
				<label for="email">Email</label>
				<input name="email" type="text" class="form-control" id="email" value="<?php echo $row['email']; ?>" required="">
			</div>

			<div class="form-group text-center">
				<input name="updatestudent" value="Update Student" type="submit" class="btn btn-danger">
			</div>
		</form>
	</div>
</div>