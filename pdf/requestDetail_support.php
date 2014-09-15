<?php
require('mbfpdf.php');
require('utfConvert.php');

//$GLOBALS['EUC2SJIS'] = true;
$GLOBALS['EUC2SJIS'] = false;
$GLOBALS['UTF82SJIS'] = true;



//post data parser

//post data [{ "mProjectName":"株式会社ハナミ","mCoName":"御中","mRtime":"平成26年9月5日","mSerialNo":"555555","mAdress":"株式会社 ハナミ","mLeadman":"金子","mReqContent":"","mReqCharge":"","mAccount":"","mPayway":"お振込み" }]
class TempData
{
  	var $mProjectName;//project Name.
  	var $mCoName;	//co. Name
    	var $mRtime;	//request time
	var $mSerialNo	;  //request SerialNo
        var $mAdress	;  //adress
	var  $mLeadman;  //leader
	var  $mReqContent;  //Request content
        var  $mReqCharge;  //Request charge
	var  $mAccount ; //Request Account
        var  $mPayway;  //pay way

	

	//start parse post data
	function init($postArray)
	{
	   $de_json = json_decode($postArray,TRUE);
           $count_json = count($de_json);
	 
           for ($i = 0; $i < $count_json; $i++)
             {
		
		  $helper = new Utf2ShifJis();
		  $this->mProjectName = $helper->convert( $de_json[$i]['mProjectName']);
		  $this->mCoName = $helper->convert( $de_json[$i]['mCoName']);
                  $this->mRtime = $helper->convert( $de_json[$i]['mRtime']);
                  $this->mSerialNo = $helper->convert( $de_json[$i]['mSerialNo']);
		  $this->mAdress = $helper->convert( $de_json[$i]['mAdress']); 
		  $this->mLeadman = $helper->convert( $de_json[$i]['mLeadman']);
		  $this->mReqContent = $helper->convert( $de_json[$i]['mReqContent']);
		  $this->mReqCharge = $helper->convert( $de_json[$i]['mReqCharge']);
   		  $this->mAccount = $helper->convert( $de_json[$i]['mAccount']);
    		  $this->mPayway = $helper->convert( $de_json[$i]['mPayway']);
		}
		return true;
	}
	
	
}


//  請 求 書 

class MYPDF extends MBFPDF
{
        var $currentY;
         var $tempdata;

	function init($postdata)
	{
		$this->tempdata = $postdata;
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
		
		
		$this->SetXY(10, 25);
		$this->SetFont(MINCHO,'B',20);
		$this->Cell(18,10,$this->tempdata->mProjectName.'  '.$this->tempdata->mCoName,0,0,'L');
		
		
		$this->SetXY(90, 25);
		$this->SetFont(MINCHO,'B',25);
		$this->Cell(18,10,'請 求 書',0,0,'L');
		
	}
	
	
	
	function headTable()
	{
		
		$this->SetXY(110, 35);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(18,10,'請求日',0,0,'L');
		
		$this->SetXY(140, 35);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(18,10,$this->tempdata->mRtime,0,0,'L');
		
		
		$this->SetXY(110, 40);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(18,10,'請求書番号',0,0,'L');
		
		
		$this->SetXY(150, 40);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(18,10,$this->tempdata->mSerialNo,0,0,'L');
		
		$this->SetXY(110, 45);
		$this->SetFont(MINCHO,'B',11);
		$this->Cell(18,10,'株式会社 ハナミ',0,0,'L');
		
		$this->SetXY(125, 50);
		$this->SetFont(MINCHO,'B',11);
		$this->Cell(18,10,'〒162-0801',0,0,'L');
		
		
		$this->SetXY(125, 55);
		$this->SetFont(MINCHO,'B',11);
		$this->Cell(58,10,'東京都新宿区山吹町333',0,0,'L');
		
		
		$this->SetXY(125, 60);
		$this->SetFont(MINCHO,'B',11);
		$this->Cell(58,10,'カーネ早稲田１F',0,0,'L');
		
		
		$this->SetXY(125, 70);
		$this->SetFont(MINCHO,'B',11);
		$this->Cell(58,10,'担当:',0,0,'L');
		
		
		$this->SetXY(135, 70);
		$this->SetFont(MINCHO,'B',11);
		$this->Cell(58,10,$this->tempdata->mLeadman,0,0,'L');
		
		$this->SetXY(125, 75);
		$this->SetFont(MINCHO,'B',11);
		$this->Cell(58,10,'0120-998-854',0,0,'L');
		
		
		$this->SetXY(15, 75);
		$this->SetFont(MINCHO,'B',11);
		$this->Cell(58,10,'下記のとおりご請求申し上げます。',0,0,'L');
		
		
		
		//add image here
		
		$this->Image('image/logo.png',100,60,0,0); 
	}
	
	
	function itemTable($index=0)
	{
	        $this->SetLineWidth(0.8);
		$this->Rect(15,85,160,67);
		
		$this->SetLineWidth(0.2);
	
		$x = 15;
		$sy = 85;
		$step = 6;
	
		// one page have 4 index
		$start = $index * 4;
	
		$y = $sy;
		$this->SetFont(PMINCHO,'B',10);
		// title
		$this->SetXY($x, $y);
		
		$this->Cell(10,7,'日 付',1,0,'C');
		
		
		$this->Cell(75,7,'        商品名',1,0,'C');
		$this->Cell(20,7,'数量',1,0,'C');
		$this->Cell(25,7,'     単価',1,0,'C');
		$this->Cell(30,7,'     金額',1,0,'C');
		$this->ln();
	
		$this->SetFont(MINCHO,'',10);
		
		$y = $sy + 7;
		for ($i=0;$i<9;$i++) {
			$this->SetXY($x, $y);
			$this->Cell(10,6,'9/5', 1, 0, 'C');
			
			$this->Cell(75,6,'テスト代',1,0,'c');
			$this->Cell(20,6,'1',1,0,'R');
			$this->Cell(25,6,'111',1,0,'R');
		        $this->Cell(30,6,'1,000',1,0,'R');
			$y = $y + $step;
		}
		
		$this->SetXY($x, $y);
		
		$this->Cell(130,6,'金額(税込)', 1, 0, 'R');
		
		$this->SetXY($x+130, $y);
		$this->Cell(30,6,'1,111', 1, 0, 'R');
		$currentY= $y+30;
		
	}
	
	
	
	function bottomTable()
	{
		
		$this->SetXY(25, 160);
		$this->SetLineWidth(0.8);
		$this->Rect(25,160,150,35);
		$this->SetFont(PMINCHO,'B',9);
		$this->Cell(75,6,'お振込は下記口座へお願いたします。',0,0,'L');
		$this->SetXY(25, 168);
		$this->Cell(75,6,'・お振込み口座。',0,0,'L');
		$this->SetXY(25, 172);
		$this->Cell(75,6,'口座名義人 カ）ハナミ',0,0,'L');
		$this->SetXY(25, 176);
		$this->Cell(75,6,'三菱東京UFJ 0005',0,0,'L');
		$this->SetXY(25, 180);
		$this->Cell(75,6,'飯田橋支店 664',0,0,'L');
		$this->SetXY(25, 184);
		$this->Cell(75,6,'普通口座 0031539',0,0,'L');
		
		
		
		$this->SetXY(28, 200);
		$this->SetLineWidth(0.8);
		$this->Rect(25,200,150,30);
		$this->SetFont(PMINCHO,'B',9);
		$this->Cell(75,6,'<<お支払い方法>>',0,0,'L');
		$this->SetXY(25,204);
		$this->Cell(75,6,$this->tempdata->mPayway,0,0,'L');
		
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
			

	
		$filePath = '/generatefile/requestBook_pdf/'.date("Ymdhisa");
		if (!file_exists($filePath )) {
			mkdir('.'.$filePath, 0777);
		}
		$fName = $filePath.'/'.$fName;
		
		$this->Output('.'.$fName ,'F');
		
		//$this->Output();
		
		return $fName;
	}
	
	
	
	
}

?>
