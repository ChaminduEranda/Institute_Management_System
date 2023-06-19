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

<h1 class="text-primary"><i class="fas fa-marker"></i> Grade Assignments<small class="text-warning"> Submitted Assignments!</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="tutor.php">Dashboard </a></li>
    <li class="breadcrumb-item active" aria-current="page">Grade Assignments</li>
  </ol>
</nav>

<?php if (isset($_GET['delete']) || isset($_GET['edit'])) { ?>
  <div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
    <div class="toast-header">
      <strong class="mr-auto">Grading Alert</strong>
      <small><?php echo date('d-M-Y'); ?></small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      <?php
      if (isset($_GET['edit'])) {
        if ($_GET['edit'] == 'successs') {
          echo "<p style='color: green; font-weight: bold; '>Marks Added!</p>";
        }
      }
      if (isset($_GET['edit'])) {
        if ($_GET['edit'] == 'errorr') {
          echo "<p style='color: red; font-weight: bold;'>Marks Not Added!</p>";
        }
      }
      ?>
    </div>
  </div>
<?php } ?>
<!-- show answers -->

<br>

<table class="table  table-striped table-hover table-bordered" id="data">
    <thead class="thead-dark">
        <tr>
        <th scope="col">ID</th>
      <th scope="col">Student</th>
      <th scope="col">Class</th>
      <th scope="col">Marks</th>

      <th scope="col">Grade</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        $tcId = $tushow['tId'];
        $query = mysqli_query($db_con, "SELECT * FROM `assignments` WHERE `assignments`.`tutor_id` = '$tcId'");
        $abc = mysqli_fetch_array($query);
        if (isset($abc['Id'])) {
          $Id = $abc['Id'];
          $query1 = mysqli_query($db_con, "SELECT * FROM `answers` WHERE `tu_Id` = '$Id'");
        while ($data = mysqli_fetch_array($query1)) {
            $i++;
        ?>
            <tr>
                <td><?php echo $data['tu_Id']; ?> </td>
                <td><?php echo $data['student_id']; ?> </td>
                <td><?php echo $data['class_id']; ?> </td>
                <td>
                    <?php if(!empty($data['marks'])){ ?> 
                    <?php echo $data['marks']; ?> <?php }else{?>
                      <?php echo '<span class="label danger"><b>Not Graded</b></span>' ?>
                   <?php } ?>
                </td>
                <td><?php echo '<a class="btn btn-xs btn-warning"  href="tutor.php?page=answer-file&tu_Id=' . base64_encode($data['tu_Id']) . '&file=' . base64_encode($abc['file']) . '&student_id=' . base64_encode($data['student_id']) . '">
             <i class="fas fa-marker"></i></a>' ?> </td>
            </tr>
            </body>
            <?php }
    } ?>
    </tbody>
</table>

<hr>
<hr>
<br>