<?php

header("Access-Control-Allow-Origin: *"); // Permite solicitudes de cualquier origen
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Métodos permitidos
header("Access-Control-Allow-Headers: Content-Type"); // Encabezados permitidos

$contratante = strtoupper($_GET['contratante']);
$aseguradora = $_GET['cia'];
$pdf = $_GET['pdf'];

/*echo "ASeguradoras  ".$aseguradoras;

$arrayCias = explode(";", $aseguradoras);
echo "<br><br><br><br>";
var_dump($arrayCias);

return ;*/
$path = "pdf/". $aseguradora . "/".$pdf.".pdf";
//echo "PATH ".$path;
//return ;
require 'vendor/autoload.php';

use setasign\Fpdi\Fpdi; // Asegúrate de que esta línea esté presente


// initiate FPDI
$pdf = new Fpdi();
$pdf->setSourceFile($path);
$pdf->AddPage();
$pdf->useTemplate($pdf->importPage(1), null,null,null,null,true);

switch ($aseguradora) {
 case 'metlife':
   $pdf->SetFont('Helvetica', '', 10);
   $pdf->SetTextColor(0,0,0);
   $pdf->SetXY(6, 36);
   $pdf->Cell(5, 2, $contratante, 0, 0, 'L', false);

   $pdf->SetFont('Courier', '', 10);
   $pdf->SetTextColor(0,0,0);
   $pdf->SetXY(15, 104);
   $pdf->Cell(5, 2, $contratante, 0, 0, 'L', false);  
  break;
  case 'gnp':
   $pdf->SetFont('times', 'B', 10);
   $pdf->SetTextColor(0,0,0);
   $pdf->SetXY(9, 41);
   $pdf->Cell(5, 2, $contratante, 0, 0, 'L', false);
  break;

  case 'vepormas':
   $pdf->SetFont('Helvetica', 'B', 10);
   $pdf->SetTextColor(0,0,0);
   $pdf->SetXY(6, 32);
   $pdf->Cell(5, 2, $contratante, 0, 0, 'L', false);
  break;
 
 
 default:
  # code...
  break;
}




// set the source file
/*$pdf->AddPage();
$pdf->useTemplate($pdf->importPage(2), null,null,null,null,true);


$pdf->AddPage();
$pdf->useTemplate($pdf->importPage(3), null,null,null,null,true);*/





$pdf->Output();            

?>
