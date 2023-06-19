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

<h1 class="text-primary"><i class="fas fa-laptop"></i> New Tutorials</h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="student.php">Dashboard </a></li>
    <li class="breadcrumb-item active" aria-current="page"> Tutorials</li>
  </ol>
</nav>



