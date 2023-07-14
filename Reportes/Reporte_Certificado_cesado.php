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


    $pdf->Ln(10);
    $pdf->SetFont("Arial", "B", 20);
    $pdf->SetFillColor(255, 255 ,255);
    $pdf->SetTextColor(1, 1, 1);
    $pdf->SetDrawColor(255, 255, 255);
    $pdf->Cell(195, 16, "", 1, 1, "C", 2);
    $pdf->Cell(195, 4, "CERTIFICADO DE TRABAJO", 1, 1, "C", 2);
 
    $pdf->Ln(15);
    $pdf->SetFont("Arial", "", 15);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetDrawColor(255, 255, 255);

    $pdf->Cell(195, 4, "", 1, 1, "C", 2);
    $pdf->MultiCell(0, 7, utf8_decode("El Sr. $gerente, Identificado con DNI N° $dni_gerente, Gerente General de $razon_social, con RUC $ruc"), 0, "C");
    $pdf->Cell(195, 8, "", 1, 1, "C", 2);
    $pdf->MultiCell(0, 7, utf8_decode("CERTIFICA:"), 0, "C");
    $pdf->Cell(195, 8, "", 1, 1, "C", 2);
    $pdf->MultiCell(0, 7, utf8_decode("         Que, el Sr. " . $dataEmpleado['nombres'] . " " . $dataEmpleado['apellidos'] . ", Identificado con DNI N° " . $dataEmpleado['dni'] . ", ha laborado en nuestra empresa como " . $dataEmpleado['descripcion'] . ", durante el periodo comprendido desde el " . $dataEmpleado['fecha_ingreso'] . " hasta el " . $dataEmpleado['fecha_cese'] . ", demostrando durante su permanencia responsabilidad, honestidad y dedicación en las labores que le fueron encomendadas."), 0, "C");
    $pdf->Cell(195, 8, "", 1, 1, "C", 2);
    $pdf->MultiCell(0, 7, utf8_decode("                     Se expide la presente a solicitud del interesado, para los fines que "), 0, "L");
    $pdf->MultiCell(0, 7, utf8_decode("     crea conveniente."), 0, "L");
    $pdf->Cell(195, 12, "", 1, 1, "C", 2);
    $pdf->Cell(195, 12, "Lima, $fecha", 1, 1, "R", 2);
    $pdf->Output();
    mysqli_close($conection);
}
