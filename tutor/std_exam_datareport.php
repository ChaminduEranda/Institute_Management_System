<?php 
require_once '../db_con.php';
require('../fpdf/fpdf.php');


$st_id = base64_decode($_GET['st_id']); 
$cid =base64_decode($_GET['cid']);
$date = base64_decode($_GET['date']); 
$exam = base64_decode($_GET['exam']); 

if(!empty($st_id) && empty($cid) && empty($date) && empty($exam)){
  $sql1 = "SELECT * FROM `exam_marks` WHERE `exam_marks`.`student_id`='$st_id'";
  }
  
  if(!empty($date) && empty($cid) && empty($st_id) && empty($exam)){
    $sql1 = "SELECT * FROM `exam_marks` INNER JOIN `exam` ON `exam_marks`.`exam_id`=`exam`.`examId` WHERE `exam`.`date`='$date'";
  }
  
  if(!empty($exam) && empty($cid) && empty($st_id) && empty($date)){
    $sql1 = "SELECT * FROM `exam_marks` WHERE `exam_marks`.`exam_id`='$exam'";
  }
  
  if(!empty($date) && !empty($exam) && empty($cid) && empty($st_id)){
    $sql1 = "SELECT * FROM `exam_marks` INNER JOIN `exam` ON `exam_marks`.`exam_id`=`exam`.`examId` WHERE `exam_marks`.`exam_id`='$exam' AND `exam`.`date`='$date'";
  }
  
  if(!empty($cid) && empty($st_id) &&  empty($exam) && empty($date) ){
    $sql1 = "SELECT * FROM `exam_marks` INNER JOIN `exam` ON `exam_marks`.`exam_id`=`exam`.`examId` WHERE `exam`.`class_id`='$cid'";
  }
  
  
  if(!empty($st_id) && !empty($date) && empty($cid)  && empty($exam)){
    $sql1 = "SELECT * FROM `exam_marks` INNER JOIN `exam` ON `exam_marks`.`exam_id`=`exam`.`examId` WHERE `exam_marks`.`student_id` = '$st_id' AND `exam`.`date`='$date';";
  }
  
  if(!empty($st_id) && !empty($exam) && empty($cid)  && empty($date) ){
    $sql1 = "SELECT * FROM `exam_marks` WHERE `exam_marks`.`student_id` = '$st_id' AND `exam_marks`.`exam_id`='$exam';";
  }
  
  if(!empty($st_id) && !empty($cid) && !empty($exam) && empty($date) ){
    $sql1 = "SELECT * FROM `exam_marks` INNER JOIN `exam` ON `exam_marks`.`exam_id`=`exam`.`examId` WHERE `exam_marks`.`student_id` = '$st_id' AND `exam`.`class_id`='$cid' AND `exam_marks`.`exam_id`='$exam'";
  }
  
  
  if(!empty($cid) && !empty($exam) && empty($st_id)  && empty($date) ){
    $sql1 = "SELECT * FROM `exam_marks` INNER JOIN `exam` ON `exam_marks`.`exam_id`=`exam`.`examId` WHERE `exam`.`class_id`='$cid' AND `exam_marks`.`exam_id`='$exam';";
  }
  
  if(!empty($st_id) && !empty($cid) && empty($exam) && empty($date) ){
    $sql1 = "SELECT * FROM `exam_marks` WHERE `exam_marks`.`student_id` = '$st_id' AND `exam_marks`.`class_id`='$cid';";
  }
  
  if(empty($st_id) && empty($cid) && empty($exam) && empty($date) ){
    echo '<h1><b>No Report to Show!!!</b></h1>';
    echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
  }
  
  if(!empty($exam)){
    $cn = "SELECT * FROM `exam` INNER JOIN `class` ON `exam`.`class_id`=`class`.`cId` WHERE `exam`.`examId`='$exam';";
    $ab = mysqli_query($db_con,$cn);
    $cn1 = mysqli_fetch_array($ab);
    }else{
      $cn1[0] = "";
      $cn1[1] = ""; 
      $cn1[2] = ""; 
    }
    
    if(!empty($st_id)){
    $sn = "SELECT * FROM `student`  WHERE `student`.`sId`='$st_id';";
    $cd = mysqli_query($db_con,$sn);
    $sn1 = mysqli_fetch_array($cd);
    }else{
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
        $this->Cell(30,10,'Student Exam Result Report',0,0,'C');
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
$logoFile = "1234.png";
$logoXPos = 50;
$logoYPos = 80;
$logoWidth = 110;
$reportN = "Exam Results Report Data";
$reportName = "Exam Results Report of $cn1[1] Class";
$reportName0 = "$cn1[0] - $cn1[2]";
$reportName1 = "$sn1[0] - $sn1[1]$sn1[2]";
$reportName2 = "$date";
$reportNameYPos = 130;
$headerColour = array( 100, 100, 100 );


// $rowLabels = array( "sdfsdfsdf", "WonderWidget", "MegaWidget", "HyperWidget" );
// $chartXPos = 20;
// $chartYPos = 250;
// $chartWidth = 160;
// $chartHeight = 80;
// $chartXLabel = "Class";
// $chartYLabel = "Students";
// $chartYStep = 20000;

// $chartColours = array(
//                   array( 255, 100, 100 ),
//                   array( 100, 255, 100 ),
//                   array( 100, 100, 255 ),
//                   array( 255, 255, 100 ),
//                 );

// $data = array(
//           array( 5454, 10100, 9490, 11730 ),
//           array( 19310, 21140, 20560, 22590 ),
//           array( 25110, 26260, 25210, 28370 ),
//           array( 27650, 24550, 30040, 31980 ),
//         );
///////

/**
  Create the title page
 **/

$pdf = new PDF('P', 'mm', 'A4');
$pdf->SetTextColor($textColour[0], $textColour[1], $textColour[2]);
$pdf->AddPage();
$pdf->Line(20, 45, 210-20, 45);
// Logo
// $pdf->Image($logoFile, $logoXPos, $logoYPos, $logoWidth);

// Report Name
$pdf->SetFont('Arial', 'B', 12);
// $pdf->Ln($reportNameYPos);
$pdf->Cell(0, 0, $reportName, 0, 0, 'C');
$pdf->Ln(8);
if (isset($cn1[0]) && isset($cn1[1]) && isset($cn1[2])){
$pdf->Cell(0, 0, $reportName0, 0, 0, 'C');
$pdf->Ln(8);
}
if (isset($sn[0]) && isset($sn[1]) && isset($sn[2])){
$pdf->Cell(0, 0, $reportName1, 0, 0, 'C');
$pdf->Ln(8);
}
$pdf->Cell(0, 0, $reportName2, 0, 0, 'C');




// data table




//$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
// $pdf->SetFont('Arial', 'B', 17);
// $pdf->Cell(0, 15, $reportN, 0, 0, 'C');
$pdf->Ln(30);



$width_cell = array(40, 40);
$pdf->SetFont('Arial', 'B', 10);

//Background color of header//
$pdf->SetFillColor(193, 229, 252);

$sps = "Exam Results";
$pdf->Cell(0, 0, $sps, 0, 0, 'C');
$pdf->Ln(5);
$pdf->SetLeftMargin(65);

// Header starts /// 
//First header column //
$pdf->Cell($width_cell[0], 10, 'Student ID', 1, 0, 'C', true);
//Second header column//
$pdf->Cell($width_cell[1], 10, 'Marks(%)', 1, 1, 'C', true);

//// header ends ///////

$pdf->SetFont('Arial', '', 10);
//Background color of header//
$pdf->SetFillColor(235, 236, 236);
//to give alternate background fill color to rows// 
$fill = false;

/// each record is one row  ///
foreach ($db_con->query($sql1) as $row) {
  $pdf->Cell($width_cell[0], 10, $row['student_id'], 1, 0, 'C', $fill);
  $pdf->Cell($width_cell[1], 10, $row['marks'], 1, 1, 'C', $fill);
  //to give alternate background fill  color to rows//
  $fill = !$fill;
}
/// end of records /// 



// //////  Create the chart


// // Compute the X scale
// $xScale = count($rowLabels) / ( $chartWidth - 40 );

// // Compute the Y scale

// $maxTotal = 0;

// foreach ( $data as $dataRow ) {
//   $totalSales = 0;
//   foreach ( $dataRow as $dataCell ) $totalSales += $dataCell;
//   $maxTotal = ( $totalSales > $maxTotal ) ? $totalSales : $maxTotal;
// }

// $yScale = $maxTotal / $chartHeight;

// // Compute the bar width
// $barWidth = ( 1 / $xScale ) / 1.5;

// // Add the axes:

// $pdf->SetFont( 'Arial', '', 10 );

// // X axis
// $pdf->Line( $chartXPos + 30, $chartYPos, $chartXPos + $chartWidth, $chartYPos );

// for ( $i=0; $i < count( $rowLabels ); $i++ ) {
//   $pdf->SetXY( $chartXPos + 40 +  $i / $xScale, $chartYPos );
//   $pdf->Cell( $barWidth, 10, $rowLabels[$i], 0, 0, 'C' );
// }

// // Y axis
// $pdf->Line( $chartXPos + 30, $chartYPos, $chartXPos + 30, $chartYPos - $chartHeight - 8 );

// for ( $i=0; $i <= $maxTotal; $i += $chartYStep ) {
//   $pdf->SetXY( $chartXPos + 7, $chartYPos - 5 - $i / $yScale );
//   $pdf->Cell( 20, 10, '$' . number_format( $i ), 0, 0, 'R' );
//   $pdf->Line( $chartXPos + 28, $chartYPos - $i / $yScale, $chartXPos + 30, $chartYPos - $i / $yScale );
// }

// // Add the axis labels
// $pdf->SetFont( 'Arial', 'B', 12 );
// $pdf->SetXY( $chartWidth / 2 + 20, $chartYPos + 8 );
// $pdf->Cell( 30, 10, $chartXLabel, 0, 0, 'C' );
// $pdf->SetXY( $chartXPos + 7, $chartYPos - $chartHeight - 12 );
// $pdf->Cell( 20, 10, $chartYLabel, 0, 0, 'R' );

// // Create the bars
// $xPos = $chartXPos + 40;
// $bar = 0;

// foreach ( $data as $dataRow ) {

//   // Total up the sales figures for this product
//   $totalSales = 0;
//   foreach ( $dataRow as $dataCell ) $totalSales += $dataCell;

//   // Create the bar
//   $colourIndex = $bar % count( $chartColours );
//   $pdf->SetFillColor( $chartColours[$colourIndex][0], $chartColours[$colourIndex][1], $chartColours[$colourIndex][2] );
//   $pdf->Rect( $xPos, $chartYPos - ( $totalSales / $yScale ), $barWidth, $totalSales / $yScale, 'DF' );
//   $xPos += ( 1 / $xScale );
//   $bar++;
// }


/***
  Serve the PDF
***/






$pdf->Output();
