<?php
require_once 'db_con.php';
session_start();
$query = "SELECT * FROM `class` INNER JOIN `subject` ON `class`.`subject_id` = `subject`.`subId`";
$result1 = mysqli_query($db_con, $query);

if (isset($_POST['register'])) {
  $titleName = $_POST['titleName'];
  $name = $_POST['name'];
  $dob = $_POST['dob'];
  $gender = $_POST['gender'];
  $nic = $_POST['nic'];
  $phone = $_POST['phone'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $c_password = $_POST['c_password'];
  $email = $_POST['email'];
  $class = $_POST['class'];
  //$key = rand(100,100000);

  $input_error = array();
  if (empty($titleName)) {
    $input_error['titleName'] = "Title is Required";
  }
  if (empty($name)) {
    $input_error['name'] = "First Name is Required";
  }
  if (!preg_match("/^[a-zA-z]*$/", $name)) {
    $sterror['name'] = "Only Alphabets and whitespace are Allowed";
  }
  if (empty($dob)) {
    $input_error['dob'] = "Date Of Birth is Required";
  }
  if (empty($gender)) {
    $input_error['gender'] = "Gender is Required";
  }
  if (empty($nic)) {
    $input_error['nic'] = "nic is Required";
  }
  if (empty($phone)) {
    $input_error['phone'] = "Telephone is Required";
  }
  if (empty($username)) {
    $input_error['username'] = "Username is Required";
  }
  if (empty($password)) {
    $input_error['password'] = "Password is Required";
  }
  if (!empty($password)) {
    if ($c_password !== $password) {
      $input_error['notmatch'] = "Passwords does not match!";
    }
  }
  if (empty($email)) {
    $input_error['email'] = "Email is Required";
  }
  if (empty($class)) {
    $input_error['class'] = "Class is Required";
  }


  if (count($input_error) == 0) {
    $check_email = mysqli_query($db_con, "SELECT * FROM `student` WHERE `email`='$email';");

    if (mysqli_num_rows($check_email) == 0) {
      $check_username = mysqli_query($db_con, "SELECT * FROM `student` WHERE `username`='$username';");
      if (mysqli_num_rows($check_username) == 0) {
        if (strlen($username) > 7) {
          if (strlen($password) > 7) {
            $password = sha1(md5($password));
            $query = "INSERT INTO `student`( `titleName`, `name`, `address`, `dob`, `gender`, `nic`, `phone`, `username`, `password`, `photo`, `email`, `status`)  VALUES ('$titleName','$name',null,'$dob', '$gender','$nic','$phone','$username','$password',null,'$email',0);";
            $query2 = "INSERT INTO `registration`(`student_id`, `class_id`, `nic`) VALUES (null,'$class','$nic');";
            $result = mysqli_query($db_con, $query);
            $result = mysqli_query($db_con, $query2);
            if ($result) {
              $_SESSION['success_message'] = "Registration Successfull Thank You!";
              header('Location: index.php?insert=sucess');
            } else {
              $_SESSION['error_message'] = "Registration Error!";
              header('Location: index.php?insert=error');
            }
          } else {
            $passlan = "Enter more than 8 characters";
          }
        } else {
          $usernamelan = "Enter more than 8 characters";
        }
      } else {
        $username_error = "This username already exists!";
      }
    } else {
      $email_error = "This email already exists!";
    }
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/registration.css?v=<?php echo time(); ?>" />
  <title>Register</title>
</head>

<body>
  <div class="form-box">
    <img src="images/1234.png" alt="" id="regimg" />


    <form name="reg" method="POST" action="" id="register" class="input-group" enctype="multipart/form-data">

      <div class="before">
        <label for="">Before Registration, Check COURSES</label>
      </div>

      <select name="titleName" class="input-field" id="" value="<?= isset($titleName) ? $titleName : '' ?>">
        <option value="">Select Title</option>
        <option value="Mr.">Mr.</option>
        <option value="Ms.">Ms.</option>
        <option value="Mrs.">Mrs.</option>
        <option value="Ven.">Ven.</option>
      </select>

      <br>

      <div class="e">
        <?= isset($input_error['titleName']) ? '<label  class="error">' . $input_error['titleName'] . '</label>' : '' ?>
        <?= isset($reg_error) ? '<label class="error">' . $reg_error . '</label>' : '';  ?>
      </div>

      <input name="name" value="<?= isset($name) ? $name : '' ?>" type="text" class="input-field" placeholder="Name" id="" />

      <br>

      <div class="e">
        <?= isset($input_error['name']) ? '<label  class="error">' . $input_error['name'] . '</label>' : '' ?>
        <?= isset($sterror['name']) ? '<label  class="error">' . $sterror['name'] . '</label>' : '' ?>

      </div>


      <input name="dob" value="<?= isset($dob) ? $dob : '' ?>" onfocus="(this.type='date')" class="input-field" placeholder="dob" id="" />

      <br>

      <div class="e">
        <?= isset($input_error['dob']) ? '<label  class="error">' . $input_error['dob'] . '</label>' : '' ?>
      </div>

      <select name="gender" class="input-field" id="" value="<?= isset($gender) ? $gender : '' ?>">
        <option value="">Select Gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
      </select>


      <br>

      <div class="e">
        <?= isset($input_error['gender']) ? '<label  class="error">' . $input_error['gender'] . '</label>' : '' ?>
      </div>

      <input name="nic" value="<?= isset($nic) ? $nic : '' ?>" type="text" class="input-field" placeholder="nic" id="" />

      <br>

      <div class="e">
        <?= isset($input_error['nic']) ? '<label  class="error">' . $input_error['nic'] . '</label>' : '' ?>
      </div>

      <input name="phone" value="<?= isset($phone) ? $phone : '' ?>" type="text" class="input-field" placeholder="Phone" id="" />

      <br>

      <div class="e">
        <?= isset($input_error['phone']) ? '<label  class="error">' . $input_error['phone'] . '</label>' : '' ?>
      </div>


      <input name="username" value="<?= isset($username) ? $username : '' ?>" type="text" class="input-field" placeholder="Username" id="" />

      <br>

      <div class="e">
        <?= isset($input_error['username']) ? '<label class="error">' . $input_error['username'] . '</label>' : '';  ?>
        <?= isset($username_error) ? '<label class="error">' . $username_error . '</label>' : '';  ?>
        <?= isset($usernamelan) ? '<label class="error">' . $usernamelan . '</label>' : '';  ?>
      </div>

      <input name="password" type="password" class="input-field" placeholder="Password" id="" />

      <br>

      <div class="e">
        <?= isset($input_error['password']) ? '<label class="error">' . $input_error['password'] . '</label>' : '';  ?>
        <?= isset($passlan) ? '<label class="error">' . $passlan . '</label>' : '';  ?>
      </div>

      <input name="c_password" type="password" class="input-field" placeholder="Confirm Password" id="" />

      <br>

      <div class="e">
        <?= isset($input_error['notmatch']) ? '<label class="error">' . $input_error['notmatch'] . '</label>' : '';  ?>
        <?= isset($passlan) ? '<label class="error">' . $passlan . '</label>' : '';  ?>
      </div>

      <input name="email" value="<?= isset($email) ? $email : '' ?>" type="email" class="input-field" placeholder="Email" id="" />

      <br>

      <div class="e">
        <?= isset($input_error['email']) ? '<label class="error">' . $input_error['email'] . '</label>' : '';  ?>
        <?= isset($email_error) ? '<label class="error">' . $email_error . '</label>' : '';  ?>
      </div>


      <!-- for class -->
      <select name="class" class="input-field" id="" value="<?= isset($class) ? $class : '' ?>">
        <option value="">Select Class</option>
        <?php while ($row1 = mysqli_fetch_array($result1)) :; ?>

          <option value="<?php echo $row1[0]; ?>"><?php echo $row1[2]; ?> - <?php echo $row1[11]; ?></option>

        <?php endwhile; ?>
      </select>
      <br>
      <div class="e">
        <?= isset($input_error['class']) ? '<label  class="error">' . $input_error['class'] . '</label>' : '' ?>
      </div>


      <button type="submit" class="submit-btn" name="register">
        Register
      </button>
    </form>
  </div>

</body>

</html>