<?php
session_start();
include "../Modelo/conexion.php";
//Mostrar Datos
$alert = '';
$msg2 = '';
$msg3 = '';

if (isset($_POST['regresar'])) {
	header('location: ../Vista/MenuAdministrador.php');
	mysqli_close($conection);
}

if (!empty($_POST)) {

	if (isset($_POST['btnBuscar'])) {
		if (empty($_POST['busqueda'])) {
			$alert = '<div class="alertError">Ingrese N° DNI</div>';
		} else {
			$busqueda 	= $_POST['busqueda'];
			$query_busqueda = mysqli_query($conection, "SELECT * FROM personal WHERE dni='$busqueda'");
			$result_busqueda = mysqli_num_rows($query_busqueda);
			if ($result_busqueda == 0) {
				$alert = '<div class="alertError">Empleado no Registrado</div>';
				$msg2 = '<a href="NuevoCliente.php">Nuevo Empleado</a>';
			} else {
				if ($query_busqueda) {
					while ($data2 = mysqli_fetch_array($query_busqueda)) {
						$cod_personal_usu		= $data2['cod_personal'];
						$dni_usu			= $data2['dni'];
						$nombres_usu		= $data2['nombres'];
					}
				} else {
				}
			}
		}
	}
	if (isset($_POST['btnGenerar'])) {

		$cod_personal = $_POST['cod_personal'];;
		$periodo       = $_POST['periodo'];
		$dias_trabajo  = $_POST['dias_trabajo'];
		$horas_trabajo = $_POST['horas_trabajo'];
		// Dividir el periodo en mes y año
		list($mes, $anio) = explode('-', $periodo);

		// Validar que los campos no estén vacíos
		if (empty($cod_personal)) {
			echo "Error: Por favor busque un trabajador valido";
			exit(); // Salir del script si hay errores
		}
		if (empty($periodo) || empty($dias_trabajo) || empty($horas_trabajo)) {
			echo "Error: Por favor complete todos los campos obligatorios (Periodo, Días de Trabajo, Horas de Trabajo)";
			exit(); // Salir del script si hay errores
		}

		/*Query Datos Empresa*/
		$query_empresa = mysqli_query($conection, "SELECT * FROM empresa");
		while ($dataEmp = mysqli_fetch_array($query_empresa)) {
			$ruc            = $dataEmp['ruc'];
			$razon_social   = $dataEmp['razon_social'];
			$telefono            = $dataEmp['telefono'];
			$direccion            = $dataEmp['direccion'];
			$pagina_web            = $dataEmp['web'];
		}

		/* DATOS EMPLEADO */
		$query = "SELECT per.NOMBRES, per.APELLIDOS, per.DNI, per.fecha_ingreso, per.fecha_cese, pue.descripcion, 
		per.cod_motivo_cese, per.sueldo, spt.nombre_pension_tipo, spt.dcto_pension_tipo,per.banco, per.cuenta_bancaria 
		FROM personal per LEFT JOIN tipo_puesto pue ON per.cod_puesto = pue.cod_puesto 
		LEFT JOIN sistema_pensiones_tipo spt ON per.id_pension_tipo = spt.id_pension_tipo 
		WHERE per.cod_personal = $cod_personal";
		$query_datos_empleado = mysqli_query($conection, $query);
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
		$nombre_pension_tipo = $dataEmpleado['nombre_pension_tipo'];
		$dcto_pension_tipo = $dataEmpleado['dcto_pension_tipo'];
		$banco = $dataEmpleado['banco'];
		$cuenta_bancaria = $dataEmpleado['cuenta_bancaria'];

		//formulas a utilizar
		$total_ingresos = $sueldo;
		$deducciones = ($sueldo * $dcto_pension_tipo) / 100;
		$total_neto = $total_ingresos - $deducciones;

		$sql = "INSERT INTO boleta_pagos (periodo,mes, anio, nombres, apellidos, dni, fecha_ingreso, dias_trabajo, horas_trabajo, descripcion_tipo_puesto, nombre_pension_tipo, sueldo, banco, cuenta_bancaria, total_ingresos, deducciones, total_neto) 
            VALUES ('$periodo','$mes', '$anio', '$nombres', '$apellidos', '$dni', '$fecha_ingreso', '$dias_trabajo', '$horas_trabajo', '$descripcion_tipo_puesto', '$nombre_pension_tipo', '$sueldo', '$banco', '$cuenta_bancaria', '$total_ingresos', '$deducciones', '$total_neto')";
    if ($conection->query($sql) === TRUE) {

		// Asegúrate de colocar la ruta correcta a la carpeta de FPDF
		require "../../fpdf/fpdf.php";
		// Crear una nueva instancia de FPDF

		$pdf = new FPDF("P", "mm", "A4");
		$pdf->AliasNbPages();
		$pdf->SetMargins(10, 10, 10);
		$pdf->AddPage("PORTRAIT", "letter");

			// Logo
			$pdf->Image("../../Imagenes/logo_hotel.png",15,8,60,30,);
			// Arial bold 15
			$pdf->SetFont("Arial","B",18);
			// Movernos a la derecha
			$pdf->Cell(55);
			$pdf->Cell(140,8,"Talenti S.A.",0,0,"R");
		

		$pdf->Ln(10);

		$pdf->SetFont("Arial", "", 9.5);
		$pdf->Cell(195, 5, utf8_decode("N° RUC: " . $ruc), 0, 1, "R");
		$pdf->Cell(195, 5, "Telefono: " . $telefono, 0, 1, "R");
		$pdf->Cell(195, 5, "Direccion: " . $direccion, 0, 1, "R");

		$pdf->Ln(10);

		// Definir el estilo para el título y la tabla
		$pdf->SetFont('Arial', 'B', 20);
		$pdf->SetFillColor(63, 81, 181); // Color de fondo para el título
		$pdf->SetTextColor(255, 255, 255); // Color de texto para el título
		$pdf->SetDrawColor(63, 81, 181); // Color de bordes para el título y la tabla
		$column_width = 97.5; // Ancho de cada columna en la tabla

		// Título de la boleta de pago con el periodo
		$pdf->Cell(0, 10, "BOLETA DE PAGO $periodo", 1, 1, "C", true);

		$pdf->Ln(10);

		// Escribir el contenido principal en una tabla con bordes visibles en el PDF
		$pdf->SetFont('Arial', '', 10);
		$pdf->SetFillColor(239, 239, 239); // Color de fondo para las celdas de la tabla
		$pdf->SetTextColor(0, 0, 0); // Color de texto para las celdas de la tabla

		$contenido_pdf = array(
			array("Datos del Empleado", ''),
			array("Nombres:", $nombres),
			array("Apellidos:", $apellidos),
			array("DNI:", $dni),
			array("Fecha de Ingreso:", $fecha_ingreso),
			array("Días de Trabajo:", $dias_trabajo),
			array("Horas de Trabajo:", $horas_trabajo),
			array("Descripción del Puesto:", $descripcion_tipo_puesto),
			array("AFP/ONP:", $nombre_pension_tipo),
			array("Sueldo:", $sueldo),
			array("Banco:", $banco),
			array("Cuenta:", $cuenta_bancaria),
			array("Total Ingresos:", $total_ingresos),
			array("Total Deducciones:", $deducciones),
			array("Total Neto:", $total_neto),
		);

		foreach ($contenido_pdf as $row) {
			$pdf->Cell($column_width, 10, utf8_decode($row[0]), 1);
			$pdf->Cell($column_width, 10, utf8_decode($row[1]), 1);
			$pdf->Ln();
		}


		// Agregar línea para la firma del trabajador
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Ln(10);
		$pdf->Line(20, $pdf->GetY(), 80, $pdf->GetY()); // Línea de firma para el trabajador
		$pdf->Cell(0, 10, "Firma del Trabajador:", 0, 1, "L");


		// Agregar línea para la firma del representante de la empresa
		$pdf->Ln(10);
		$pdf->Line(20, $pdf->GetY(), 80, $pdf->GetY()); // Línea de firma para el representante
		$pdf->Cell(1, 10, "Firma del Representante de la Empresa:", 0, 1, "L");


		// Generar el PDF y mostrarlo en el navegador
		$pdf->Output('boleta_pago.pdf', 'I');
		exit();
	} else {
        $msg2= "Error al guardar los datos en la tabla: " . $conection->error;
    }

	}
}