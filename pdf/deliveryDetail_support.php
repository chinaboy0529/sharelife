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
		$this->SetXY(90, 25);
		$this->SetFont(MINCHO,'B',25);
		$this->Cell(18,10,'�[ �i ��',0,0,'L');
	}
	
	
	
	function headTable()
	{
		
		$this->SetXY(15, 35);
		$this->SetFont(MINCHO,'B',15);
		$this->Cell(18,10,'������Ѓn�i�~�@�䒆',0,0,'L');
		
		
		$this->SetXY(110, 35);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(18,10,'�[�i��',0,0,'L');
		
		$this->SetXY(140, 35);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(18,10,'����26�N9��5��',0,0,'L');
		
		
		$this->SetXY(110, 40);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(18,10,'�����ԍ�',0,0,'L');
		
		
		$this->SetXY(150, 40);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(18,10,'555555',0,0,'L');
		
		$this->SetXY(110, 50);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(18,10,'������� �n�i�~',0,0,'L');
		
		$this->SetXY(120, 55);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(18,10,'��162-0801',0,0,'L');
		
		
		$this->SetXY(120, 60);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(58,10,'�����s�V�h��R����333',0,0,'L');
		
		
		$this->SetXY(120, 65);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(58,10,'�J�[�l����c�PF',0,0,'L');
		
		
		
		$this->SetXY(15, 75);
		$this->SetFont(MINCHO,'B',12);
		$this->Cell(58,10,'���L�̒ʂ�[�i���������܂��B',0,0,'L');
		
		
		
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
		
		$this->Cell(10,7,'�� �t',1,0,'C');
		
		
		$this->Cell(75,7,'        ���i��',1,0,'C');
		$this->Cell(20,7,'����',1,0,'C');
		$this->Cell(25,7,'     �P��',1,0,'C');
		$this->Cell(30,7,'     ���z',1,0,'C');
		$this->ln();
	
		$this->SetFont(MINCHO,'',10);
		
		$y = $sy + 7;
		for ($i=0;$i<9;$i++) {
			$this->SetXY($x, $y);
			$this->Cell(10,6,'9/5', 1, 0, 'C');
			
			$this->Cell(75,6,'�e�X�g��',1,0,'c');
			$this->Cell(20,6,'1',1,0,'R');
			$this->Cell(25,6,'111',1,0,'R');
		        $this->Cell(30,6,'1,000',1,0,'R');
			$y = $y + $step;
		}
		
		$this->SetXY($x, $y);
		
		$this->Cell(130,6,'���z(�ō�)', 1, 0, 'R');
		
		$this->SetXY($x+130, $y);
		$this->Cell(30,6,'1,111', 1, 0, 'R');
		$currentY= $y+30;
		
	}
	
	
	
	function bottomTable()
	{
		
		$this->SetXY(20, 230);
		$this->SetLineWidth(0.8);
		$this->Rect(25,160,150,35);
		
		$this->SetXY(20, 230);
		$this->SetLineWidth(0.8);
		$this->Rect(25,200,150,30);
		
	}
	
	
	
	
}

?>
