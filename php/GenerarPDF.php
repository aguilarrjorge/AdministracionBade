<?php

header("Access-Control-Allow-Origin: *"); // Permite solicitudes de cualquier origen
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Métodos permitidos
header("Access-Control-Allow-Headers: Content-Type"); // Encabezados permitidos

echo "string";


require 'vendor/autoload.php'; // Cargar Composer autoload

use setasign\Fpdi\Fpdi;

// Crear instancia de FPDI
$pdf = new FPDI();

// Cargar un archivo PDF existente
$pdfPath = 'pdf/met_1.pdf'; // Ruta del PDF que quieres modificar
$pageCount = $pdf->setSourceFile($pdfPath); // Número total de páginas

for ($i = 1; $i <= $pageCount; $i++) {
    // Importar página actual
    $templateId = $pdf->importPage($i);
    $size = $pdf->getTemplateSize($templateId);

    // Agregar nueva página con las dimensiones del PDF original
    $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);

    // Usar la página importada como plantilla
    $pdf->useTemplate($templateId);

    // Agregar texto o contenido
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(255, 0, 0); // Rojo
    $pdf->SetXY(10, 10); // Coordenadas (x, y)
    $pdf->Write(10, "Este es un texto añadido en la página $i");
}

// Guardar el PDF modificado
$pdf->Output('I', 'nuevo_archivo.pdf'); // 'I' para enviar al navegador, 'F' para guardar
?>
?>