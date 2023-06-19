<?php
require_once 'db_con.php';
session_start();
if (isset($_POST['login'])) {
	$Id = $_POST['Id'];
	$password = $_POST['password'];


	$input_arr = array();

	if (empty($Id)) {
		$input_arr['input_user_error'] = "Username Is Required!";
	}

	if (empty($password)) {
		$input_arr['input_pass_error'] = "Password Is Required!";
	}

	if (count($input_arr) == 0) {
		$query = "SELECT * FROM `admin` WHERE `aId` = '$Id';";
		$result = mysqli_query($db_con, $query);
		if (mysqli_num_rows($result) == 1) {
			$row = mysqli_fetch_assoc($result);
			if ($row['password'] == ($password)) {
				$_SESSION['user_login'] = $Id;
				header('Location: admin/admin.php');
			} else {
				$worngpass = "This password Wrong!";
			}
		} else {
			$Iderr = "Username Not Found!";
		}
	}

	if (count($input_arr) == 0) {
		$query = "SELECT * FROM `student` WHERE `sId` = '$Id';";
		$result = mysqli_query($db_con, $query);
		if (mysqli_num_rows($result) == 1) {
			$row = mysqli_fetch_assoc($result);
			//if ($row['password'] == (sha1(md5($password)))) {
				if ($row['password'] == ($password)) {
				$_SESSION['user_login'] = $Id;
				if ($row['status'] == 1) {
					header('Location: student/student.php');
				} else if($row['status'] == 0) {
					$disablemsg = "Your Account is Deactivated";
				} else if($row['status'] == -1){
					header('Location: student/changepw.php');
				}
			} else {
				$worngpass = "This password Wrong!";
			}
		} else {
			$Iderr = "Username Not Found!";
		}
	}

	if (count($input_arr) == 0) {
		$query = "SELECT * FROM `tutor` WHERE `tId` = '$Id';";
		$result = mysqli_query($db_con, $query);
		if (mysqli_num_rows($result) == 1) {
			$row = mysqli_fetch_assoc($result);
			if ($row['password'] == ($password)) {
				$_SESSION['user_login'] = $Id;
				header('Location: tutor/tutor.php');
			} else {
				$worngpass = "This password Wrong!";
			}
		} else {
			$Iderr = "Username Not Found!";
		}
	}
}

?>

<a href="index.php">
        <img src="images/home.png" alt="" id="home-btn" /></a>
		
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="css/login.css?v=<?php echo time(); ?>" />

	<title>Login</title>
</head>

<body>
<div>
	<div class="form-box">

		<img src="images/login.jpg" alt="" id="logimg" />

		<!-- login form -->
		<form name="log" method="post" action="" id="login" class="input-group1" enctype="multipart/form-data">
			<input name="Id" value="<?= isset($Id) ? $Id : ''; ?>" type="text" class="input-field" placeholder="Username" id="" />
			<br>
			<div class="e">
				<?php echo isset($input_arr['input_user_error']) ? '<label class="error">' . $input_arr['input_user_error'] . '</label>' : ''; ?>
				<?= isset($Iderr) ? '<label class="error">' . $Iderr . '</label>' : '';  ?>
			</div>

			<input name="password" type="password" class="input-field" placeholder="Password" id="" />
			<br>
			<div class="e">
				<?php echo isset($input_arr['input_pass_error']) ? '<label class="error">' . $input_arr['input_pass_error'] . '</label>' : ''; ?>
				<?= isset($worngpass) ? '<label class="error">' . $worngpass . '</label>' : '';  ?>
			</div>

			<button type="submit" class="submit-btn" name="login">
				Login
			</button>


			<div class="e">
				<?= isset($disablemsg) ? '<label class="error_msg">' . $disablemsg . '</label>' : '';  ?>
			</div>

		</form>

		
	</div>
	<div class="bubble">
			<img src="images/bubble.png" alt="" />
			<img src="images/bubble.png" alt="" />
			<img src="images/bubble.png" alt="" />
			<img src="images/bubble.png" alt="" />
			<img src="images/bubble.png" alt="" />
			<img src="images/bubble.png" alt="" />
			<img src="images/bubble.png" alt="" />
			<img src="images/bubble.png" alt="" />
			<img src="images/bubble.png" alt="" />
		</div>
</div>
	
</body>

</html>