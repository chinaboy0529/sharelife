<?php
require ('psupport.php');

$GLOBALS ['EUC2SJIS'] = false; // If your file encoding is EUC-JP, uncomment it.

$GLOBALS ['UTF82SJIS'] = true;

$pdf = new MYPDF ( 'P', 'mm', 'A4' );

// $pdf->AddMBFont ( PMINCHO, 'SJIS' );
// $pdf->AddMBFont ( MINCHO, 'SJIS' );
$pdf->AddMBFont ( PMINCHO, 'SJIS' );
$pdf->AddMBFont ( MINCHO, 'SJIS' );
$pdf->AddPage ();  
$pdf->titleTable(1);//draw title Table
$pdf->infoTable();  //draw info Table
$pdf->cartTable(0,null,1);//draw cart list table
$pdf->memoTable();//draw momo Table
$pdf->memoTable2();//draw momo table
$pdf->packageTable();//draw packageTable
$pdf->paymentTable();//draw paymentTable
$pdf->processTable(0,null,1);//draw process Table
$pdf->workTable();//draw workTable
$pdf->Output ();

?>