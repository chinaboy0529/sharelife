<?php
require('mbfpdf.php');
require('utfConvert.php');
//require('gsupport.php');

//$GLOBALS['EUC2SJIS'] = true;
$GLOBALS['EUC2SJIS'] = false;
$GLOBALS['UTF82SJIS'] = true;



//post data parser
class TempData
{
  	var $mSerialNo;//No.
  	var $mTime;	//—ÌŽû“ú•t
    	var $mCustomName;	//‚¨‹q—l–¼
	var $mPrice	;  //—ÌŽû‹àŠz
        var $mClause	;  //’A‚µ‘
	var  $mRemark;//”õ
	
	
	//start parse post data
	function init($postArray)
	{
	   $de_json = json_decode($postArray,TRUE);
           $count_json = count($de_json);
	 
           for ($i = 0; $i < $count_json; $i++)
             {
		
		  $helper =new Utf2ShifJis();
		  $this->mTime = $de_json[$i]['mTime'];
                  $this->mSerialNo = $de_json[$i]['mSerialNo'];
		  $this->mCustomName = $helper->convert( $de_json[$i]['mCustomName']); 
		  $this->mPrice = $de_json[$i]['mPrice'];
		  $this->mRemark = $helper->convert( $de_json[$i]['mRemark']);;
		  $this->mClause = $helper->convert( $de_json[$i]['mClause']);
                }
		return true;
		
	}
	
	
}




class MYPDF extends MBFPDF
{
        var $currentY;
        // [{"mTime":"2014/09/13","mSerialNo":"5555556","mCustomName":"‹àŽq","mPrice":"2,111","mClause":"ƒeƒXƒg‘ã","mRemark":"ƒNƒŒƒWƒbƒg‚É‚æ‚è‚¨Žx•¥‚¢B"}]
   
	function init($post_data)
	{
		$this->tempdata = $post_data;
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
		$this->Cell(0,10,'Page '.$this->PageNo().'',0,0,'C');

	}
	
	
	
	function titleTable()
	{
		// 10 18  190  7
		$this->SetXY(70, 25);
		$this->SetFont(MINCHO,'B',45);
		$this->Cell(18,10,' —ÌŽû‘',0,0,'L');
		 // $this->SetFillColor(200,220,255);
	}
	
	
	
	function headTable()
	{
		
		$this->SetXY(160, 35);
		$this->SetFont(MINCHO,'',15);
	 	$this->Cell(18,10,'No.'.$this->tempdata->mSerialNo,0,0,'L');
		
		$this->Line(160, 43,  200, 43) ;
		
		$this->SetXY(160, 45);
		$this->SetFont(MINCHO,'',15);
	 	$this->Cell(18,10,$this->tempdata->mTime,0,0,'L');
		
		$this->Line(160, 53,  200, 53) ;
		
		
	}
	
	
        function body()
	{
		
		$this->SetXY(25, 80);
		$this->SetFont(MINCHO,'B',25);
	 	$this->Cell(18,10,$this->tempdata->mCustomName,0,0,'L');
		
		$this->SetLineWidth(0.3);
		$this->Line(25, 90,  190, 90) ;
		
		
		$this->SetXY(25, 115);
		$this->SetFont(MINCHO,'',20);
	 	$this->Cell(18,10,'—ÌŽû‹àŠz',0,0,'L');
		
		$this->Line(25, 125,  190, 125) ;
		
		$this->SetFont(MINCHO,'B',25);
		$this->SetXY(100, 115);
		$this->SetFont(MINCHO,'',20);
	 	$this->Cell(18,10,''.$this->tempdata->mPrice,0,0,'L');

		
	        $this->SetXY(100, 150);
		$this->SetFont(MINCHO,'B',20);
		$this->Cell(18,10,$this->tempdata->mClause,0,0,'L');
		
		
		$this->SetXY(45, 149);
		$this->SetFont(MINCHO,'B',20);
		$this->Cell(18,10,'’A‚µA',0,0,'L');
		
		$this->SetXY(65, 165);
		$this->SetFont(MINCHO,'B',20);
		$this->Cell(18,10,'‚Æ‚µ‚Äã‹L‹àŠz³‚ÉŽó—Ì‚¢‚½‚µ‚Ü‚µ‚½B',0,0,'L');
		
		
		
		$this->SetXY(25, 190);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(18,10,'”õl',0,0,'L');
		
		$this->SetLineWidth(0.2);
		$this->Line(25, 200,  190, 200) ;
		
		$this->SetXY(25, 200);
		$this->SetFont(MINCHO,'',12);
		$this->Cell(18,10,$this->tempdata->mRemark,0,0,'L');
		
		
		$this->SetLineWidth(0.2);
		$this->Line(25, 208,  190, 208) ;
		
		
		$this->SetLineWidth(0.2);
		$this->Line(25, 216,  190, 216) ;
		
		
		//add adress
		
		$this->SetXY(79, 250);
		$this->SetFont(PMINCHO,'B',11);
		$this->Cell(18,10,'§160-0022@“Œ‹ž“sVh‹æVh2-5-5@Vh“y’nŒš•¨‘æ‚P‚Pƒrƒ‹',0,0,'L');
		
		$this->SetXY(80, 257);
		$this->SetFont(PMINCHO,'B',17);
		$this->Cell(18,10,'Š”Ž®‰ïŽÐƒnƒiƒ~u”Ì‘£‰ž‰‡.COMvŽ–‹Æ•”',0,0,'L');
		
		$this->SetXY(81, 263);
		$this->SetFont(PMINCHO,'B',13);
		$this->Cell(18,10,'TEL(03)5363-1873 FAX(03)5363-1887',0,0,'L');
		
		//add image
		$this->Image('image/logo_large.png',150,239,45,45,0,0); 
		
	}
	
	
	function bottomTable()
	{
		
		//$this->SetXY(20, 230);
		//$this->SetLineWidth(0.8);
		//$this->Rect(25,160,150,35);
		//
		//$this->SetXY(20, 230);
		//$this->SetLineWidth(0.8);
		//$this->Rect(25,200,150,30);
		
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
			$this->body();
			$this->bottomTable();
			

	
		$filePath = '/generatefile/receipt_pdf/'.date("Ymdhisa");
		if (!file_exists($filePath )) {
			mkdir('.'.$filePath, 0777);
		}
		$fName = $filePath.'/'.$fName;
	
		$this->Output('.'.$fName ,'F');
		
		echo $fName;
		return $fName;
	}
	
	
	
}

?>
