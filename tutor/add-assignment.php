<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'tutor.php') {
  if ($corepage == $corepage) {
    $corepage = explode('.', $corepage);
    header('Location: tutor.php?page=' . $corepage[0]);
  }
}

if (isset($_POST['addassignment'])) {
  $assignmenttitle = $_POST['assignmenttitle'];
  $description = $_POST['description'];
  $startdate = $_POST['startdate'];
  $duedate = $_POST['duedate'];
  $class = $_POST['class'];

  $file = explode('.', $_FILES['file']['name']);
  $file = end($file);
  $file_name = $assignmenttitle.'.'.$file;

  $tId = $showrow['tId'];

  $query = "INSERT INTO `assignments`(`tutor_id`, `class_id`, `title`, `description`, `start_date`, `due_date`, `file`, `directory`, `status`) VALUES ('$tId','$class','$assignmenttitle','$description','$startdate','$duedate','$file_name','/OSLO/files/','1');";
  if (mysqli_query($db_con, $query)) {
    $datainsert['insertsucesss'] = '<p style="color: green;">Assignment Inserted!</p>';
    move_uploaded_file($_FILES['file']['tmp_name'], '../files/' . $file_name);
  } else {
    $datainsert['inserterrorr'] = '<p style="color: red;">Assignment Not Inserted, please input right informations!</p>';
  }
}
?>
<h1 class="text-primary"><i class="fas fa-pen"><i class="fas fa-plus"></i></i> Add Assignment<small class="text-warning"> Add New Assignment!</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="tutor.php">Dashboard </a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Assignment</li>
  </ol>
</nav>

<div class="row">

  <div class="col-sm-6">
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
    $tcId = $tushow['tId'];
    $query1 = "SELECT * FROM `tutor_enroll` INNER JOIN `class` ON `tutor_enroll`.`class_id` = `class`.`cId` WHERE `tutor_enroll`.`tutor_id` = '$tcId'";
    $result1 = mysqli_query($db_con, $query1);
    ?>

    <form enctype="multipart/form-data" method="POST" action="">

      <div class="form-group">
        <label for="assignmenttitle">Title</label>
        <textarea name="assignmenttitle" type="text" rows="2" cols="100" type="text" class="" id="assignmenttitle" value="<?= isset($assignmenttitle) ? $assignmenttitle : ''; ?>" required=""></textarea>
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" rows="5" cols="100" type="text" class="" id="description" value="<?= isset($description) ? $description : ''; ?>" required=""></textarea>
      </div>

      <div class="form-group">
        <label for="class">Class</label>
        <select name="class" class="form-control" id="class" value="<?= isset($class) ? $class : '' ?>">
          <?php while ($row1 = mysqli_fetch_array($result1)) :; ?>

            <option value="<?php echo $row1[3]; ?>"><?php echo $row1[3]; ?> - <?php echo $row1[4]; ?> - <?php echo $row1[5]; ?></option>

          <?php endwhile; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="startdate">Start Date</label>
        <input name="startdate" type="date" class="form-control" id="startdate" value="<?= isset($startdate) ? $startdate : ''; ?>" required="">
      </div>

      <div class="form-group">
        <label for="duedate">Due Date</label>
        <input name="duedate" type="date" class="form-control" id="duedate" value="<?= isset($duedate) ? $duedate : ''; ?>" required="">
      </div>

      <div class="form-group">
        <label for="file">File</label>
        <input name="file" type="file" class="form-control" id="file" value="<?= isset($file) ? $file : ''; ?>" required="">
      </div>
      <br>

      <div class="form-group text-center">
        <input name="addassignment" value="Add Assignment" type="submit" class="btn btn-danger">
      </div>
    </form>
  </div>
</div>

