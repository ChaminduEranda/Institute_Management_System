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

<h1><a href="student.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a> <small>Satistics Overview</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page"><i class=""></i> Dashboard</li>
  </ol>
</nav>

<?php $showstd = $_SESSION['user_login'];
$st = mysqli_query($db_con, "SELECT * FROM `student` WHERE `sId`='$showstd';");
$showrow = mysqli_fetch_array($st);

$stid = $showrow['sId'];
$query = mysqli_query($db_con, "SELECT * FROM `class` INNER JOIN `student_enroll` ON `class`.`cId` = `student_enroll`.`class_id` WHERE `student_enroll`.`student_id` ='$stid';");
$row = mysqli_fetch_array($query);
$subid = $row['class_id'];
$query1 = mysqli_query($db_con, "SELECT * FROM `class` WHERE `cId` = '$subid';");
$stu = mysqli_num_rows($query);

?>


<div class="row student">
  <div class="col-sm-4">
    <div class="card text-white bg-primary mb-3">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-4">
            <i class="fa fa-book fa-3x"></i>
          </div>
          <div class="col-sm-8">
            <div class="float-sm-right">&nbsp;
              <span style="font-size: 30px">
                <?php 
                echo $stu;
                ?>
              </span>
            </div>
            <div class="clearfix"></div>
            <div class="float-sm-right"> Your Subjects</div>
          </div>
        </div>
      </div>
      <div class="list-group-item-primary list-group-item list-group-item-action">
        <a href="student.php?page=subjects">
          <div class="row">
            <div class="col-sm-8">
              <p class=""> Subjects</p>
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
          <?php $sIdshow = $_SESSION['user_login'];
          $userspro = mysqli_query($db_con, "SELECT * FROM `student` WHERE `sId`='$sIdshow';");
          $userrow = mysqli_fetch_array($userspro); ?>
          <div class="col-sm-8">
            <img class="showimg" src="../userimages/<?php echo $userrow['photo']; ?>">
            <div style="font-size: 20px"><?php echo ucwords($userrow['name']); ?></div>
          </div>
         
        </div>
      </div>

      <div class="list-group-item-primary list-group-item list-group-item-action">
        <a href="student.php?page=student-userprofile">
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
<h3>Tutors</h3>
<table class="table  table-striped table-hover table-bordered" id="data">
  <thead class="thead-dark">
    <tr>
      <th scope="col"></th>
      <th scope="col">Name</th>
      <th scope="col">Contact</th>
      <th scope="col">Photo</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $query = mysqli_query($db_con, 'SELECT * FROM `tutor` ORDER BY `tutor`.`tid` ASC;');
    $i = 1;
    while ($result = mysqli_fetch_array($query)) { ?>
      <tr>
        <?php
        echo '<td>' . $i . '</td>        
          <td>' . ucwords($result['name']) . '</td>
          <td>' . $result['phone'] . '</td>
          <td><img src="../userimages/' . $result['photo'] . '" height="50px"></td>'; ?>
      </tr>
    <?php $i++;
    } ?>

  </tbody>
</table> -->