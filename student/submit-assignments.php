<?php
$user =  $_SESSION['user_login'];
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'student.php') {
  if ($corepage == $corepage) {
    $corepage = explode('.', $corepage);
    header('Location: student.php?page=' . $corepage[0]);
  }
}

$Id = base64_decode($_GET['Id']);
$ofile = base64_decode($_GET['file']);


if (isset($_POST['submit'])) {
  $sId = $showrow['sId'];
  $class = $_POST['class'];

  $comment = $_POST['comment'];

  $assignmenttitle = $_POST['assignmenttitle'];

  $file = explode('.', $_FILES['file']['name']);
  $file = end($file);
  $file_name = $assignmenttitle . '.' . $file;

  $comment = $_POST['comment'];


  $query = "INSERT INTO `answers`(`tu_Id`, `student_id`, `class_id`, `comment`, `file`, `directory`, `marks`, `status`) VALUES ('$Id','$sId','$class','$comment','$file_name','/OSLO/files/',null,'1');";
  if (mysqli_query($db_con, $query)) {
    $datainsert['insertsucesss'] = '<p style="color: green;">Assignment Submitted!</p>';
    move_uploaded_file($_FILES['file']['tmp_name'], '../files/' . $file_name);
  } else {
    $datainsert['inserterrorr'] = '<p style="color: red;">Assignment Not Submitted, please input right informations!</p>';
  }
}
?>
<h1 class="text-primary"><i class="fas fa-pen"></i> Submit Assignment</h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="student.php">Dashboard </a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="assignments.php">Assignments</a></li>
    <li class="breadcrumb-item active" aria-current="page">Submit Assignment</li>
  </ol>
</nav>


<?php if (isset($datainsert)) { ?>
  <div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
    <div class="toast-header">
      <strong class="mr-auto"> Insert Alert</strong>
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
$stuid = $showrow['sId'];
$qu = "SELECT * FROM `answers` WHERE `answers`.`tu_Id` = '$Id' AND `answers`.`student_id` = '$stuid'";
$re = mysqli_query($db_con, $qu);
$re2 = mysqli_fetch_array($re);
if (isset($re2['status']) && isset($re2['marks'])) {
  $mk = $re2['marks'];
  $sta = $re2['status'];
  if (!empty($mk) && $sta == "1") {
    echo '<p style="color:GREEN;font-size:30px;font-family:calibri ;"><b>Graded <i class="fas fa-check"> </i></b></p>';
    echo '<a style="color:GREEN;font-size:20px;font-family:calibri ;"><b>Your Marks: </b></a>';
    echo $mk.'%';
  }
} else if (isset($re2['status'])) {
  $mk = $re2['marks'];
  $sta = $re2['status'];
  if (null == $mk && $sta == "1") {
    echo '<p style="color:GREEN;font-size:30px;font-family:calibri ;"><b>Assignment is Submitted to Grade <i class="fas fa-check"></i></b></p> ';
  }
} else if (empty($re2['status']) && empty($re2['marks'])) {

  echo '<p style="color:RED;font-size:30px;font-family:calibri ;"><b>Not Submitted <i class="fas fa-times"></i></b></p>';
}
?>


<br><br>
<div class="row">
  <div class="col-sm-6">
    <?php
    if (isset($Id)) {
      $query1 = "SELECT * FROM `assignments` WHERE `assignments`.`Id` = '$Id'";
      $resu = mysqli_query($db_con, $query1);
      $result1 = mysqli_fetch_array($resu);
    }
    ?>

    <form enctype="multipart/form-data" method="POST" action="">

      <div class="form-group">
        <label for="assignmenttitle">Title</label>
        <textarea name="assignmenttitle" type="text" rows="2" cols="100" type="text" class="" id="assignmenttitle" readonly><?php echo $result1['title']; ?></textarea>
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" rows="5" cols="100" type="text" class="" id="description" disabled><?php echo $result1['description']; ?></textarea>
      </div>

      <div class="form-group">
        <label for="class">Class</label>
        <input name="class" type="text" class="form-control" id="duedate" value="<?php echo $result1['class_id']; ?>" readonly>
      </div>

      <div class="form-group">
        <label for="startdate">Start Date</label>
        <input name="startdate" type="date" class="form-control" id="startdate" value="<?php echo $result1['start_date']; ?>" disabled>
      </div>

      <div class="form-group">
        <label for="duedate">Due Date</label>
        <input name="duedate" type="date" class="form-control" id="duedate" value="<?php echo $result1['due_date']; ?>" disabled>
      </div>

      <div class="form-group">
        <label for="comment">Comment</label>
        <textarea name="comment" type="text" rows="2" cols="100" type="text" class="" id="comment"></textarea>
      </div>

      <div class="form-group">
        <label for="file">File</label>
        <input name="file" type="file" class="form-control" id="file" value="<?= isset($file) ? $file : ''; ?>" required="">
      </div>
      <br>

      <div class="form-group text-center">
        <input name="submit" value="Submit" type="submit" class="btn btn-danger">
      </div>

    </form>
  </div>
</div>

<br>
<label for="AssignmentFile"><b><u>Assignment File</u></b></label>
<br><br>

<?php
$select = "SELECT * FROM `assignments` WHERE `Id` = '$Id';";
$result = $db_con->query($select);
while ($row = $result->fetch_object()) {
  $pdf = $row->file;
  $path = $row->directory;
}

echo '<strong>File Name : </strong>' . $pdf;
?>
<br /><br />
<iframe src="<?php echo $path . $pdf; ?>" width="100%" height="700px">
</iframe>