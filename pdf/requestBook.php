<?php
require ('requestDetail_support.php');

$postArray= $_POST['jsonData'] ;//get post data
$tempData=new TempData();
$opFlg =$tempData->init($postArray);            

$GLOBALS ['EUC2SJIS'] = false; // If your file encoding is EUC-JP, uncomment it.
$GLOBALS ['UTF82SJIS'] = true;

$pdf = new MYPDF ( 'P', 'mm', 'A4' );
$pdf->AddMBFont ( PMINCHO, 'SJIS' );
$pdf->AddMBFont ( MINCHO, 'SJIS' );
$pdf->init($tempData);
$filePath = $pdf->innerOutputPDF();
//echo $filePath;

?>