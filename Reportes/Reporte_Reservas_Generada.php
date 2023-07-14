<?php
require "Plantilla.php";

if (empty($_REQUEST['idUser'])) {
    header('location: ../MVC/Vista/Gestion_Reservas.php');
    mysqli_close($conection);
} else {
    session_start();
    date_default_timezone_set('America/Lima');
    $fecha = date("Y-m-d");
    $fecha_cab = date("Y-m-d  /  " . "H:m:s");
    /*Datos Usuario*/
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
    }
    /*Query Reservas Generadas*/
    $query_reserv_generate = mysqli_query($conection, "SELECT l.cod_licencia, t.nom_licencia AS tipo, p.nombres AS nombres, p.dni AS dni, l.fecha_inicio, p.cod_puesto,l.fecha_fin, l.estado, DATEDIFF(l.fecha_fin, l.fecha_inicio) AS dias
                        FROM licencia l
                        INNER JOIN personal p ON l.cod_personal = p.cod_personal
                        INNER JOIN tipo_licencia t ON l.tipo = t.cod_licencia
                        ORDER BY l.cod_licencia");


    $result = mysqli_num_rows($query_reserv_generate);

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
    $pdf->SetFont("Arial", "B", 15);
    $pdf->SetFillColor(41, 165, 161);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetDrawColor(229, 229, 229);
    $pdf->Cell(195, 10, " Licencias Generadas", 1, 1, "C", 2);
    $pdf->SetFont("Arial", "B", 12);
    $pdf->Cell(100, 10, " Responsable", 1, 0, "C", 2);
    $pdf->Cell(95, 10, " Fecha", 1, 1, "C", 2);


    $pdf->SetFillColor(210, 245, 244);

    $pdf->SetFont("Arial", "B", 11);
    $pdf->SetTextColor(1, 1, 1);
    $pdf->Cell(35, 7, "Nombre: ", 0, 0, "C", 1);
    $pdf->SetFont("Arial", "", 11);
    $pdf->Cell(160, 7, $nombre, 0, 1, "D", 1);


    $pdf->SetFont("Arial", "B", 11);
    $pdf->SetTextColor(1, 1, 1);
    $pdf->Cell(35, 7, "DNI: ", 0, 0, "C", 1);
    $pdf->SetFont("Arial", "", 11);
    $pdf->Cell(80, 7, "$", 0, 0, "D", 1);
    $pdf->Cell(80, 7, $fecha_cab, 0, 1, "C", 1);

    $pdf->SetFont("Arial", "B", 11);
    $pdf->SetTextColor(1, 1, 1);
    $pdf->Cell(35, 7, "Direccion: ", 0, 0, "C", 1);
    $pdf->SetFont("Arial", "", 11);
    $pdf->Cell(160, 7, $domicilio, 0, 0, "D", 1);


    $pdf->Ln(12);
    $pdf->SetFont("Arial", "B", 11);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFillColor(41, 165, 161);
    $pdf->Cell(10, 12, utf8_decode("N°"), 1, 0, "C", 1);
    $pdf->Cell(40, 12, "Nombre Emp.", 1, 0, "C", 1);
    $pdf->Cell(20, 12, "DNI", 1, 0, "C", 1);
    $pdf->Cell(22, 12, "Puesto", 1, 0, "C", 1);
    $pdf->Cell(28, 12, "Tipo Lic.", 1, 0, "C", 1);
    $pdf->Cell(20.5, 12, "F-Inicio ", 1, 0, "C", 1);
    $pdf->Cell(20.5, 12, "F-Final ", 1, 0, "C", 1);
    $pdf->Cell(16, 12, utf8_decode("N° Dias"), 1, 0, "C", 1);
    $pdf->Cell(18, 12, "Estado", 1, 1, "C", 1);


    $pdf->SetFont("Arial", "", 9.5);
    $pdf->SetTextColor(1, 1, 1);
    $pdf->SetFillColor(255, 255, 255);

    $num = 0;
    $porcentaje = 0;
    if ($result > 0) {
        while ($data = mysqli_fetch_array($query_reserv_generate)) {

            $num = $num + 1;
            $pdf->Cell(10, 12, $num, 1, 0, "C", 1);
            $pdf->Cell(40, 12, $data['nombres'], 1, 0, "C", 1);
            $pdf->Cell(20, 12, $data['dni'], 1, 0, "C", 1);
            $cod_puesto = '';
            switch ($data['cod_puesto']) {
                case 1:
                    $cod_puesto = "Analista";
                    break;
                case 2:
                    $cod_puesto = "Coordinador";
                    break;
                case 3:
                    $cod_puesto = "Jefe T.I";
                    break;
                default:
                    $cod_puesto = "Desconocida";
                    break;
            }
            $pdf->Cell(22, 12, $cod_puesto, 1, 0, "C", 1);
            // Obtener el valor de estado y asignar el texto correspondiente
            $cod_licencia = '';
            switch ($data['cod_licencia']) {
                case 1:
                    $cod_licencia = "Paternidad";
                    break;
                case 2:
                    $cod_licencia = "Maternidad";
                    break;
                case 3:
                    $cod_licencia = "Vacaciones";
                    break;
                case 4:
                    $cod_licencia = "Accidente Laboral";
                    break;
                case 5:
                    $cod_licencia = "Familiar Enfermo";
                    break;
                default:
                    $cod_licencia = "Desconocida";
                    break;
            }
            $pdf->Cell(28, 12, $cod_licencia, 1, 0, "C", 1);
            $pdf->Cell(20.5, 12, $data['fecha_inicio'], 1, 0, "C", 1);
            $pdf->Cell(20.5, 12, $data['fecha_fin'], 1, 0, "C", 1);
            $pdf->Cell(16, 12, $data['dias'], 1, 0, "C", 1);
            // Obtener el valor de estado y asignar el texto correspondiente
            $estado = '';
            switch ($data['estado']) {
                case 1:
                    $estado = "Pendiente";
                    break;
                case 2:
                    $estado = "Aprobada";
                    break;
                case 3:
                    $estado = "Confirmada";
                    break;
                case 4:
                    $estado = "Terminada";
                    break;
                case 5:
                    $estado = "Denegada";
                    break;
                case 6:
                    $estado = "Anulada";
                    break;
                default:
                    $estado = "Desconocida";
                    break;
            }

            $pdf->Cell(18, 12, $estado, 1, 1, "C", 1);
        }
    }

    $pdf->Output();
    mysqli_close($conection);
}
