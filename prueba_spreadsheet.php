<?php

// Incluye el autoloader de Composer para cargar la biblioteca
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// 1. Crea un nuevo objeto de hoja de cálculo
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// 2. Establece un título para la hoja
$sheet->setCellValue('A1', 'Prueba de PhpSpreadsheet');

// 3. Define los encabezados de las columnas
$sheet->setCellValue('A3', 'ID');
$sheet->setCellValue('B3', 'Nombre');
$sheet->setCellValue('C3', 'Calificación');

// 4. Llena la hoja con datos de ejemplo
$data = [
    [1, 'Juan Pérez', 95],
    [2, 'María López', 88],
    [3, 'Carlos Rivera', 76],
];

$row = 4;
foreach ($data as $rowData) {
    $sheet->setCellValue('A' . $row, $rowData[0]);
    $sheet->setCellValue('B' . $row, $rowData[1]);
    $sheet->setCellValue('C' . $row, $rowData[2]);
    $row++;
}

// 5. Crea el objeto para escribir el archivo y lo guarda
$writer = new Xlsx($spreadsheet);
$writer->save('prueba_creada.xlsx');

echo '¡Archivo "prueba_creada.xlsx" creado con éxito!';
?>