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


<h1 class="text-primary"><i class="fas fa-key"></i> Reset Password<small class="text-warning"> Reset Users Passwords!</small></h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="admin.php">Dashboard </a></li>
        <li class="breadcrumb-item active" aria-current="page">Reset Password</li>
    </ol>
</nav>

<?php if (isset($_GET['reset'])) { ?>
    <div role="alert" aria-live="assertive" aria-atomic="false" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
        <div class="toast-header">
            <strong class="mr-auto">Password Reset Alert</strong>
            <small><?php echo date('d-M-Y'); ?></small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            <?php
            if (isset($_GET['reset'])) {
                if ($_GET['reset'] == 'error') {
                    echo "<p style='color: red'; font-weight: bold;>Password Reset Unsuccess!</p>";
                }
            }
            ?>
        </div>
    </div>
<?php } ?>


<?php
$qs = "SELECT `cId`, `batchName`, `subName` FROM `class`";
$re1 = mysqli_query($db_con, $qs);
?>

<form enctype="multipart/form-data" method="POST" action="">

    <div class="form-group">
        <label for="classid">Class</label>
        <select name="classid" class="form-control" id="" value="<?= isset($classid) ? $classid : '' ?>" required>
            <?php while ($r1 = mysqli_fetch_array($re1)) :; ?>

                <option value="<?php echo $r1[0]; ?>"><?php echo $r1[0]; ?> - <?php echo $r1[1]; ?> - <?php echo $r1[2]; ?></option>

            <?php endwhile; ?>
        </select>

    </div>


    <div class="form-group text-center">
        <input name="show" value="Show" type="submit" class="btn btn-danger">
    </div>
    <br>
</form>



<?php if (isset($_POST['show'])) { ?>
    <h3 class="text-primary">Students</h3>
        <table class="table  table-striped table-hover table-bordered" id="data">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Reset</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $classid = $_POST['classid'];
                $query = mysqli_query($db_con, "SELECT * FROM `student_enroll` INNER JOIN `student` ON `student_enroll`.`student_id`=`student`.`sId`  WHERE `class_id`='$classid';");
                while ($result = mysqli_fetch_array($query)) { ?>
                    <tr>
                        <?php
                        echo '
          <td>' . $result['sId'] . '</td>
          <td>' . $result['titleName'] . $result['name'] . '</td>
          <td>
            <a class="btn btn-xs btn-warning" onclick="javascript:confirmationDelete($(this));return false;" href="admin.php?page=passrest&sId=' . base64_encode($result['sId'])  . '">
              <i class="fa fa-key"></i></a>
                </td>'; ?>
                    </tr>
                <?php
                } ?>

            </tbody>
        </table>
    <?php } ?>

    <br>
    <?php if (isset($_POST['show'])) { ?>
        <h3 class="text-primary">Teachers</h3>
            <table class="table  table-striped table-hover table-bordered" id="data">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">NIC</th>
                        <th scope="col">Reset</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $classid = $_POST['classid'];
                    $query = mysqli_query($db_con, "SELECT * FROM `tutor_enroll` INNER JOIN `tutor` ON `tutor_enroll`.`tutor_id`=`tutor`.`tId`  WHERE `class_id`='$classid';");
                    while ($result = mysqli_fetch_array($query)) { ?>
                        <tr>
                            <?php
                            echo '
          <td>' . $result['tId'] . '</td>
          <td>' . $result['titleName'] . $result['name'] . '</td>
          <td>' . $result['nic'] . '</td>
              
          <td>
            <a class="btn btn-xs btn-warning" onclick="javascript:confirmationDelete($(this));return false;" href="admin.php?page=passretu&tId=' . base64_encode($result['tId'])  . '&nic=' . base64_encode($result['nic'])  . '">
              <i class="fa fa-key"></i></a>
                </td>'; ?>
                        </tr>
                    <?php
                    } ?>

                </tbody>
            </table>
        <?php } ?>


        <script type="text/javascript">
            function confirmationDelete(anchor) {
                var conf = confirm('Are you sure want to reset this password?');
                if (conf)
                    window.location = anchor.attr("href");
            }
        </script>