<?php
require "Plantilla.php";

if (empty($_REQUEST['idUser'])) {
    header('location: ../MVC/Vista/Gestion_Reservas.php');
    mysqli_close($conection);
} else {
    session_start();
    date_default_timezone_set('America/Lima');
    $fecha = fechaC();
    $fecha_cab = date("Y-m-d  /  " . "H:m:s");
    $nombre            = $_SESSION['nombre'];
    $domicilio            = $_SESSION['domicilio'];

    /*Query Datos Empresa*/
    $query_empresa = mysqli_query($conection, "SELECT * FROM empresa");
    while ($dataEmp = mysqli_fetch_array($query_empresa)) {
        $ruc            = $dataEmp['ruc'];
        $razon_social   = $dataEmp['razon_social'];
        $telefono            = $dataEmp['telefono'];
        $direccion            = $dataEmp['direccion'];
        $pagina_web            = $dataEmp['web'];
        $gerente= $dataEmp['gerente'];
        $dni_gerente= $dataEmp['dni_gerente'];
    }
    /*Query*/
    $cod_personal = $_REQUEST['idUser'];
    $query_datos_empleado = mysqli_query($conection, "SELECT p.*, tp.descripcion FROM personal p JOIN tipo_puesto tp ON p.cod_puesto = tp.cod_puesto WHERE cod_personal = $cod_personal");

    $dataEmpleado = mysqli_fetch_assoc($query_datos_empleado);

    $pdf = new PDF("P", "mm", "A4");
    $pdf->AliasNbPages();
    $pdf->SetMargins(10, 10, 10);
    $pdf->AddPage("PORTRAIT", "letter");

    $pdf->Ln(10);

    $pdf->SetFont("Arial", "", 9.5);
    $pdf->Cell(195, 5, utf8_decode("N° RUC: " . $ruc), 0, 1, "R");
    $pdf->Cell(195, 5, "Telefono: " . $telefono, 0, 1, "R");
    $pdf->Cell(195, 5, "Direccion: " . $direccion, 0, 1, "R");

    $pdf->Ln(15);
    $pdf->SetFont("Arial", "", 15);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetDrawColor(255, 255, 255);
    $pdf->Cell(195, 12, "Lima, $fecha", 1, 1, "R", 2);
 

    $pdf->Ln(10);
    $pdf->SetFont("Arial", "B", 20);
    $pdf->SetFillColor(255, 255 ,255);
    $pdf->SetTextColor(1, 1, 1);
    $pdf->SetDrawColor(255, 255, 255);
    $pdf->Cell(195, 7, "", 1, 1, "C", 2);
    $pdf->Cell(195, 4, "CARTA DE RECOMENDACIÓN", 1, 1, "C", 2);
 
    $pdf->Ln(15);
    $pdf->SetFont("Arial", "", 15);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetDrawColor(255, 255, 255);



    $pdf->MultiCell(0, 7, utf8_decode("A quien corresponda:"), 0, "L");
    $pdf->Cell(195, 4, "", 1, 1, "C", 2);
    $pdf->MultiCell(0, 7, utf8_decode("Me permito informarle que conozco amplia y detalladamente al Sr. " . $dataEmpleado['nombres'] . " " . $dataEmpleado['apellidos'] . "  quien laboró conmigo desde el " . $dataEmpleado['fecha_ingreso'] . " hasta el " . $dataEmpleado['fecha_cese'] . ", y puedo asegurar que es una persona integra, estable, responsable y competente para cualquier tipo de actividad que se le encomiende"), 0, "L");
    $pdf->Cell(195, 8, "", 1, 1, "C", 2);
    $pdf->MultiCell(0, 7, utf8_decode("Por lo anterior no tengo inconveniente ninguno en recomendarlo ampliamente agradeciendo de antemano la atencion, un cordial saludo. "), 0, "L");
    $pdf->Cell(195, 40, "", 1, 1, "C", 2);
    $pdf->MultiCell(0, 7, utf8_decode("Atentamente."), 0, "C");
    $pdf->Cell(195, 20, "", 1, 1, "C", 2);
    $pdf->MultiCell(0, 7, utf8_decode("___________________________"), 0, "C");
    $pdf->MultiCell(0, 7, utf8_decode("$gerente"), 0, "C");
    $pdf->MultiCell(0, 7, utf8_decode("DNI: ".$dni_gerente), 0, "C");
    $pdf->Output();
    mysqli_close($conection);
}
