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

<h1 class="text-primary"><i class="fa fa-calendar"></i> Schedule<small class="text-warning"> Class Schedule!</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="tutor.php">Dashboard </a></li>
    <li class="breadcrumb-item active" aria-current="page"> Schedule</li>
  </ol>
</nav>



<!-- show schedule -->


<table class="table  table-striped table-hover table-bordered" id="data">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Schedule</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
   $tId = $tushow['tId'];
   $query1 = mysqli_query($db_con, "SELECT * FROM `tutor_enroll` INNER JOIN `class` ON `tutor_enroll`.`class_id` = `class`.`cId` WHERE `tutor_enroll`.`tutor_id` ='$tId';");
    while ($result3 = mysqli_fetch_array($query1)) { ?>
      <tr>
        <?php
        echo '
        <td>' . $result3['schedule'] . '</td>
                
          <td>
             &nbsp; <a class="btn btn-xs btn-warning"  href="tutor.php?page=sch&class_id=' . base64_encode($result3['class_id']) . '">
             <i class="fa fa-eye"></i></a></td>'; ?>
      </tr>
    <?php } ?>

  </tbody>
</table>

<hr>
<hr>
<br>