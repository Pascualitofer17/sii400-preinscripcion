<?php

// 1. Incluir el autoload de Composer
require 'vendor/autoload.php';

// 2. Crear una nueva instancia de mPDF
$mpdf = new \Mpdf\Mpdf();

// 3. Escribir contenido HTML en el PDF
$html = '
<h1>¡Hola Mundo en PASCUAL!</h1>
<p>Este es mi primer documento PDF generado con PHP y la librería mPDF.</p>
<p>Puedes usar casi cualquier etiqueta HTML y estilo CSS que quieras.</p>
';
$mpdf->WriteHTML($html);

// 4. Guardar el PDF en un archivo en el servidor
$fileName = 'mi-primer-pdf.pdf';
$mpdf->Output($fileName, 'F'); // 'F' significa que lo guarda en un archivo

echo "✅ ¡El archivo '$fileName' ha sido creado exitosamente! 🚀";

?>
