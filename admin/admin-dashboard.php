<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'admin.php') {
  if ($corepage == $corepage) {
    $corepage = explode('.', $corepage);
    header('Location: admin.php?page=' . $corepage[0]);
  }
}
?>

<h1><a href="admin.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a> <small>Satistics Overview</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page"><i class=""></i> Dashboard</li>
  </ol>
</nav>

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
            <?php $stu = mysqli_query($db_con, 'SELECT * FROM `student`');
            $stu = mysqli_num_rows($stu);
            echo $stu; ?></span>
            </div>
            <div class="clearfix"></div>
            <div class="float-sm-right">Total Students</div>
          </div>
        </div>
      </div>
      <div class="list-group-item-primary list-group-item list-group-item-action">
        <a href="admin.php?page=all-student">
          <div class="row">
            <div class="col-sm-8">
              <p class="">All Students</p>
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
    <div class="card text-white bg-primary mb-3">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-4">
            <i class="fa fa-users fa-3x"></i>
          </div>
          <div class="col-sm-8">
            <div class="float-sm-right">&nbsp;<span style="font-size: 30px">
            <?php $stu = mysqli_query($db_con, 'SELECT * FROM `tutor`');
            $stu = mysqli_num_rows($stu);
            echo $stu; ?></span>
            </div>
            <div class="clearfix"></div>
            <div class="float-sm-right">Total Tutors</div>
          </div>
        </div>
      </div>
      <div class="list-group-item-primary list-group-item list-group-item-action">
        <a href="admin.php?page=all-tutors">
          <div class="row">
            <div class="col-sm-8">
              <p class="">All Tutors</p>
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
    <div class="card text-white bg-primary mb-3">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-4">
            <i class="fa fa-book fa-3x"></i>
          </div>
          <div class="col-sm-8">
            <div class="float-sm-right">&nbsp;<span style="font-size: 30px">
            <?php $stu = mysqli_query($db_con, 'SELECT * FROM `class`');
            $stu = mysqli_num_rows($stu);
            echo $stu; ?></span>
            </div>
            <div class="clearfix"></div>
            <div class="float-sm-right">Total Classes</div>
          </div>
        </div>
      </div>
      <div class="list-group-item-primary list-group-item list-group-item-action">
        <a href="admin.php?page=add-Class">
          <div class="row">
            <div class="col-sm-8">
              <p class="">Classes</p>
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
    <br>
    <div class="card text-white bg-warning mb-3">
      <div class="card-header">
        <div class="row">
          <?php $aIdshow = $_SESSION['user_login'];
          $userspro = mysqli_query($db_con, "SELECT * FROM `admin` WHERE `aId`='$aIdshow';");
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
        <a href="admin.php?page=admin-user-profile">
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


<!-- <h3>New Students</h3>
<table class="table  table-striped table-hover table-bordered" id="data">
  <thead class="thead-dark">
    <tr>
      <th scope="col"></th>
      <th scope="col">Student ID</th>
      <th scope="col">Name</th>
      <th scope="col">NIC</th>
      <th scope="col">Photo</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $query = mysqli_query($db_con, 'SELECT * FROM `student` ORDER BY `student`.`sId` ASC;');
    $i = 1;
    while ($result = mysqli_fetch_array($query)) { ?>
      <tr>
        <?php
        echo '<td>' . $i . '</td>
          <td>' . $result['sId'] . '</td>
          <td>' . $result['name'] . '</td>
          <td>' . $result['nic'] . '</td>
          <td><img src="../userimages/' . $result['photo'] . '" height="50px"></td>'; ?>
      </tr>
    <?php $i++;
    } ?>

  </tbody>
</table> -->