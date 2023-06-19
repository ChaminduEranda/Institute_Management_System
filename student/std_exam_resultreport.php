<?php require_once '../db_con.php';
session_start();
if (!isset($_SESSION['user_login'])) {
  header('Location: login.php');
}
?>

<?php $showuser = $_SESSION['user_login'];
$st = mysqli_query($db_con, "SELECT * FROM `student` WHERE `username`='$showuser';");
$showrow = mysqli_fetch_array($st);
$stid = $showrow['sId'];
$query = mysqli_query($db_con, "SELECT * FROM `class` INNER JOIN `registration` ON `class`.`cId` = `registration`.`class_id` WHERE `registration`.`student_id` ='$stid';");
$row = mysqli_fetch_array($query);
$subid = $row['subject_id'];
$query1 = mysqli_query($db_con, "SELECT * FROM `subject` WHERE `subId` = '$subid';");
$row1 = mysqli_fetch_array($query1);


$result = mysqli_fetch_array($st);
$tn = $showrow['titleName'];
$na = $showrow['name'];

$sql = "SELECT * FROM `registration` INNER JOIN `class` ON `registration`.`class_id` = `class`.`cId` INNER JOIN `student` ON `registration`.`student_id` = `student`.`sId`";

$year = date("Y");

$exam = "SELECT * FROM `exammarks` INNER JOIN `exam` ON `exammarks`.`exam_id` = `exam`.`exam_id` WHERE `exammarks`.`std_eId` = '$stid'";

?>
<?Php

require('../../fpdf/fpdf.php');


$textColour = array(0, 0, 0);
$logoFile = "1234.png";
$logoXPos = 50;
$logoYPos = 80;
$logoWidth = 110;
$reportName = "Exam Result Report of $tn$na - $year";
$reportNameYPos = 130;
$headerColour = array(100, 100, 100);


$rowLabels = array("sdfsdfsdf", "WonderWidget", "MegaWidget", "HyperWidget");
$chartXPos = 20;
$chartYPos = 250;
$chartWidth = 160;
$chartHeight = 80;
$chartXLabel = "Class";
$chartYLabel = "Students";
$chartYStep = 20000;

$chartColours = array(
  array(255, 100, 100),
  array(100, 255, 100),
  array(100, 100, 255),
  array(255, 255, 100),
);

$data = array(
  array(5454, 10100, 9490, 11730),
  array(19310, 21140, 20560, 22590),
  array(25110, 26260, 25210, 28370),
  array(27650, 24550, 30040, 31980),
);
///////

/**
  Create the title page
 **/

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->SetTextColor($textColour[0], $textColour[1], $textColour[2]);
$pdf->AddPage();

// Logo
$pdf->Image($logoFile, $logoXPos, $logoYPos, $logoWidth);

// Report Name
$pdf->SetFont('Arial', 'B', 24);
$pdf->Ln($reportNameYPos);
$pdf->Cell(0, 15, $reportName, 0, 0, 'C');



// data table


$pdf->AddPage();

//$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
$pdf->SetFont('Arial', '', 17);
$pdf->Cell(0, 15, $reportName, 0, 0, 'C');
$pdf->Ln(30);

$width_cell = array(20, 50, 40, 40, 40);
$pdf->SetFont('Arial', 'B', 16);

//Background color of header//
$pdf->SetFillColor(193, 229, 252);



// Header starts /// 
//First header column //
$pdf->Cell($width_cell[0], 10, 'ID', 1, 0, 'C', true);
//Second header column//
$pdf->Cell($width_cell[1], 10, 'EXAM', 1, 0, 'C', true);
//Third header column//
$pdf->Cell($width_cell[2], 10, 'STD_ID', 1, 0, 'C', true);
//Fourth header column//
$pdf->Cell($width_cell[3], 10, 'MARKS%', 1, 0, 'C', true);
//Third header column//
$pdf->Cell($width_cell[4], 10, 'DATE', 1, 1, 'C', true);
//// header ends ///////

$pdf->SetFont('Arial', '', 14);
//Background color of header//
$pdf->SetFillColor(235, 236, 236);
//to give alternate background fill color to rows// 
$fill = false;

/// each record is one row  ///
foreach ($db_con->query($exam) as $row) {
  $pdf->Cell($width_cell[0], 10, $row['exam_id'], 1, 0, 'C', $fill);
  $pdf->Cell($width_cell[1], 10, $row['exam_name'], 1, 0, 'C', $fill);
  $pdf->Cell($width_cell[2], 10, $row['std_eId'], 1, 0, 'C', $fill);
  $pdf->Cell($width_cell[3], 10, $row['marks'], 1, 0, 'C', $fill);
  $pdf->Cell($width_cell[4], 10, $row['date'], 1, 1, 'C', $fill);
  //to give alternate background fill  color to rows//
  $fill = !$fill;
}
/// end of records /// 

$pdf->Output();
?>