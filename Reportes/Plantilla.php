<?php 
require '../MVC/Modelo/conexion.php';
require "../fpdf/fpdf.php";
require "../MVC/Controlador/fecha.php";



class PDF extends FPDF{
// Cabecera de página
function Header(){
    // Logo
    $this->Image("../Imagenes/logo_hotel.png",15,8,60,30,);
    // Arial bold 15
    $this->SetFont("Arial","B",18);
    // Movernos a la derecha
    $this->Cell(55);
    $this->Cell(140,8,"Talenti S.A.",0,0,"R");
    $this->SetFont("Arial","",14);
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