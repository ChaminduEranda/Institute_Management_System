<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'admin.php') {
  if ($corepage == $corepage) {
    $corepage = explode('.', $corepage);
    header('Location: admin.php?page=' . $corepage[0]);
  }
}
?>
<h1 class="text-primary"><i class="fas fa-users"></i> Full Details<small class="text-warning"> Check Students Full Details!</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="admin.php">Dashboard </a></li>
    <li class="breadcrumb-item active" aria-current="page">Full Details</li>
  </ol>
</nav>

<table class="table  table-striped table-hover table-bordered" id="data">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Status</th>
      <th scope="col">Full Details</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 0;
    $query = mysqli_query($db_con, 'SELECT * FROM `student` ORDER BY `student`.`sId` DESC;');
    while ($result = mysqli_fetch_array($query)) {
      $i++; ?>
      <tr>
        <td><?php echo $result['sId']; ?> </td>
        <td><?php echo ucwords($result['name']); ?> </td>
        <td>
          <?php if ($result['status'] == 1) { ?>
            <?php echo '<span class="label success"><b>Active</b></span>' ?> <?php } else if ($result['status'] == -1) { ?>
            <?php echo '<span class="label info"><b>New</b></span>' ?><?php } else if ($result['status'] == 0) { ?>
            <?php echo '<span class="label danger"><b>Deactivated</b></span>' ?>
          <?php } ?>
        </td>
        <td><?php echo '<a class="btn btn-xs btn-warning" href="admin.php?page=studFullDetails&sId=' . base64_encode($result['sId']) . '&photo=' . base64_encode($result['photo']) . '">
             <b>Check</b></a>' ?> </td>

      </tr>
    <?php } ?>

  </tbody>
</table>