<?php
// Require composer autoload
require_once __DIR__ . '/vendor/autoload.php';
// Create an instance of the class:
$mpdf = new \Mpdf\Mpdf();
include "reportes/Reservas.php";
// Write some HTML code:
$mpdf->SetFooter('');
//$html .='Hola Como estan todos tods';
$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output();
