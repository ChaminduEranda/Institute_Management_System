<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'student.php') {
  if ($corepage == $corepage) {
    $corepage = explode('.', $corepage);
    header('Location: student.php?page=' . $corepage[0]);
  }
}

?>


<h1 class="text-primary"><i class="fas fa-clipboard-list"></i> Exam Results<small class="text-warning"> Find Exam Results!</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="student.php">Dashboard </a></li>
    <li class="breadcrumb-item active" aria-current="page">Exam Results</li>
  </ol>
</nav>








<?php
$query1 = "SELECT * FROM `exam`";
$result1 = mysqli_query($db_con, $query1);
?>

<form enctype="multipart/form-data" method="POST" action="">

  <div class="col-sm-5">
    <div class="form-group">
      <label for="stid">Your ID</label>
      <input name="stid" type="text" class="form-control" id="stid" value="<?= isset($stid) ? $stid : ''; ?>" required="">
    </div>
  </div>

  <div class="col-sm-7">
    <div class="form-group">
      <label for="examid">Exam</label>
      <select name="examid" class="form-control" id="examid" value="<?= isset($examid) ? $examid : '' ?>">
        <?php while ($row1 = mysqli_fetch_array($result1)) :; ?>

          <option value="<?php echo $row1[0]; ?>"><?php echo $row1[0]; ?> - <?php echo $row1[2]; ?></option>

        <?php endwhile; ?>
      </select>
    </div>
  </div>
    <div class="form-group text-center">
      <input name="exam" value="Search" type="submit" class="btn btn-danger">
    </div>
  
</form>

<!-- All class table  -->

<br>



<table class="table  table-striped table-hover table-bordered" id="data">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Exam</th>
      <th scope="col">Marks</th>
    </tr>
  </thead>
  <tbody>
    <?php

    if (isset($_POST['exam'])) {

      $stid = $_POST['stid'];
      $examid = $_POST['examid'];
      $query = mysqli_query($db_con, "SELECT * FROM `exam` INNER JOIN `exam_marks` ON `exam`.`examId` = `exam_marks`.`exam_id` WHERE `exam_marks`.`student_id` = '$stid' AND `exam_marks`.`exam_id` = '$examid';");
      while ($result = mysqli_fetch_array($query)) { ?>
        <tr>
          <?php
          echo '
		      <td>' . $result['examName'] . '</td>
          <td>' . $result['marks'] . '</td> 
        '; ?>
        </tr>
    <?php }
    } ?>

  </tbody>
</table>