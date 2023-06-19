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

if (isset($_POST['stuconfirm'])) {

	$confirm = $_POST['confirm'];

	$query = "UPDATE `student` SET `status`='$confirm' WHERE `student`.`sId`= '$sId'";
	if (mysqli_query($db_con, $query)) {
		$datainsert['insertsucess'] = '<p style="color: green;">Student Status Changed!</p>';
	} else {
		$datainsert['inserterror'] = '<p style="color: green;">Student Status Not Changed!</p>';
	}
}

?>

<h1 class="text-primary"><i class="fas fa-user-plus"></i> Student Full Information!<small class="text-warning"> Student Full Info!</small></h1>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="admin.php">Dashboard </a></li>
		<li class="breadcrumb-item" aria-current="page"><a href="admin.php?page=allStudents">All Students </a></li>
		<li class="breadcrumb-item active" aria-current="page">Full Info</li>
	</ol>
</nav>

<?php if (isset($datainsert)) { ?>
	<div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
		<div class="toast-header">
			<strong class="mr-auto">Student Insert Alert</strong>
			<small><?php echo date('d-M-Y'); ?></small>
			<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="toast-body">
			<?php
			if (isset($datainsert['insertsucess'])) {
				echo $datainsert['insertsucess'];
			}
			if (isset($datainsert['inserterror'])) {
				echo $datainsert['inserterror'];
			}
			?>
		</div>
	</div>
<?php } ?>

<?php
if (isset($sId)) {
	$query = "SELECT * FROM `student` WHERE `sId`='$sId'";
	$result = mysqli_query($db_con, $query);
	$row = mysqli_fetch_array($result);
}
?>

<?php if ($row['status'] == 1) { ?>
	<?php echo '<h4><b>Current Status </b></h4><span class="label success"><b>Active</b></span>' ?> <?php } else if ($row['status'] == -1) { ?>
	<?php echo '<h4><b>Current Status </b></h4><span class="label info"><b>New</b></span>' ?><?php } else if ($row['status'] == 0) { ?>
	<?php echo '<h4><b>Current Status </b></h4><span class="label danger"><b>Deactivated</b></span>' ?>
<?php } ?>
<br><br>
<div class="row">
	<div class="col-sm-6">
		<form enctype="multipart/form-data" method="POST" action="">

			<div class="form-group">
				<label for="sId">Student ID</label>
				<input name="sId" type="text" class="form-control" id="sId" value="<?php echo $row['sId']; ?>" disabled>
			</div>



			<div class="form-group">
				<label for="titleName">Title</label>
				<input name="titleName" type="text" class="form-control" id="name" value="<?php echo $row['titleName']; ?>" disabled>
			</div>

			<div class="form-group">
				<label for="name">Name</label>
				<input name="name" type="text" class="form-control" id="name" value="<?php echo $row['name']; ?>" disabled>
			</div>



			<div class="form-group">
				<label for="address">Address</label>
				<input name="address" type="text" value="<?php echo $row['address']; ?>" class="form-control" id="address" disabled>
			</div>

			<div class="form-group">
				<label for="dob">Date Of Birth</label>
				<input name="dob" type="date" class="form-control" id="dob" value="<?php echo $row['dob']; ?>" disabled>
			</div>


			<div class="form-group">
				<label for="gender">Gender</label>
				<input name="gender" type="text" class="form-control" id="gender" value="<?php echo $row['gender']; ?>" disabled>

			</div>

			<div class="form-group">
				<label for="nic">NIC</label>
				<input name="nic" type="text" class="form-control" id="nic" value="<?php echo $row['nic']; ?>" disabled>
			</div>




			<div class="form-group">
				<label for="phone">Phone</label>
				<input name="phone" type="text" class="form-control" id="phone" pattern="[0-9]{10}" value="<?php echo $row['phone']; ?>" disabled>
			</div>


			<div class="form-group">
				<label for="password">Password</label>
				<input name="password" type="text" class="form-control" id="password" value="<?php echo $row['password']; ?>" disabled>
			</div>



			<div class="form-group">
				<label for="photo">Photo</label><br>
				<a href="../userimages/<?php echo $row['photo']; ?>">
					<img class="img-thumbnail" id="imguser" src="../userimages/<?php echo $row['photo']; ?>" width="200px">
				</a>
			</div>


			<div class="form-group">
				<label for="email">Email</label>
				<input name="email" type="text" class="form-control" id="email" value="<?php echo $row['email']; ?>" disabled>
			</div>


		</form>
	</div>
	<div class="col-sm-6">
		<form enctype="multipart/form-data" method="POST" action="">

			<div class="form-group">
				<label for="confirm">Change Status</label>
				<select name="confirm" class="form-control" id="confirm">
					<option value=""></option>
					<option value="1">Activate</option>
					<option value="0">Deactivate</option>
					<option value="-1">New</option>
				</select>
			</div>

			<div class="form-group text-center">
				<input name="stuconfirm" value="Save Changes" type="submit" class="btn btn-danger">
			</div>
		</form>

	</div>
</div>