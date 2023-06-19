<?php 
  $corepage = explode('/', $_SERVER['PHP_SELF']);
    $corepage = end($corepage);
    if ($corepage!=='tutor.php') {
      if ($corepage==$corepage) {
        $corepage = explode('.', $corepage);
       header('Location: tutor.php?page='.$corepage[0]);
     }
    }
?>
<h1 class="text-primary"><i class="fas fa-users"></i>  All Students<small class="text-warning"> All Students List!</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="tutor.php">Dashboard </a></li>
     <li class="breadcrumb-item active" aria-current="page">All Students</li>
  </ol>
</nav>

<table class="table  table-striped table-hover table-bordered" id="data">
  <thead class="thead-dark">
    <tr>
     
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Class</th>
      <th scope="col">Tel</th>
      <th scope="col">Photo</th>  
      <th scope="col">Email</th>   
    </tr>
  </thead>
  <tbody>
    <?php 

      $tId = $tushow['tId'];
      $query = mysqli_query($db_con, "SELECT * FROM `student_enroll` INNER JOIN `tutor_enroll` ON `student_enroll`.`class_id` = `tutor_enroll`.`class_id` INNER JOIN `student` ON `student`.`sId` = `student_enroll`.`student_id` WHERE `tutor_enroll`.`tutor_id` = '$tId';");           
      while ($result = mysqli_fetch_array($query)) { ?>
      <tr>
        <?php 
        echo '
        <td>'.$result['student_id'].'</td>
        <td>'.$result['name'].'</td>  
        <td>'.$result['class_id'].'</td>  
        <td>'.$result['phone'].'</td>
        <td><img src="../userimages/'.$result['photo'].'" height="50px"></td>
        <td>'.$result['email'].'</td>  
            
          ';?>
      </tr>  
     <?php } ?>
    
  </tbody>
</table>

