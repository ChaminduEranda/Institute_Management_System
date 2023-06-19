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

<h1 class="text-primary"><i class="fas fa-list"></i> <i class="fas fa-pen"></i>All Assignments<small class="text-warning"> All Assignments list!</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="tutor.php">Dashboard </a></li>
    <li class="breadcrumb-item active" aria-current="page">All Assignment</li>
    <li class="breadcrumb-item active" aria-current="page">Tutor - <?php echo $tushow['titleName'].$tushow['name'];?></li>
     
  </ol>
</nav>



<?php if (isset($_GET['delete']) || isset($_GET['edit'])) { ?>
  <div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
    <div class="toast-header">
      <strong class="mr-auto">Assignment Edit Alert</strong>
      <small><?php echo date('d-M-Y'); ?></small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      <?php
      if (isset($_GET['delete'])) {
        if ($_GET['delete'] == 'succes') {
          echo "<p style='color: green; font-weight: bold;'>Assignment Deleted Successfully!</p>";
        }
      }
      if (isset($_GET['delete'])) {
        if ($_GET['delete'] == 'erro') {
          echo "<p style='color: red'; font-weight: bold;>Assignment Not Deleted!</p>";
        }
      }
      if (isset($_GET['edit'])) {
        if ($_GET['edit'] == 'successs') {
          echo "<p style='color: green; font-weight: bold; '>Assignment Edited Successfully!</p>";
        }
      }
      if (isset($_GET['edit'])) {
        if ($_GET['edit'] == 'errorr') {
          echo "<p style='color: red; font-weight: bold;'>Assignment Not Edited!</p>";
        }
      }
      ?>
    </div>
  </div>
<?php } ?>
<table class="table  table-striped table-hover table-bordered" id="data">
  <thead class="thead-dark">
    <tr>
      <th scope="col"> ID</th>
      <th scope="col"> Class</th>
      <th scope="col"> Start</th>
      <th scope="col"> Due</th>
      <th scope="col"> Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $tcId = $tushow['tId'];
    $query = mysqli_query($db_con, "SELECT * FROM `assignments` WHERE `assignments`.`tutor_id` = '$tcId'");
    while ($result = mysqli_fetch_array($query)) { ?>
      <tr>
        <?php
        echo '
		      <td>' . $result['Id'] . '</td>
          <td>' . $result['class_id'] . '</td>
          <td>' . $result['start_date'] . '</td>
          <td>' . $result['due_date'] . '</td>
      
          <td>
            <a class="btn btn-xs btn-warning" href="tutor.php?page=edit-assignment&Id=' . base64_encode($result['Id']) . '&file=' . base64_encode($result['file']) . '">
              <i class="fa fa-edit"></i></a>

              &nbsp; <a class="btn btn-xs btn-warning"  href="tutor.php?page=view-assign&Id=' . base64_encode($result['Id']) . '&file=' . base64_encode($result['file']) . '">
              <i class="fa fa-eye"></i></a>

             &nbsp; <a class="btn btn-xs btn-danger" onclick="javascript:confirmationDelete($(this));return false;" href="tutor.php?page=delete-assignment&Id=' . base64_encode($result['Id']) .  '&file=' . base64_encode($result['file']) . '">
             <i class="fas fa-trash-alt"></i></a> </td>'; ?>
      </tr>
    <?php } ?> 

  </tbody>
</table>
<script type="text/javascript">
  function confirmationDelete(anchor) {
    var conf = confirm('Are you sure want to delete this record?');
    if (conf)
      window.location = anchor.attr("href");
  }
</script>