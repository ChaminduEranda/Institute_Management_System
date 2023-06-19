<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'admin.php') {
    if ($corepage == $corepage) {
        $corepage = explode('.', $corepage);
        header('Location: admin.php?page=' . $corepage[0]);
    }
}



if (isset($_POST['att'])) {


    foreach ($_POST['st_status'] as $i => $st_status) {

        $stat_id = $_POST['stat_id'][$i];
        $cls_id = $_POST['cls_id'][$i];
        $date = $_POST['date'];
        $checkin = $_POST['time1'];
        $checkout = $_POST['time2'];
        $query = "INSERT INTO `attendance`(`student_id`, `class_id`, `attend_date`, `st_status`, `check_in`, `check_out`) VALUES ('$stat_id','$cls_id','$date','$st_status','$checkin','$checkout');";
        if (mysqli_query($db_con, $query)) {
            $datainsert['insertsucesss'] = '<p style="color: green;">Attendence Inserted!</p>';
        } else {
            $datainsert['inserterrorr'] = '<p style="color: red;">Attendence Not Inserted</p>';
        }
    }
}
?>
<h1 class="text-primary"><i class="fas fa-users"></i> Student Attendence<small class="text-warning"> Mark Attendence!</small></h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="admin.php">Dashboard </a></li>
        <li class="breadcrumb-item active" aria-current="page">Attendence</li>
        <li class="breadcrumb-item active" aria-current="page">Attendance of <?php echo date('Y-m-d'); ?></li>
    </ol>
</nav>



<?php
$query1 = "SELECT * FROM `class`";
$result1 = mysqli_query($db_con, $query1);
?>
<form method="POST" action="">

    <div class="col-sm-6">
        <div class="form-group">
            <label for="subjectId">Select Class</label>
            <select name="whichcourse" class="form-control" id="whichcourse">
                <?php while ($row1 = mysqli_fetch_array($result1)) :; ?>

                    <option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?> - <?php echo $row1[2]; ?></option>

                <?php endwhile; ?>
            </select>
        </div>

        <br>

        <div class="form-group text-center">
            <input name="batch" value="Search" type="submit" class="btn btn-danger">
        </div>
    </div>

    <br>

    <table class="table  table-striped table-hover table-bordered" id="data">
        <thead class="thead-dark">
            <tr>
                <th scope="col">St.No</th>
                <th scope="col">Status</th>
                <th scope="col">Date</th>
                <th scope="col">CheckIN</th>
                <th scope="col">CheckOUT</th>

            </tr>
        </thead>
        <tbody>
            <?php

            if (isset($_POST['batch'])) {

                $i = 0;
                $radio = 0;
                $batch = $_POST['whichcourse'];
                $query2 = "SELECT `student_id`,`cId` FROM `student_enroll` INNER JOIN `class` ON `student_enroll`.`class_id` = `class`.`cId` WHERE `class`.`cId` = '$batch' ORDER BY `student_enroll`.`student_id` ASC;";
                $all_query = mysqli_query($db_con, $query2);

                while ($data = mysqli_fetch_array($all_query)) {
                    $i++;
            ?>
                    <tr>
                        <td><?php echo $data['student_id']; ?> <input type="hidden" name="stat_id[]" value="<?php echo $data['student_id']; ?>"> </td>
                        <input type="hidden" name="cls_id[]" value="<?php echo $data['cId']; ?>">


                        <td>
                            <label>Present</label>
                            <input type="radio" name="st_status[<?php echo $radio; ?>]" value="Present">
                            <label>Absent </label>
                            <input type="radio" name="st_status[<?php echo $radio; ?>]" value="Absent" checked>
                        </td>

                        <td>
                            <input type="date" name="date" value="">

                        </td>
                        

                        <td>
                            <input type="time" name="time1" value="">

                        </td>
                            
                        <td>
                        <input type="time" name="time2" value="">
                        </td>
                    </tr>
                    </body>

            <?php

                    $radio++;
                }
            }
            ?>

        </tbody>
    </table>
    <br>
    <div class="form-group text-center">
        <input name="att" value="Save" type="submit" class="btn btn-danger">
    </div>

</form>