<?php
require_once("init.php");

define('FPDF_FONTPATH','font');
$user = 'test';
$complement = 'The faculty at PiaGotsky are honored to present the official certification for completing BS Computer. Your achievement will be remembered and your participation cherished.';

$pdf = new PDF();
$pdf->AddPage('L','A4');
$pdf->AddFont('ananda','R');
$pdf->SetFont('ananda','R',40);
$pdf->Image('images/cert.jpg',0,0,-120,-120);
$pdf->SetXY(10,110);
$pdf->SetTextColor(45,50,125);
$pdf->Cell(10,0,$user,0,0,'L');

$pdf->AddFont('helvetica');
$pdf->SetFont('helvetica','',11);
$pdf->SetXY(10,125);
$pdf->SetTextColor(50,50,50);
$data =  $pdf->WordWrap($complement,120);
$pdf->MultiCell(150,5,$complement,0,'J',false);


//put signature


$pdf->Output();

?>
