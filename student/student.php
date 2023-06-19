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


  <script src="../js/jquery-3.5.1.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.dataTables.min.js"></script>
  <script src="../js/dataTables.bootstrap4.min.js"></script>
  <script src="../js/fontawesome.min.js"></script>
  <script src="../js/script.js"></script>
  <title>Student Dashboard</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img src="../images/login.jpg" width="150px" height="50px">
    <div class="navbar-collapse collapse justify-content-end" id="navbarSupportedContent">
      <?php $showuser = $_SESSION['user_login'];
      $haha = mysqli_query($db_con, "SELECT * FROM `student` INNER JOIN `student_enroll` ON `student`.`sId` = `student_enroll`.`student_id` WHERE `sId`='$showuser';");
      $showrow = mysqli_fetch_array($haha); ?>
      <ul class="nav navbar-nav ">
        <li class="nav-item"><a class="nav-link" href="student.php?page=student-userprofile">
            <i class="fa fa-user"></i> Welcome <?php echo $showrow['name']; ?>!</a>
        </li>

        <li class="nav-item"><a class="nav-link" href="../logout.php">
            <i class="fa fa-power-off"></i> Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <br>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="list-group">
          <a href="student.php?page=student-dashboard" class="list-group-item list-group-item-action active">
            <i class="fas fa-tachometer-alt"></i> Dashboard
          </a>

          <a href="student.php?page=subjects" class="list-group-item list-group-item-action"><i class="fas fa-book-open"></i> Subjects</a>

          <a href="student.php?page=exame-results" class="list-group-item list-group-item-action"><i class="fas fa-clipboard-list"></i> Exam Results</a>

          <a href="student.php?page=schedule" class="list-group-item list-group-item-action"><i class="fa fa-calendar"></i> Schedule</a>

          <!-- <a href="student.php?page=progress" class="list-group-item list-group-item-action"><i class="fa fa-chart-bar"></i> Progress</a> -->

          <a href="student.php?page=assignments" class="list-group-item list-group-item-action"><i class="fa fa-pen"></i> Assignments</a>
        
        
          <a href="student.php?page=student-userprofile" class="list-group-item list-group-item-action"><i class="fa fa-user"></i> User Profile</a>

        </div>
      </div>
      <div class="col-md-9">
        <div class="content">
          <?php
          if (isset($_GET['page'])) {
            $page = $_GET['page'] . '.php';
          } else {
            $page = 'student-dashboard.php';
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