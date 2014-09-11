<?php
require('mbfpdf.php');
//require('gsupport.php');

//$GLOBALS['EUC2SJIS'] = true;
$GLOBALS['EUC2SJIS'] = false;
$GLOBALS['UTF82SJIS'] = true;

//  '�I���f�}���h����w����'	= 1
//	'754����w����'		= 2
//  '�唻�J���[����w����'	= 3

class MYPDF extends MBFPDF
{
	var $tempfile;
	var $fileList;

	function init($aFile)
	{
		$this->tempfile = $aFile;
		$this->fileList = array();
	}
  
	function Header()
	{	
		/*$this->SetFont(PMINCHO,'B',20);
		$this->Cell(0,10,'WEB',0,0,'C');*/
	}
	
	function Footer()
	{
		
		$this->SetY(-15);
		$this->SetFont(PMINCHO,'',8);
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

		/*
		$this->SetFontSize(8);
		$this->Cell(13,0,'�������',0,0,'L');
		$this->SetFontSize(15);
		$this->Cell(10,0,'�n�i�~',0,0,'L');
		
		$this->SetFontSize(4);
		$this->SetXY(40, -15);
	    $this->Cell(10,0,'���]�ː싴',0,0,'L');
		$this->Cell(20,0,'dic@hanami.co.jp',0,0,'L');
		$this->SetX(80);
		$this->Cell(10,0,'���V�h',0,0,'L');
		$this->Cell(20,0,'shin@hanami.co.jp',0,0,'L');
		
		$this->SetXY(40, -13);
		$this->Cell(40,0,'��162-0801 �����s�V�h��R����333 �]�ː싴���؃r���PF',0,0,'L');
		$this->Cell(50,0,'��160-0022 �����s�V�h��V�h2-5-5 �V�h�y�n������P�P�r���PF',0,0,'L');
		
		$this->SetXY(40, -11);
		$this->Cell(40,0,'TEL.03-3267-8430 (��\) FAX.03-3267-8440',0,0,'L');
		$this->Cell(50,0,'TEL.03-5363-1873 FAX.03-5363-1887',0,0,'L');
		*/
	}
	
	function titleTable($type)
	{

		// 10 18  190  7
		$this->SetXY(10, 8);
		
		$this->SetFont(PMINCHO,'B',20);
		$this->Cell(18,10,'WEB',0,0,'L');

		$this->SetFont(MINCHO,'',18);
		
		if($type == 1){
			$str = '�I���f�}���h����w����';
		} else if($type == 2){
			$str = '754����w����';
		} else if($type == 3){
			$str = '�唻�J���[����w����';
		}

		$this->Cell(80,10,$str,0,0,'L');
		
		$this->SetFont(MINCHO,'',10);
		$this->SetXY(100, 9);
		$this->Cell(35,5,'23023423423',0,0,'L');
		$this->SetFont(MINCHO,'',10);
		$this->SetXY(100, 12);
		$this->Cell(35,5,'234234234',0,0,'L');
		
		$this->SetLineWidth(0.3);
		$this->Rect(135,9,25,7);
		$this->Rect(162,9,38,7);
		
		$this->SetXY(135, 9);
		$this->SetFont(PMINCHO,'',5);
		$this->Cell(0,4,'��t',0,0,'L');
		$this->SetX(162);
		$this->Cell(0,4,'�`�[�ԍ�',0,0,'L');

	}
	
	function infoTable()
	{
		// 10 27  190  30
		$this->SetLineWidth(0.8);
		$this->Rect(10,19,190,30);
		
		$this->SetLineWidth(0.3);
		$this->Rect(10,19,95,30);
		$this->Rect(10+95,19,95,15);
		$this->Rect(10+95,34,15,15);
		
		$this->SetFont(PMINCHO,'',8);
		$this->SetXY(10, 19);
		$this->Cell(95,5,'���q�l��',0,0,'L');
		
		$this->SetXY(105, 19);
		$this->Cell(95,5,'�������܂��͂����X��',0,0,'L');
		
		$this->SetXY(115, 26);
		$this->Cell(95,5,'         ��               ��               �j��',0,0,'L');
		
		$this->SetXY(10, 44);
		$this->Cell(50,5,'���A����',0,0,'L');
		$this->SetXY(55, 44);
		$this->Cell(40,5,'���S���Җ�',0,0,'L');
	
		$this->SetFont(PMINCHO,'',15);
		$this->SetXY(98, 43);
		$this->Cell(5,5,'�l',0,0,'L');
	
		$this->SetFont(PMINCHO,'',10);
		$this->SetXY(107, 36);
		$this->Cell(15,7,'�[�i',0,0,'C');
		$this->SetXY(107, 41);
		$this->Cell(15,7,'���@',0,0,'C');
		
		$displayName = "";
		/*
		if ($this->tempfile->mNameFlg == 1){
	
			if ($this->tempfile->historyFlg == 1){
				$displayName = $this->tempfile->pName;
			}else{
				$displayName = $this->tempfile->cName;
				$this->SetFont(MINCHO,'B',15);
				$this->SetXY(70, 43);
				$this->Cell(30,6,$this->tempfile->pName,0,0,'L');
			}
			
		}else{
			$displayName = $this->tempfile->pName;
		}
		*/
	
		//if ($this->tempfile->mNameFlg == 1){
		//	// Not �l
		//	if(mb_strlen($this->tempfile->cName) < 1){
		//		//�M�Ж� is empty show �����O
		//		$displayName = $this->tempfile->pName;
		//	}else{
		//		// show �M�Ж�
		//		$displayName = $this->tempfile->cName;
		//		$this->SetFont(MINCHO,'B',15);
		//		$this->SetXY(70, 43);
		//		$this->Cell(30,6,$this->tempfile->pName,0,0,'L');
		//	}
		//}
		//else
		//{
		//	// �l
		//	$displayName = $this->tempfile->pName;
		//}
	
		$this->SetFont(MINCHO,'B',22);
		$this->SetXY(15, 24);
		//$oneline = mb_substr($displayName, 0, 11);
		$oneline = mb_substr('XIANSHIMINGZI', 0, 11);
		$this->Cell(90,9,$oneline,0,0,'L');
	
	
		//$time = strtotime($this->tempfile->mTime );
		$time = strtotime(20140711 );
		$this->SetXY(115, 24);
		$this->Cell(90,9,date("n", $time),0,0,'L');
	
		$this->SetXY(130, 24);
		$this->Cell(90,9,date("j", $time),0,0,'L');
	
		$this->SetXY(145, 24);
		$w = date("w", $time);
	
		$week = array("��", "��", "��", "��", "��", "��", "�y");
		$this->Cell(90,9,$week[$w],0,0,'L');
	
		if(mb_strlen($displayName) > 11){
			$this->SetXY(15, 33);
			$oneline = mb_substr($displayName, 11);
			$this->Cell(90,9,$oneline,0,0,'L');
		}
	
		$this->SetFont(PMINCHO,'B',8);
		$this->SetXY(23, 46);
		//if ($this->tempfile->historyFlg == 1){
		//	$this->Cell(0,0,$this->tempfile->mEmail,0,0,'L');
		//}else{
		//	$this->Cell(0,0,$this->tempfile->cPhone,0,0,'L');
		//}
	
		$this->SetFont(PMINCHO,'B',25);
		$this->SetXY(120, 34);
		//$this->Cell(90,15,$this->tempfile->mDeliver,0,0,'C');
		$this->Cell(90,15,'MDEVICE',0,0,'C');
	
	}

	
	/**
	 *cart list table
	 */
	function cartTable($index, $cList, $type){
		// 10 60  100  100
		$this->SetLineWidth(0.8);
		$this->Rect(10,51,130,67);
		
		$this->SetLineWidth(0.3);
	
		$x = 10;
		$sy = 51;
		$step = 15;
	
		// one page have 4 index
		$start = $index * 4;
	
		$y = $sy;
		$this->SetFont(PMINCHO,'B',8);
		// title
		$this->SetXY($x, $y);
		$this->Cell(5,7,'',1,0,'C');
		$this->Cell(52,7,'�i                ��',1,0,'C');
		$this->Cell(30,7,'        �d��T�C�Y',1,0,'C');
		$this->Cell(13,7,'     ��  ��',1,0,'C');
		$this->Cell(15,7,'     ��  ��',1,0,'C');
		$this->Cell(15,7,'     ���v����',1,0,'C');
		$this->ln();
	
		$this->SetFont(MINCHO,'B',12);
		
		$y = $sy + 7;
		for ($i=0;$i<4;$i++) {
			$this->SetXY($x, $y);
			$this->Cell(5,15,$i + $start + 1, 1, 0, 'L');
			
			$this->Rect($x + 5,$y,52,15);
			$this->Rect($x + 57,$y,30,15);
			$this->Rect($x + 87,$y,13,15);
			$this->Rect($x + 100,$y,15,15);
			$this->Rect($x + 115,$y,15,15);
	
			$y = $y + $step;
		}
	
		$this->SetFont(PMINCHO,'',8);
		$y = $sy + 7;
		for ($i=0;$i<4;$i++) {
	
			$this->SetXY($x + 100, $y + 1);
			$this->Cell(5,4,"�e",0,0,'L');
			
			$this->SetXY($x + 94, $y + 11);
			$this->Cell(5,4,"��",0,0,'L');
			
			$this->SetXY($x + 110, $y + 11);
			$this->Cell(5,4,"��",0,0,':');
			
			$this->SetXY($x + 125, $y + 11);
			$this->Cell(5,4,"��",0,0,'L');
	
			$y = $y + 15;
		}
	
		$start = $index * 3;
		$end = $start + 3;
		if($type == 3){
			$start = $index * 4;
			$end = $start + 4;
		}
	
		if(count($cList) < $end){
			$end = count($cList);
		}
		
		if($type == 3){
			$this->SetFont(PMINCHO,'',12);
		}else{
			$this->SetFont(PMINCHO,'',10);
		}
		
		$y = $sy + 7;
		for($j=$start;$j<$end;$j++){
			
			$this->SetXY($x + 5, $y);
			$this->Cell(52,15,$cList[$j]->name,0,0,'L');
	
			$indexOfX = mb_strpos($cList[$j]->size,"x");
			if($indexOfX === FALSE){
				$indexOfX = 9;
			}else{
				$indexOfX++;
			}
	
			if(mb_strlen($cList[$j]->size) > $indexOfX){
				$this->SetXY($x + 57, $y);
				$this->Cell(30,7, mb_substr($cList[$j]->size, 0, $indexOfX),0,0,'L');
				$this->SetXY($x + 57, $y + 7);
				$this->Cell(30,7, mb_substr($cList[$j]->size, $indexOfX),0,0,'L');
			}else{
				$this->SetXY($x + 57, $y);
				$this->Cell(30,15,$cList[$j]->size,0,0,'L');
			}
	
			$this->SetXY($x + 87, $y);
			$this->Cell(13,15,$cList[$j]->kind,0,0,'C');
			$this->Cell(15,15,number_format($cList[$j]->mCount),0,0,'C');
			$this->Cell(15,15,number_format($cList[$j]->mSum),0,0,'C');
	
			$y = $y + 15;
		}
	
	}
	
	
	
        ///draw memoTable
	function memoTable()
	{
		$x = 10;
		$y = 224;
	
		$this->SetLineWidth(0.3);
		$this->Rect($x,$y,94,60);
		
		$this->SetXY($x + 1, $y + 2);
		$this->SetFont(PMINCHO,'',8);
		$this->Cell(0,0,'���̑��w��',0,0,'L');
	
		$this->SetFont(MINCHO,'',8);
		$lineIndex = 0;
		
		for($i=0;$i<count('���l�� ');$i++){
			$oneline = '���l�� ';
			do{
				$subline = mb_substr($oneline, 0, 30);
				if(mb_strlen($subline) > 0){
					$this->SetXY($x + 2, $y + 6 + $lineIndex * 4);
					$this->Cell(110,0,$subline,0,0,'L');
					$lineIndex++;	
				}
				$oneline = mb_substr($oneline, 30);
				
			}while(mb_strlen($oneline) > 0);
	
			if($lineIndex > 10){
				$this->SetXY($x + 2, $y + 4 + $lineIndex * 4);
				$this->Cell(110,0,"......",0,0,'L');
				break;
			}
		}
	
	}
	
	function memoTable2(){
		$x = 106;
		$y = 224;
	
		$this->SetLineWidth(0.3);
		$this->Rect($x,$y,94,60);
		
		$this->SetXY($x + 1, $y + 2);
		$this->SetFont(PMINCHO,'',8);
		$this->Cell(0,0,'���l�E���̑��w��',0,0,'L');
	}
	
	
	
	function workTable()
	{
		$this->SetFont(PMINCHO,'',10);
		$x = 142;
		$y = 145;
		$this->SetLineWidth(0.3);
		$this->Rect($x,$y,58,22);
		
		$this->SetXY($x, $y + 2);
		$this->Cell(58,4,'',0,0,'L');
		$this->SetXY($x, $y + 5);
		$this->Cell(58,4,'',0,0,'L');
	
		$softCheck = '';
		$lineIndex = 0;
		do{
			$subline = mb_substr($softCheck, 0, 20);
			if(mb_strlen($subline) > 0){
				$this->SetXY($x, $y + 11 + $lineIndex * 4);
				$this->Cell(110,0,$subline,0,0,'L');
				$lineIndex++;
			}
			$softCheck = mb_substr($softCheck, 20);
				
		}while(mb_strlen($softCheck) > 0);
	
		$y = $y + 23;
		$this->SetXY($x, $y);
		$this->Rect($x,$y,58,6);
	
		$this->SetFont(PMINCHO,'',8);
		$this->Cell(15,6,'�[��',1,0,'C');	
		$this->Cell(30,6,'    ��Ɠ��e/�H��',0,0,'L');		
		$this->Cell(15,6,'�S��',0,0,'C');	
		
		$y = $y + 6;
		for ($i=0;$i<6;$i++) {
			$this->Rect($x,$y,15,8);
			$this->Rect($x + 15,$y,43,8);
			$y = $y + 8;
		}
	
	}
	
	
	
	
	function packageTable()
	{
	
		// 105 60  80  20
		$this->SetLineWidth(0.5);
		$this->Rect(142,51,32,16);
		$this->Rect(176,51,24,16);
	
		$this->SetFont(PMINCHO,'',10);
		$this->SetXY(142, 52);
		$this->Cell(20,7,'���e�f�[�^',0,0,'L');
		$this->SetXY(176, 52);
		$this->Cell(20,7,'��]���',0,0,'L');
	
	}
	
	
	//	
	function paymentTable()
	{
	
		$x = 142;
		// 105 80  80  60
		$this->SetLineWidth(0.5);
		$this->Rect($x,69,58,75);
		
		$this->SetFont(MINCHO,'',15);
		
		$this->SetXY(155, 75);
		$this->Cell(30,20,trim('234234'),0,0,'L');
		$this->Ellipse(170,85,20,5);
		
		$this->SetXY($x, 109);
		$this->Cell(15,6,'��',0,0,'C');	
	
		$this->SetFont(MINCHO,'B',25);
	
		$this->SetXY($x + 7, 109);
		$this->Cell(50,5,number_format('234234'),0,0,'L');
		$this->SetFont(PMINCHO,'',15);
		$this->SetXY(190, 109);
		$this->Cell(15,6,'�f',0,0,'C');	
		
		$this->Line($x + 3, 116, 196, 116);
	
		$this->SetFont(PMINCHO,'',10);
		$this->SetXY(150, 117);
		$this->Cell(30,6,'�̎���      ������ ',0,0,'C');
	
		//if($this->tempfile->mReceipt == 1){
		//	$this->Ellipse(150,120,8,3);
		//}
		
		if(1 == 1){
			//$this->Ellipse(150,120,8,3);
		}
		
		//$this->Line($x + 3, 137, 196, 137);
		$this->SetXY($x, 138);
		$this->Cell(68,6,'(                )������(                )����',0,0,'C');
	
	
		$this->SetFont(MINCHO,'B',20);
	
		$this->SetXY($x + 3, 138);
		$this->Cell(10,6,$this->getDisplayDate('20140906'),0,0,'L');
	
		$this->SetXY($x + 33, 138);
		$this->Cell(10,6,$this->getDisplayDate('20140912'),0,0,'L');
		
	
	}
	
	function processTable($index, $cList, $type)
	{
	

		// 10 60  100  100
		$this->SetLineWidth(0.8);
		$x = 10;
		$sy = 120;
		$y = $sy;
		$step = 26;
	
		$start = $index * 4;
	
		for ($i=0;$i<4;$i++) {
			$this->Rect($x,$y,130,24);	
			$y = $y + $step;
		}
	
		// index 
		$y = $sy;
		$this->SetFont(MINCHO,'B',12);
		for ($i=0;$i<4;$i++) {
			$this->SetXY($x, $y);
			$this->Cell(5,24,$i + $start + 1, 1, 0, 'L');	
			$y = $y + $step;
		}
	
		if($type != 3){
	
			$y = $sy;
			$this->SetFont(PMINCHO,'',6);
			for ($i=0;$i<3;$i++) {
				$this->Rect($x + 108,$y + 15,22,9);	
				$y = $y + $step;
			}
	
			$this->SetLineWidth(0.3);
			$y = $sy;
			for ($i=0;$i<3;$i++) {
				$this->Rect($x + 108,$y + 15,22,3);	
				$y = $y + $step;
			}
	
			$y = $sy;
			for ($i=0;$i<3;$i++) {
				$this->SetXY($x + 116, $y + 15.5);
				$this->Cell(20,3,'���H', 0, 0, 'L');	
				$y = $y + $step;
			}
	
			$y = $sy;
			$this->SetFont(PMINCHO,'',12);
			for ($i=0;$i<3;$i++) {
				$this->SetXY($x + 108, $y + 18);
				$this->Cell(20,6,'�Г�/�O��', 0, 0, 'L');	
				$y = $y + $step;
			}
			
			$x = 15;
			$y = $sy + $step * 3;
			for ($i=0;$i<5;$i++) {
				$hh = 5;
				if($i == 0){
					$hh = 4;
				}
				$this->Rect($x,$y,21,$hh);
				$this->Rect($x+21,$y,20,$hh);
				$this->Rect($x+41,$y,21,$hh);
				$this->Rect($x+62,$y,21,$hh);
				$this->Rect($x+83,$y,20,$hh);
				$this->Rect($x+103,$y,22,$hh);
				$y = $y + $hh;
			}
	
			$x = 15;
			$y = $sy + $step * 3;
	
			$this->SetXY($x + 64, $y + 4.5);
			$this->Cell(4,5,'/', 0, 0, 'L');
	
			$this->SetFont(PMINCHO,'',6);
			$this->SetXY($x + 5, $y);
			$this->Cell(10,4,'��/��ԍ�', 0, 0, 'L');	
			$this->SetXY($x + 26, $y);
			$this->Cell(20,4,'�T�C�Y', 0, 0, 'L');	
			$this->SetXY($x + 47, $y);
			$this->Cell(21,4,'�ʕt�d�l', 0, 0, 'L');	
			$this->SetXY($x + 67, $y);
			$this->Cell(21,4,'�F/�䐔', 0, 0, 'L');	
			$this->SetXY($x + 88, $y);
			$this->Cell(20,4,'�ʂ�����', 0, 0, 'L');	
			$this->SetXY($x + 105, $y);
			$this->Cell(22,4,'����@/���H��', 0, 0, 'L');
	
			$this->SetXY($x + 21, $y + 4);
			$this->Cell(4,3,'�e', 0, 0, 'L');	
			$this->SetXY($x + 21, $y + 6);
			$this->Cell(8,3,'�l�Z', 0, 0, 'L');	
			$this->SetXY($x + 39, $y + 6);
			$this->Cell(4,3,'��', 0, 0, 'R');	
	
			$this->SetXY($x + 79, $y + 6);
			$this->Cell(4,3,'��', 0, 0, 'L');	
			$this->SetXY($x + 99, $y + 6);
			$this->Cell(4,3,'��', 0, 0, 'L');
	
			$this->SetFont(PMINCHO,'',4);
			$this->SetXY($x + 57, $y + 4);
			$this->Cell(4,2,'�Ŋ|', 0, 0, 'L');	
			$this->SetXY($x + 57, $y + 5.5);
			$this->Cell(4,2,'�B��', 0, 0, 'L');	
			$this->SetXY($x + 57, $y + 7);
			$this->Cell(4,2,'�t��', 0, 0, 'L');
	
		}
	
		$start = $index * 3;
		$end = $start + 3;
		if($type == 3){
			$start = $index * 4;
			$end = $start + 4;
		}
	
		if(count($cList) < $end){
			$end = count($cList);
		}
	
		if($type == 3){
			$this->SetFont(PMINCHO,'',12);
		}else{
			$this->SetFont(PMINCHO,'',10);
		}
	
		$y = $sy;
		$x = 15;
		for($j=$start;$j<$end;$j++){
			$process = null;//$cList[$j]->mPaper;
			$lineIndex = 0;
			$processList = null;//$cList[$j]->process;
			for($n=0;$n<count($processList);$n++){
				if(mb_strlen($process) > 0){
					$process = $process . " + ". trim($processList[$n]);
				} else {
					$process = trim($processList[$n]);
				}
			}
	
			do{
				$oneline = mb_substr($process, 0, 34);
				if(mb_strlen($oneline) > 0){
					$this->SetXY($x, $y + $lineIndex * 7);
					$this->Cell(130,7,$oneline,0,0,'L');
					$lineIndex++;
				}
				$process = mb_substr($process, 34);
				
			}while(mb_strlen($process) > 0);
	
			$y = $y + $step;
		}
	}
	//
	//function innerOutputPDF($type)
	//{
	//	$fName = $this->tempfile->mSerialNo . "_" . $type . ".pdf";
	//
	//	$cList = array();
	//	if($type == 1){
	//		$cList = $this->tempfile->products1;
	//	} else if($type == 2){
	//		$cList = $this->tempfile->products2;
	//	} else if($type == 3){
	//		$cList = $this->tempfile->products3;
	//	}
	//
	//	$recordCount = count($cList);
	//	if($recordCount == 0){
	//		return '';
	//	}
	//
	//	$this->Open();
	//	
	//	// �y�I���f�z�y754�z��3��?�i
	//	$pageSize = 3;
	//	//�y�唻�z����?4��?�i
	//	if($type == 3){
	//		$pageSize = 4;
	//	}
	//
	//	$pageCount = 0;
	//	while ($recordCount > 0) {
	//		
	//		$pageCount++;
	//		$recordCount = $recordCount - $pageSize;
	//	}
	//	
	//	for($i=0;$i<$pageCount;$i++){
	//		$this->AddPage();
	//		$this->titleTable($type);
	//		$this->infoTable();
	//		$this->cartTable($i, $cList, $type);
	//		$this->processTable($i, $cList, $type);
	//		$this->packageTable();
	//		$this->paymentTable();
	//		$this->workTable();
	//		$this->memoTable();
	//		$this->memoTable2();
	//	}
	//
	//	$filePath = '/generatefile/pdf/'.date("Ymd");
	//	if (!file_exists($filePath )) {
	//		mkdir('.'.$filePath, 0777);
	//	}
	//	$fName = $filePath.'/'.$fName;
	//
	//	$this->Output('.'.$fName ,'F');
	//	return $fName;
	//}
	//
	//function Circle($x, $y, $r, $style='D')
	//{
	//	$this->Ellipse($x,$y,$r,$r,$style);
	//}
	
	
	//
	function Ellipse($x, $y, $rx, $ry, $style='D')
	{
		if($style=='F')
			$op='f';
		elseif($style=='FD' || $style=='DF')
			$op='B';
		else
			$op='S';
		$lx=4/3*(M_SQRT2-1)*$rx;
		$ly=4/3*(M_SQRT2-1)*$ry;
		$k=$this->k;
		$h=$this->h;
		$this->_out(sprintf('%.2F %.2F m %.2F %.2F %.2F %.2F %.2F %.2F c',
			($x+$rx)*$k,($h-$y)*$k,
			($x+$rx)*$k,($h-($y-$ly))*$k,
			($x+$lx)*$k,($h-($y-$ry))*$k,
			$x*$k,($h-($y-$ry))*$k));
		$this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c',
			($x-$lx)*$k,($h-($y-$ry))*$k,
			($x-$rx)*$k,($h-($y-$ly))*$k,
			($x-$rx)*$k,($h-$y)*$k));
		$this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c',
			($x-$rx)*$k,($h-($y+$ly))*$k,
			($x-$lx)*$k,($h-($y+$ry))*$k,
			$x*$k,($h-($y+$ry))*$k));
		$this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c %s',
			($x+$lx)*$k,($h-($y+$ry))*$k,
			($x+$rx)*$k,($h-($y+$ly))*$k,
			($x+$rx)*$k,($h-$y)*$k,
			$op));
	}
	
	//
	function getDisplayDate($str){
	
		if(trim($str) == ""){
			return "";
		}
	
		$time = strtotime( $str );
	
		$ret = date("n", $time);
		$ret .= '/';
		$ret .= date("j", $time);
		return $ret;
	}
	
}

?>
