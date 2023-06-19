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


<h1 class="text-primary"><i class="fas fa-chart-area"></i> Progress<small class="text-warning"> Check Your Progress!</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="student.php">Dashboard </a></li>
    <li class="breadcrumb-item active" aria-current="page">Progress</li>
  </ol>
</nav>

<br><Br>


<div class="row">
    <div class="col-sm-2">
        <div class="form-group text-center">
            <input type="button" value="Attendence Report" class="btn btn-danger" onClick="window.open('std_attendence_report.php','_blank')" />
        </div>

        <br><br>

        <div class="form-group text-center">
            <input type="button" value="Exam Result Report" class="btn btn-danger" onClick="window.open('std_exam_resultreport.php','_blank')" />
        </div>
    
        <br><br>

        <!-- <div class="form-group text-center">
            <input type="button" value="Number of Students in classes Report" class="btn btn-danger" onClick="window.open('std_NoOfinClass_datareport.php','_blank')" />
        </div> -->
    </div>
</div>

