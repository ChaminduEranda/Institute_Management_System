<?Php

require_once '../db_con.php';
require('../fpdf/fpdf.php');

$cid = base64_decode($_GET['cid']);
$sql1 = "SELECT * FROM `student` INNER JOIN `student_enroll` ON `student`.`sId`=`student_enroll`.`student_id` WHERE `student_enroll`.`class_id`='$cid';";



if (!empty($cid)) {
  $cn = "SELECT * FROM `class`  WHERE `class`.`cid`='$cid';";
  $ab = mysqli_query($db_con, $cn);
  $cn1 = mysqli_fetch_array($ab);
} else {
  $cn1[1] = "";
  $cn1[2] = "";
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
    $this->Cell(30,10,'Student Basic Info Report',0,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

$textColour = array(0, 0, 0);
$logoFile = "1234.png";
$logoXPos = 50;
$logoYPos = 80;
$logoWidth = 110;
$reportN = "Student Details";
$reportName = "Students Details of $cn1[1] $cn1[2] Class";
$reportNameYPos = 130;
$headerColour = array(100, 100, 100);


/**
  Create the title page
 **/

$pdf = new PDF('P', 'mm', 'A4');
$pdf->SetTextColor($textColour[0], $textColour[1], $textColour[2]);
$pdf->AddPage();
$pdf->Line(20, 45, 210-20, 45);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 0, $reportName, 0, 0, 'C');
$pdf->Ln(8);



$pdf->Ln(30);

$width_cell = array(30, 40, 25, 25, 20, 50);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(193, 229, 252);

$sps = "Student Details";
$pdf->Cell(0, 0, $sps, 0, 0, 'C');
$pdf->Ln(5);

// Header starts /// 
//First header column //
$pdf->Cell($width_cell[0], 10, 'ID', 1, 0, 'C', true);
$pdf->Cell($width_cell[1], 10, 'Name', 1, 0, 'C', true);
$pdf->Cell($width_cell[2], 10, 'Tel', 1, 0, 'C', true);
$pdf->Cell($width_cell[3], 10, 'DOB', 1, 0, 'C', true);
$pdf->Cell($width_cell[4], 10, 'Gender', 1, 0, 'C', true);
$pdf->Cell($width_cell[5], 10, 'Email', 1, 1, 'C', true);

//// header ends ///////

$pdf->SetFont('Arial', '', 10);
$pdf->SetFillColor(235, 236, 236);
$fill = false;

foreach ($db_con->query($sql1) as $row) {
  $pdf->Cell($width_cell[0], 10, $row['sId'], 1, 0, 'C', $fill);
  $pdf->Cell($width_cell[1], 10, $row['name'], 1, 0, 'C', $fill);
  $pdf->Cell($width_cell[2], 10, $row['phone'], 1, 0, 'C', $fill);
  $pdf->Cell($width_cell[3], 10, $row['dob'], 1, 0, 'C', $fill);
  $pdf->Cell($width_cell[4], 10, $row['gender'], 1, 0, 'C', $fill);
  $pdf->Cell($width_cell[5], 10, $row['email'], 1, 1, 'C', $fill);  
  $fill = !$fill;
}

$pdf->Output();
