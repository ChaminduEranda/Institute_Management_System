<?php
$user =  $_SESSION['user_login'];
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'admin.php') {
    if ($corepage == $corepage) {
        $corepage = explode('.', $corepage);
        header('Location: admin.php?page=' . $corepage[0]);
    }
}


?>

<h1 class="text-primary"><i class="fas fa-chart-area"></i> Reports<small class="text-warning"> Generate Reports!</small></h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="admin.php">Dashboard </a></li>
        <li class="breadcrumb-item active" aria-current="page">Reports</li>
    </ol>
</nav>

<?php

$qt = "SELECT * FROM `class`";
$re2 = mysqli_query($db_con, $qt);

?>


<?php

if (isset($_POST['gen'])) {
    $class_id  = $_POST['class_id'];
    $report = $_POST['report'];
    $date = $_POST['date'];
    $frdate = $_POST['frdate'];
    $utdate = $_POST['utdate'];
    $st_id = $_POST['st_id'];
    $month = $_POST['month'];

    if ($report == "std_dr") {
        echo '<a class="btn btn-xs btn-warning" href="std_datareport.php?&cid=' . base64_encode($class_id) . '" target="_blank">
        <i class="fa fa-eye"> View Data Report of ' . $class_id . '</i></a>';
    } else if ($report == "std_ar") {
        echo '<a class="btn btn-xs btn-warning" href="std_attendance_report.php?&cid=' . base64_encode($class_id) . '&date=' . base64_encode($date) . '&frdate=' . base64_encode($frdate) . '&utdate=' . base64_encode($utdate) . '&st_id=' . base64_encode($st_id) . '" target="_blank">
        <i class="fa fa-eye"> View Attendance Report of ' . $class_id . ' ' . $date . ' ' . $st_id . ' ' . $frdate  . ' ' . $utdate . '</i></a>';
    } else if ($report == "std_pr") {
        echo '<a class="btn btn-xs btn-warning" href="std_payment_report.php?&st_id=' . base64_encode($st_id) . '&date=' . base64_encode($date) . '&month=' . base64_encode($month) . '&cid=' . base64_encode($class_id) . '" target="_blank">
        <i class="fa fa-eye"> View Payment Report of ' . $st_id . ' ' . $date . ' ' . $month . ' ' . $class_id . '</i></a>';
    }
}
?>

<form enctype="multipart/form-data" method="POST" action="">

    <br>
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
                <option value="std_ar">Student Attendance Report</option>
                <option value="std_pr">Student Payment Report</option>

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
        <div class="form-group">
            <label for="month">Select Month (Not Compulsory)</label>
            <input name="month" type="month" class="form-control" id="month">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="frdate">From (Not Compulsory)</label>
            <input name="frdate" type="date" class="form-control" id="frdate">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="utdate">Upto (Not Compulsory)</label>
            <input name="utdate" type="date" class="form-control" id="utdate">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group text-center">
            <input name="gen" value="Generate" type="submit" class="btn btn-danger">
        </div>
    </div>

</form>