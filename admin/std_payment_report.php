<?Php

require_once '../db_con.php';
require('../fpdf/fpdf.php');

$st_id = base64_decode($_GET['st_id']);
$cid = base64_decode($_GET['cid']);
$date = base64_decode($_GET['date']);
$month = base64_decode($_GET['month']);


if (!empty($st_id) && empty($cid) && empty($date) && empty($month)) {
  $sql1 = "SELECT `student_id`,`amount` FROM `payment` WHERE `payment`.`student_id`='$st_id'";
  $amount = "SELECT SUM(`amount`) AS `value_sum` FROM `payment` WHERE `payment`.`student_id`='$st_id'";
  $am = mysqli_query($db_con, $amount);
  $am1 = mysqli_fetch_assoc($am);
  $am2 = $am1['value_sum'];
}

if (!empty($date) && empty($cid) && empty($st_id) && empty($month)) {
  $sql1 = "SELECT `student_id`,`amount` FROM `payment` WHERE `payment`.`payDate`='$date'";
}

if (!empty($month) && empty($cid) && empty($st_id) && empty($date)) {
  $sql1 = "SELECT `student_id`,`amount` FROM `payment` WHERE `payment`.`payMonth`='$month'";
}

if (!empty($st_id) && empty($cid) && !empty($date) && empty($month)) {
  $sql1 = "SELECT `student_id`,`amount` FROM `payment` WHERE `payment`.`student_id` = '$st_id' AND `payment`.`payDate`='$date'";
}

if (!empty($st_id) && empty($cid) && !empty($month) && empty($date)) {
  $sql1 = "SELECT `student_id`,`amount`,`st` FROM `payment` WHERE `payment`.`student_id`='$st_id' AND `payment`.`payMonth`='$month'";
}

if (!empty($st_id) && !empty($cid) && !empty($month) && empty($date)) {
  $sql1 = "SELECT `student_id`,`amount` FROM `payment` WHERE `payment`.`student_id` = '$st_id' AND `payment`.`class_id`='$cid' AND `payment`.`payMonth`='$month'";
}

if (empty($st_id) && !empty($cid) && empty($month) && empty($date)) {
  $sql1 = "SELECT `student_id`,`amount` FROM `payment` WHERE `payment`.`class_id`='$cid'";
}

if (!empty($cid) && !empty($month) && empty($st_id) && empty($date)) {
  $sql1 = "SELECT `student_id`,`amount` FROM `payment` WHERE `payment`.`class_id`='$cid' AND `payment`.`payMonth`='$month'";

  $amount = "SELECT SUM(`amount`) AS `value_sum` FROM  `payment` WHERE `payment`.`class_id`='$cid' AND `payment`.`payMonth`='$month' AND `payment`.`amount` IS NOT NULL";
  $am = mysqli_query($db_con, $amount);
  $am1 = mysqli_fetch_assoc($am);
  $am2 = $am1['value_sum'];

  $sql2 = "SELECT * FROM `payment` WHERE `payment`.`class_id`='$cid' AND `payment`.`payMonth`='$month' AND `payment`.`amount` IS NOT NULL";
  $nosp2 = mysqli_query($db_con, $sql2);
  $nosp3 = mysqli_num_rows($nosp2);
}

if (!empty($st_id) && !empty($cid) && empty($month) && empty($date)) {
  $sql1 = "SELECT `student_id`,`amount` FROM `payment` WHERE `payment`.`student_id` = '$st_id' AND `payment`.`class_id`='$cid'";
}

if (empty($st_id) && empty($cid) && empty($month) && empty($date)) {
  echo '<h1><b>No Report to Show!!!</b></h1>';
  echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
}

if (!empty($cid)) {
  $cn = "SELECT * FROM `class`  WHERE `class`.`cid`='$cid';";
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
  $sn1[0] = "";
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
    $this->Cell(30,10,'Student Payment Report',0,0,'C');
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
$reportN = "Payment Report Data";
$reportName = "Payment Report of $cn1[0] $cn1[1] $cn1[2] Class";
$reportName1 = "$sn1[0]  $sn1[1]$sn1[2]";
$reportName2 = "$date";
$reportName3 = "Month - $month";
$reportNameYPos = 130;
$headerColour = array(100, 100, 100);



/**
  Create the title page
 **/

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
if (isset($month)) {
  $pdf->Cell(0, 0, $reportName3, 0, 0, 'C');
  $pdf->Ln(8);
}
if (isset($sn1[0]) && isset($sn1[1]) && isset($sn1[2])) {
  $pdf->Cell(0, 0, $reportName1, 0, 0, 'C');
  $pdf->Ln(8);
}
if (isset($date)) {
  $pdf->Cell(0, 0, $reportName2, 0, 0, 'C');
}


// data table




//$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
// $pdf->SetFont('Arial', '', 17);
// $pdf->Cell(0, 15, $reportN, 0, 0, 'C');
$pdf->Ln(20);

/// amount ///

if (!empty($cid)) {
  $nos1 = "SELECT * FROM `student` INNER JOIN `student_enroll` ON `student`.`sId`=`student_enroll`.`student_id` WHERE `student_enroll`.`class_id`='$cid';";
  $nos2 = mysqli_query($db_con, $nos1);
  $nos3 = mysqli_num_rows($nos2);


  $clsam = "SELECT * FROM `class` WHERE `class`.`cId`='$cid';";
  $clsam1 = mysqli_query($db_con, $clsam);
  $clsam2 = mysqli_fetch_array($clsam1);
  $clsam3 = $clsam2['monthFee'];
}

if (isset($am2) && isset($nos3) && isset($nosp3)) {
  $nospch = $nos3 - $nosp3;
  $fullamo = $clsam3 * $nos3;
  $loss   = $fullamo - $am2;
  $tns    = "Total number of students       = $nos3";
  $pns    = "Number of students paid        = $nosp3";
  $npns   = "Number of students not paid  = $nospch";
  $clsfee = "Class Fee = Rs.$clsam3";
  $eafc   = "Expected total amount from class = Rs.$fullamo.00";
  $sum    = "Total amount received                   = Rs.$am2.00";
  $sumnot = "Management loss                          = Rs.$loss.00";
  $pdf->SetLeftMargin(20);
  $pdf->SetFont('Arial', '', 12);
  $pdf->Cell(0, 0, $tns, 0, 0, '');
  $pdf->Ln(5);
  $pdf->Cell(0, 0, $pns, 0, 0, '');
  $pdf->Ln(5);
  $pdf->Cell(0, 0, $npns, 0, 0, '');
  $pdf->Ln(10);
  $pdf->Cell(0, 0, $clsfee, 0, 0, 'B');
  $pdf->Ln(10);
  $pdf->Cell(0, 0, $eafc, 0, 0, '');
  $pdf->Ln(5);
  $pdf->Cell(0, 0, $sum, 0, 0, '');
  $pdf->Ln(5);
  $pdf->Cell(0, 0, $sumnot, 0, 0, '');
}

$pdf->Ln(30);


$width_cell = array(40, 50, 40, 40);
$pdf->SetFont('Arial', 'B', 10);

//Background color of header//
$pdf->SetFillColor(193, 229, 252);



// Header starts /// 
//First header column //
$sps = "Payment Details";
$pdf->Cell(0, 0, $sps, 0, 0, 'C');
$pdf->Ln(5);

$pdf->SetLeftMargin(60);

$pdf->Cell($width_cell[0], 10, 'Student', 1, 0, 'C', true);
//Second header column//
//Fourth header column//
$pdf->Cell($width_cell[1], 10, 'Status', 1, 1, 'C', true);
//Third header column//
//$pdf->Cell($width_cell[4], 10, 'GENDER', 1, 1, 'C', true);
//// header ends ///////

$pdf->SetFont('Arial', '', 10);
//Background color of header//
$pdf->SetFillColor(235, 236, 236);
//to give alternate background fill color to rows// 
$fill = false;

/// each record is one row  ///
foreach ($db_con->query($sql1) as $row) {
  if (!empty($row['amount'])) {
    $ab = 'Paid';
  } else if (empty($row['amount'])) {
    $ab = 'Not Paid';
  }
  $pdf->Cell($width_cell[0], 10, $row['student_id'], 1, 0, 'C', $fill);
  $pdf->Cell($width_cell[1], 10, $ab, 1, 1, 'C', $fill);
  $fill = !$fill;
}


/// end of records ///
$pdf->Output();
