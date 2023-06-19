<?php 
$user=  $_SESSION['user_login'];
  $corepage = explode('/', $_SERVER['PHP_SELF']);
    $corepage = end($corepage);
    if ($corepage!=='student.php') {
      if ($corepage==$corepage) {
        $corepage = explode('.', $corepage);
       header('Location: student.php?page='.$corepage[0]);
     }
    }
?>
<h1 class="text-primary"><i class="fas fa-user"></i>  User Profile</h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="student.php">Dashboard </a></li>
     <li class="breadcrumb-item active" aria-current="page">User Profile</li>
  </ol>
</nav>
<?php 
  $query = mysqli_query($db_con, "SELECT * FROM `student` WHERE `sId` ='$user';");
  $row = mysqli_fetch_array($query);

 ?>
<div class="row">
  <div class="col-sm-6">
    <table class="table table-bordered">
      <tr>
        <td>User ID</td>
        <td><?php echo $row['sId']; ?></td>
      </tr>
      <tr>
        <td>Name</td>
        <td><?php echo ucwords($row['name']); ?></td>
      </tr>
      <tr>
        <td>Email</td>
        <td><?php echo $row['email']; ?></td>
      </tr>
    </table>
    <a class="btn btn-warning pull-right" href="student.php?page=edit-userprofile&sId=<?php echo base64_encode($row['sId']); ?>">Edit Profile</a>
  </div>
  <div class="col-sm-6">
    <h3>Profile Picture</h3>
    <a href="../userimages/?php echo $row['photo']; ?>">
      <img class="img-thumbnail" id="imguser" src="../userimages/<?php echo $row['photo']; ?>" width="200px">
    </a>
    <?php 
        if (isset($_POST['upphoto'])) {
          unlink('../userimages/'.$row['photo']);
          $photo = $_FILES['userphoto']['name'];
	  	    $photo = explode('.', $photo);
		      $photo = end($photo); 
          $photofile = $_FILES['userphoto']['tmp_name'];
          $upphoto = $user.'.'.$photo;
          if (mysqli_query($db_con, "UPDATE `student` SET `photo` = '$upphoto' WHERE `student`.`sId` = '$user';")) {
            move_uploaded_file($photofile, '../userimages/'.$upphoto);
          }else{
            echo "Profile Picture Not Uploaded";
          }
        }
     ?><br>
    <form method="POST" enctype="multipart/form-data">
      <input type="file" name="userphoto" required="" id="photo"><br>
      <input class="btn btn-info" type="submit" name="upphoto" value="Upload Photo">
    </form>
  </div>
</div>



<br>
<a class="btn btn-warning pull-right" href="changepwinside.php?&sId=<?php echo base64_encode($row['sId']); ?>">Change Password</a>
  