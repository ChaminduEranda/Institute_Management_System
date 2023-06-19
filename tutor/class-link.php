<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'tutor.php') {
    if ($corepage == $corepage) {
        $corepage = explode('.', $corepage);
        header('Location: tutor.php?page=' . $corepage[0]);
    }
}

if (isset($_POST['addlink'])) {

    $class = $_POST['class'];
    $link = $_POST['link'];

    $query = "UPDATE `class` SET `link` = '$link'  WHERE `class`.`cId`= '$class'";
    if (mysqli_query($db_con, $query)) {
        $datainsert['insertsucesss'] = '<p style="color: green;">Link Inserted!</p>';
    } else {
        $datainsert['inserterrorr'] = '<p style="color: red;">Link Not Inserted, please input right informations!</p>';
    }
}

if (isset($_POST['removelink'])) {

    $class = $_POST['class'];

    $query = "UPDATE `class` SET `link` = null  WHERE `class`.`cId`= '$class'";
    if (mysqli_query($db_con, $query)) {
        $datainsert['insertsucesss'] = '<p style="color: green;">Link Removed!</p>';
    } else {
        $datainsert['inserterrorr'] = '<p style="color: red;">Link Not Removed!</p>';
    }
}
?>
<h1 class="text-primary"><i class="fas fa-link"><i class="fas fa-plus"></i></i> Add Link<small class="text-warning"> Add Link to the Class!</small></h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="tutor.php">Dashboard </a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Class Link</li>
    </ol>
</nav>

<div class="row">

    <div class="col-sm-6">
        <?php if (isset($datainsert)) { ?>
            <div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
                <div class="toast-header">
                    <strong class="mr-auto"> Insert Alert</strong>
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
        $tcId = $tushow['tId'];
        $query1 = "SELECT * FROM `tutor_enroll` INNER JOIN `class` ON `tutor_enroll`.`class_id` = `class`.`cId` WHERE `tutor_enroll`.`tutor_id` = '$tcId'";
        $result1 = mysqli_query($db_con, $query1);
        ?>

        <form enctype="multipart/form-data" method="POST" action="">



            <div class="form-group">
                <label for="class">Class</label>
                <select name="class" class="form-control" id="class" value="<?= isset($class) ? $class : '' ?>" required>
                <option value="">Select Class</option>    
                <?php while ($row1 = mysqli_fetch_array($result1)) :; ?>

                        <option value="<?php echo $row1[3]; ?>"><?php echo $row1[3]; ?> - <?php echo $row1[4]; ?> - <?php echo $row1[5]; ?></option>

                    <?php endwhile; ?>
                </select>
            </div>


            <div class="form-group">
                <label for="link">Link</label>
                <textarea name="link" rows="3" cols="100" type="text" class="" id="link" value="<?= isset($link) ? $link : ''; ?>"></textarea>
            </div>



            <div class="form-group text-center">
                <input name="addlink" value="Add Link" type="submit" class="btn btn-warning">
           
                <input name="removelink" value="Remove Link" type="submit" class="btn btn-danger">
            </div>
         
        </form>
    </div>
</div>

<!-- class link list -->


<table class="table  table-striped table-hover table-bordered" id="data">
    <thead class="thead-dark">
        <tr>
            <th scope="col"> Class</th>
            <th scope="col"> Link</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        $tcId = $tushow['tId'];
        $query2 = "SELECT * FROM `tutor_enroll` INNER JOIN `class` ON `tutor_enroll`.`class_id` = `class`.`cId` WHERE `tutor_enroll`.`tutor_id` = '$tcId';";
        $all_query = mysqli_query($db_con, $query2);
        while ($data = mysqli_fetch_array($all_query)) {
            $i++;
        ?>
            <tr>
                <td><?php echo $data['cId']; ?> </td>
                
                <td>
                    <?php if(!empty($data['link'])){ ?> 
                    <?php echo 'Link Added' ?> <?php } ?>
                </td>
            </tr>
            </body>
        <?php
        }
        ?>
    </tbody>
</table>



