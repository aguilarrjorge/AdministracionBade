<?php

header("Access-Control-Allow-Origin: *"); // Permite solicitudes de cualquier origen
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Métodos permitidos
header("Access-Control-Allow-Headers: Content-Type"); // Encabezados permitidos

include("php/codigosPostales.php");

$contratante = strtoupper($_GET['contratante']);
$aseguradora = $_GET['cia'];
$pdf = $_GET['pdf'];
$sexo = $_GET['sexo'];

$cp_aleatorio = rand(0, count($cp) - 1);

$dia = rand(10,30);
$fechaActual = date('d-m-Y');
$mes_aleatorio = rand(date('m') + 1 ,11);
$rand_sus = "- $mes_aleatorio month";
$fechaCalculada = strtotime($rand_sus, strtotime($fechaActual));   
$fechaActual = date('Y');


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

   // SEXO
   $pdf->SetFont('Courier', '', 11);
   $pdf->SetTextColor(0,0,0);
   $pdf->SetXY(158, 104.3);
   $pdf->Cell(5, 2, $sexo, 0, 0, 'L', false);

   // numero de poliza
   $pdf->SetFont('Helvetica', '', 10);
   $pdf->SetTextColor(0,0,0);
   $pdf->SetXY(131, 36.2);
   $pdf->Cell(5, 2, rand(100000, 1000000), 0, 0, 'L', false);

   // vigencia
   
   $pdf->SetFont('Helvetica', '', 10);
   $pdf->SetTextColor(0,0,0);
   $pdf->SetXY(125, 72);
   $pdf->Cell(5, 2, $dia, 0, 0, 'L', false);

   // mes
  
   $pdf->SetFont('Helvetica', '', 10);
   $pdf->SetTextColor(0,0,0);
   $pdf->SetXY(136, 72);
   $pdf->Cell(5, 2, date('m', $fechaCalculada), 0, 0, 'L', false);

   // anio
   $fechaActual = date('d-m-Y');
   $fechaCalculada = strtotime('-1 year', strtotime($fechaActual));
   $pdf->SetFont('Helvetica', '', 10);
   $pdf->SetTextColor(0,0,0);
   $pdf->SetXY(148, 72);
   $pdf->Cell(5, 2, date('Y', $fechaCalculada), 0, 0, 'L', false);

   // hasta

    // vigencia    
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetXY(165, 72);
    $pdf->Cell(5, 2, $dia, 0, 0, 'L', false);

     // mes
   $fechaActual = date('d-m-Y');
   $fechaCalculada = strtotime($rand_sus, strtotime($fechaActual));
   $pdf->SetFont('Helvetica', '', 10);
   $pdf->SetTextColor(0,0,0);
   $pdf->SetXY(177, 72);
   $pdf->Cell(5, 2, date('m', $fechaCalculada), 0, 0, 'L', false);

    // anio    
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetXY(189, 72);
    $pdf->Cell(5, 2, $fechaActual, 0, 0, 'L', false);
 
    // CP
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetXY(49, 54.5);
    $pdf->Cell(5, 2, $cp[$cp_aleatorio], 0, 0, 'L', false);

    //colonia
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetXY(6, 50);
    $pdf->Cell(5, 2, utf8_decode(strtoupper($colonia[$cp_aleatorio])) , 0, 0, 'L', false);

    //Calle
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetXY(6, 45);
    $pdf->Cell(5, 2, utf8_decode(strtoupper("$calles[$cp_aleatorio] No $numerosExt[$cp_aleatorio]")) , 0, 0, 'L', false);
    
 
   

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

   //Calle
   $pdf->SetFont('times', '', 10);
   $pdf->SetTextColor(0,0,0);
   $pdf->SetXY(9, 45);
   $pdf->Cell(5, 2, utf8_decode(strtoupper("$calles[$cp_aleatorio] No $numerosExt[$cp_aleatorio] $colonia[$cp_aleatorio]")) , 0, 0, 'L', false);

   //municipio estado
   $pdf->SetFont('times', '', 10);
   $pdf->SetTextColor(0,0,0);
   $pdf->SetXY(9, 49);
   $pdf->Cell(5, 2,"MORELIA, MICHOACAN C.P $cp[$cp_aleatorio]" , 0, 0, 'L', false);

   // vigencia desde
   $pdf->SetFont('times', '', 10);
   $pdf->SetTextColor(0,0,0);
   $pdf->SetXY(181.5, 49);
   $pdf->Cell(5, 2, " $dia " . "  ". date('m', $fechaCalculada) . "  ".date('Y', $fechaCalculada), 0, 0, 'L', false);

    // vigencia desde
    $pdf->SetFont('times', '', 10);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetXY(181.5, 146);
    $pdf->Cell(5, 2, " $dia " . "  ". date('m', $fechaCalculada) . "  ".date('Y', $fechaCalculada), 0, 0, 'L', false);

   // vigencia hasta
   $pdf->SetFont('times', '', 10);
   $pdf->SetTextColor(0,0,0);
   $pdf->SetXY(181.5, 53);
   $pdf->Cell(5, 2, " $dia " . "  ". date('m', $fechaCalculada) . "  ".$fechaActual, 0, 0, 'L', false);

   $pdf->SetFont('times', '', 10);
   $pdf->SetTextColor(0,0,0);
   $pdf->SetXY(181.5, 150);
   $pdf->Cell(5, 2, " $dia " . "  ". date('m', $fechaCalculada) . "  ".$fechaActual, 0, 0, 'L', false);

  break;

  case 'vepormas':
   $pdf->SetFont('Helvetica', 'B', 10);
   $pdf->SetTextColor(0,0,0);
   $pdf->SetXY(6, 32);
   $pdf->Cell(5, 2, $contratante, 0, 0, 'L', false);

   //Calle
   $pdf->SetFont('Helvetica', 'B', 10);
   $pdf->SetTextColor(0,0,0);
   $pdf->SetXY(7, 50);
   $pdf->Cell(5, 2, utf8_decode(strtoupper("$calles[$cp_aleatorio] No $numerosExt[$cp_aleatorio]")) , 0, 0, 'L', false);

   // colonia
   $pdf->SetFont('Helvetica', 'B', 10);
   $pdf->SetTextColor(0,0,0);
   $pdf->SetXY(7, 56);
   $pdf->Cell(5, 2, utf8_decode(strtoupper("$colonia[$cp_aleatorio]")) , 0, 0, 'L', false);

   //CP
   $pdf->SetFont('Helvetica', 'B', 10);
   $pdf->SetTextColor(0,0,0);
   $pdf->SetXY(70, 65.5);
   $pdf->Cell(5, 2,$cp[$cp_aleatorio], 0, 0, 'L', false);

   // numero de poliza
   $num = rand(100000, 1000000);
   $pdf->SetFont('Helvetica', '', 10);
   $pdf->SetTextColor(0,0,0);
   $pdf->SetXY(164, 32.5);
   $pdf->Cell(5, 2, "0".$num - 1, 0, 0, 'L', false);

   // numero de poliza
   $pdf->SetFont('Helvetica', '', 10);
   $pdf->SetTextColor(0,0,0);
   $pdf->SetXY(191, 32.5);
   $pdf->Cell(5, 2, "0".$num, 0, 0, 'L', false);

   // vigencia desde
   $pdf->SetFont('Helvetica', 'B', 10);
   $pdf->SetTextColor(0,0,0);
   $pdf->SetXY(110, 60);
   $pdf->Cell(5, 2, " $dia " . "/". date('M', $fechaCalculada) . "/".date('Y', $fechaCalculada)." 12:00 HORAS", 0, 0, 'L', false);

    // vigencia HASTA
    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetXY(160, 60);
    $pdf->Cell(5, 2, " $dia " . "/". date('M', $fechaCalculada) . "/".$fechaActual." 12:00 HORAS", 0, 0, 'L', false);

    // contratante
    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetXY(15, 130);
    $pdf->Cell(5, 2, $contratante, 0, 0, 'L', false);

    //sexo
    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetXY(195, 130);
    $pdf->Cell(5, 2, $sexo, 0, 0, 'L', false);
  break;

  case 'mafre':   

    
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetXY(140, 18);
    $pdf->Cell(5, 2, rand(100000000, 1000000000), 0, 0, 'L', false);


    // vigencia desde
   $pdf->SetFont('Helvetica', '', 10);
   $pdf->SetTextColor(0,0,0);
   $pdf->SetXY(80, 64);
   $pdf->Cell(5, 2, " $dia " . "/". date('m', $fechaCalculada) . "/".date('Y', $fechaCalculada), 0, 0, 'L', false);

   
    // vigencia hasta
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetXY(80, 69);
    $pdf->Cell(5, 2, " $dia " . "/". date('m', $fechaCalculada) . "/".$fechaActual, 0, 0, 'L', false);

    //contratante

    $pdf->SetFont('Helvetica', '', 10);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetXY(40, 95.5);
    $pdf->Cell(5, 2, $contratante, 0, 0, 'L', false);


    //direccion
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetXY(40, 101);
    $pdf->Cell(5, 2, utf8_decode(strtoupper("$calles[$cp_aleatorio] # $numerosExt[$cp_aleatorio] $colonia[$cp_aleatorio] MORELIA MICHOACAN")) , 0, 0, 'L', false);

    //CP
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetXY(40, 110.5);
    $pdf->Cell(5, 2,$cp[$cp_aleatorio], 0, 0, 'L', false);



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
