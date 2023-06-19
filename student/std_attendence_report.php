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
$query = mysqli_query($db_con, "SELECT * FROM `class` INNER JOIN `student_enroll` ON `class`.`cId` = `student_enroll`.`class_id` WHERE `student_enroll`.`student_id` ='$stid';");
$row = mysqli_fetch_array($query);
$subid = $row['class_id'];
$query1 = mysqli_query($db_con, "SELECT * FROM `class` WHERE `cId` = '$subid';");
$row1 = mysqli_fetch_array($query1);


$result = mysqli_fetch_array($st);
$tn = $showrow['titleName'];
$na = $showrow['name'];



$sql = "SELECT * FROM `registration` INNER JOIN `class` ON `registration`.`class_id` = `class`.`cId` INNER JOIN `student` ON `registration`.`student_id` = `student`.`sId`";

$att = "SELECT * FROM `attendance` WHERE `student_id` ='$stid';";



$year = date("Y-M"); 

?>
<?Php

require('../fpdf/fpdf.php');


$textColour = array(0, 0, 0);
$logoFile = "1234.png";
$logoXPos = 50;
$logoYPos = 80;
$logoWidth = 110;
$reportName = "Attendence Report of $tn$na - $year";
$reportNameYPos = 130;
$headerColour = array( 100, 100, 100 );


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
$pdf->SetFont( 'Arial', '', 17 );
$pdf->Cell( 0, 15, $reportName, 0, 0, 'C' );
$pdf->Ln( 30 );

$width_cell = array(30, 30, 40, 40, 40);
$pdf->SetFont('Arial', 'B', 16);

//Background color of header//
$pdf->SetFillColor(193, 229, 252);


$pdf->SetLeftMargin(35);
// Header starts /// 
//First header column //
$pdf->Cell($width_cell[0], 10, 'Std ID', 1, 0, 'C', true);
//Second header column//
$pdf->Cell($width_cell[1], 10, 'Class ID', 1, 0, 'C', true);
//Third header column//
$pdf->Cell($width_cell[2], 10, 'Date', 1, 0, 'C', true);
//Fourth header column//
$pdf->Cell($width_cell[3], 10, 'Status', 1, 1, 'C', true);
//Third header column//
//$pdf->Cell($width_cell[4], 10, 'GENDER', 1, 1, 'C', true);
//// header ends ///////

$pdf->SetFont('Arial', '', 14);
//Background color of header//
$pdf->SetFillColor(235, 236, 236);
//to give alternate background fill color to rows// 
$fill = false;

/// each record is one row  ///
foreach ($db_con->query($att) as $row) {
  $pdf->Cell($width_cell[0], 10, $row['student_id'], 1, 0, 'C', $fill);
  $pdf->Cell($width_cell[1], 10, $row['class_id'], 1, 0, 'C', $fill);
  $pdf->Cell($width_cell[2], 10, $row['attend_date'], 1, 0, 'C', $fill);
  $pdf->Cell($width_cell[3], 10, $row['st_status'], 1, 1, 'C', $fill);
  //$pdf->Cell($width_cell[4], 10, $row['gender'], 1, 1, 'C', $fill);
  //to give alternate background fill  color to rows//
  $fill = !$fill;
}
/// end of records /// 

$pdf->Output();
?>