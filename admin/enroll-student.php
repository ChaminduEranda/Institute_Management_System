<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'admin.php') {
    if ($corepage == $corepage) {
        $corepage = explode('.', $corepage);
        header('Location: admin.php?page=' . $corepage[0]);
    }
}

if (isset($_POST['enroll'])) {
    $student_id  = $_POST['student_id'];
    $class_id = $_POST['class_id'];

    $query = "INSERT INTO `student_enroll`(`student_id`, `class_id`) VALUES ('$student_id','$class_id');";
    if (mysqli_query($db_con, $query)) {
        $datainsert['insertsucesss'] = '<p style="color: green;">Enroll Success!</p>';
    } else {
        $datainsert['inserterrorr'] = '<p style="color: red;">Enroll Not Success, please input correct data!</p>';
    }
}
?>
<h1 class="text-primary"><i class="fas fa-book-open"></i> Enroll Student<small class="text-warning"> Enroll Student to Class!</small></h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="admin.php">Dashboard </a></li>
        <li class="breadcrumb-item active" aria-current="page">Enroll Student</li>
    </ol>
</nav>

<div class="row">

    <div class="col-sm-6">
        <?php if (isset($datainsert)) { ?>
            <div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
                <div class="toast-header">
                    <strong class="mr-auto">Enrollment Alert</strong>
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
        $qs = "SELECT `sId` FROM `student`";
        $re1 = mysqli_query($db_con, $qs);

        $qt = "SELECT * FROM `class`";
        $re2 = mysqli_query($db_con, $qt);

        ?>

        <form enctype="multipart/form-data" method="POST" action="">

            <div class="form-group">
                <label for="student_id">Student</label>
                <select name="student_id" class="form-control" id="" value="<?= isset($student_id) ? $student_id : '' ?>" required>
                <option value="">Select</option>
                    <?php while ($r1 = mysqli_fetch_array($re1)) :; ?>

                        <option value="<?php echo $r1[0]; ?>"><?php echo $r1[0]; ?></option>

                    <?php endwhile; ?>
                </select>

            </div>

            <br>


            <div class="form-group">
                <label for="class_id">Class</label>
                <select name="class_id" class="form-control" id="" value="<?= isset($class_id) ? $class_id : '' ?>" required>
                <option value="">Select</option>
                    <?php while ($r2 = mysqli_fetch_array($re2)) :; ?>

                        <option value="<?php echo $r2[0]; ?>"><?php echo $r2[0]; ?> - <?php echo $r2[1]; ?> - <?php echo $r2[2]; ?></option>

                    <?php endwhile; ?>
                </select>

            </div>

            <br>

            <div class="form-group text-center">
                <input name="enroll" value="Enroll" type="submit" class="btn btn-danger">
            </div>
        </form>
    </div>
</div>

<!-- All class table  -->

<br><br>

<?php if (isset($_GET['delete']) || isset($_GET['edit'])) { ?>
    <div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
        <div class="toast-header">
            <strong class="mr-auto">Enrollment Edit Alert</strong>
            <small><?php echo date('d-M-Y'); ?></small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            <?php
            if (isset($_GET['delete'])) {
                if ($_GET['delete'] == 'succes') {
                    echo "<p style='color: green; font-weight: bold;'>Enrollment Deleted!</p>";
                }
            }
            if (isset($_GET['delete'])) {
                if ($_GET['delete'] == 'erro') {
                    echo "<p style='color: red'; font-weight: bold;>Enrollment Not Deleted!</p>";
                }
            }
            if (isset($_GET['edit'])) {
                if ($_GET['edit'] == 'successs') {
                    echo "<p style='color: green; font-weight: bold; '>Enrollment Edited!</p>";
                }
            }
            if (isset($_GET['edit'])) {
                if ($_GET['edit'] == 'errorr') {
                    echo "<p style='color: red; font-weight: bold;'>Enrollment Not Edited!</p>";
                }
            }
            ?>
        </div>
    </div>
<?php } ?>
<table class="table  table-striped table-hover table-bordered" id="data">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Student ID</th>
            <th scope="col">Class ID</th>
            <th scope="col">Reg Date</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = mysqli_query($db_con, 'SELECT * FROM `student_enroll` ORDER BY `student_enroll`.`student_id` DESC;');
        while ($result = mysqli_fetch_array($query)) { ?>
            <tr>
                <?php
                echo '
          <td>' . $result['student_id'] . '</td>
          <td>' . $result['class_id'] . '</td>
          <td>' . $result['reg_date'] . '</td>
              
          <td>
             &nbsp; <a class="btn btn-xs btn-danger" onclick="javascript:confirmationDelete($(this));return false;" href="admin.php?page=delete-enrollst&student_id=' . base64_encode($result['student_id']) . '&class_id=' . base64_encode($result['class_id']) . '">
             <i class="fas fa-trash-alt"></i></a></td>'; ?>
            </tr>
        <?php } ?>

    </tbody>
</table>
<script type="text/javascript">
    function confirmationDelete(anchor) {
        var conf = confirm('Are you sure want to delete this record?');
        if (conf)
            window.location = anchor.attr("href");
    }
</script>