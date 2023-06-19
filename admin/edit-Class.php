<?php 
  $corepage = explode('/', $_SERVER['PHP_SELF']);
    $corepage = end($corepage);
    if ($corepage!=='admin.php') {
      if ($corepage==$corepage) {
        $corepage = explode('.', $corepage);
       header('Location: admin.php?page='.$corepage[0]);
     }
    }
    
    $cId = base64_decode($_GET['cId']);
   
  if (isset($_POST['updateclass'])) {
	$cId = $_POST['cId'];
	$batchName = $_POST['batchName'];
	$subName = $_POST['subName'];
	$monthFee = $_POST['monthFee'];
	
	$query = "UPDATE `class` SET `cId`='$cId',`batchName`='$batchName',`subName`='$subName',`monthFee`='$monthFee' WHERE `cId`= '$cId'";
  	if (mysqli_query($db_con,$query)) {
  		$datainsert['insertsucess'] = '<p style="color: green;">Class Updated!</p>';
  		header('Location: admin.php?page=add-Class&edit=successs');
  	}else{
  		header('Location: admin.php?page=add-Class&edit=errorr');
  	} 
  }
?>
<h1 class="text-primary"><i class="fas fa-user-plus"></i>  Edit Class Informations!<small class="text-warning"> Edit Class!</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="admin.php">Dashboard </a></li>
     <li class="breadcrumb-item" aria-current="page"><a href="admin.php?page=add-Class">Classes</a></li>
     <li class="breadcrumb-item active" aria-current="page">Add Class</li>
  </ol>
</nav>

	<?php
		if (isset($cId)) {
			$query = "SELECT * FROM `class` WHERE `cId`='$cId'";
			$result = mysqli_query($db_con,$query);
			$row = mysqli_fetch_array($result);
		}
	 ?>
<div class="row">
<div class="col-sm-6">
	<form enctype="multipart/form-data" method="POST" action="">

	<div class="form-group">
				<label for="cId">Class ID</label>
				<input name="cId" type="text" class="form-control" id="cId" value="<?php echo $row['cId']; ?>" required="">
			</div>

      <div class="form-group">
				<label for="batchName">Batch Name</label>
				<input name="batchName" type="text" class="form-control" id="batchName" value="<?php echo $row['batchName']; ?>" required="">
			</div>

			<div class="form-group">
				<label for="subName">Subject</label>
				<input name="subName" type="text" class="form-control" id="subName" value="<?php echo $row['subName']; ?>" required="">
			</div>
      
      <div class="form-group">
		    <label for="monthFee">Fee (Rs.)</label>
		    <input name="monthFee" type="text" class="form-control" id="monthFee" value="<?php echo $row['monthFee']; ?>" required="">
	  	</div>


	  	<div class="form-group text-center">
		    <input name="updateclass" value="Update Class" type="submit" class="btn btn-danger">
	  	</div>
	 </form>
</div>
</div>