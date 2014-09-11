<?php
require ('mbfpdf.php');

$GLOBALS ['EUC2SJIS'] = false; // If your file encoding is EUC-JP, uncomment it.

$GLOBALS ['UTF82SJIS'] = true;

$pdf = new MBFPDF ( 'P', 'mm', 'A4' );

// $pdf->AddMBFont ( PMINCHO, 'SJIS' );
// $pdf->AddMBFont ( MINCHO, 'SJIS' );
$pdf->AddMBFont ( PMINCHO, 'SJIS' );
$pdf->AddMBFont ( MINCHO, 'SJIS' );
$pdf->AddPage ();
$pdf->SetFont ( PMINCHO, '', 10 );
$pdf->SetLineWidth ( 0.5 );
$pdf->Rect ( 142, 51, 32, 16 );
$pdf->Rect ( 176, 51, 24, 16 );

$pdf->SetXY ( 142, 52 );
$pdf->Cell ( 20, 7, '��e�f�[�^', 0, 0, 'L' );
$pdf->SetXY ( 176, 52 );
$pdf->Cell ( 20, 7, '��]���', 0, 0, 'L' );

$pdf->Output ();

?>