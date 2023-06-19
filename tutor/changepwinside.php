<?php
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'tutor.php') {
    if ($corepage == $corepage) {
        $corepage = explode('.', $corepage);
        header('Location: tutor.php?page=' . $corepage[0]);
    }
}

if (isset($_POST['save'])) {

    $tid = $showrow['tId'];
    $cp = $_POST['cp'];
    $np = $_POST['np'];
    $npa = $_POST['npa'];


    $input_error = array();
    if (empty($cp)) {
        $input_error['cp'] = "Current Password is Required";
    }
    if (empty($np)) {
        $input_error['np'] = "New Password is Required";
    }
    if (empty($npa)) {
        $input_error['npa'] = "Enter new password again";
    }
    if (!empty($npa)) {
        if ($npa !== $np) {
            $input_error['notmatch'] = "Passwords does not match!";
        }
    }

    if (count($input_error) == 0) {
        $query = "SELECT * FROM `tutor` WHERE `password` = '$cp';";
        $result = mysqli_query($db_con, $query);
        if (mysqli_num_rows($result) == 1) {
            if (strlen($np) > 7) {
                $query = "UPDATE `tutor` SET `password` = '$np' WHERE `tId`='$tid';";
                $result = mysqli_query($db_con, $query);
                //header('Location: ../LoginForm.php');
                header('Location: tutor.php?page=tutor-dashboard&edit=success');
            } else {
                $passlan = "Enter more than 8 characters";
            }
        } else {
            $cp_error = "Password is Wrong!";
        }
    }
}
?>


<?php
if (isset($_POST['cancel'])) {
    header("Location: tutor.php");
    exit;
}
?>

<div class="col">
    <div class="col-md-12">
        <h1 style="color:red;"><i class="fas fa-key"></i> Change password!</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="tutor.php">Dashboard </a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="tutor-userprofile.php">User Profile </a></li>

                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
            </ol>
        </nav>
    </div>
</div>





</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.js"></script>


<br>

<div class="row" style="margin: 0px 20px 5px 20px">
    <div class="col-sm-9">
        <div class="card jumbotron">
            <div class="card-body">
                <form class="form" method="POST" action="">
                    <label for="cp">Current Password</label>
                    <input class="form-control mr-sm-2" type="text" name="cp" value="<?= isset($cp) ? $cp : '' ?>">
                    <div class="e">
                        <?= isset($input_error['cp']) ? '<label class="error">' . $input_error['cp'] . '</label>' : '';  ?>
                        <?= isset($cp_error) ? '<label class="error">' . $cp_error . '</label>' : '';  ?>
                    </div>
                    <br>

                    <label for="exampleInputEmail1">New Password <b>(must have at least 8 characters)</b></label>
                    <input class="form-control mr-sm-2" type="text" name="np" value="<?= isset($np) ? $np : '' ?>">
                    <div class="e">
                        <?= isset($input_error['np']) ? '<label class="error">' . $input_error['np'] . '</label>' : '';  ?>
                        <?= isset($passlan) ? '<label class="error">' . $passlan . '</label>' : '';  ?>

                    </div>

                    <br>
                    <label for="exampleInputEmail1">New Password <b>(again)</b></label>
                    <input class="form-control mr-sm-2" type="text" name="npa" value="<?= isset($npa) ? $npa : '' ?>">
                    <div class="e">
                        <?= isset($input_error['npa']) ? '<label class="error">' . $input_error['npa'] . '</label>' : '';  ?>
                        <?= isset($input_error['notmatch']) ? '<label class="error">' . $input_error['notmatch'] . '</label>' : '';  ?>
                    </div>

                    <br>
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="save">Save Changes</button>
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="cancel">Cancel</button>

                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>