<?php
require('mbfpdf.php');
require('utfConvert.php');

//$GLOBALS['EUC2SJIS'] = true;
$GLOBALS['EUC2SJIS'] = false;
$GLOBALS['UTF82SJIS'] = true;





//post data parser

//post data [{ "mProjectName":"株式会社ハナミ","mSerialNo":"555555","mDtime":"平成26年9月5日","mCustomName":"御中","mAttachclause":"","mRemark":"お振込み" ,"mDeqCharge":"2132"}]
class TempData
{
  	var $mProjectName;//project Name.
	var $mSerialNo	;  //request SerialNo
  	var $mDtime;	//delivery time
	var $mCustomName;	//custom Name
    	var $mDeqCharge;  //delivery charge
        var $mAttachclause;  //Attachclause
	var $mRemark;  //remark

	

	//start parse post data
	function init($postArray)
	{
	   $de_json = json_decode($postArray,TRUE);
           $count_json = count($de_json);
	// echo $count_json;
           for ($i = 0; $i < $count_json; $i++)
             {
		  $helper = new Utf2ShifJis();
		  $this->mProjectName = $helper->convert( $de_json[$i]['mProjectName']);
                  $this->mSerialNo = $helper->convert( $de_json[$i]['mSerialNo']);
		  $this->mDtime = $helper->convert( $de_json[$i]['mDtime']); 
		  $this->mCustomName = $helper->convert( $de_json[$i]['mCustomName']);
		  $this->mDeqCharge = $helper->convert( $de_json[$i]['mDeqCharge']);
		  $this->mAttachclause = $helper->convert( $de_json[$i]['mAttachclause']);
   		  $this->mRemark = $helper->convert( $de_json[$i]['mRemark']);
		  	
		}
		
	
		return true;
	}
	
}

//  

class MYPDF extends MBFPDF
{
        var $currentY;
        var  $tempdata;
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
		$this->SetXY(90, 25);
		$this->SetFont(MINCHO,'B',25);
		$this->Cell(18,10,'納 品 書',0,0,'L');
	}
	
	
	
	function headTable()
	{
		
		$this->SetXY(15, 35);
		$this->SetFont(MINCHO,'B',15);
		$this->Cell(18,10,$this->tempdata->mProjectName.''.$this->tempdata->mCustomName,0,0,'L');
		
		
		$this->SetXY(110, 35);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(18,10,'納品日',0,0,'L');
		
		$this->SetXY(140, 35);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(18,10,$this->tempdata->mDtime,0,0,'L');
		
		
		$this->SetXY(110, 40);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(18,10,'注文番号',0,0,'L');
		
		
		$this->SetXY(150, 40);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(18,10,$this->tempdata->mSerialNo,0,0,'L');
		
		$this->SetXY(110, 50);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(18,10,'株式会社 ハナミ',0,0,'L');
		
		$this->SetXY(120, 55);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(18,10,'〒162-0801',0,0,'L');
		
		
		$this->SetXY(120, 60);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(58,10,'東京都新宿区山吹町333',0,0,'L');
		
		
		$this->SetXY(120, 65);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(58,10,'カーネ早稲田１F',0,0,'L');
		
		
		
		$this->SetXY(15, 75);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(58,10,'下記の通り納品をいたします。',0,0,'L');
		
		
		
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
		$this->Cell(30,6,$this->tempdata->mDeqCharge, 1, 0, 'R');
		$currentY= $y+30;
		
	}
	
	
	
	function bottomTable()
	{

		$this->SetXY(20, 230);
		$this->SetLineWidth(0.8);
		$this->Rect(25,160,150,35);
		
		
		$this->SetXY(30,160);
		$this->SetFont(PMINCHO,'',10);
		$this->Cell(58,10,$this->tempdata->mAttachclause,0,0,'L');
		
		
		//echo $this->tempdata->mAttachclause;
		$this->SetXY(20, 230);
		$this->SetLineWidth(0.8);
		$this->Rect(25,200,150,30);
		
		$this->SetXY(30,200);
		$this->SetFont(PMINCHO,'',10);
		//echo $this->tempdata->mRemark;
		 $this->Cell(58,10,$this->tempdata->mRemark,0,0,'L');
		//$this->Cell(58,10,'金額(税込',0,0,'L');
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
			

	
		$filePath = '/generatefile/deliveryDetail_pdf/'.date("Ymdhisa");
		if (!file_exists($filePath )) {
			mkdir('.'.$filePath, 0777);
		}
		$fName = $filePath.'/'.$fName;
	       //  $this->Output();
		$this->Output('.'.$fName ,'F');
		return $fName;
	}
	
	
}

?>
