<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'admin.php') {
	if ($corepage == $corepage) {
		$corepage = explode('.', $corepage);
		header('Location: admin.php?page=' . $corepage[0]);
	}
}

$examId = base64_decode($_GET['examId']);

if (isset($_POST['updateexam'])) {

	$examId = $_POST['examId'];
	$class_id = $_POST['class_id'];
	$examName = $_POST['examName'];
	$examTime = $_POST['examTime'];
	$examDate = $_POST['examDate'];

	$query = "UPDATE `exam` SET `examId`='$examId',`class_id`='$class_id',`examName`='$examName',`examTime`='$examTime',`examDate`='$examDate' WHERE `examId`= '$examId'";
	if (mysqli_query($db_con, $query)) {
		$datainsert['insertsucess'] = '<p style="color: green;">Exam Updated!</p>';
		header('Location: admin.php?page=add-exam&edit=successs');
	} else {
		header('Location: admin.php?page=add-exam&edit=errorr');
	}
}
?>
<h1 class="text-primary"><i class="fas fa-user-plus"></i> Edit Exam Informations!<small class="text-warning"> Edit Exam!</small></h1>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="admin.php">Dashboard </a></li>
		<li class="breadcrumb-item" aria-current="page"><a href="admin.php?page=add-exam">Exams</a></li>
		<li class="breadcrumb-item active" aria-current="page">Edit Exam</li>
	</ol>
</nav>

<?php
if (isset($examId)) {
	$query = "SELECT * FROM `exam` WHERE `examId`='$examId'";
	$result = mysqli_query($db_con, $query);
	$row = mysqli_fetch_array($result);
}

$qt = "SELECT `cId` FROM `class`";
$re2 = mysqli_query($db_con, $qt);
?>
<div class="row">
	<div class="col-sm-6">
		<form enctype="multipart/form-data" method="POST" action="">


			<div class="form-group">
				<label for="examId">Exam ID</label>
				<input name="examId" type="text" class="form-control" id="examId" value="<?php echo $row['examId']; ?>" required="">
			</div>


			<div class="form-group">
                <label for="class_id">Class ID</label>
                <select name="class_id" class="form-control" id="" value="<?= isset($class_id) ? $class_id : '' ?>">

                    <?php while ($r2 = mysqli_fetch_array($re2)) :; ?>

                        <option value="<?php echo $r2[0]; ?>"><?php echo $r2[0]; ?></option>

                    <?php endwhile; ?>
                </select>

            </div>

			<div class="form-group">
				<label for="examName">Name</label>
				<input name="examName" type="text" class="form-control" id="examName" value="<?php echo $row['examName']; ?>" required="">
			</div>
			
			<div class="form-group">
				<label for="examTime">Time</label>
				<input name="examTime" type="time" class="form-control" id="examTime" value="<?php echo $row['examTime']; ?>" required="">
			</div>

			<div class="form-group">
				<label for="examDate">Date</label>
				<input name="examDate" type="date" class="form-control" id="examDate" value="<?php echo $row['examDate']; ?>" required="">
			</div>

			<div class="form-group text-center">
				<input name="updateexam" value="Update Exam" type="submit" class="btn btn-danger">
			</div>
		</form>
	</div>
</div>