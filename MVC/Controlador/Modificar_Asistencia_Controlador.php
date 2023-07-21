<?php
session_start();
$alert = '';
$msg2 = '';
$msg3 = '';
include_once "../Modelo/conexion.php";

if (!empty($_POST)) {
	$alert = '';
	if (empty($_POST['fecha_ingreso']) || empty($_POST['hora_ingreso']) || empty($_POST['hora_salida'])) {
		$alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
	} else {
		$fecha_ingreso = $_POST['fecha_ingreso'];
		$hora_ingreso = $_POST['hora_ingreso'];
		$hora_salida = $_POST['hora_salida'];
		$idusuario = $_POST['idusuario'];
		$cod_asistencia = $_POST['cod_asistencia'];

		$sql_update = mysqli_query($conection, "UPDATE asistencia
				SET fecha_ingreso = '$fecha_ingreso', hora_ingreso = '$hora_ingreso', hora_salida = '$hora_salida',
				 modificado_por = '$idusuario' WHERE cod_asistencia = $cod_asistencia");

		if ($sql_update) {
			$alert = '<p class="msg_save">Asistencia actualizada correctamente.</p>';
		} else {
			$error = mysqli_error($conection);
			$alert = '<p class="msg_error">Error al actualizar la asistencia: ' . $error . '</p>';
		}
	}
}

if (empty($_REQUEST['id'])) {
	mysqli_close($conection);
}

$cod_asistencia = $_REQUEST['id'];

$sql = mysqli_query($conection, "SELECT a.cod_asistencia, a.fecha_ingreso, a.hora_ingreso, a.hora_salida, c.nombres
		FROM asistencia a
		INNER JOIN personal c ON a.cod_personal = c.cod_personal
		WHERE a.cod_asistencia = '$cod_asistencia'");

$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
	// No se encontraron resultados
	$error = mysqli_error($conection);
	$alert = '<p class="msg_error">Error al recibir los datos: ' . $error . '</p>';
} else {
	while ($data = mysqli_fetch_array($sql)) {
		$cod_asistencia = $data['cod_asistencia'];
		$nombres = $data['nombres'];
		$fecha_ingreso = $data['fecha_ingreso'];
		$hora_ingreso = $data['hora_ingreso'];
		$hora_salida = $data['hora_salida'];
	}
}
