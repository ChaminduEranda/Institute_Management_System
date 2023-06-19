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

<h1><a href="tutor.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a> <small>Satistics Overview</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page"><i class=""></i> Dashboard</li>
  </ol>
</nav>

  <?php if(isset($showrow)){ $tcid = $showrow['class_id'] ;} ?>


<div class="row student">
  <div class="col-sm-4">
    <div class="card text-white bg-primary mb-3">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-4">
            <i class="fa fa-users fa-3x"></i>
          </div>
          <div class="col-sm-8">
            <div class="float-sm-right">&nbsp;<span style="font-size: 30px">
                <?php
                $tId = $tushow['tId'];
                $stu = mysqli_query($db_con, "SELECT `sId` FROM `student_enroll` INNER JOIN `tutor_enroll` ON `student_enroll`.`class_id` = `tutor_enroll`.`class_id` INNER JOIN `student` ON `student`.`sId` = `student_enroll`.`student_id` WHERE `tutor_enroll`.`tutor_id` = '$tId';");
                $stu = mysqli_num_rows($stu);
                echo $stu;
                ?>
              </span>
            </div>
            <div class="clearfix"></div>
            <div class="float-sm-right">Total Students</div>
          </div>
        </div>
      </div>
      <div class="list-group-item-primary list-group-item list-group-item-action">
        <a href="tutor.php?page=all-students">
          <div class="row">
            <div class="col-sm-8">
              <p class=""> Students</p>
            </div>
            <div class="col-sm-4">
              <i class="fa fa-arrow-right float-sm-right"></i>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>



  <div class="col-sm-4">
    <div class="card text-white bg-info mb-3">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-4">
            <i class="fas fa-book-open fa-3x"></i>
          </div>
          <div class="col-sm-8">
            <div class="float-sm-right">&nbsp;<span style="font-size: 30px">
                <?php 
                $tcid = $tushow['tId'];
                $tusers = mysqli_query($db_con, "SELECT * FROM `tutor_enroll` INNER JOIN `class` ON `tutor_enroll`.`class_id` = `class`.`cId` WHERE `tutor_enroll`.`tutor_id` ='$tcid';");
                $tusers = mysqli_num_rows($tusers);
                echo $tusers;
                ?>
              </span></div>
            <div class="clearfix"></div>
            <div class="float-sm-right"> Classes</div>
          </div>
        </div>
      </div>
      <div class="list-group-item-primary list-group-item list-group-item-action">
        <a href="tutor.php?page=subject">
          <div class="row">
            <div class="col-sm-8">
              <p class=""> Classes</p>
            </div>
            <div class="col-sm-4">
              <i class="fa fa-arrow-right float-sm-right"></i>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="card text-white bg-warning mb-3">
      <div class="card-header">
        <div class="row">
          <?php $tIdshow = $_SESSION['user_login'];
          $userspro = mysqli_query($db_con, "SELECT * FROM `tutor` WHERE `tId`='$tIdshow';");
          $userrow = mysqli_fetch_array($userspro); ?>
          <div class="col-sm-6">
            <img class="showimg" src="../userimages/<?php echo $userrow['photo']; ?>">
            <div style="font-size: 20px"><?php echo ucwords($userrow['name']); ?></div>
          </div>
          <div class="col-sm-6">

            <div class="clearfix"></div>
            <div class="float-sm-right">Welcome!</div>
          </div>
        </div>
      </div>

      <div class="list-group-item-primary list-group-item list-group-item-action">
        <a href="tutor.php?page=tutor-userprofile">
          <div class="row">
            <div class="col-sm-8">
              <p class="">Your Profile</p>
            </div>
            <div class="col-sm-4">
              <i class="fa fa-arrow-right float-sm-right"></i>
            </div>
          </div>
        </a>
      </div>

    </div>
  </div>
</div>
<!-- <hr>
<h3> Students</h3>
<table class="table  table-striped table-hover table-bordered" id="data">
  <thead class="thead-dark">
    <tr>
      <th scope="col"></th>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Class</th>
      <th scope="col">Photo</th>
    </tr>
  </thead>
  <tbody>
    <?php
     $query = mysqli_query($db_con, "SELECT * FROM `student_enroll` INNER JOIN `tutor_enroll` ON `student_enroll`.`class_id` = `tutor_enroll`.`class_id` INNER JOIN `student` ON `student`.`sId` = `student_enroll`.`student_id` WHERE `tutor_enroll`.`tutor_id` = '$tId';");
     $i = 1;
    while ($result = mysqli_fetch_array($query)) { ?>
      <tr>
        <?php
        echo '<td>' . $i . '</td>
          <td>' . $result['sId'] . '</td>
          <td>' . $result['name'] . '</td>
          <td>' . $result['class_id'] . '</td>
          <td><img src="../userimages/' . $result['photo'] . '" height="50px"></td>'; ?>
      </tr>
    <?php $i++;
    } ?>

  </tbody>
</table> -->