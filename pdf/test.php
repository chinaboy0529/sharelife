<?php
require('mbfpdf.php');

$GLOBALS['EUC2SJIS'] = false;
//$GLOBALS['UTF82SJIS'] = true;

$pdf=new MBFPDF(); // Don't use $pdf = new FPDF();  MBFPDF() has overriden it.
 $pdf->AddMBFont(PGOTHIC,'SJIS');
 //$pdf->AddMBFont ( PMINCHO, 'SJIS' );
 //$pdf->AddMBFont ( MINCHO, 'SJIS' );
$pdf->AddPage();
$pdf->SetFont(PGOTHIC,'U',10);
$pdf->Cell(40,10,'���ƥǡ���');
$pdf->Output();



?>
