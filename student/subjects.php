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

<h1 class="text-primary"><i class="fas fa-book-open"></i> Subjects</h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="student.php">Dashboard </a></li>
    <li class="breadcrumb-item active" aria-current="page"> Subjects</li>
  </ol>
</nav>

<br>

<div class="row student">
  <?php
  $stid = $showrow['sId'];
  $query1 = mysqli_query($db_con, "SELECT * FROM `student_enroll` INNER JOIN `class` ON `student_enroll`.`class_id` = `class`.`cId` WHERE `student_enroll`.`student_id` ='$stid';");
  while ($result = mysqli_fetch_array($query1)) { ?>
    <div class="col-sm-5">
      <div class="card text-white bg-primary mb-5">
        <div class="card-header">
          <div class="row">

            <div class="col-sm-10">
              <div class="">
                <span style="font-size: 30px;">
                  <?php echo $result['subName'] ?>
                </span>
              </div>
              <div class="clearfix"></div>
              <div class="float-sm-right"> </div>
            </div>
          </div>
        </div>&nbsp;
        <div class="list-group-item-primary list-group-item list-group-item-action">
          <?php echo '<a href="student.php?page=student-sub&cid=' . base64_encode($result['cId']) . '">' ?>
          <div class="row">
            <div class="col-sm-8">
              <p class=""> View</p>
            </div>
            <div class="col-sm-4">
              <i class="fa fa-arrow-right float-sm-right"></i>
            </div>
          </div>
          </a>
        </div>

      </div>
    </div>
  <?php
  }
  ?>
</div>