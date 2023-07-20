<?php
session_start();
include_once "../Modelo/conexion.php";
//Mostrar Datos
$alert = '';
$msg2 = '';
$msg3 = '';
if (empty($_REQUEST['id'])) {
	header('location: ../Vista/Licencias.php');
	mysqli_close($conection);
} else {
	$tipo_licencia = $_REQUEST['id'];
	$sql = mysqli_query($conection, "SELECT nom_licencia, descripcion FROM `tipo_licencia` 
									WHERE cod_licencia = '$tipo_licencia' ");
	$result_sql = mysqli_num_rows($sql);
	if ($result_sql == 0) {
	} else {
		while ($data = mysqli_fetch_array($sql)) {
			$licencia_nombre             = $data['nom_licencia'];
			$licencia_detalle        = $data['descripcion'];
		}
	}
}
if (!empty($_POST)) {
	if (isset($_POST['regresar'])) {
		header('location: ../Vista/Licencias.php');
		mysqli_close($conection);
	}
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
						$direccion_usu		= $data2['direccion'];
						$telefono_usu		= $data2['telefono'];
						$correo_usu			= $data2['correo'];
					}
				} else {
				}
			}
		}
	}
	if (isset($_POST['btnGenerar'])) {
		$fechain    	= $_POST['fechain'];
		$fechasal    	= $_POST['fechasal'];
		$cod_personal = $_POST['cod_personal'];
		$query_registrar_asistencia = "INSERT INTO licencia(tipo,cod_personal,fecha_inicio,fecha_fin,estado)
			VALUES ($tipo_licencia,$cod_personal,'$fechain','$fechasal','1')";

		$query_insert = mysqli_query(
			$conection,
			$query_registrar_asistencia
		);
		if ($query_insert) {
			$alert = '<div class="alertSave">Licencia registrada con éxito</div>';
		} else {
			$alert = '<div class="alertError">Error al generar la licencia</div>';
		}
	}
	if (isset($_POST['btn_Estado'])) {
		$estado    	= $_POST['fechain'];
		$fechasal    	= $_POST['fechasal'];
		$cod_personal = $_POST['cod_personal'];
		$query_registrar_asistencia = "INSERT INTO licencia(tipo,cod_personal,fecha_inicio,fecha_fin,estado)
			VALUES ($tipo_licencia,$cod_personal,'$fechain','$fechasal','1')";

		$query_insert = mysqli_query(
			$conection,
			$query_registrar_asistencia
		);
		if ($query_insert) {
			$alert = '<div class="alertSave">Licencia registrada con éxito</div>';
		} else {
			$alert = '<div class="alertError">Error al generar la licencia</div>';
		}
	}
}
