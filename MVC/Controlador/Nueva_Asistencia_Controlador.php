<?php
session_start();
include "../Modelo/conexion.php";
//Mostrar Datos
$alert = '';
$msg2 = '';
$msg3 = '';
if (!empty($_POST)) {

	if (isset($_POST['regresar'])) {
		header('location: ../Vista/MenuAdministrador.php');
		mysqli_close($conection);
	}

	if (isset($_POST['btnGenerar'])) {
		$idusuario 		= $_POST['idusuario'];
		$cod_personal 		= $_POST['cod_personal'];
		$fechain    	= $_POST['fechain'];
		$horain    		= $_POST['horain'];
		$horasal    	= $_POST['horasal'];

		$query_insert = mysqli_query(
			$conection,
			"INSERT INTO asistencia(cod_personal,registrado_por,fecha_ingreso,hora_ingreso,hora_salida)
								VALUES ('$cod_personal','$idusuario','$fechain','$horain','$horasal')"
		);
		if ($query_insert) {
			$alert = '<div class="alertSave">Asistencia registrada</div>';
		} else {
			$alert = '<div class="alertError">Error al registrar la asistencia.</div>';
		}
	}
}
// Realizar la consulta a la base de datos para obtener empleados activos 
$query = "SELECT cod_personal, CONCAT(nombres, ' ', apellidos) AS nombre_completo FROM personal WHERE estado = 1";
$result = mysqli_query($conection, $query);

// Verificar si se obtuvieron resultados
if ($result && mysqli_num_rows($result) > 0) {
	$options = ""; // Variable para almacenar las opciones del select

	// Recorrer los resultados y generar las opciones
	while ($row = mysqli_fetch_assoc($result)) {
		$cod_personal = $row['cod_personal'];
		$nombre_completo = $row['nombre_completo'];
		$options .= "<option value=\"$cod_personal\">$nombre_completo</option>";
	}
} else {
	// Manejar el caso en que no se obtuvieron resultados
	$options = "<option value=\"\">No hay empleados disponibles</option>";
}

