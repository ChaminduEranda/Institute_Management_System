<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'tutor.php') {
    if ($corepage == $corepage) {
        $corepage = explode('.', $corepage);
        header('Location: tutor.php?page=' . $corepage[0]);
    }
}

$Id = base64_decode($_GET['Id']);
$oldfile = base64_decode($_GET['file']);

if (isset($_POST['updateassignment'])) {
  $assignmenttitle = $_POST['assignmenttitle'];
  $description = $_POST['description'];
  $startdate = $_POST['startdate'];
  $duedate = $_POST['duedate'];
  $class = $_POST['class'];

  if (!empty($_FILES['file']['name'])) {
    $file = $_FILES['file']['name'];
    $file = explode('.', $file);
    $file = end($file);
    $file = $assignmenttitle.'.'.$file;
} else {
    $oldfile = base64_decode($_GET['file']);
    $file = $oldfile;
}

    $query = "UPDATE `assignments` SET `class_id`='$class',`title`='$assignmenttitle',`description`='$description',`start_date`='$startdate',`due_date`='$duedate',`file`='$file' WHERE `Id`= '$Id'";
    if (mysqli_query($db_con, $query)) {
        $datainsert['insertsucess'] = '<p style="color: green;">Class Updated!</p>';
        header('Location: tutor.php?page=all-assignments&edit=successs');
    } else {
        header('Location: tutor.php?page=all-assignments&edit=errorr');
    }
}
?>
<h1 class="text-primary"><i class="fas fa-edit"></i> Edit Asignment!<small class="text-warning"> Edit Assignment!</small></h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="tutor.php">Dashboard </a></li>
        <li class="breadcrumb-item" aria-current="page"><a href="tutor.php?page=all-assignments">All Assignments</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Assignment</li>
    </ol>
</nav>

<div class="row">
    <div class="col-sm-6">
        <?php
        if (isset($Id)) {
            $query1 = "SELECT * FROM `assignments` WHERE `assignments`.`Id` = '$Id'";
            $resu = mysqli_query($db_con, $query1);
            $result1 = mysqli_fetch_array($resu);
        }
      
        $tcId = $showrow['tId'];
        $query4 = "SELECT * FROM `tutor_enroll` INNER JOIN `class` ON `tutor_enroll`.`class_id` = `class`.`cId` WHERE `tutor_enroll`.`tutor_id` = '$tcId'";
        $result4 = mysqli_query($db_con, $query4); 
        ?>

        <form enctype="multipart/form-data" method="POST" action="">

            <div class="form-group">
                <label for="assignmenttitle">Title</label>
                <textarea name="assignmenttitle" type="text" rows="2" cols="100" type="text" class="" id="assignmenttitle" required=""><?php echo $result1['title']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" rows="5" cols="100" type="text" class="" id="description"  required=""><?php echo $result1['description']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="class">Class</label>
                <select name="class" class="form-control" id="class">
                
                <option value="<?php echo $result1['class_id']; ?>"><?php echo $result1['class_id']; ?></option>
                <?php while ($row1 = mysqli_fetch_array($result4)) :; ?>

                        <option value="<?php echo $row1[3]; ?>"><?php echo $row1[3]; ?> - <?php echo $row1[4]; ?> - <?php echo $row1[5]; ?></option>

                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="startdate">Start Date</label>
                <input name="startdate" type="date" class="form-control" id="startdate" value="<?php echo $result1['start_date']; ?>" required="">
            </div>

            <div class="form-group">
                <label for="duedate">Due Date</label>
                <input name="duedate" type="date" class="form-control" id="duedate" value="<?php echo $result1['due_date']; ?>" required="">
            </div>

            <div class="form-group">
                <label for="file">File</label>
                <input name="file" type="file" class="form-control" id="file" value="<?php echo $result1['file']; ?>">
            </div>
            <br>

            <div class="form-group text-center">
                <input name="updateassignment" value="Update Assignment" type="submit" class="btn btn-danger">
            </div>
        </form>
    </div>
</div>