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

<h1 class="text-primary"><i class="fas fa-book-open"></i> Classes<small class="text-warning"> Classes of <?php echo $tushow['titleName'] ?><?php echo ucwords($tushow['name']) ?></small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="tutor.php">Dashboard </a></li>

    <li class="breadcrumb-item active" aria-current="page">Classes</li>
  </ol>
</nav>

<br>

<div class="row student">
  <?php
  $tId = $tushow['tId'];
  $query1 = mysqli_query($db_con, "SELECT * FROM `tutor_enroll` INNER JOIN `class` ON `tutor_enroll`.`class_id` = `class`.`cId` WHERE `tutor_enroll`.`tutor_id` ='$tId';");
  while ($result = mysqli_fetch_array($query1)) { ?>
    <div class="col-sm-5">
      <div class="card text-white bg-primary mb-5">
        <div class="card-header">
          <div class="row">

            <div class="col-sm-10">
              <div class="">
                <span style="font-size: 22px;">
                  <?php echo $result['cId'] ?><br>
                  <?php echo $result['batchName'] ?> - <?php echo $result['subName'] ?>
                </span>
              </div>
              <div class="clearfix"></div>
              <div class="float-sm-right"> </div>
            </div>
          </div>
        </div>&nbsp;
        <div class="list-group-item-primary list-group-item list-group-item-action">
          <?php echo '<a href="tutor.php?page=tutor-sub&cid=' . base64_encode($result['cId']) . '">' ?>
          <div class="row">
            <div class="col-sm-8">
              <p class=""> View</p>
            </div>
            <div class="col-sm-4">
              <i class="fa fa-arrow-right float-sm-right"></i>
            </div>
          </div>
          </a>
        </div>

      </div>
    </div>
  <?php
  }
  ?>
</div>