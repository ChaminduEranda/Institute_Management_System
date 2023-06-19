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
    $file = base64_decode($_GET['file']);

?>
<h1 class="text-primary"><i class="fas fa-eye"></i> View Asignment!<small class="text-warning"> View Assignment!</small></h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="tutor.php">Dashboard </a></li>
        <li class="breadcrumb-item" aria-current="page"><a href="tutor.php?page=all-assignments">All Assignments</a></li>
        <li class="breadcrumb-item active" aria-current="page">View Assignment</li>
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
       ?>

        <form enctype="multipart/form-data" method="POST" action="">

            <div class="form-group">
                <label for="assignmenttitle">Title</label>
                <textarea name="assignmenttitle" type="text" rows="2" cols="100" type="text" class="" id="assignmenttitle" disabled><?php echo $result1['title']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" rows="5" cols="100" type="text" class="" id="description"  disabled><?php echo $result1['description']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="class">Class</label>             
                <input name="class" type="text" class="form-control" id="duedate" value="<?php echo $result1['class_id']; ?>" disabled>
            </div>

            <div class="form-group">
                <label for="startdate">Start Date</label>
                <input name="startdate" type="date" class="form-control" id="startdate" value="<?php echo $result1['start_date']; ?>" disabled>
            </div>

            <div class="form-group">
                <label for="duedate">Due Date</label>
                <input name="duedate" type="date" class="form-control" id="duedate" value="<?php echo $result1['due_date']; ?>" disabled>
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