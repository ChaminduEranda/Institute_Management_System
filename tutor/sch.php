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


<h1 class="text-primary"><i class="fa fa-calendar"></i> View Schedule<small class="text-warning"> View Class Schedule!</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="tutor.php">Dashboard </a></li>
    <li class="breadcrumb-item" aria-current="page"><a href="schedule.php"> Schedule</a></li>
    <li class="breadcrumb-item active" aria-current="page"> View</li>
  </ol>
</nav>

<?php

$sce = base64_decode($_GET['class_id']);
$select = "SELECT * FROM `class` WHERE `cId` = '$sce';";
$result = $db_con->query($select);
while ($row = $result->fetch_object()) {
  $pdf = $row->schedule;
  $path = $row->directory;
}

echo '<strong>File Name : </strong>' . $pdf;
?>
<br /><br />
<iframe src="<?php echo $path . $pdf; ?>" width="90%" height="500px">
</iframe>