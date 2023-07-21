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
    $gratificacion = 0;
    $monto_adicional = 0;
    $remuneracion_computable = 0;
    $meses_completos = 0;
    $dias_faltantes = 0;
    $cts_trunca1 = 0;
    $cts_trunca2 = 0;
    $diasLaborados = 0;
    $meses_trabajados_año = 0;

    // Función para calcular la CTS trunca
    function calcularCTS($sueldo, $fecha_cese, $hijos)
    {
        // Paso 1: Obtener la remuneración computable
        global $gratificacion;
        $gratificacion = $sueldo * (1 / 6);
        global $remuneracion_computable;
        $remuneracion_computable = $sueldo + $gratificacion;
        // Paso 2: Verificar si el empleado tiene hijos
        if ($hijos == 1) {
            // Calcular el 10% de la remuneración mínima
            $remuneracion_minima = 1025;
            global $monto_adicional;
            $monto_adicional = $remuneracion_minima * 0.10;

            // Sumar el monto adicional a la remuneración computable
            $remuneracion_computable += $monto_adicional;
        }

        // Paso 3: Calcular meses completos
        $fecha_inicio_periodo1 = date('Y-m-d', strtotime('December 1st', strtotime($fecha_cese)));
        $fecha_fin_periodo1 = date('Y-m-d', strtotime('April 30th', strtotime($fecha_cese)));
        $fecha_inicio_periodo2 = date('Y-m-d', strtotime('May 1st', strtotime($fecha_cese)));
        $fecha_fin_periodo2 = date('Y-m-d', strtotime('November 30th', strtotime($fecha_cese)));

        $meses_completos = 0;
        if ($fecha_cese >= $fecha_inicio_periodo1 && $fecha_cese <= $fecha_fin_periodo1) {
            global $meses_completos;
            $meses_completos = (int)date('m', strtotime($fecha_cese)) - (int)date('m', strtotime($fecha_inicio_periodo1));
        } elseif ($fecha_cese >= $fecha_inicio_periodo2 && $fecha_cese <= $fecha_fin_periodo2) {
            global $meses_completos;
            $meses_completos = (int)date('m', strtotime($fecha_cese)) - (int)date('m', strtotime($fecha_inicio_periodo2));
        }

        // Paso 4: Calcular días proporcionales del último mes trabajado
        global $dias_faltantes;
        $dias_faltantes = (int)date('d', strtotime($fecha_cese));

        // Paso 5: Calcular la CTS Trunca
        global $cts_trunca1;
        $cts_trunca1 = ($remuneracion_computable / 12) * ($meses_completos);
        global $cts_trunca2;
        $cts_trunca2 = ($remuneracion_computable / 12) / 30 * $dias_faltantes;

        $cts_trunca = $cts_trunca1 + $cts_trunca2;
        return $cts_trunca;
    }

    // Función para calcular las vacaciones truncas
    function calcularVacaciones($sueldo, $fecha_ingreso, $fecha_cese)
    {
        // Crear objetos DateTime para las dos fechas
        $inicio = new DateTime($fecha_ingreso);
        $fin = new DateTime($fecha_cese);

        // Calcular la diferencia entre las fechas
        $diferencia = $inicio->diff($fin);
        global $meses_trabajados_año;
        $meses_trabajados_año = $diferencia->m;

        if ($meses_trabajados_año == 0) {
            // Manejo de división entre 0
            return 0;
        }

        return ($sueldo * (1 / $meses_trabajados_año));
    }


    // Función para calcular la gratificación trunca
    function calcularGratificacion($sueldo, $mesesTrabajados)
    {
        return ($sueldo / 6) * $mesesTrabajados;
    }

    function calcularMesesEnTexto($fecha_ingreso, $fecha_cese)
    {
        // Convertir las cadenas de texto en objetos de fecha
        $inicio = new DateTime($fecha_ingreso);
        $cese = new DateTime($fecha_cese);

        // Calcular la diferencia entre las fechas
        $intervalo = $inicio->diff($cese);

        // Obtener los años y meses de la diferencia
        $anios = $intervalo->y;
        $meses = $intervalo->m;

        return "$anios años y $meses meses";
    }
    // Obtener los datos del empleado desde la base de datos
    $query = "SELECT NOMBRES, APELLIDOS,DNI,fecha_ingreso, fecha_cese,cod_puesto, cod_motivo_cese, sueldo, hijos FROM personal WHERE cod_personal = $cod_personal";
    $query_datos_empleado = mysqli_query($conection, "SELECT p.*, tp.descripcion FROM personal p JOIN tipo_puesto tp ON p.cod_puesto = tp.cod_puesto WHERE cod_personal = $cod_personal");

    $dataEmpleado = mysqli_fetch_assoc($query_datos_empleado);

    $result = mysqli_query($conection, $query);
    if ($result) {

        $row = mysqli_fetch_assoc($result);
        $nombres = $row['NOMBRES'];
        $apellidos = $row['APELLIDOS'];
        $dni = $row['DNI'];
        $fecha_ingreso = $row['fecha_ingreso'];
        $fecha_cese = $row['fecha_cese'];
        $cod_puesto = $row['cod_puesto'];
        $cod_motivo = $row['cod_motivo_cese'];
        $sueldo = $row['sueldo'];
        $hijos = $row['hijos'];

        // Calcular meses trabajados
        $fecha_ingreso_dt = new DateTime($fecha_ingreso);
        $fecha_cese_dt = new DateTime($fecha_cese);
        $interval = $fecha_ingreso_dt->diff($fecha_cese_dt);
        $mesesTrabajados = ($interval->y * 12) + $interval->m;

        // Verificar si cumple con el requisito de al menos un mes trabajando
        if ($mesesTrabajados >= 1) {
            $pdf = new PDF("p", "mm", "A4");
            $pdf->AliasNbPages();
            $pdf->SetMargins(10, 10, 10);
            $pdf->AddPage("portrait", "A4");


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
            $pdf->Cell(196, 10, utf8_decode("Liquidación de beneficios sociales"), 1, 1, "C", 2);
            $pdf->SetFont("Arial", "B", 13);
            $pdf->Cell(196, 10, utf8_decode("I. Información General"), 1, 1, "l", 1);

            $pdf->SetFillColor(210, 245, 244);

            $pdf->SetFont("Arial", "B", 11);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(50, 7, "Apellidos y nombres: ", 0, 0, "l", 1);
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(145, 7, $nombres, 0, 1, "D", 1);


            $pdf->SetFont("Arial", "B", 11);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(50, 7, "DNI: ", 0, 0, "l", 1);
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(145, 7, "$dni ", 0, 1, "D", 1);

            $pdf->SetFont("Arial", "B", 11);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(50, 7, "Fecha de ingreso: ", 0, 0, "l", 1);
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(145, 7, $fecha_ingreso, 0, 1, "D", 1);

            $pdf->SetFont("Arial", "B", 11);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(50, 7, "Fecha de cese: ", 0, 0, "l", 1);
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(145, 7, $fecha_cese, 0, 1, "D", 1);

            $pdf->SetFont("Arial", "B", 11);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(50, 7, "Cargo: ", 0, 0, "l", 1);
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(145, 7, $dataEmpleado['descripcion'], 0, 1, "D", 1);

            $pdf->SetFont("Arial", "B", 11);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(50, 7, utf8_decode("Periodo de liquidación: "), 0, 0, "l", 1);
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(145, 7, utf8_decode(calcularMesesEnTexto($fecha_ingreso, $fecha_cese)), 0, 1, "D", 1);

            $pdf->SetFont("Arial", "B", 11);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(50, 7, "Motivo: ", 0, 0, "l", 1);
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(145, 7, $cod_motivo, 0, 1, "D", 1);

            $pdf->Ln(10);
            $pdf->SetFillColor(41, 165, 161);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->SetDrawColor(229, 229, 229);
            $pdf->SetFont("Arial", "B", 13);
            $pdf->Cell(196, 10, utf8_decode("II. Cálculo de CTS Trunca"), 1, 1, "l", 1);

            // Calcular los montos de la CTS, vacaciones y gratificación truncas
            $cts_trunca = calcularCTS($sueldo, $fecha_cese, $hijos);
            $vacaciones_truncas = calcularVacaciones($sueldo, $fecha_ingreso, $fecha_cese);
            $gratificacion_trunca = calcularGratificacion($sueldo, $mesesTrabajados);

            $pdf->SetFillColor(210, 245, 244);

            $pdf->SetFont("Arial", "B", 11);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(60, 7, utf8_decode("Remuneración Básica"), 0, 0, "l", 1);
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(136, 7, $sueldo, 0, 1, "D", 1);

            $pdf->SetFont("Arial", "B", 11);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(60, 7, utf8_decode("Gratificación"), 0, 0, "l", 1);
            $pdf->SetFont("Arial", "", 11);
            $red_gratitr = round($gratificacion, 3);
            $pdf->Cell(136, 7, $red_gratitr, 0, 1, "D", 1);

            $pdf->SetFont("Arial", "B", 11);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(60, 7, utf8_decode("Asignación Familiar"), 0, 0, "l", 1);
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(136, 7, $monto_adicional, 0, 1, "D", 1);

            $pdf->SetFont("Arial", "B", 11);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(60, 7, utf8_decode("Remuneración Computable"), 0, 0, "l", 1);
            $pdf->SetFont("Arial", "", 11);
            $red_remuneracion = round($remuneracion_computable, 3);
            $pdf->Cell(136, 7, $red_remuneracion, 0, 1, "D", 1);

            $pdf->SetFont("Arial", "B", 11);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(60, 7, "Meses desde ultimo CTS", 0, 0, "l", 1);
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(136, 7, $meses_completos, 0, 1, "D", 1);

            $pdf->SetFont("Arial", "B", 11);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(60, 7, "Dias para completar el mes: ", 0, 0, "l", 1);
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(136, 7, $dias_faltantes, 0, 1, "D", 1);

            $pdf->SetFont("Arial", "B", 11);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(60, 7, " ", 0, 0, "l", 1);
            $pdf->SetFont("Arial", "", 11);
            $red_cts_trunca1 = round($cts_trunca1, 3);
            $pdf->Cell(136, 7, "(" . $red_remuneracion . " / 12 Meses) * (" . $meses_completos . ") = " . $red_cts_trunca1, 0, 1, "D", 1);

            $pdf->SetFont("Arial", "B", 11);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(60, 7, " ", 0, 0, "l", 1);
            $pdf->SetFont("Arial", "", 11);
            $red_cts_trunca2 = round($cts_trunca2, 3);
            $pdf->Cell(136, 7, "(" . $red_remuneracion . " / 12 Meses) / 30 Dias *" . $dias_faltantes . " = " . $red_cts_trunca2, 0, 1, "D", 1);

            $pdf->SetFont("Arial", "B", 11);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(60, 7, "CTS Trunca: ", 0, 0, "l", 1);
            $pdf->SetFont("Arial", "", 11);
            $red_cts_trunca = round($cts_trunca, 3);
            $pdf->Cell(136, 7, $red_cts_trunca, 0, 1, "D", 1);

            $pdf->SetFillColor(210, 245, 244);

            $pdf->Ln(10);
            $pdf->SetFillColor(41, 165, 161);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->SetDrawColor(229, 229, 229);
            $pdf->SetFont("Arial", "B", 13);
            $pdf->Cell(196, 10, "III. Calculo de Vacaciones Truncas", 1, 1, "l", 1);

            $pdf->SetFillColor(210, 245, 244);

            $pdf->SetFont("Arial", "B", 11);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(60, 7, "Remuneracion Basica", 0, 0, "l", 1);
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(136, 7, $sueldo, 0, 1, "D", 1);

            $pdf->SetFont("Arial", "B", 11);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(60, 7, "Meses trabajados en el año", 0, 0, "l", 1);
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(136, 7, $meses_trabajados_año, 0, 1, "D", 1);

            $pdf->SetFont("Arial", "B", 11);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(60, 7, "", 0, 0, "l", 1);
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(136, 7, "(" . $sueldo . "* 1 /(meses trabajados en el año)) ", 0, 1, "D", 1);

            $pdf->SetFont("Arial", "B", 11);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(60, 7, "Vacaciones Truncas: ", 0, 0, "l", 1);
            $pdf->SetFont("Arial", "", 11);
            $red_vaca = round($vacaciones_truncas, 3);
            $pdf->Cell(136, 7, $red_vaca, 0, 1, "D", 1);

            $pdf->Ln(10);
            $pdf->SetFont("Arial", "", 12);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetDrawColor(255, 255, 255);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(195, 4, "", 1, 1, "C", 1);

            $pdf->SetFillColor(210, 245, 244);

            $pdf->Ln(10);
            $pdf->SetFillColor(41, 165, 161);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->SetDrawColor(229, 229, 229);
            $pdf->SetFont("Arial", "B", 13);
            $pdf->Cell(196, 10, "IV. Calculo de Gratificacion Trunca", 1, 1, "l", 1);

            $pdf->SetFillColor(210, 245, 244);

            $pdf->SetFont("Arial", "B", 11);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(60, 7, "Remuneracion Basica", 0, 0, "l", 1);
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(136, 7, $sueldo, 0, 1, "D", 1);

            $pdf->SetFont("Arial", "B", 11);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(60, 7, "Meses totales trabajados", 0, 0, "l", 1);
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(136, 7, $mesesTrabajados, 0, 1, "D", 1);

            $pdf->SetFont("Arial", "B", 11);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(60, 7, "Ley 29351", 0, 0, "l", 1);
            $pdf->SetFont("Arial", "", 11);
            $pdf->Cell(136, 7, "(" . $sueldo . "/ 6 Meses) *" . $mesesTrabajados, 0, 1, "D", 1);

            $pdf->SetFont("Arial", "B", 11);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(60, 7, "Gratificacion Trunca", 0, 0, "l", 1);
            $pdf->SetFont("Arial", "", 11);
            $red_grati = round($gratificacion_trunca, 3);
            $pdf->Cell(136, 7, $red_grati, 0, 1, "D", 1);

            $liquidacion = round($cts_trunca + $gratificacion_trunca + $vacaciones_truncas, 3);

            $pdf->Ln(10);
            $pdf->SetFillColor(41, 165, 161);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->SetDrawColor(229, 229, 229);
            $pdf->SetFont("Arial", "B", 13);
            $pdf->Cell(196, 10, "Liquidacion:  " . $liquidacion . " nuevos soles.", 1, 1, "R", 1);

            $pdf->Ln(10);
            $pdf->SetFont("Arial", "", 12);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetDrawColor(255, 255, 255);
            $pdf->SetTextColor(1, 1, 1);
            $pdf->Cell(195, 4, "", 1, 1, "C", 1);
            $pdf->MultiCell(0, 7, utf8_decode("Recibo de " . $razon_social . " la cantidad de " . $liquidacion . " Nuevos Soles por concepto de compensacion por tiempo de servicios, vacaciones y gratificaciones que corresponden de acuerdo a Ley, no teniendo reclamo alguno posterior que formular, por dichos conceptos lo que firmo en señal de conformidad. "), 0, "L");
            $pdf->SetTextColor(0, 0, 0); // Color de texto para las celdas de la tabla

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Ln(10);
            $pdf->MultiCell(0, 7, utf8_decode("___________________________"), 0, "l");
            $pdf->Cell(0, 10, "Firma del Trabajador", 0, 1, "L");


            // Agregar línea para la firma del representante de la empresa
            $pdf->Ln(10);
            $pdf->MultiCell(0, 7, utf8_decode("___________________________"), 0, "l");
            $pdf->Cell(1, 10, "Firma del Representante de la Empresa", 0, 1, "L");
        } else {
            $pdf->Ln(15);
            $pdf->SetFont("Arial", "", 15);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->SetDrawColor(255, 255, 255);
            $pdf->Cell(195, 4, "El empleado no cumple con el requisito mínimo de un mes trabajando.", 0, 1, "C", 1);
        }
    } else {
        $contenido .= "<p>Error al obtener los datos del empleado desde la base de datos.</p>";
    }


    $pdf->Output();
    mysqli_close($conection);
}
