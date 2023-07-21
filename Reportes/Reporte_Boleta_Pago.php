<?php
require "Plantilla.php";

if (empty($_REQUEST['cod_personal'])) {
    header('location: ../MVC/Vista/Gestion_Reservas.php');
    mysqli_close($conection);
} else {
    session_start();
    date_default_timezone_set('America/Lima');
    $fecha = date("Y-m-d");
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
    }

    // Obtener el id del personal desde la URL
    $cod_personal = $_REQUEST['idUser'];

    //variables para el pdf
    $total_ingresos = 0;
    $total_deducciones = 0;
    $total_neto = 0;
    $dias_trabajados = 30;
    $horas_trabajados = 240;
    
    // Obtener los datos del empleado desde la base de datos
    // Verificar si se proporciona el parámetro $cod_personal y si es un número válido
    if (!isset($cod_personal) || !is_numeric($cod_personal)) {
        die("El código de empleado no es válido.");
    }

    // Escapar el parámetro $cod_personal para evitar inyección de SQL
    $cod_personal = mysqli_real_escape_string($conection, $cod_personal);

    // Consulta SQL para obtener los datos del empleado y su tipo de puesto
    $query = "SELECT per.NOMBRES, per.APELLIDOS, per.DNI, per.fecha_ingreso, per.fecha_cese, pue.descripcion, per.cod_motivo_cese, per.sueldo, spt.nombre_pension_tipo, spt.dcto_pension_tipo FROM personal per LEFT JOIN tipo_puesto pue ON per.cod_puesto = pue.cod_puesto LEFT JOIN sistema_pensiones_tipo spt ON per.id_pension_tipo = spt.id_pension_tipo WHERE per.cod_personal = $cod_personal";

    // Ejecutar la consulta
    $query_datos_empleado = mysqli_query($conection, $query);

    // Verificar si se obtuvieron resultados
    if (!$query_datos_empleado) {
        die("Error al obtener los datos del empleado: " . mysqli_error($conection));
    }

    // Verificar si se encontraron datos para el empleado con el código proporcionado
    if (mysqli_num_rows($query_datos_empleado) === 0) {
        die("No se encontraron datos para el empleado con el código $cod_personal");
    } else {

    // Obtener los datos del empleado desde el resultado de la consulta
    $dataEmpleado = mysqli_fetch_assoc($query_datos_empleado);

    // Ahora puedes acceder a los datos del empleado utilizando el alias del resultado de la consulta
    $nombres = $dataEmpleado['NOMBRES'];
    $apellidos = $dataEmpleado['APELLIDOS'];
    $dni = $dataEmpleado['DNI'];
    $fecha_ingreso = $dataEmpleado['fecha_ingreso'];
    $fecha_cese = $dataEmpleado['fecha_cese'];
    $cod_motivo_cese = $dataEmpleado['cod_motivo_cese'];
    $sueldo = $dataEmpleado['sueldo'];
    $descripcion_tipo_puesto = $dataEmpleado['descripcion'];

    }

        $pdf = new PDF("p", "mm", "A4");
        $pdf->AliasNbPages();
        $pdf->SetMargins(10, 10, 10);
        $pdf->AddPage("portrait", "A4");


        $pdf->Ln(10);

        $pdf->SetFont("Arial", "", 9.5);
        $pdf->Cell(195, 5, utf8_decode("N° RUC: " . $ruc), 0, 1, "R");
        $pdf->Cell(195, 5, "Telefono: " . $telefono, 0, 1, "R");
        $pdf->Cell(195, 5, "Direccion: " . $direccion, 0, 1, "R");

        $pdf->Output();
        mysqli_close($conection);

}
