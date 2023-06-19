<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'tutor.php') {
  if ($corepage == $corepage) {
    $corepage = explode('.', $corepage);
    header('Location: tutor.php?page=' . $corepage[0]);
  }
}

$tu_Id = base64_decode($_GET['tu_Id']);
$file = base64_decode($_GET['file']);
$student_id = base64_decode($_GET['student_id']);


if (isset($_POST['addmarks'])) {
  $marks = $_POST['marks'];

  $query = "UPDATE `answers` SET `marks`='$marks'  WHERE `tu_Id`= '$tu_Id' AND `student_id`= '$student_id'";
  if (mysqli_query($db_con, $query)) {
    $datainsert['insertsucess'] = '<p style="color: green;">Grade Updated!</p>';
    header('Location: tutor.php?page=view-assign-answers&edit=successs');
  } else {
    header('Location: tutor.php?page=view-assign-answers&edit=errorr');
  }
}
?>

<h1 class="text-primary"><i class="fas fa-envelope-open-text"></i> Grade Answer<small class="text-warning"> </small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="tutor.php">Dashboard </a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="tutor.php?page=view-assign-answers"> Grade Assignments</a></li>
    <li class="breadcrumb-item active" aria-current="page"> Answer Of </li>
  </ol>
</nav>

<?php
$qu = "SELECT * FROM `answers` WHERE `answers`.`tu_Id` = '$tu_Id' AND `answers`.`student_id` = '$student_id'";
$re = mysqli_query($db_con, $qu);
$re2 = mysqli_fetch_array($re);
$sta = $re2['marks'];
if (!empty($sta)) {
  echo '<p style="color:Green;font-size:30px;font-family:calibri ;"><b>Graded <i class="fas fa-check"></i></b></p> ';
} else {
  echo '<p style="color:RED;font-size:30px;font-family:calibri ;"><b>Not Graded <i class="fas fa-times"></i></b></p>';
}
?>

<?php
$select = "SELECT * FROM `answers` WHERE `tu_id` = '$tu_Id';";
$result = $db_con->query($select);
while ($row = $result->fetch_object()) {
  $pdf = $row->file;
  $path = $row->directory;
  $sname = $row->student_id;
  $cname = $row->class_id;
}

echo '<strong>Student : </strong>' . $sname;

echo '<br><br><strong>Class : </strong>' . $cname;

echo '<br><br><strong>File Name : </strong>' . $pdf;




?>
<br /><br />
<iframe src="<?php echo $path . $pdf; ?>" width="90%" height="500px">
</iframe>




<br><br><br><br>
<h1 class="text-primary"><i class="fas fa-pen"></i> Add Marks<small class="text-warning"> </small></h1>
<br>

<div class="row">
  <div class="col-sm-6">

    <?php
    if (isset($tu_Id)) {
      $query1 = "SELECT * FROM `answers` WHERE `tu_id`= '$tu_Id' AND `student_id`= '$student_id';";
      $resu = mysqli_query($db_con, $query1);
      $mmm = mysqli_fetch_array($resu);
    }
    ?>
    <form enctype="multipart/form-data" method="POST" action="">

      <div class="form-group">
        <label for="marks">Marks</label>
        <input name="marks" type="text" class="form-control" id="marks" value="<?php echo $mmm['marks']; ?>">
      </div>

      <div class="form-group text-center">
        <input name="addmarks" value="Add Marks" type="submit" class="btn btn-danger">
      </div>
    </form>
  </div>
</div>

<br><br><br>