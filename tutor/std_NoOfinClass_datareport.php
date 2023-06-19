<?php require_once '../db_con.php';
session_start();
if (!isset($_SESSION['user_login'])) {
  header('Location: login.php');
}
?>

<?php $showuser = $_SESSION['user_login'];
$haha = mysqli_query($db_con, "SELECT * FROM `tutor` WHERE `username`='$showuser';");
$showrow = mysqli_fetch_array($haha);
$tSubId = $showrow['subject_id'];

$haha2 = mysqli_query($db_con, "SELECT * FROM `subject` WHERE `subId`='$tSubId';");
$showrow2 = mysqli_fetch_array($haha2);
$subname = $showrow2['subName'];

$query = "SELECT * FROM `class` INNER JOIN `subject` ON `class`.`subject_id` = `subject`.`subId` WHERE `subject_id`='$tSubId';";
// $csname = mysqli_fetch_array($query);

$haha3 = mysqli_query($db_con, "SELECT * FROM `class` INNER JOIN `subject` ON `class`.`subject_id` = `subject`.`subId` WHERE `subject_id` = '$tSubId';");
$sh3 = mysqli_fetch_array($haha3);
$sb = $sh3['cId'];

$co = "SELECT * FROM `registration` WHERE `class_id` = '$sb';";

$year = date("Y");

?>


<?php

require_once("../../fpdf/fpdf.php");


$textColour = array(0, 0, 0);
$logoFile = "1234.png";
$logoXPos = 50;
$logoYPos = 80;
$logoWidth = 110;
$reportName = "Number Of Students in $year '$subname' classes";
$reportNameYPos = 130;
$headerColour = array(100, 100, 100);


$rowLabels = array("2022AL-Science", "2022AL-ScienceREV", "MegaWidget", "HyperWidget");
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

$pdf->SetFont('Arial', '', 17);
$pdf->Cell(0, 15, $reportName, 0, 0, 'C');
$pdf->Ln(30);

$pdf->SetLeftMargin(40);

$width_cell = array(80, 50, 50, 40, 40);
$pdf->SetFont('Arial', 'B', 16);

//Background color of header//
$pdf->SetFillColor(193, 229, 252);



// Header starts /// 
//First header column //
$pdf->Cell($width_cell[0], 10, 'Class', 1, 0, 'C', true);
//Second header column//
$pdf->Cell($width_cell[1], 10, 'No.Of Students', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 14);
//Background color of header//
$pdf->SetFillColor(235, 236, 236);
//to give alternate background fill color to rows// 
$fill = false;

/// each record is one row  ///
foreach ($db_con->query($query) as $row) {
  $pdf->Cell($width_cell[0], 10, $row['className'], 1, 0, 'C', $fill);
  $pdf->Cell($width_cell[1], 10, count($row), 1, 1, 'C', $fill);    
}

/// end of records /// 



// //////  Create the chart

// // Compute the X scale
// $xScale = count($rowLabels) / ($chartWidth - 40);

// // Compute the Y scale

// $maxTotal = 0;

// foreach ($data as $dataRow) {
//   $totalSales = 0;
//   foreach ($dataRow as $dataCell) $totalSales += $dataCell;
//   $maxTotal = ($totalSales > $maxTotal) ? $totalSales : $maxTotal;
// }

// $yScale = $maxTotal / $chartHeight;

// // Compute the bar width
// $barWidth = (1 / $xScale) / 1.5;

// // Add the axes:

// $pdf->SetFont('Arial', '', 10);

// // X axis
// $pdf->Line($chartXPos + 30, $chartYPos, $chartXPos + $chartWidth, $chartYPos);

// for ($i = 0; $i < count($rowLabels); $i++) {
//   $pdf->SetXY($chartXPos + 40 +  $i / $xScale, $chartYPos);
//   $pdf->Cell($barWidth, 10, $rowLabels[$i], 0, 0, 'C');
// }

// // Y axis
// $pdf->Line($chartXPos + 30, $chartYPos, $chartXPos + 30, $chartYPos - $chartHeight - 8);

// for ($i = 0; $i <= $maxTotal; $i += $chartYStep) {
//   $pdf->SetXY($chartXPos + 7, $chartYPos - 5 - $i / $yScale);
//   $pdf->Cell(20, 10, '$' . number_format($i), 0, 0, 'R');
//   $pdf->Line($chartXPos + 28, $chartYPos - $i / $yScale, $chartXPos + 30, $chartYPos - $i / $yScale);
// }

// // Add the axis labels
// $pdf->SetFont('Arial', 'B', 12);
// $pdf->SetXY($chartWidth / 2 + 20, $chartYPos + 8);
// $pdf->Cell(30, 10, $chartXLabel, 0, 0, 'C');
// $pdf->SetXY($chartXPos + 7, $chartYPos - $chartHeight - 12);
// $pdf->Cell(20, 10, $chartYLabel, 0, 0, 'R');

// // Create the bars
// $xPos = $chartXPos + 40;
// $bar = 0;

// foreach ($data as $dataRow) {

//   // Total up the sales figures for this product
//   $totalSales = 0;
//   foreach ($dataRow as $dataCell) $totalSales += $dataCell;

//   // Create the bar
//   $colourIndex = $bar % count($chartColours);
//   $pdf->SetFillColor($chartColours[$colourIndex][0], $chartColours[$colourIndex][1], $chartColours[$colourIndex][2]);
//   $pdf->Rect($xPos, $chartYPos - ($totalSales / $yScale), $barWidth, $totalSales / $yScale, 'DF');
//   $xPos += (1 / $xScale);
//   $bar++;
// }

$pdf->Output();

?>