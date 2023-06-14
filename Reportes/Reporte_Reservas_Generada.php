<?php
require "Plantilla.php";

if (empty($_REQUEST['idUser'])) {
    header('location: ../MVC/Vista/Gestion_Reservas.php');
    mysqli_close($conection);
} else {

    $idusuario = $_REQUEST['idUser'];
    date_default_timezone_set('America/Lima');
    $fecha = date("Y-m-d");
    $fecha_cab = date("Y-m-d  /  " . "H:m:s");
    /*Query Datos Usuario*/
    $query_user = mysqli_query($conection, "SELECT r.rol,u.nombre,u.dni,u.domicilio
                    FROM usuario u
                    INNER JOIN rol r ON (u.rol=r.idrol)
                    WHERE u.idusuario=$idusuario");

    while ($dataUs = mysqli_fetch_array($query_user)) {
        $nombre            = $dataUs['nombre'];
        $dni            = $dataUs['dni'];
        $domicilio            = $dataUs['domicilio'];
        $nombre            = $dataUs['nombre'];
        $nombre            = $dataUs['nombre'];
        $nombre            = $dataUs['nombre'];
        $nombre            = $dataUs['nombre'];
    }
    /*Query Datos Empresa*/
    $query_empresa = mysqli_query($conection, "SELECT * FROM empresa");
    while ($dataEmp = mysqli_fetch_array($query_empresa)) {
        $ruc            = $dataEmp['ruc'];
        $razon_social   = $dataEmp['razon_social'];
        $telefono            = $dataEmp['telefono'];
        $direccion            = $dataEmp['direccion'];
        $pagina_web            = $dataEmp['pagina_web'];
    }
    /*Query Reservas Generadas*/
    $query_reserv_generate = mysqli_query($conection, " SELECT r.idreserva, r.fecha_ingreso, r.hora_ingreso, r.hora_salida,
            r.fecha_salida, r.estatus, r.cant_noches, h.num_habitacion, (c.nombre) AS nom_cli,
            c.dni,c.motivo_cese, c.puesto_trabajo, DATEDIFF(r.fecha_salida, r.fecha_ingreso) AS dias
        FROM reserva r 
        INNER JOIN habitacion h ON (h.idhabitacion = r.idhabitacion)
        INNER JOIN cliente c ON (c.idcliente = r.idcliente)

        ORDER BY r.idreserva");


    $result = mysqli_num_rows($query_reserv_generate);



    $pdf = new PDF("P", "mm", "A4");
    $pdf->AliasNbPages();
    $pdf->SetMargins(10, 10, 10);
    $pdf->AddPage("PORTRAIT", "letter");


    $pdf->Ln(10);

    $pdf->SetFont("Arial", "", 9.5);
    $pdf->Cell(195, 5, utf8_decode("N° RUC: " . $ruc), 0, 1, "C");
    $pdf->Cell(195, 5, "Razon Social: " . $razon_social, 0, 1, "C");
    $pdf->Cell(195, 5, "Telefono: " . $telefono, 0, 1, "C");
    $pdf->Cell(195, 5, "Direccion: " . $direccion, 0, 1, "C");


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
    $pdf->Cell(80, 7, $dni, 0, 0, "D", 1);
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
            $pdf->Cell(40, 12, $data['nom_cli'], 1, 0, "C", 1);
            $pdf->Cell(20, 12, $data['dni'], 1, 0, "C", 1);
            $puesto_trabajo = '';
            switch ($data['puesto_trabajo']) {
                case 1:
                    $puesto_trabajo = "Vigilate";
                    break;
                case 2:
                    $puesto_trabajo = "Limpieza";
                    break;
                case 3:
                    $puesto_trabajo = "Secretaria";
                    break;
                default:
                    $puesto_trabajo = "Desconocida";
                    break;
            }
            $pdf->Cell(22, 12, $puesto_trabajo, 1, 0, "C", 1);
            // Obtener el valor de estatus y asignar el texto correspondiente
            $num_habitacion = '';
            switch ($data['num_habitacion']) {
                case 1:
                    $num_habitacion = "Maternidad";
                    break;
                case 10:
                    $num_habitacion = "Familiar enfermo";
                    break;
                case 101:
                    $num_habitacion = "Paternidad";
                    break;
                case 102:
                    $num_habitacion = "Accidente Laboral";
                    break;
                case 112:
                    $num_habitacion = "Vacaciones";
                    break;
                default:
                    $num_habitacion = "Desconocida";
                    break;
            }
            $pdf->Cell(28, 12, $num_habitacion, 1, 0, "C", 1);
            $pdf->Cell(20.5, 12, $data['fecha_ingreso'], 1, 0, "C", 1);
            $pdf->Cell(20.5, 12, $data['fecha_salida'], 1, 0, "C", 1);
            $pdf->Cell(16, 12, $data['dias'], 1, 0, "C", 1);
            // Obtener el valor de estatus y asignar el texto correspondiente
            $estatus = '';
            switch ($data['estatus']) {
                case 1:
                    $estatus = "Pendiente";
                    break;
                case 2:
                    $estatus = "Aprobada";
                    break;
                case 3:
                    $estatus = "Confirmada";
                    break;
                case 4:
                    $estatus = "Terminada";
                    break;
                case 5:
                    $estatus = "Denegada";
                    break;
                case 6:
                    $estatus = "Anulada";
                    break;
                default:
                    $estatus = "Desconocida";
                    break;
            }

            $pdf->Cell(18, 12, $estatus, 1, 1, "C", 1);
        }
    }

    $pdf->Output();
    mysqli_close($conection);
}
