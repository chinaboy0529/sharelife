<?php
require ('estimate_support.php');

$GLOBALS ['EUC2SJIS'] = false; // If your file encoding is EUC-JP, uncomment it.

$GLOBALS ['UTF82SJIS'] = true;

$pdf = new MYPDF ( 'P', 'mm', 'A4' );

// $pdf->AddMBFont ( PMINCHO, 'SJIS' );
// $pdf->AddMBFont ( MINCHO, 'SJIS' );
$pdf->AddMBFont ( PMINCHO, 'SJIS' );
$pdf->AddMBFont ( MINCHO, 'SJIS' );
$pdf->AddPage ();  
$pdf->titleTable();//draw title Table
$pdf->headTable();
//$pdf->itemTable();
$pdf->bottomTable();
$pdf->Output ();

?>