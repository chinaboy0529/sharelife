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
		
		
		$this->SetXY(10, 25);
		$this->SetFont(MINCHO,'B',20);
		$this->Cell(18,10,'株式会社ハナミ　御中',0,0,'L');
		
		
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
		$this->Cell(18,10,'平成26年9月5日',0,0,'L');
		
		
		$this->SetXY(110, 40);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(18,10,'請求書番号',0,0,'L');
		
		
		$this->SetXY(150, 40);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(18,10,'555555',0,0,'L');
		
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
		$this->Cell(58,10,'下記のとおりご請求申し上げます。',0,0,'L');
		
		
		
		//add image here
		
		$this->Image('logo.png',100,60,0,0); 
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
		$this->Cell(75,6,'お振込み',0,0,'L');
		
	}
	
	
	
	
}

?>
