<?php 
require '../MVC/Modelo/conexion.php';
require "../fpdf/fpdf.php";
require "../MVC/Controlador/fecha.php";



class PDF extends FPDF{
// Cabecera de página
function Header(){
    // Logo
    $this->Image("../Imagenes/logo_hotel.jpg",15,8,40,40,);
    // Arial bold 15
    $this->SetFont("Arial","B",18);
    // Movernos a la derecha
    $this->Cell(25);
    $this->Cell(140,8,"ReporteTuTrabajo",0,0,"C");
    $this->SetFont("Arial","",12);
    // Salto de línea
}

// Pie de página
function Footer(){
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Pagina'.$this->PageNo().'/{nb}',0,0,'C');
}
}

?>