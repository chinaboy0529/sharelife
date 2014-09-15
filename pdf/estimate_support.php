<?php
require('mbfpdf.php');
//require('gsupport.php');
require('utfConvert.php');
//$GLOBALS['EUC2SJIS'] = true;
$GLOBALS['EUC2SJIS'] = false;
$GLOBALS['UTF82SJIS'] = true;



//post data parser
//'・営業日(土日祝含まず)18時までのご注文ご入稿で、'
//[{ "mPtitle":"テスト代","mSerialNo":"555555","mDtime":"平成26年9月5日","mStime":"営業日(土日祝含まず)18時までのご注文ご入稿で、","mCoName":"株式会社　ハナミ","mPeriod":"" ,"mAdress":"","mLeadMan":"ハナミ","mTotal":"1,111","mNum":"1","mPrice":"1,000","mStyle":"","mRemark":"..."}]
class TempData
{
  	//var $mProjectName;//project Name.
	var $mSerialNo	;  //request SerialNo
  	var $mDtime;	//make time
	var $mStime;	//success time   納期
	var $mCoName;	//co. name
	var $mPeriod ; // period of validity
	var $mPtitle ; // procuct title
	//var $mCustomName;	//custom Name
    	var $mAdress;  //adress
        var $mLeadMan;  //担当
	var $mTotal;  //合計
        var $mNum;  //数量
        var $mPrice;  //単価
        var $mStyle;//仕樣
        var $mRemark;//      備考	

	
	
	//start parse post data
	function init($postArray)
	{
	   $de_json = json_decode($postArray,TRUE);
           $count_json = count($de_json);
	// echo $count_json;
           for ($i = 0; $i < $count_json; $i++)
             {
		  $helper = new Utf2ShifJis();
		//  $this->mProjectName = $helper->convert( $de_json[$i]['mProjectName']);
                  $this->mSerialNo = $helper->convert( $de_json[$i]['mSerialNo']);
		  $this->mDtime = $helper->convert( $de_json[$i]['mDtime']); 
		  $this->mStime = $helper->convert( $de_json[$i]['mStime']);
		  $this->mCoName = $helper->convert( $de_json[$i]['mCoName']);
		  $this->mPeriod = $helper->convert( $de_json[$i]['mPeriod']);
   		  $this->mPtitle = $helper->convert( $de_json[$i]['mPtitle']);
   		 // $this->mCustomName = $helper->convert( $de_json[$i]['mCustomName']);
   		  $this->mAdress = $helper->convert( $de_json[$i]['mAdress']);
   		  $this->mLeadMan = $helper->convert( $de_json[$i]['mLeadMan']);
   		  $this->mTotal = $helper->convert( $de_json[$i]['mTotal']);
   		  $this->mNum = $helper->convert( $de_json[$i]['mNum']);
   		  $this->mPrice = $helper->convert( $de_json[$i]['mPrice']);
		  $this->mStyle = $helper->convert( $de_json[$i]['mStyle']);
   		  $this->mRemark = $helper->convert( $de_json[$i]['mRemark']);

		}
	
		return true;
	}
	
}


//  御見積書 

class MYPDF extends MBFPDF
{
        var $currentY;
        var $tempdata;

	function init($aFile)
	{
		$this->tempdata = $aFile;
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

	}
	
	
	
	function titleTable()
	{
		// 10 18  190  7
		$this->SetXY(20, 25);
		$this->SetFont(MINCHO,'B',18);
		$this->Cell(18,10,'御見積書',0,0,'L');
	}
	
	
	
	function headTable()
	{
		
		
		$this->SetXY(130, 35);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(18,10,'作成日',0,0,'L');
		
		$this->SetXY(150, 35);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(18,10,$this->tempdata->mDtime,0,0,'L');
		
		$this->SetLineWidth(0.1);
		$this->Line(18, 47,  120, 47) ;
		
	        $this->SetLineWidth(0.1);
		$this->Line(18, 52,  120, 52) ;
		
	        $this->SetLineWidth(0.1);
		$this->Line(18, 57,  115, 57) ;
		
		$this->SetXY(18, 27);
		$this->SetFont(MINCHO,'B',10);
		$this->Cell(18,47,'社名',0,0,'L');
		
		$this->SetXY(38, 27);
		$this->SetFont(MINCHO,'B',10);
		$this->Cell(18,47,$this->tempdata->mCoName,0,0,'L');
		
		
		$this->SetXY(110, 27);
		$this->SetFont(MINCHO,'B',10);
		$this->Cell(18,47,'宛',0,0,'L');
		
		
		$this->SetXY(18, 32);
		$this->SetFont(MINCHO,'B',10);
		$this->Cell(18,47,'件名',0,0,'L');
		
		$this->SetXY(38, 32);
		$this->SetFont(MINCHO,'B',10);
		$this->Cell(18,47,$this->tempdata->mPtitle,0,0,'L');
		
		$this->SetXY(18, 42);
		$this->SetFont(MINCHO,'B',10);
		$this->Cell(18,45,'下記の通り、御見積り申し上げます',0,0,'L');
		
		
	        $this->SetLineWidth(0.1);
		$this->Line(18, 75,  115, 75) ;
		
		
		$this->SetLineWidth(0.1);
		$this->Line(18, 80,  40, 80) ;
		
		
		$this->SetLineWidth(0.1);
		$this->Line(18, 85,  40, 85) ;
		
		$this->SetLineWidth(0.1);
		$this->Line(18, 90,  40, 90) ;
		
		$this->SetXY(18, 56);
		$this->SetFont(MINCHO,'B',10);
		$this->Cell(18,45,'納期',0,0,'L');

		
		
		$this->SetXY(38, 56);
		$this->SetFont(MINCHO,'B',9);
		$this->Cell(18,45,$this->tempdata->mStime,0,0,'L');
		
		
		$this->SetXY(58,60);
		$this->SetFont(MINCHO,'B',8);
		$this->Cell(18,45,'   ご注文ご入稿日を含めない、',0,0,'L');
		
		$this->SetXY(58,65);
		$this->SetFont(MINCHO,'B',8);
		$this->Cell(18,45,'   翌々営業日発送をいたします。',0,0,'L');
		
		
		
		
		
		
		
		
		//
		$this->SetXY(120, 55);
		$this->SetFont(MINCHO,'B',10);
		$this->Cell(18,10,'株式会社ハナミ　販促応援',0,0,'L');
		//
		$this->SetXY(120, 64);
		$this->SetFont(MINCHO,'B',8);
		$this->Cell(18,10,'〒162-0801',0,0,'L');
		
		//
		$this->SetXY(120, 68);
		$this->SetFont(MINCHO,'B',8);
		$this->Cell(58,10,'東京都新宿区山吹町333',0,0,'L');
		
		//
		$this->SetXY(120, 72);
		$this->SetFont(MINCHO,'B',8);
		$this->Cell(58,10,'カーネワセダ1F',0,0,'L');
		
		//
		//
		$this->SetXY(120, 76);
		$this->SetFont(MINCHO,'B',8);
		$this->Cell(58,10,'電話 0120-998-854',0,0,'L');
		
		
		$this->SetXY(120, 80);
		$this->SetFont(MINCHO,'B',8);
		$this->Cell(58,10,'ファックス 03-3267-8440',0,0,'L');
		
		//add image here
		
		$this->Image('image/logo.png',155,63,0,0); 
	}
	
	
	function itemTable($index=0)
	{
	      
		
		$this->SetLineWidth(0.2);
	
		$x = 18;
		$sy = 95;
		$step = 6;
	
		// one page have 4 index
		$start = $index * 4;
	
		$y = $sy;
		$this->SetFont(PMINCHO,'B',10);
		// title
		$this->SetXY($x, $y);
		
		$this->Cell(70,7,'税込合計金額付',1,0,'L');
		
		
		$this->Cell(20,7,'税率',1,0,'C');
		$this->Cell(20,7,'',1,0,'C');
		$this->Cell(25,7,'     ',1,0,'C');
		$this->Cell(25,7,'     ',1,0,'C');
		$this->ln();
	
		$this->SetFont(MINCHO,'',10);
		
		$y = $sy + 7;
		
		
		
	
	        $this->SetXY($x, $y);
		$this->SetFont(PMINCHO,'B',10);
		$this->Cell(70,6,'\1,119', 1, 0, 'L');
		$this->Cell(20,6,'8%',1,0,'c');
		$this->Cell(20,6,'',1,0,'R');
		$this->Cell(25,6,'',1,0,'R');
		$this->Cell(25,6,'',1,0,'R');
		$y = $y + $step;
		
		
		 $this->SetXY($x, $y);
		$this->Cell(70,6,'', 1, 0, 'L');
			
		$this->Cell(20,6,'',1,0,'c');
		$this->Cell(20,6,'',1,0,'R');
		$this->Cell(25,6,'',1,0,'R');
		$this->Cell(25,6,'',1,0,'R');
		$y = $y + $step;
		
		
		
		$this->SetXY($x, $y);
		
		$this->SetFont(PMINCHO,'B',10);
		$this->Cell(70,7,'摘　　要',1,0,'L');
		$this->Cell(20,7,'数 量',1,0,'C');
		$this->Cell(20,7,'単価',1,0,'C');
		$this->Cell(25,7,'   金額(税込)  ',1,0,'C');
		$this->Cell(25,7,'    備考 ',1,0,'C');
		$this->ln();
		
		
		$this->SetXY($x, $y);
		
		$y = $y + 7;
		
	        $this->Cell(70,50,'   ',1,0,'L');
		$this->Cell(20,50,'',1,0,'C');
		$this->Cell(20,50,'',1,0,'C');
		$this->Cell(25,50,'     ',1,0,'C');
		$this->Cell(25,50,'     ',1,0,'C');
		$this->ln();
		
		
		
		$y =$y+43;
		$this->SetXY($x, $y);
		
		$this->Cell(70,7,'  送料 ',1,0,'L');
		$this->Cell(20,7,'2',1,0,'C');
		$this->Cell(20,7,'1000',1,0,'C');
		$this->Cell(25,7,'  2000   ',1,0,'C');
		$this->Cell(25,7,'     ',1,0,'C');
		$this->ln();
		
		
		
		$y =$y+7;
		$this->SetXY($x, $y);
		
		$this->Cell(70,7,'  消費税 ',1,0,'L');
		$this->Cell(20,7,'',1,0,'C');
		$this->Cell(20,7,'',1,0,'C');
		$this->Cell(25,7,'  640   ',1,0,'C');
		$this->Cell(25,7,'     ',1,0,'C');
		$this->ln();
		
	        $y =$y+7;
		$this->SetXY($x, $y);
		
		$this->Cell(70,7,'  合　　計 ',1,0,'L');
		$this->Cell(20,7,'',1,0,'C');
		$this->Cell(20,7,'',1,0,'C');
		$this->Cell(25,7,'    '.$this->tempdata->mTotal,1,0,'C');
		$this->Cell(25,7,'     ',1,0,'C');
		$this->ln();
		
		
		
		
		$this->SetLineWidth(0.7);
		$this->Rect(18,95,160,90);
		
	}
	
	
	
	function bottomTable()
	{
		
//		$this->SetXY(25, 130);
//		
//		$this->SetLineWidth(0.1);
//		$this->Rect(18,95,160,60);
//		$this->SetFont(PMINCHO,'B',9);
//		
//		$this->SetXY(20, 95);
//                $this->SetFont(PMINCHO,'B',9);
//		$this->Cell(75,6,'試樣',0,0,'L');
		
		$this->SetXY(20, 190);
		$this->SetLineWidth(0.1);
		$this->Rect(18,190,160,30);
		$this->SetFont(PMINCHO,'B',9);
		$this->Cell(75,6,'備考',0,0,'L');
		
		
		$this->SetXY(20, 200);
		$this->SetFont(PMINCHO,'',9);
		$this->Cell(75,6,$this->tempdata->mRemark,0,0,'L');
	}



        //output pdf file
	function innerOutputPDF()
	{
		$fName = $this->tempdata->mSerialNo. ".pdf";
		$this->Open();
		
	
		//$pageCount = 0;
		//while ($recordCount > 0) {
		//	
		//	$pageCount++;
		//	$recordCount = $recordCount - $pageSize;
		//}
		//
		
		$this->AddPage();
		$this->titleTable();
		$this->headTable();
		$this->itemTable();
		$this->bottomTable();

	
		//$filePath = '/generatefile/estimateBook_pdf/'.date("Ymdhisa");
		//if (!file_exists($filePath )) {
		//	mkdir('.'.$filePath, 0777);
		//}
		//$fName = $filePath.'/'.$fName;
		//
		//$this->Output('.'.$fName ,'F');
		$this->Output();
		return $fName;
	}
		
	
	
	
}

?>
