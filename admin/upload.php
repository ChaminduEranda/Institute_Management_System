<?php

include_once "../db_con.php";
if (isset($_POST["Import"])) {

	$cid = $_POST['class_id'];
	$adate = $_POST['attdate'];

	$filename = $_FILES["file"]["tmp_name"];
	

	if ($_FILES["file"]["size"] > 0) {
		$file = fopen($filename, "r");
		fgetcsv($file);
		while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
			$sql = "INSERT INTO `attendance` (`std_id`,`time`,`class_id`,`attend_date`) VALUES ('" . $getData[0] . "', '" . $getData[1] . "', '$cid', '$adate')";
			$result = mysqli_query($db_con, $sql);
			if (!isset($result)) {
				echo "<script type=\"text/javascript\">
              alert(\"Invalid File:Please Upload CSV File.\");
              window.location = \"add-csv.php\"
              </script>";
			} else {
				echo "<script type=\"text/javascript\">
            alert(\"CSV File has been successfully Imported.\");
            window.location = \"add-csv.php\"
          </script>";
			}
		}

		fclose($file);
	}
}


// (A) CONNECT TO DATABASE - CHANGE SETTINGS TO YOUR OWN!
// $dbHost = "localhost";
// $dbName = "dboslo";
// $dbChar = "utf8";
// $dbUser = "root";
// $dbPass = "";
// try {
//   $pdo = new PDO(
//     "mysql:host=".$dbHost.";dbname=".$dbName.";charset=".$dbChar,
//     $dbUser, $dbPass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
//   );
// } catch (Exception $ex) { exit($ex->getMessage()); }

// // (B) READ UPLOADED CSV
// $fh = fopen($_FILES["file"]["tmp_name"], "r");
// if ($fh === false) { exit("Failed to open uploaded CSV file"); }

// // (C) IMPORT ROW BY ROW
// while (($row = fgetcsv($fh)) !== false) {
//   try {
//     // print_r($row);
//     $stmt = $pdo->prepare("INSERT INTO `attendance`(`std_id`, `class_id`, `attend_date`) VALUES (?,?,?)");
//     $stmt->execute([$row[0], $row[1], $row[2]]);
//   } catch (Exception $ex) { echo $ex->getmessage(); }
// }
// fclose($fh);
// echo "DONE.";


if (isset($_POST["Export"])) {

	$cid = $_POST['class_id'];
	$adate = $_POST['attdate'];

	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=data.csv');
	$output = fopen("php://output", "w");
	fputcsv($output, array('Student ID', 'Class ID', 'Attend Date'));
	$query = "SELECT `std_id`, `class_id`, `attend_date` from `attendance` WHERE `class_id`='$cid' AND `attend_date`='$adate'  ORDER BY std_id DESC";
	$result = mysqli_query($db_con, $query);
	while ($row = mysqli_fetch_assoc($result)) {
		fputcsv($output, $row);
	}
	fclose($output);
}
?>
