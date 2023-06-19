<?Php

require_once '../db_con.php';
$clcid = base64_decode($_GET['cid']); 
$sql = "SELECT * FROM `student` INNER JOIN `student_enroll`  ON  `student`.`sId`=`student_enroll`.`student_id` INNER JOIN `class` ON `student_enroll`.`class_id`=`class`.`cId` WHERE `class`.`cId`='$clcid';";
$year = date("Y");

require('../fpdf/fpdf.php');

$textColour = array(0, 0, 0);
$logoFile = "1234.jpg";
$logoXPos = 50;
$logoYPos = 80;
$logoWidth = 110;
$reportName = "All Students in $clcid";
$reportNameYPos = 130;
$headerColour = array(100, 100, 100);


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

$width_cell = array(40, 40,  40, 40);
$pdf->SetFont('Arial', 'B', 16);

//Background color of header//
$pdf->SetFillColor(193, 229, 252);



// Header starts /// 
//First header column //
$pdf->Cell($width_cell[0], 10, 'ID', 1, 0, 'C', true);
//Second header column//
$pdf->Cell($width_cell[1], 10, 'NAME', 1, 0, 'C', true);
//Third header column//

//Fourth header column//
$pdf->Cell($width_cell[2], 10, 'DOB', 1, 0, 'C', true);
//Third header column//
$pdf->Cell($width_cell[3], 10, 'GENDER', 1, 1, 'C', true);
//// header ends ///////

$pdf->SetFont('Arial', '', 14);
//Background color of header//
$pdf->SetFillColor(235, 236, 236);
//to give alternate background fill color to rows// 
$fill = false;

/// each record is one row  ///
foreach ($db_con->query($sql) as $row) {
  $pdf->Cell($width_cell[0], 10, $row['sId'], 1, 0, 'C', $fill);
  $pdf->Cell($width_cell[1], 10, $row['name'], 1, 0, 'C', $fill);
 
  $pdf->Cell($width_cell[2], 10, $row['dob'], 1, 0, 'C', $fill);
  $pdf->Cell($width_cell[3], 10, $row['gender'], 1, 1, 'C', $fill);
  //to give alternate background fill  color to rows//
  $fill = !$fill;
}
/// end of records /// 

$pdf->Output();
