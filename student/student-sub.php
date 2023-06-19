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

<?php
$i = 0;
$csid = base64_decode($_GET['cid']);
$stid = $showrow['sId'];
$query2 = "SELECT * FROM `student_enroll` INNER JOIN `class` ON `student_enroll`.`class_id` = `class`.`cId` WHERE `student_enroll`.`student_id` ='$stid' AND `class`.`cId` = '$csid';";
$all_query = mysqli_query($db_con, $query2);
$data = mysqli_fetch_array($all_query);
?>

    <ol class="breadcrumb">
        <h1 class="text-primary"><u> <?php echo $data['cId']; ?> - <?php echo $data['batchName']; ?> - <?php echo $data['subName']; ?></u> </h1>
    </ol>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="student.php">Dashboard </a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="subjects.php">Subjects</a></li>
            <li class="breadcrumb-item active" aria-current="page"> <?php echo $data['subName']; ?></li>
        </ol>
    </nav>

    <hr>

    <?php $li = $data['link'];
    if (!empty($li)) { ?>
        <ol class="breadcrumb">
            <h1 class="text-primary"><small class="text-color green">Online Class Link</small>
                <h1 class="text-primary"><br><br>

                    <a class="btn btn-xs btn-warning" href='<?php echo $li ?>' target="_blank"><b>Click to Join</b></a>
        </ol><br>
    <?php } else { ?>

    <?php } ?>

