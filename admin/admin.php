<?php
ob_start();
require_once '../db_con.php';
session_start();
if (!isset($_SESSION['user_login'])) {
  header('Location: login.php');
}

?>

<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../css/fontawesome.min.css">
  <link rel="stylesheet" href="../css/solid.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
  <link rel="stylesheet" type="text/css" href="../css/style.css?v=<?php echo time(); ?>">

  <link rel="stylesheet" href="../css/bootstrap-responsive.min.css">
  <link rel="stylesheet" href="../css/bootstrap-custom.css">

  <script src="../js/jquery-3.5.1.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.dataTables.min.js"></script>
  <script src="../js/dataTables.bootstrap4.min.js"></script>
  <script src="../js/fontawesome.min.js"></script>
  <script src="../js/script.js"></script>
  <title>admin Dashboard</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">

    <img src="../images/login.jpg" width="100px" height="50px">
    <div class="navbar-collapse collapse justify-content-end" id="navbarSupportedContent">

      <?php $showuser = $_SESSION['user_login'];
      $haha = mysqli_query($db_con, "SELECT * FROM `admin` WHERE `aId`='$showuser';");
      $showrow = mysqli_fetch_array($haha); ?>
      <ul class="nav navbar-nav ">
        <li class="nav-item"><a class="nav-link" href="admin.php?page=admin-user-profile">
            <i class="fa fa-user"></i> Welcome <?php echo $showrow['name']; ?> ! </a>
        </li>

        <li class="nav-item"><a class="nav-link" href="../logout.php">
            <i class="fa fa-power-off"></i> Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <br>

  <?php
  $select = "SELECT * FROM `admin` WHERE `aId`='$showuser';";
  $result = $db_con->query($select);
  $row = $result->fetch_object()
  ?>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="list-group">
          <a href="admin.php?page=admin-dashboard" class="list-group-item list-group-item-action active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>

          <a href="admin.php?page=add-student" class="list-group-item list-group-item-action"><i class="fa fa-user-plus"></i> Add New Student</a>
          <a href="admin.php?page=all-student" class="list-group-item list-group-item-action"><i class="fa fa-users"></i> All Students</a>
          <a href="admin.php?page=allStudents" class="list-group-item list-group-item-action"><i class="fa fa-users"></i> Students Full Details</a>


          <a href="admin.php?page=enroll-student" class="list-group-item list-group-item-action"><i class="fa fa-user-plus"></i> Enroll Student</a>


          <a href="admin.php?page=add-class" class="list-group-item list-group-item-action"><i class="fas fa-book-open"></i> Classes</a>

          <?php
          if ($row->accessLevel == 'SuperAdmin') {
            echo '<a href="admin.php?page=add-tutor" class="list-group-item list-group-item-action"><i class="fa fa-user-plus"></i> Add Tutor</a>';
            echo '<a href="admin.php?page=all-tutors" class="list-group-item list-group-item-action"><i class="fa fa-users"></i> All Tutors</a>';
            echo '<a href="admin.php?page=enroll-tutor" class="list-group-item list-group-item-action"><i class="fa fa-user-plus"></i> Enroll Tutor</a>';
          }
          ?>

          <a href="admin.php?page=add-exam" class="list-group-item list-group-item-action"><i class="fas fa-clipboard-list"></i> Add Exam</a>
          <a href="admin.php?page=add-examResult" class="list-group-item list-group-item-action"><i class="fas fa-clipboard-list"></i> Add Exam Result</a>


          <a href="admin.php?page=payment" class="list-group-item list-group-item-action"><i class="fa fa-dollar-sign"></i> Payment</a>

          <!--<a href="admin.php?page=confirmstudent" class="list-group-item list-group-item-action"><i class="fa fa-user-plus"></i> Confirm New Students</a> -->
          <a href="admin.php?page=add-csv" class="list-group-item list-group-item-action"><i class="fas fa-users"></i> Attendence</a>
          <a href="admin.php?page=schedule" class="list-group-item list-group-item-action"><i class="fa fa-calendar"></i> Schedule</a>
          <a href="admin.php?page=reports" class="list-group-item list-group-item-action"><i class="fas fa-chart-area"></i> Reports</a>
          <a href="id-card.php" class="list-group-item list-group-item-action"><i class="fas fa-id-card"></i> Generate ID</a>


          <?php
          if ($row->accessLevel == 'SuperAdmin') {
            echo '<a href="admin.php?page=add-admin" class="list-group-item list-group-item-action"><i class="fa fa-user-plus"></i> Add Admins</a>';
            echo '<a href="admin.php?page=all-admins" class="list-group-item list-group-item-action"><i class="fa fa-users"></i> All Admins</a>';
            echo '<a href="admin.php?page=password-reset" class="list-group-item list-group-item-action"><i class="fas fa-key"></i> Reset Password</a>';
          }
          ?>
          <a href="admin.php?page=admin-user-profile" class="list-group-item list-group-item-action"><i class="fa fa-user"></i> User Profile</a>

        </div>
      </div>
      <div class="col-md-9">
        <div class="content">
          <?php
          if (isset($_GET['page'])) {
            $page = $_GET['page'] . '.php';
          } else {
            $page = 'admin-dashboard.php';
          }

          if (file_exists($page)) {
            require_once $page;
          } else {
            require_once '../404.php';
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>

  <script type="text/javascript">
    jQuery('.toast').toast('show');
  </script>
</body>

</html>