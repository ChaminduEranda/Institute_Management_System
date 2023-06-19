<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'tutor.php') {
  if ($corepage == $corepage) {
    $corepage = explode('.', $corepage);
    header('Location: tutor.php?page=' . $corepage[0]);
  }
}



if (isset($_POST['addtutorial'])) {
  $tutorialttitle = $_POST['tutorialttitle'];
 
  $file = explode('.', $_FILES['file']['name']);
	$file = end($file);
	$file_name = $tutorialttitle . '.' . $file;

  $tId = $showrow['tId'];

  $query = "INSERT INTO `adminuploads`(`fileName`, `tfId`, `title`, `description`, `startDate`, `dueDate`, `type`) VALUES ('$file_name','$tId','$tutorialttitle',null,null,null,'Tutorial');";

  if (mysqli_query($db_con, $query)) {
    $datainsert['insertsucesss'] = '<p style="color: green;">Tutorial Inserted!</p>';
    move_uploaded_file($_FILES['file']['tmp_name'], '../files/' . $file_name);
  } else {
    $datainsert['inserterrorr'] = '<p style="color: red;">Tutorial Not Inserted, please input right informations!</p>';
  }
}
?>
<h1 class="text-primary"><i class="fas fa-laptop"></i> Add Tutorials<small class="text-warning"> Add New Tutorial!</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="tutor.php">Dashboard </a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Tutorial</li>
  </ol>
</nav>

<div class="row">

  <div class="col-sm-6">
    <?php if (isset($datainsert)) { ?>
      <div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
        <div class="toast-header">
          <strong class="mr-auto">Insert Alert</strong>
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

  

    <form enctype="multipart/form-data" method="POST" action="">
    
    <div class="form-group">
        <label for="tutorialttitle">Tutorial Title</label>
        <textarea name="tutorialttitle" type="text" rows="2" cols="100" type="text" class="" id="tutorialttitle" value="<?= isset($tutorialttitle) ? $tutorialttitle : ''; ?>" required="">
        </textarea>
      </div>

      <div class="form-group">
		    <label for="file">File</label>
		    <input name="file" type="file" class="form-control" id="file" value="<?= isset($file) ? $file : ''; ?>" required="">
	  	</div>

    

      <div class="form-group text-center">
        <input name="addtutorial" value="Add Tutorial" type="submit" class="btn btn-danger">
      </div>
    </form>
  </div>
</div>

<!-- All class table  -->

<br>

<?php if (isset($_GET['delete']) || isset($_GET['edit'])) { ?>
  <div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
    <div class="toast-header">
      <strong class="mr-auto">Edit Alert</strong>
      <small><?php echo date('d-M-Y'); ?></small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      <?php
      if (isset($_GET['delete'])) {
        if ($_GET['delete'] == 'succes') {
          echo "<p style='color: green; font-weight: bold;'>Tutorial Deleted Successfully!</p>";
        }
      }
      if (isset($_GET['delete'])) {
        if ($_GET['delete'] == 'erro') {
          echo "<p style='color: red'; font-weight: bold;>Tutorial Not Deleted!</p>";
        }
      }
      if (isset($_GET['edit'])) {
        if ($_GET['edit'] == 'successs') {
          echo "<p style='color: green; font-weight: bold; '>Tutorial Edited Successfully!</p>";
        }
      }
      if (isset($_GET['edit'])) {
        if ($_GET['edit'] == 'errorr') {
          echo "<p style='color: red; font-weight: bold;'>Tutorial Not Edited!</p>";
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
      <th scope="col">Title</th>
      <th scope="col">Type</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
   $query = mysqli_query($db_con, "SELECT * FROM `adminuploads` WHERE `adminuploads`.`type` = 'Tutorial'  ORDER BY `adminuploads`.`fId` ASC;");
   while ($result = mysqli_fetch_array($query)) { ?>
      <tr>
        <?php
        echo '
		      <td>' . $result['fId'] . '</td>
          <td>' . $result['title'] . '</td>
          <td>' . $result['type'] . '</td>
      
          <td>
            <a class="btn btn-xs btn-warning" href="tutor.php?page=edittutorial&fId=' . base64_encode($result['fId']) . '">
              <i class="fa fa-edit"></i></a>

             &nbsp; <a class="btn btn-xs btn-danger" onclick="javascript:confirmationDelete($(this));return false;" href="tutor.php?page=deletetutorial&fId=' . base64_encode($result['fId']) . '">
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