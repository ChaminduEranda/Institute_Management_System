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

<h1 class="text-primary"><i class="fas fa-pen"></i> Assignment</h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="student.php">Dashboard </a></li>
    <li class="breadcrumb-item active" aria-current="page"> Assignment</li>
  </ol>
</nav>

<?php

?>

<table class="table  table-striped table-hover table-bordered" id="data">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Title</th>
      <th scope="col">Class</th>
      <th scope="col">View</th>
    </tr>
  </thead>
  <tbody>

    <?php
    $tcid = $showrow['class_id'];
    $tsid = $showrow['sId'];
    $query1 = mysqli_query($db_con, "SELECT * FROM `assignments` INNER JOIN `student_enroll` ON `assignments`.`class_id` = `student_enroll`.`class_id` WHERE`student_enroll`.`student_id` = '$tsid';");
    while ($result3 = mysqli_fetch_array($query1)) { ?>
      <tr>
        <?php
        echo '
        <td>' . $result3['Id'] . '</td>
        <td>' . $result3['title'] . '</td>
        <td>' . $result3['class_id'] . '</td>                
          <td>
             &nbsp; <a class="btn btn-xs btn-warning"  href="student.php?page=submit-assignments&Id=' . base64_encode($result3['Id']) . '&file=' . base64_encode($result3['file']) . '">
             <i class="fa fa-eye"></i></a></td>'; ?>
      </tr>
    <?php } ?>

  </tbody>
</table>

<hr>
<hr>
<br>