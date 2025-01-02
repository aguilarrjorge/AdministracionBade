<?php

$contratante = $_POST['contratante'];
$aseguradoras = $_POST['aseguradoras'];

$arrayCias = explode(";", $aseguradoras);
sort($arrayCias);
$long  = count($arrayCias) - 1;

/*provisional mientras se define las demas cias*/

  $prov_arrayCia = [];

   foreach ($arrayCias as $key => $value) { 
     if ($value == 'metlife' || $value == 'gnp' || $value == 'vepormas') {
         array_push($prov_arrayCia, $value);
     }
   }   
   $lonProv  = count($prov_arrayCia) - 1;
   $cia = rand(0, $lonProv);
/*fin provisional*/

//$cia = rand(1, $long); // descomentar cuando provisional se quite
$pdf = rand(1, 5);

//$response = array("contratante" => $contratante, "cia" => $arrayCias[$cia], "pdf" =>$pdf); // descomentar cuando se quite provisional
$response = array("contratante" => $contratante, "cia" => $prov_arrayCia[$cia], "pdf" =>$pdf);
echo json_encode($response);


?>

