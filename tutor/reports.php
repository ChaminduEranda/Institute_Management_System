<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'tutor.php') {
    if ($corepage == $corepage) {
        $corepage = explode('.', $corepage);
        header('Location: tutor.php?page=' . $corepage[0]);
    }
}
?>


<h1 class="text-primary"><i class="fas fa-chart-area"></i> Reports<small class="text-warning"> Generate Reports!</small></h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="tutor.php">Dashboard </a></li>
        <li class="breadcrumb-item active" aria-current="page">Reports</li>
    </ol>
</nav>

<?php

$qt = "SELECT * FROM `class`;";
$re2 = mysqli_query($db_con, $qt);

?>



<?php
if (isset($_POST['gen'])) {
    $class_id  = $_POST['class_id'];
    $report = $_POST['report'];
    $date = $_POST['date'];
    $exam = $_POST['exam'];
    $st_id = $_POST['st_id'];
    
    if ($report == "std_dr") {
        echo '<a class="btn btn-xs btn-warning" href="std_datareport.php?&cid=' . base64_encode($class_id) . '" target="_blank">
        <i class="fa fa-eye"> View Data Report </i></a>';
    } else if ($report == "std_er") {
        echo '<a class="btn btn-xs btn-warning" href="std_exam_datareport.php?&cid=' . base64_encode($class_id) . '&date=' . base64_encode($date) . '&exam=' . base64_encode($exam)  . '&st_id=' . base64_encode($st_id) . '" target="_blank">
        <i class="fa fa-eye"> View Exam Results Report </i></a>';
    }
}
?>

<form enctype="multipart/form-data" method="POST" action="">

    <br>
    
    <div class="col-sm-7">
        <div class="form-group">
            <label for="exam">Select Exam </label>
            <select name="exam" class="form-control" id="" required>
                <option value=""></option>
                <?php
                $qs = "SELECT * FROM `exam` INNER JOIN `class` ON `exam`.`class_id`=`class`.`cId`";
                $ree = mysqli_query($db_con, $qs);
                while ($r2 = mysqli_fetch_array($ree)) :; ?>

                    <option value="<?php echo $r2[0]; ?>"><?php echo $r2[0]; ?> - <?php echo $r2[1]; ?> - <?php echo $r2[7]; ?></option>

                <?php endwhile; ?>
            </select>
        </div>
    </div>
    
    <div class="col-sm-7">
        <div class="form-group">
            <label for="class_id">Select Class</label>
            <select name="class_id" class="form-control" id="">
            <option value=""></option>
                <?php while ($r2 = mysqli_fetch_array($re2)) :; ?>

                    <option value="<?php echo $r2[0]; ?>"><?php echo $r2[0]; ?> - <?php echo $r2[1]; ?> - <?php echo $r2[2]; ?></option>

                <?php endwhile; ?>
            </select>
        </div>
    </div>

    <div class="col-sm-7">
        <div class="form-group">
            <label for="st_id">Select Student (Not Compulsory)</label>
            <select name="st_id" class="form-control" id="">
                <option value=""></option>
                <?php
                $qs = "SELECT * FROM `student`";
                $ree = mysqli_query($db_con, $qs);
                while ($r2 = mysqli_fetch_array($ree)) :; ?>

                    <option value="<?php echo $r2[0]; ?>"><?php echo $r2[0]; ?> - <?php echo $r2[1]; ?><?php echo $r2[2]; ?></option>

                <?php endwhile; ?>
            </select>
        </div>
    </div>


    <div class="col-sm-6">
        <div class="form-group">
            <label for="report">Report</label>
            <select name="report" class="form-control" id="" required>
            <option value=""></option>
                <option value="std_dr">Student Data Report</option>
                <option value="std_er">Student Exam Results Report</option>
            </select>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="date">Select Date (Not Compulsory)</label>
            <input name="date" type="date" class="form-control" id="date">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group text-center">
            <input name="gen" value="Generate" type="submit" class="btn btn-danger">
        </div>
    </div>

</form>

