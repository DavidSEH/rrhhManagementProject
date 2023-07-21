<?php
session_start();
if ($_SESSION['rol'] != 1) {
	header("location: ../Vista/cliente.php");
}
include_once "../Modelo/conexion.php";

// Realizar la consulta a la base de datos para obtener los motivos de cese
$query = "SELECT cod_motivo_cese, descripcion FROM tipo_motivo_cese";
$result = mysqli_query($conection, $query);

// Verificar si se obtuvieron resultados
if ($result && mysqli_num_rows($result) > 0) {
	$options = ""; // Variable para almacenar las opciones del select

	// Recorrer los resultados y generar las opciones
	while ($row = mysqli_fetch_assoc($result)) {
		$cod_motivo_cese = $row['cod_motivo_cese'];
		$descripcion = $row['descripcion'];
		$options .= "<option value=\"$cod_motivo_cese\">$descripcion</option>";
	}
} else {
	// Manejar el caso en que no se obtuvieron resultados
	$options = "<option value=\"\">No hay motivos de cese disponibles</option>";
}

if (!empty($_POST)) {
	$alert = '';
	if ($_POST['cod_personal'] == 1) {
		header("location: ../Vista/Gestion_Empleados.php");
		mysqli_close($conection);
		exit;
	}
	$cod_personal = $_POST['cod_personal'];
	$fecha_cese = date('Y-m-d');

	$cod_motivo_cese = $_POST['cod_motivo_cese'];
	$query_delete = mysqli_query($conection, "UPDATE personal SET estado = 0, fecha_cese = '$fecha_cese', 
	cod_motivo_cese = '$cod_motivo_cese' WHERE cod_personal = $cod_personal");
	$query_update_usuario = mysqli_query($conection, "UPDATE usuario SET estado = 0 WHERE cod_personal = $cod_personal ");
	mysqli_close($conection);
	if ($query_delete) {
		header("location: ../Vista/Gestion_Empleados.php");
	} else {
		$error = mysqli_error($conection);
		$alert = '<p class="msg_error">Error al dar de baja al cliente: ' . $error . '</p>';
	}
}

if (empty($_REQUEST['id']) || $_REQUEST['id'] == 1) {
	header("location: ../Vista/Gestion_Empleados.php");
	mysqli_close($conection);
} else {

	$cod_personal = $_REQUEST['id'];

	$query = mysqli_query($conection, "SELECT p.nombres,p.fecha_ingreso,p.sueldo,tp.descripcion as cod_puesto
												FROM personal p
												inner join tipo_puesto tp on p.cod_puesto = tp.cod_puesto
												WHERE cod_personal = $cod_personal ");

	mysqli_close($conection);
	$result = mysqli_num_rows($query);

	if ($result > 0) {
		while ($data = mysqli_fetch_array($query)) {
			$nombres = $data['nombres'];
			$fecha_ingreso = $data['fecha_ingreso'];
			$sueldo = $data['sueldo'];
			$cod_puesto = $data['cod_puesto'];
		}
	} else {
		header("location: ../Vista/Gestion_Empleados.php");
	}
}
