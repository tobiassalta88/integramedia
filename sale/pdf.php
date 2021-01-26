<?php
require('../fpdf17/fpdf.php');
class PDF extends FPDF {
//Load data
function LoadData() {
	$id =  $_GET['i'];
	include '../conn.php';
	// Create connection
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	// Check connection
	if (!$conn) {
		  die("Connection failed: " . mysqli_connect_error());
	}
  $querySale = "SELECT s.*, c.name AS 'name_client', c.last_name AS 'last_name_client', c.dni, e.name as 'name_employee', e.last_name as 'last_name_employee' FROM sales AS s INNER JOIN clients AS c ON s.id_client = c.id INNER JOIN employees AS e ON s.id_employee = e.id WHERE s.id = '".$id."'";
  $resultQuerySale = $conn-> query($querySale);
  $dataSale = mysqli_fetch_assoc($resultQuerySale);
  $resultDetail = array();
  $queryDetailSale = "SELECT d.*, p.name AS 'name_product' FROM sales_detail AS d INNER JOIN products AS p ON d.id_product = p.id WHERE d.id_sale = '".$id."'";
  $resultQueryDetailSale = mysqli_query($conn, $queryDetailSale);
  while ($row = mysqli_fetch_assoc($resultQueryDetailSale)) {
      $resultDetail[] = $row;
  }
  $data = array(
    'Sale' => $dataSale,
    'Detail' => $resultDetail
  );
	return $data;
}

function Ticket($data) {
$this->Image('../dist/img/header.jpg',0,0);
$this->SetFont('Arial','',8);
$this->Cell(190,45,'','',1);
$this->Cell(190,15,$data['Sale']['datetime'],'',1,'R');
$this->Cell(105,7,'','',0);
$this->SetFont('Arial','B',18);
$this->Cell(75,7,'INTEGRA MEDIA S.R.L.','',1,'L');
$this->SetFont('Arial','',12);
$this->Cell(105,7,'','',0);
$this->Cell(75,5,'EMPLOYEE: ' . $data['Sale']['name_employee'] . ' ' . $data['Sale']['last_name_employee'],'',1,'L');
$this->Cell(105,5,'','',0);
$this->Cell(75,5,utf8_decode('N° 001-') . str_pad($data['Sale']['id'], 8, "0", STR_PAD_LEFT),'',1,'L');
$this->Cell(190,5,'','',1);
$this->SetFont('Arial','B',18);
$this->Cell(75,7,'CLIENT DATA:','LRT',1,'L');
$this->SetFont('Arial','B',12);
$this->Cell(75,7,$data['Sale']['name_client'] . ' ' . $data['Sale']['last_name_client'],'RL',1,'L');
$this->Cell(75,7,'DNI ' . $data['Sale']['dni'],'RBL',1,'L');

$this->SetFillColor(200,200,200);

$this->Cell(190,5,'',0,1);

$this->SetFont('Arial','B',9);

$this->Cell(15,4,'','',0);
$this->Cell(5,4,'','BTL',0,'',1);
$this->Cell(70,4,'PRODUCT','BT',0,'L',1);
$this->Cell(20,4,'QUANTITY','BT',0,'C',1);
$this->Cell(30,4,'UNIT PRICE','BT',0,'C',1);
$this->Cell(30,4,'SUBTOTAL','BT',0,'C',1);
$this->Cell(5,4,'','BTR',0,'',1);
$this->Cell(15,4,'','',1);

$this->Cell(190,1,'',0,1);

$i = 0;

while ($i < count($data['Detail'])) {
  $d = $data['Detail'][$i];
  $this->Cell(20,4,'','',0);
  $this->Cell(70,4,$d['name_product'],'B',0,'L');
  $this->Cell(20,4,$d['quantity'],'B',0,'C');
  $this->Cell(30,4,'$ ' . number_format($d['price'],2),'B',0,'C');
  $this->Cell(30,4,'$ ' . number_format($d['amount'],2),'B',0,'C');
  $this->Cell(20,4,'','',1);
  $i++;
}

$this->Cell(190,15,'',0,1);

$this->SetFont('Arial','B',16);
$this->Cell(140,4,'TOTAL = $','',0,'R');
$this->Cell(50,4,number_format($data['Sale']['total'],2),'',0,'L');
}
}
$pdf=new PDF();
$pdf->SetAutoPageBreak(false);
$pdf->AliasNbPages();
$data=$pdf->LoadData();
$pdf->AddPage();
$pdf->Ticket($data);
$pdf->Output();
?>
