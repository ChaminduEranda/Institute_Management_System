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
  <title>tutor Dashboard</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img src="../images/login.jpg" width="150px" height="50px">

    <div class="navbar-collapse collapse justify-content-end" id="navbarSupportedContent">
      <?php $showuser = $_SESSION['user_login'];
      $tuha = mysqli_query($db_con, "SELECT * FROM `tutor` WHERE `tId`='$showuser';");
      $tushow = mysqli_fetch_array($tuha); 
      $haha = mysqli_query($db_con, "SELECT * FROM `tutor` INNER JOIN `tutor_enroll` ON `tutor`.`tId` = `tutor_enroll`.`tutor_id` WHERE `tId`='$showuser';");
      $showrow = mysqli_fetch_array($haha); 
      ?>
      
      <ul class="nav navbar-nav ">

        <!-- <li class="sa">
        <a class="sathra"><b>Sathra</b></a>
      </li> -->

        <li class="nav-item"><a class="nav-link" href="tutor.php?page=tutor-userprofile">
            <i class="fa fa-user"></i> Welcome <?php echo $tushow['name']; ?>!</a>
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
          <a href="tutor.php?page=tutor-dashboard" class="list-group-item list-group-item-action active">
            <i class="fas fa-tachometer-alt"></i> Dashboard
          </a>

          <a href="tutor.php?page=subject" class="list-group-item list-group-item-action"><i class="fas fa-book-open"></i> Classes</a>
          <a href="tutor.php?page=schedule" class="list-group-item list-group-item-action"><i class="fa fa-calendar"></i> Schedule</a>
          <a href="tutor.php?page=all-students" class="list-group-item list-group-item-action"><i class="fa fa-users"></i> Students</a>
          <a href="tutor.php?page=add-assignment" class="list-group-item list-group-item-action"><i class="fas fa-plus"> <i class="fas fa-pen"></i></i> Add Assignments</a>
          <a href="tutor.php?page=all-assignments" class="list-group-item list-group-item-action"><i class="fas fa-list"> <i class="fas fa-pen"></i></i></i> All Assignments</a>

          <a href="tutor.php?page=view-assign-answers" class="list-group-item list-group-item-action"><i class="fas fa-marker"></i> Grade Assignments</a>
           

          <a href="tutor.php?page=class-link" class="list-group-item list-group-item-action"><i class="fas fa-plus"> <i class="fas fa-link"></i></i> Add Class Link</a>
          
          <a href="tutor.php?page=reports" class="list-group-item list-group-item-action"><i class="fas fa-chart-area"></i> Reports</a>
          <a href="tutor.php?page=tutor-userprofile" class="list-group-item list-group-item-action"><i class="fa fa-user"></i> User Profile</a>

        </div>
      </div>
      <div class="col-md-9">
        <div class="content">
          <?php
          if (isset($_GET['page'])) {
            $page = $_GET['page'] . '.php';
          } else {
            $page = 'tutor-dashboard.php';
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