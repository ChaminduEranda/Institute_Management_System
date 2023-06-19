<?Php

require_once '../db_con.php';
require('../fpdf/fpdf.php');

$clcid = base64_decode($_GET['cid']);
$date = base64_decode($_GET['date']);
$frdate = base64_decode($_GET['frdate']);
$utdate = base64_decode($_GET['utdate']);
$st_id = base64_decode($_GET['st_id']);

if (!empty($clcid) && empty($date) && empty($frdate) && empty($utdate) && empty($st_id)) {
  $att = "SELECT * FROM `attendance` INNER JOIN `student`  ON  `attendance`.`std_id`=`student`.`sId`  WHERE `attendance`.`class_id`='$clcid';";
}

if (!empty($st_id) && empty($clcid)  && empty($date) && empty($frdate) && empty($utdate)) {
  $att = "SELECT * FROM `attendance` INNER JOIN `student`  ON  `attendance`.`std_id`=`student`.`sId`  WHERE `attendance`.`std_id`='$st_id';";
}

if (!empty($clcid) && !empty($date) && empty($frdate) && empty($utdate) && empty($st_id)) {
  $att = "SELECT * FROM `attendance` INNER JOIN `student`  ON  `attendance`.`std_id`=`student`.`sId`  WHERE `attendance`.`class_id`='$clcid' AND `attendance`.`attend_date`='$date';";

  $att2 = "SELECT * FROM `attendance`  WHERE  `attendance`.`class_id`='$clcid' AND `attendance`.`attend_date`='$date';";
  $att3 = mysqli_query($db_con, $att2);
  $att4 = mysqli_num_rows($att3);

  $notatt  = "SELECT * FROM `student` WHERE `sId` NOT IN (
  SELECT * FROM `attendance` WHERE `attendance`.`class_id`='$clcid' AND `attendance`.`attend_date`='$date';)";

}

if (!empty($clcid)  && !empty($st_id) && empty($date) && empty($frdate) && empty($utdate)) {
  $att = "SELECT * FROM `attendance` INNER JOIN `student`  ON  `attendance`.`std_id`=`student`.`sId`  WHERE `attendance`.`class_id`='$clcid' AND `attendance`.`std_id`='$st_id';";
}

if (!empty($clcid) && !empty($date) && !empty($st_id) && empty($frdate) && empty($utdate)) {
  $att = "SELECT * FROM `attendance` INNER JOIN `student`  ON  `attendance`.`std_id`=`student`.`sId`  WHERE `attendance`.`class_id`='$clcid' AND `attendance`.`std_id`='$st_id' AND `attendance`.`attend_date`='$date';";
}

if (!empty($clcid)  && !empty($frdate) && !empty($utdate) && !empty($st_id) && empty($date)) {
  $att = "SELECT * FROM `attendance` INNER JOIN `student`  ON  `attendance`.`std_id`=`student`.`sId`  WHERE `attendance`.`class_id`='$clcid' AND `attendance`.`std_id`='$st_id' AND `attendance`.`attend_date` >= '$frdate' AND `attendance`.`attend_date` < '$utdate';";
}

if (!empty($clcid)  && !empty($frdate) && !empty($utdate) && empty($st_id) && empty($date)) {
  $att = "SELECT * FROM `attendance` INNER JOIN `student`  ON  `attendance`.`std_id`=`student`.`sId`  WHERE `attendance`.`class_id`='$clcid' AND `attendance`.`attend_date` >= '$frdate' AND `attendance`.`attend_date` < '$utdate';";
}

if (empty($clcid)  && empty($frdate) && empty($utdate) && empty($st_id) && empty($date)) {
  echo '<h1><b>No Report to Show!!!</b></h1>';
  echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
}

if (!empty($clcid)) {
  $cn = "SELECT * FROM `class` WHERE `class`.`cid`='$clcid';";
  $ab = mysqli_query($db_con, $cn);
  $cn1 = mysqli_fetch_array($ab);
} else {
  $cn1[0] = "";
  $cn1[1] = "";
  $cn1[2] = "";
}

if (!empty($st_id)) {
  $sn = "SELECT * FROM `student`  WHERE `student`.`sid`='$st_id';";
  $cd = mysqli_query($db_con, $sn);
  $sn1 = mysqli_fetch_array($cd);
} else {
  $sn1[1] = "";
  $sn1[2] = "";
}

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('1234.jpg',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'Student Attendance Report',0,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    $this->SetX(10);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

$textColour = array(0, 0, 0);
$logoFile = "1234.jpg";
$logoXPos = 50;
$logoYPos = 80;
$logoWidth = 110;
$reportN = "Attendance Report Data";
$reportName0 = "$cn1[0]";
$reportName = "Attendance Report of $cn1[0] $cn1[1] $cn1[2] Class";
$reportName2 = "$sn1[1]$sn1[2]";
if (!empty($frdate) && !empty($utdate)) {
  $ab = 'from';
  $cd = 'to';
  $reportName3 =  "$ab $frdate $cd $utdate";
} else {
  $reportName3 = "";
}
$reportName4 = "Date - $date";


// $reportNameYPos = 130;
$headerColour = array(100, 100, 100);
$pdf = new PDF('P', 'mm', 'A4');
$pdf->SetTextColor($textColour[0], $textColour[1], $textColour[2]);
$pdf->AddPage();

// Logo
// $pdf->Image($logoFile, $logoXPos, $logoYPos, $logoWidth);
$pdf->Line(20, 45, 210-20, 45);
// Report Name
$pdf->SetFont('Arial', 'B', 12);
// $pdf->Ln($reportNameYPos);
if (isset($cn1[1]) && isset($cn1[2])) {
  $pdf->Cell(0, 0, $reportName, 0, 0, 'C');
  $pdf->Ln(8);
}
if (isset($sn1[1]) && isset($sn2[2])) {
  $pdf->Cell(0, 0, $reportName2, 0, 0, 'C');
  $pdf->Ln(8);
}
if (isset($date)) {
  $pdf->Cell(0, 0, $reportName4, 0, 0, 'C');
  $pdf->Ln(8);
}
$pdf->Cell(0, 0, $reportName3, 0, 0, 'C');



// data table



// $pdf->SetFont('Arial', '', 17);
// $pdf->Cell(0, 15, $reportN, 0, 0, 'C');
$pdf->Ln(30);

if (!empty($clcid)) {
  $nos1 = "SELECT * FROM `student` INNER JOIN `student_enroll` ON `student`.`sId`=`student_enroll`.`student_id` WHERE `student_enroll`.`class_id`='$clcid';";
  $nos2 = mysqli_query($db_con, $nos1);
  $nos3 = mysqli_num_rows($nos2);
}

if (isset($nos3) && isset($att4)) {
  $nospch = $nos3 - $att4;
  $tns    = "Total number of students      = $nos3  ";
  $pns    = "Number of students attend   = $att4  ";
  $npns   = "Number of students absent   = $nospch ";
  $pdf->SetLeftMargin(20);
  $pdf->SetFont('Arial', '', 12);
  $pdf->Cell(0, 0, $tns, 0, 0, '');
  $pdf->Ln(5);
  $pdf->Cell(0, 0, $pns, 0, 0, '');
  $pdf->Ln(5);
  $pdf->Cell(0, 0, $npns, 0, 0, '');
}

$pdf->Ln(30);


$width_cell = array(50, 40);
$pdf->SetFont('Arial', 'B', 10);

//Background color of header//
$pdf->SetFillColor(193, 229, 252);



// Header starts /// 
//First header column //
$sps = "Attendance Details";
$pdf->Cell(0, 0, $sps, 0, 0, 'C');
$pdf->Ln(5);

$pdf->SetLeftMargin(60);
// Header starts /// 
//First header column //
$pdf->Cell($width_cell[0], 10, 'Student ID', 1, 0, 'C', true);
//Second header column//
//Third header column//
$pdf->Cell($width_cell[1], 10, 'Time', 1, 1, 'C', true);
//Fourth header column//

//// header ends ///////

$pdf->SetFont('Arial', '', 10);
//Background color of header//
$pdf->SetFillColor(235, 236, 236);
//to give alternate background fill color to rows// 
$fill = false;

/// each record is one row  ///

foreach ($db_con->query($att) as $row) {
  $pdf->Cell($width_cell[0], 10, $row['std_id'], 1, 0, 'C', $fill);
  $pdf->Cell($width_cell[1], 10, $row['time'], 1, 1, 'C', $fill);
  //to give alternate background fill  color to rows//
  $fill = !$fill;
}

/// end of records /// 

// /// new table /// 
// $pdf->Ln(30);


// $width_cell = array(50, 40);
// $pdf->SetFont('Arial', 'B', 12);

// //Background color of header//
// $pdf->SetFillColor(193, 229, 252);

// $pdf->SetLeftMargin(60);

// // Header starts /// 
// //First header column //
// $sps = "Not Attend";
// $pdf->Cell(5, 0, $sps, 0, 0, '');
// $pdf->Ln(5);

// // Header starts /// 
// //First header column //
// $pdf->Cell($width_cell[0], 10, 'Student ID', 1, 0, 'C', true);
// //Second header column//
// //Third header column//

// //Fourth header column//

// //// header ends ///////

// $pdf->SetFont('Arial', '', 12);
// //Background color of header//
// $pdf->SetFillColor(235, 236, 236);
// //to give alternate background fill color to rows// 
// $fill = false;

// /// each record is one row  ///

// foreach ($db_con->query($notatt) as $row) {
//   $pdf->Cell($width_cell[0], 10, $row['std_id'], 1, 0, 'C', $fill);
//   //to give alternate background fill  color to rows//
//   $fill = !$fill;
// }

/// end of records /// 




$pdf->Output();
