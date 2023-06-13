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
    $query_reserv_generate =  mysqli_query($conection, " SELECT a.idasistencia, a.idusuario, a.idcliente, a.fecha_ingreso, a.hora_ingreso, a.hora_salida, a.id_usu_mod, c.nombre AS cliente, u.nombre AS usuario
        FROM asistencia a
        INNER JOIN cliente c ON (a.idcliente = c.idcliente)
        INNER JOIN usuario u ON (a.idusuario = u.idusuario)
        ORDER BY a.idasistencia");

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
    $pdf->Cell(195, 10, "Listado de asistencias", 1, 1, "C", 2);
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
    $pdf->Cell(38, 12, "Nombre Emp.", 1, 0, "C", 1);
    $pdf->Cell(32, 12, "Registrado por", 1, 0, "C", 1);
    $pdf->Cell(32, 12, "Modificado por", 1, 0, "C", 1);
    $pdf->Cell(28, 12, "Fech. Regis.", 1, 0, "C", 1);
    $pdf->Cell(28, 12, "H-Entrada", 1, 0, "C", 1);
    $pdf->Cell(28, 12, "H-Salida", 1, 1, "C", 1);

    $pdf->SetFont("Arial", "", 9.5);
    $pdf->SetTextColor(1, 1, 1);
    $pdf->SetFillColor(255, 255, 255);

    $num = 0;
    $porcentaje = 0;
    if ($result > 0) {
        while ($data = mysqli_fetch_array($query_reserv_generate)) {
            $num = $num + 1;
            $pdf->Cell(10, 12, $num, 1, 0, "C", 1);
            $pdf->Cell(38, 12, $data['cliente'], 1, 0, "C", 1);
            $pdf->Cell(32, 12, $data['usuario'], 1, 0, "C", 1);
    
            // Obtener el nombre de usuario modificador
            $id_usu_mod = $data['id_usu_mod'];
            $query_usuario_mod = mysqli_query($conection, "SELECT nombre FROM usuario WHERE idusuario = '$id_usu_mod'");
            $usuario_mod = mysqli_fetch_array($query_usuario_mod);
            $nombre_modificador = ($usuario_mod !== null) ? $usuario_mod['nombre'] : "Ninguno";
    
            $pdf->Cell(32, 12, $nombre_modificador, 1, 0, "C", 1);
            $pdf->Cell(28, 12, $data['fecha_ingreso'], 1, 0, "C", 1);
            $pdf->Cell(28, 12, $data['hora_ingreso'], 1, 0, "C", 1);
            $pdf->Cell(28, 12, $data['hora_salida'], 1, 1, "C", 1);
        }
    }
    

    $pdf->Output();
    mysqli_close($conection);
}
