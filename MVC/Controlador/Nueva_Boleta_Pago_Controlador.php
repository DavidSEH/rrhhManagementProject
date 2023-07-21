<?php
session_start();
include_once "../Modelo/conexion.php";

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

		$msg2 = $periodo;

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
		$total_ingresos= $sueldo;
		$deducciones = ($sueldo*$dcto_pension_tipo)/100;
		$total_neto = $total_ingresos - $deducciones;


		require_once('../../fpdf/fpdf.php'); // Asegúrate de colocar la ruta correcta a la carpeta de FPDF

		// Crear una nueva instancia de FPDF
		$pdf = new FPDF();
		$pdf->AddPage();
	
		// Definir la fuente y tamaño del texto para el encabezado
		$pdf->SetFont('Arial', 'B', 14);
	
		// Definir el contenido del encabezado del PDF (Datos de la Empresa)
		$contenido_encabezado = "
			Empresa: $razon_social\n
			RUC: $ruc\n
			Teléfono: $telefono\n
			Dirección: $direccion\n
			Página Web: $pagina_web\n\n
		";
	
		// Escribir el contenido del encabezado en el PDF
		$pdf->MultiCell(0, 10, $contenido_encabezado);
	
		// Definir la fuente y tamaño del texto para el contenido principal
		$pdf->SetFont('Arial', 'B', 16);
	
		// Definir el contenido del PDF (Boleta de Pago)
		$contenido_pdf = "
			Boleta de Pago\n
			Período: $periodo\n
			
			Datos del Empleado:\n
			Nombres: $nombres\n
			Apellidos: $apellidos\n
			DNI: $dni\n
			Fecha de Ingreso: $fecha_ingreso\n
			Días de Trabajo: $dias_trabajo\n
			Horas de Trabajo: $horas_trabajo\n\n
			Descripción del Puesto: $descripcion_tipo_puesto\n
			AFP/ONP: $nombre_pension_tipo\n
			Sueldo: $sueldo\n
			Banco: $banco\n
			Cuenta: $cuenta_bancaria\n
			Total Ingresos: $total_ingresos\n
			Total Deducciones: $deducciones\n
			Total Neto: $total_neto\n
			
		";
	
		// Escribir el contenido principal en el PDF
		$pdf->MultiCell(0, 10, $contenido_pdf);
	
		// Generar el PDF y mostrarlo en el navegador
		$pdf->Output('boleta_pago.pdf', 'I');
		exit();  

	}
}
