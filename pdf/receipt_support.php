<?php
require('mbfpdf.php');
//require('gsupport.php');

//$GLOBALS['EUC2SJIS'] = true;
$GLOBALS['EUC2SJIS'] = false;
$GLOBALS['UTF82SJIS'] = true;


// 

class MYPDF extends MBFPDF
{
        var $currentY;



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

	}
	
	
	
	function titleTable()
	{
		// 10 18  190  7
		$this->SetXY(70, 25);
		$this->SetFont(MINCHO,'B',45);
		$this->Cell(18,10,' 領収書',0,0,'L');
		 // $this->SetFillColor(200,220,255);
	}
	
	
	
	function headTable()
	{
		
		$this->SetXY(160, 35);
		$this->SetFont(MINCHO,'',15);
	 	$this->Cell(18,10,'No.55555',0,0,'L');
		
		$this->Line(160, 43,  200, 43) ;
		
		$this->SetXY(160, 45);
		$this->SetFont(MINCHO,'',15);
	 	$this->Cell(18,10,'2014/09/05',0,0,'L');
		
		$this->Line(160, 53,  200, 53) ;
		
		
	}
	
	
        function body()
	{
		
		$this->SetXY(25, 80);
		$this->SetFont(MINCHO,'B',25);
	 	$this->Cell(18,10,'金子',0,0,'L');
		
		$this->SetLineWidth(0.3);
		$this->Line(25, 90,  190, 90) ;
		
		
		$this->SetXY(25, 115);
		$this->SetFont(MINCHO,'',20);
	 	$this->Cell(18,10,'領収金額',0,0,'L');
		
		$this->Line(25, 125,  190, 125) ;
		
		$this->SetFont(MINCHO,'B',25);
		$this->SetXY(100, 115);
		$this->SetFont(MINCHO,'',20);
	 	$this->Cell(18,10,'￥1,111-',0,0,'L');

		
	        $this->SetXY(100, 150);
		$this->SetFont(MINCHO,'B',20);
		$this->Cell(18,10,'テスト代',0,0,'L');
		
		
		$this->SetXY(45, 149);
		$this->SetFont(MINCHO,'B',20);
		$this->Cell(18,10,'但し、',0,0,'L');
		
		$this->SetXY(65, 165);
		$this->SetFont(MINCHO,'B',20);
		$this->Cell(18,10,'として上記金額正に受領いたしました。',0,0,'L');
		
		
		
		$this->SetXY(25, 190);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(18,10,'備考',0,0,'L');
		
		$this->SetLineWidth(0.2);
		$this->Line(25, 200,  190, 200) ;
		
		$this->SetXY(25, 200);
		$this->SetFont(MINCHO,'',12);
		$this->Cell(18,10,'クレジットによりお支払い。',0,0,'L');
		
		
		$this->SetLineWidth(0.2);
		$this->Line(25, 208,  190, 208) ;
		
		
		$this->SetLineWidth(0.2);
		$this->Line(25, 216,  190, 216) ;
		
		
		//add adress
		
		$this->SetXY(79, 250);
		$this->SetFont(PMINCHO,'B',11);
		$this->Cell(18,10,'〒160-0022　東京都新宿区新宿2-5-5　新宿土地建物第１１ビル',0,0,'L');
		
		$this->SetXY(80, 257);
		$this->SetFont(PMINCHO,'B',17);
		$this->Cell(18,10,'株式会社ハナミ「販促応援.COM」事業部',0,0,'L');
		
		$this->SetXY(81, 263);
		$this->SetFont(PMINCHO,'B',13);
		$this->Cell(18,10,'TEL(03)5363-1873 FAX(03)5363-1887',0,0,'L');
		
		//add image
		$this->Image('logo_large.png',150,239,45,45,0,0); 
		
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
	
	
	
	
}

?>
