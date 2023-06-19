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
?>



<h1 class="text-primary"><i class="fa fa-calendar"></i> Schedule<small class="text-warning"> Class Schedule!</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="student.php">Dashboard </a></li>
    <li class="breadcrumb-item active" aria-current="page"> Schedule</li>
  </ol>
</nav>

<table class="table  table-striped table-hover table-bordered" id="data">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Schedule</th>
      <th scope="col">View</th>
    </tr>
  </thead>
  <tbody>
    <?php
     $stid = $showrow['sId'];
    $query1 = mysqli_query($db_con, "SELECT * FROM `student_enroll` INNER JOIN `class` ON `student_enroll`.`class_id` = `class`.`cId` WHERE `student_enroll`.`student_id` ='$stid';");
     while ($result3 = mysqli_fetch_array($query1)) { ?>
      <tr>
        <?php
        echo '
        <td>' . $result3['schedule'] . '</td>
                
          <td>
             &nbsp; <a class="btn btn-xs btn-warning"  href="student.php?page=sch&class_id=' . base64_encode($result3['class_id']) . '">
             <i class="fa fa-eye"></i></a></td>'; ?>
      </tr>
    <?php } ?>

  </tbody>
</table>

<hr>
<hr>
<br>
