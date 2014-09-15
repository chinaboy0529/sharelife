<?php
require('mbfpdf.php');
require('utfConvert.php');

//$GLOBALS['EUC2SJIS'] = true;
$GLOBALS['EUC2SJIS'] = false;
$GLOBALS['UTF82SJIS'] = true;




//post data parser
class TempData
{
        var $mTime; //íçï∂éûä‘  èoâ◊ó\íËì˙
  	var $mSerialNo;//éÛïtî‘çÜ
  	var $mEmail;	//[ email ]
  	var $mLeadman;	//[  
	
  	var $cName;	//[ ãMé–ñº ]
  	var $cPhone;	//[ ìdòbî‘çÜ ]
  	var $mZip;	//[ óXï÷î‘çÜ ]
  	var $mCity;	//[ ìsìπï{åß ]
  	var $mTown;	//[ ésãÊí¨ë∫ ]
  	var $mStreet;	//[ íöñ⁄î‘ín ]
  	var $mPayment;	//[ Ç®éxï•ï˚ñ@ ]
  	var $mDeliver;	//[ Ç≤î[ïiï˚ñ@ ]
  	var $mPrice;	//[ Ç®éxï•Ç¢çáåvã‡äz ]
  	var $tName;		//[ Ç®ìÕÇØêÊÇ®ñºëO ]
	var $tCompany;	//[ Ç®ìÕÇØêÊâÔé–ñº ]
  	var $tPhone;	//[ Ç®ìÕÇØêÊìdòbî‘çÜ ]
	// 20140410 í«â¡ start
	
	var $mStartTime;// start time
	var $mArriveTime; //ì˙ïtéwíËÇP
	var $tZipCode;	//[ Ç®ìÕÇØêÊóXï÷î‘çÜ ]
	var $tCity;		//[ Ç®ìÕÇØêÊìsìπï{åß ]
	var $tTown;		//[ Ç®ìÕÇØêÊésãÊí¨ë∫ ]
	var $tStreet;	//[ Ç®ìÕÇØêÊíöñ⁄î‘ín ]
	// 20140401 í«â¡ end
  	var $tAddress;	//[ Ç®ìÕÇØêÊèZèä ]
  
  	var $mMemo;	//[ îıçlóì ]
  	var $mReceipt;//[ óÃé˚èÿ ]
  	var $mNameFlg;//ï\é¶ñº å¬êl0 à»äO 1

	var $mOs; // Ç≤égópOS
	var $mSoft; //Ç≤égópÉ\ÉtÉg
	var $mSoftCheck; // ì¸çeëOÇÃÉ`ÉFÉbÉN

  	// for PDF
  	var $mailFrom;
  	var $pdfType; // PDF title
  	var $pdfName; // custom title
  
  	

	//ÅuëÓîzï÷àÀóäéÂñºÅvê•nullàΩÅyÉnéûÉiÉ~ñºã`Åzéû 1
	// ÅyÇ®ãqólñºã`Åz2
	// à»äO 0
	var $deliverMethod;

	// ï ÇÃÇ®ìÕÇØêÊÇéwíËÇ∑ÇÈèÍçá 1 
	// ÇªÇÃëº 0
	var $sendToOther;

	var $historyFlg; // [ çwì¸ó ] Ç∑Ç≈Ç…îÃë£âûâáÇ…Çƒçwì¸óÇ™Ç†ÇËÇ‹Ç∑ 1
	var $firstProductName;
        
  [{"mTime":"20140908","mSerialNo":"","mEmail":"","cName":"","mLeadman":"","mDeliver":"","mPayment":"","mPrice":"","mArriveTime":"","pdfType":"","mStartTime":""}]
	
	//start parse post data
	function init($postArray)
	{
	   $de_json = json_decode($postArray,TRUE);
           $count_json = count($de_json);
	   echo $count_json;
           for ($i = 0; $i < $count_json; $i++)
             {
 
                  $helper =new Utf2ShifJis();
		  $this->mTime = $de_json[$i]['mTime'];
                  $this->mSerialNo = $de_json[$i]['mSerialNo'];
		  $this->mEmail = $helper->convert( $de_json[$i]['mEmail']);
		  $this->cName = $helper->convert( $de_json[$i]['cName']); 
		  $this->mLeadman = $helper->convert( $de_json[$i]['mLeadman']); 
		  $this->mDeliver = $helper->convert( $de_json[$i]['mDeliver']);
		  $this->mPayment = $helper->convert( $de_json[$i]['mPayment']);
		  $this->mPrice = $helper->convert( $de_json[$i]['mPrice']);
		  $this->mArriveTime = $helper->convert( $de_json[$i]['mArriveTime']);
		  $this->pdfType = $helper->convert( $de_json[$i]['pdfType']);
		  $this->mStartTime; = $helper->convert( $de_json[$i]['mStartTime']);
		  
		  
                }
		return true;
		
	}
	
	
}







//  'ÉIÉìÉfÉ}ÉìÉhàÛç¸éwé¶èë'	= 1
//	'754àÛç¸éwé¶èë'		= 2
//  'ëÂîªÉJÉâÅ[àÛç¸éwé¶èë'	= 3

class MYPDF extends MBFPDF
{
	var $tempdata;
	var $fileList;

	function init($data)
	{
		$this->tempdata = $data;
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
		$this->Cell(13,0,'äîéÆâÔé–',0,0,'L');
		$this->SetFontSize(15);
		$this->Cell(10,0,'ÉnÉiÉ~',0,0,'L');
		
		$this->SetFontSize(4);
		$this->SetXY(40, -15);
	    $this->Cell(10,0,'Åúç]åÀêÏã¥',0,0,'L');
		$this->Cell(20,0,'dic@hanami.co.jp',0,0,'L');
		$this->SetX(80);
		$this->Cell(10,0,'ÅúêVèh',0,0,'L');
		$this->Cell(20,0,'shin@hanami.co.jp',0,0,'L');
		
		$this->SetXY(40, -13);
		$this->Cell(40,0,'Åß162-0801 ìåãûìsêVèhãÊéRêÅí¨333 ç]åÀêÏã¥î™ñÿÉrÉãÇPF',0,0,'L');
		$this->Cell(50,0,'Åß160-0022 ìåãûìsêVèhãÊêVèh2-5-5 êVèhìyínåöï®ëÊÇPÇPÉrÉãÇPF',0,0,'L');
		
		$this->SetXY(40, -11);
		$this->Cell(40,0,'TEL.03-3267-8430 (ë„ï\) FAX.03-3267-8440',0,0,'L');
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
			$str = 'ÉIÉìÉfÉ}ÉìÉhàÛç¸éwé¶èë';
		} else if($type == 2){
			$str = '754àÛç¸éwé¶èë';
		} else if($type == 3){
			$str = 'ëÂîªÉJÉâÅ[àÛç¸éwé¶èë';
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
		$this->Cell(0,4,'éÛït',0,0,'L');
		$this->SetX(162);
		$this->Cell(0,4,'ì`ï[î‘çÜ',0,0,'L');

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
		$this->Cell(95,5,'Ç®ãqólñº',0,0,'L');
		
		$this->SetXY(105, 19);
		$this->Cell(95,5,'î≠ëóì˙Ç‹ÇæÇÕÇ≤óàìXì˙',0,0,'L');
		
		$this->SetXY(115, 26);
		$this->Cell(95,5,'         åé               ì˙               ójì˙',0,0,'L');
		
		$this->SetXY(10, 44);
		$this->Cell(50,5,'Ç≤òAóçêÊ',0,0,'L');
		$this->SetXY(55, 44);
		$this->Cell(40,5,'Ç≤íSìñé“ñº',0,0,'L');
	
		$this->SetFont(PMINCHO,'',15);
		$this->SetXY(98, 43);
		$this->Cell(5,5,'ól',0,0,'L');
	
		$this->SetFont(PMINCHO,'',10);
		$this->SetXY(107, 36);
		$this->Cell(15,7,'î[ïi',0,0,'C');
		$this->SetXY(107, 41);
		$this->Cell(15,7,'ï˚ñ@',0,0,'C');
		
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
		//	// Not å¬êl
		//	if(mb_strlen($this->tempfile->cName) < 1){
		//		//ãMé–ñº is empty show Ç®ñºëO
		//		$displayName = $this->tempfile->pName;
		//	}else{
		//		// show ãMé–ñº
		//		$displayName = $this->tempfile->cName;
		//		$this->SetFont(MINCHO,'B',15);
		//		$this->SetXY(70, 43);
		//		$this->Cell(30,6,$this->tempfile->pName,0,0,'L');
		//	}
		//}
		//else
		//{
		//	// å¬êl
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
	
		$week = array("ì˙", "åé", "âŒ", "êÖ", "ñÿ", "ã‡", "ìy");
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
		$this->Cell(52,7,'ïi                ñº',1,0,'C');
		$this->Cell(30,7,'        édè„ÉTÉCÉY',1,0,'C');
		$this->Cell(13,7,'   éÌ  óﬁ',1,0,'C');
		$this->Cell(15,7,'   ñá  êî',1,0,'C');
		$this->Cell(15,7,'   çáåvñáêî',1,0,'C');
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
			$this->Cell(5,4,"äe",0,0,'L');
			
			$this->SetXY($x + 94, $y + 11);
			$this->Cell(5,4,"éÌ",0,0,'L');
			
			$this->SetXY($x + 110, $y + 11);
			$this->Cell(5,4,"ñá",0,0,':');
			
			$this->SetXY($x + 125, $y + 11);
			$this->Cell(5,4,"ñá",0,0,'L');
	
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
		$this->Cell(0,0,'ÇªÇÃëºéwé¶',0,0,'L');
	
		$this->SetFont(MINCHO,'',8);
		$lineIndex = 0;
		
		for($i=0;$i<count('îıçlóì ');$i++){
			$oneline = 'îıçlóì ';
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
		$this->Cell(0,0,'îıçlÅEÇªÇÃëºéwé¶',0,0,'L');
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
		$this->Cell(15,6,'î[ä˙',1,0,'C');	
		$this->Cell(30,6,'    çÏã∆ì‡óe/çHíˆ',0,0,'L');		
		$this->Cell(15,6,'íSìñ',0,0,'C');	
		
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
		$this->Cell(20,7,'ì¸çeÉfÅ[É^',0,0,'L');
		$this->SetXY(176, 52);
		$this->Cell(20,7,'äÛñ]ç´ïÔêî',0,0,'L');
	
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
		$this->Cell(15,6,'Åè',0,0,'C');	
	
		$this->SetFont(MINCHO,'B',25);
	
		$this->SetXY($x + 7, 109);
		$this->Cell(50,5,number_format('234234'),0,0,'L');
		$this->SetFont(PMINCHO,'',15);
		$this->SetXY(190, 109);
		$this->Cell(15,6,'Éf',0,0,'C');	
		
		$this->Line($x + 3, 116, 196, 116);
	
		$this->SetFont(PMINCHO,'',10);
		$this->SetXY(150, 117);
		$this->Cell(30,6,'óÃé˚èë      êøãÅèë ',0,0,'C');
	
		//if($this->tempfile->mReceipt == 1){
		//	$this->Ellipse(150,120,8,3);
		//}
		
		if(1 == 1){
			//$this->Ellipse(150,120,8,3);
		}
		
		//$this->Line($x + 3, 137, 196, 137);
		$this->SetXY($x, 138);
		$this->Cell(68,6,'(                )ì˙î≠ëó(                )ì˙íÖ',0,0,'C');
	
	
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
				$this->Cell(20,3,'â¡çH', 0, 0, 'L');	
				$y = $y + $step;
			}
	
			$y = $sy;
			$this->SetFont(PMINCHO,'',12);
			for ($i=0;$i<3;$i++) {
				$this->SetXY($x + 108, $y + 18);
				$this->Cell(20,6,'é–ì‡/äOíç', 0, 0, 'L');	
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
			$this->Cell(10,4,'ê‹/ë‰î‘çÜ', 0, 0, 'L');	
			$this->SetXY($x + 26, $y);
			$this->Cell(20,4,'ÉTÉCÉY', 0, 0, 'L');	
			$this->SetXY($x + 47, $y);
			$this->Cell(21,4,'ñ ïtédól', 0, 0, 'L');	
			$this->SetXY($x + 67, $y);
			$this->Cell(21,4,'êF/ë‰êî', 0, 0, 'L');	
			$this->SetXY($x + 88, $y);
			$this->Cell(20,4,'í Çµñáêî', 0, 0, 'L');	
			$this->SetXY($x + 105, $y);
			$this->Cell(22,4,'àÛç¸ã@/â¡çHèä', 0, 0, 'L');
	
			$this->SetXY($x + 21, $y + 4);
			$this->Cell(4,3,'ãe', 0, 0, 'L');	
			$this->SetXY($x + 21, $y + 6);
			$this->Cell(8,3,'élòZ', 0, 0, 'L');	
			$this->SetXY($x + 39, $y + 6);
			$this->Cell(4,3,'çÕ', 0, 0, 'R');	
	
			$this->SetXY($x + 79, $y + 6);
			$this->Cell(4,3,'ë‰', 0, 0, 'L');	
			$this->SetXY($x + 99, $y + 6);
			$this->Cell(4,3,'í ', 0, 0, 'L');
	
			$this->SetFont(PMINCHO,'',4);
			$this->SetXY($x + 57, $y + 4);
			$this->Cell(4,2,'ï≈ä|', 0, 0, 'L');	
			$this->SetXY($x + 57, $y + 5.5);
			$this->Cell(4,2,'êBî≈', 0, 0, 'L');	
			$this->SetXY($x + 57, $y + 7);
			$this->Cell(4,2,'ïtçá', 0, 0, 'L');
	
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
	
	
	
	//output pdf file
	function innerOutputPDF($type)
	{
		
		return $this->tempdata->mSerialNo;
		
		$fName = '20140411009970' . "_" . $type . ".pdf";
	
		$cList = array();
		//if($type == 1){
		//	$cList = $this->tempfile->products1;
		//} else if($type == 2){
		//	$cList = $this->tempfile->products2;
		//} else if($type == 3){
		//	$cList = $this->tempfile->products3;
		//}
	
		$recordCount = 1;//count($cList);
		if($recordCount == 0){
			return '';
		}
	
		$this->Open();
		
		// ÅyÉIÉìÉfÅzÅy754Åzê•3ò¢?ïi
		$pageSize = 3;
		//ÅyëÂîªÅzê•àÍ?4ò¢?ïi
		if($type == 3){
			$pageSize = 4;
		}
	
		$pageCount = 0;
		while ($recordCount > 0) {
			
			$pageCount++;
			$recordCount = $recordCount - $pageSize;
		}
		
		for($i=0;$i<$pageCount;$i++){
			$this->AddPage();
			$this->titleTable($type);
			$this->infoTable();
			$this->cartTable($i, null, $type);
			$this->processTable($i, null, $type);
			$this->packageTable();
			$this->paymentTable();
			$this->workTable();
			$this->memoTable();
			$this->memoTable2();
		}
	
		$filePath = '/generatefile/pointBook_pdf/'.date("Ymdhisa");
		if (!file_exists($filePath )) {
			mkdir('.'.$filePath, 0777);
		}
		$fName = $filePath.'/'.$fName;
	
		$this->Output('.'.$fName ,'F');
		return $fName;
	}
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
