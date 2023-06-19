<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'admin.php') {
  if ($corepage == $corepage) {
    $corepage = explode('.', $corepage);
    header('Location: admin.php?page=' . $corepage[0]);
  }
}

if (isset($_POST['addSchedule'])) {

  $cId = $_POST['cId'];
  $filename = $_POST['filename'];

  $sch = explode('.', $_FILES['file']['name']);
  $sch = end($sch);
  $sch_name = $filename . '.' . $sch;

  $query = "UPDATE `class` SET `schedule` = '$sch_name' , `directory` = '/OSLO/files/' WHERE `class`.`cId`= '$cId'";
  if (mysqli_query($db_con, $query)) {
    $datainsert['insertsucesss'] = '<p style="color: green;">Schedule Added!</p>';
    move_uploaded_file($_FILES['file']['tmp_name'], '../files/' . $sch_name);
  } else {
    $datainsert['inserterrorr'] = '<p style="color: red;">Schedule Not Added, please input right informations!</p>';
  }
}
?>

<h1 class="text-primary"><i class="fa fa-calendar"></i> Schedule<small class="text-warning"> Class Schedule!</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="admin.php">Dashboard </a></li>
    <li class="breadcrumb-item active" aria-current="page"> Schedule</li>
  </ol>
</nav>

<div class="row">

  <div class="col-sm-6">
    <?php if (isset($datainsert)) { ?>
      <div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
        <div class="toast-header">
          <strong class="mr-auto">Schedule Insert Alert</strong>
          <small><?php echo date('d-M-Y'); ?></small>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body">
          <?php
          if (isset($datainsert['insertsucesss'])) {
            echo $datainsert['insertsucesss'];
          }
          if (isset($datainsert['inserterrorr'])) {
            echo $datainsert['inserterrorr'];
          }
          ?>
        </div>
      </div>
    <?php } ?>

    <?php
    $qt = "SELECT * FROM `class`";
    $re2 = mysqli_query($db_con, $qt);
    ?>

    <form enctype="multipart/form-data" method="POST" action="">


      <div class="form-group">
        <label for="">Class</label>
        <select name="cId" class="form-control" id="" value="<?= isset($cId) ? $cId : '' ?>">

          <?php while ($r2 = mysqli_fetch_array($re2)) :; ?>

            <option value="<?php echo $r2[0]; ?>"><?php echo $r2[0]; ?> - <?php echo $r2[1]; ?> - <?php echo $r2[2]; ?> </option>

          <?php endwhile; ?>
        </select>

      </div>


      <div class="form-group">
        <label for="filename">File Name</label>
        <input name="filename" type="filename" class="form-control" id="filename" required="">
      </div>


      <div class="form-group">
        <label for="file">File</label>
        <input name="file" type="file" class="form-control" id="file" required="">
      </div>

      <br>
      <div class="form-group text-center">
        <input name="addSchedule" value="Add Schedule" type="submit" class="btn btn-danger">
      </div>

    </form>
  </div>
</div>

<br><br>
<!-- show schedule -->

<?php if (isset($_GET['delete']) || isset($_GET['edit'])) { ?>
  <div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
    <div class="toast-header">
      <strong class="mr-auto">schedule Edit Alert</strong>
      <small><?php echo date('d-M-Y'); ?></small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      <?php
      if (isset($_GET['delete'])) {
        if ($_GET['delete'] == 'succes') {
          echo "<p style='color: green; font-weight: bold;'>schedule Deleted Successfully!</p>";
        }
      }
      if (isset($_GET['delete'])) {
        if ($_GET['delete'] == 'erro') {
          echo "<p style='color: red'; font-weight: bold;>schedule Not Deleted!</p>";
        }
      }
      ?>
    </div>
  </div>
<?php } ?>
<table class="table  table-striped table-hover table-bordered" id="data">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Subject</th>
      <th scope="col">Schedule</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $query1 = mysqli_query($db_con, 'SELECT * FROM `class`');
    while ($result3 = mysqli_fetch_array($query1)) { ?>
      <tr>
        <?php
        echo '
		      <td>' . $result3['cId'] . '</td>
          <td>' . $result3['batchName'] . '</td>
          <td>' . $result3['subName'] . '</td>
          <td>' . $result3['schedule'] . '</td>
          
          <td>
             &nbsp; <a class="btn btn-xs btn-warning"  href="admin.php?page=sch&cId=' . base64_encode($result3['cId']) . '">
             <i class="fa fa-eye"></i></a>

          
             &nbsp; <a class="btn btn-xs btn-danger" onclick="javascript:confirmationDelete($(this));return false;" href="admin.php?page=delete-schedule&cId=' . base64_encode($result3['cId']) . '&schedule=' . base64_encode($result3['schedule']) . '">
             <i class="fas fa-trash-alt"></i></a></td>'; ?>
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