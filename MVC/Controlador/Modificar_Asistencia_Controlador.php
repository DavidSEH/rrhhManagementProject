
<?php
session_start();
$alert = '';
$msg2 = '';
$msg3 = '';
include "../Modelo/conexion.php";

if (!empty($_POST)) {
	$alert = '';
	if (empty($_POST['fecha_ingreso']) || empty($_POST['hora_ingreso']) || empty($_POST['hora_salida'])) {
		$alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
	} else {
		$fecha_ingreso = $_POST['fecha_ingreso'];
		$hora_ingreso = $_POST['hora_ingreso'];
		$hora_salida = $_POST['hora_salida'];
		$idusuario = $_POST['idusuario'];
		$idasistencia = $_POST['idasistencia'];

		$sql_update = mysqli_query($conection, "UPDATE asistencia
				SET fecha_ingreso = '$fecha_ingreso', hora_ingreso = '$hora_ingreso', hora_salida = '$hora_salida', id_usu_mod = '$idusuario'
				WHERE idasistencia = $idasistencia");

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

$idasistencia = $_REQUEST['id'];

$sql = mysqli_query($conection, "SELECT a.idasistencia, a.fecha_ingreso, a.hora_ingreso, a.hora_salida, c.nombre
		FROM asistencia a
		INNER JOIN cliente c ON a.idcliente = c.idcliente
		WHERE a.idasistencia = '$idasistencia'");

$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
	// No se encontraron resultados
} else {
	while ($data = mysqli_fetch_array($sql)) {
		$idasistencia = $data['idasistencia'];
		$nombre = $data['nombre'];
		$fecha_ingreso = $data['fecha_ingreso'];
		$hora_ingreso = $data['hora_ingreso'];
		$hora_salida = $data['hora_salida'];
	}
}
