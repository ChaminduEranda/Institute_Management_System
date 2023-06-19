<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'admin.php') {
	if ($corepage == $corepage) {
		$corepage = explode('.', $corepage);
		header('Location: admin.php?page=' . $corepage[0]);
	}
}

if (isset($_POST['addpayment'])) {
	$student_id = $_POST['student_id'];
	$class_id = $_POST['class_id'];
	$payMonth = $_POST['payMonth'];
	$amount = $_POST['amount'];

	$query = "INSERT INTO `payment`(`student_id`, `class_id`, `payMonth`, `amount`) VALUES ('$student_id','$class_id','$payMonth','$amount');";
	if (mysqli_query($db_con, $query)) {
		$datainsert['insertsucesss'] = '<p style="color: green;">Payment Inserted!</p>';
	} else {
		$datainsert['inserterrorr'] = '<p style="color: red;">Payment Not Inserted, please input right informations!</p>';
	}
}

?>

<h1 class="text-primary"><i class="fa fa-dollar-sign"></i> Payment<small class="text-warning"> Add Payment Record</small></h1>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="admin.php">Dashboard </a></li>
		<li class="breadcrumb-item active" aria-current="page">Payment</li>
	</ol>
</nav>

<div class="row">

	<div class="col-sm-6">
		<?php if (isset($datainsert)) { ?>
			<div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
				<div class="toast-header">
					<strong class="mr-auto">Payment Insert Alert</strong>
					<small><?php echo date('d-M-Y'); ?></small>
					<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="toast-body">
					<?php
					if (isset($datainsert['insertsucesss'])) {
						echo $datainsert['insertsucesss'];
					}
					if (isset($datainsert['inserterrorr'])) {
						echo $datainsert['inserterrorr'];
					}
					?>
				</div>
			</div>
		<?php } ?>

		<?php
		$queryac = "SELECT * FROM `student`;";
		$resultac = mysqli_query($db_con, $queryac);

		$qt = "SELECT * FROM `class`";
        $re2 = mysqli_query($db_con, $qt);
		?>

		<form enctype="multipart/form-data" method="POST" action="">

			<div class="form-group">
				<label for="student_id">Student</label>
				<select name="student_id" class="form-control" id="student_id" value="<?= isset($student_id ) ? $student_id  : ''; ?>" required="">
					<?php while ($row1 = mysqli_fetch_array($resultac)) :; ?>

						<option value="<?php echo $row1[0]; ?>"><?php echo $row1[0]; ?> - <?php echo $row1[1]; ?> <?php echo $row1[2]; ?></option>

					<?php endwhile; ?>
				</select>
			</div>

			
            <div class="form-group">
                <label for="class_id">Class</label>
                <select name="class_id" class="form-control" id="" value="<?= isset($class_id) ? $class_id : '' ?>" required>
                <option value="">Select</option>
                    <?php while ($r2 = mysqli_fetch_array($re2)) :; ?>

                        <option value="<?php echo $r2[0]; ?>"><?php echo $r2[0]; ?> - <?php echo $r2[1]; ?> - <?php echo $r2[2]; ?></option>

                    <?php endwhile; ?>
                </select>

            </div>

			<div class="form-group">
				<label for="payMonth">Month</label>
				<input name="payMonth" type="month" class="form-control" id="payMonth" value="<?= isset($payMonth) ? $payMonth : ''; ?>" required="">
			</div>

			<div class="form-group">
				<label for="amount">Amount (RS.)</label>
				<input name="amount" type="text" class="form-control" id="amount" value="<?= isset($amount) ? $amount : ''; ?>" required="">
			</div>

			<div class="form-group text-center">
				<input name="addpayment" value="Add" type="submit" class="btn btn-danger">
			</div>

		</form>
	</div>
</div>

<br>

<table class="table  table-striped table-hover table-bordered" id="data">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Student</th>
      <th scope="col">Class</th>
      <th scope="col">Month</th>
      <th scope="col">Amount(RS.)</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 0;
    $query = mysqli_query($db_con, 'SELECT * FROM  `payment`;');
    while ($result = mysqli_fetch_array($query)) {
      $i++; ?>
      <tr>
        <td><?php echo $result['student_id']; ?> </td>
        <td><?php echo $result['class_id']; ?> </td>
		<td><?php echo $result['payMonth']; ?> </td>
		<td><?php echo $result['amount']; ?> </td>
		
        <!-- <td>
          <?php if ($result['status'] == 1) { ?>
            <?php echo '<span class="label success"><b>Active</b></span>' ?> <?php } else if ($result['status'] == -1) { ?>
            <?php echo '<span class="label info"><b>New</b></span>' ?><?php } else if ($result['status'] == 0) { ?>
            <?php echo '<span class="label danger"><b>Deactivated</b></span>' ?>
          <?php } ?>
        </td>
        <td><?php echo '<a class="btn btn-xs btn-warning" href="admin.php?page=studFullDetails&sId=' . base64_encode($result['sId']) . '&photo=' . base64_encode($result['photo']) . '">
             <b>Check</b></a>' ?> </td> -->

      </tr>
    <?php } ?>

  </tbody>
</table>