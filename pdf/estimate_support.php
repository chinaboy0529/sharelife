<?php
require('mbfpdf.php');
//require('gsupport.php');

//$GLOBALS['EUC2SJIS'] = true;
$GLOBALS['EUC2SJIS'] = false;
$GLOBALS['UTF82SJIS'] = true;


//  御見積書 

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
		$this->Cell(18,10,'平成26年9月5日',0,0,'L');
		
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
		$this->Cell(18,47,'株式会社　ハナミ',0,0,'L');
		
		
		$this->SetXY(110, 27);
		$this->SetFont(MINCHO,'B',10);
		$this->Cell(18,47,'宛',0,0,'L');
		
		
		$this->SetXY(18, 32);
		$this->SetFont(MINCHO,'B',10);
		$this->Cell(18,47,'件名',0,0,'L');
		
		$this->SetXY(38, 32);
		$this->SetFont(MINCHO,'B',10);
		$this->Cell(18,47,'テスト代',0,0,'L');
		
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
		$this->Cell(18,45,'・営業日(土日祝含まず)18時までのご注文ご入稿で、',0,0,'L');
		
		
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
		
		$this->Image('logo.png',155,63,0,0); 
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
		
		$this->SetXY(25, 130);
		
		$this->SetLineWidth(0.1);
		$this->Rect(18,95,160,60);
		$this->SetFont(PMINCHO,'B',9);
		
		$this->SetXY(20, 95);
                $this->SetFont(PMINCHO,'B',9);
		$this->Cell(75,6,'試樣',0,0,'L');
		
		$this->SetXY(20, 160);
		$this->SetLineWidth(0.1);
		$this->Rect(18,160,160,30);
		$this->SetFont(PMINCHO,'B',9);
		$this->Cell(75,6,'備考',0,0,'L');
		
		
	}
	
	
	
	
}

?>
