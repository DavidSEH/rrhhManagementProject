<?php
session_start();
include_once "../Modelo/conexion.php";
//Mostrar Datos
if (empty($_REQUEST['id'])) {
	header("location: ../Vista/LicenciasEmpleado.php");
	mysqli_close($conection);
}
$tipo_licencia = $_REQUEST['id'];
$sql = mysqli_query($conection, "SELECT nom_licencia, descripcion 
								FROM `tipo_licencia` WHERE cod_licencia = '$tipo_licencia' ");
$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
	header("location: ../Vista/LicenciasEmpleado.php");
	mysqli_close($conection);
} else {
	while ($data = mysqli_fetch_array($sql)) {
		$licencia_nombre             = $data['nom_licencia'];
		$licencia_detalle        = $data['descripcion'];
	}
}

if (!empty($_POST)) {
	$alert = '';
	$fechain    	= $_POST['fechain'];
	$fechasal    	= $_POST['fechasal'];
	$idusuario = $_POST['idusuario'];

	$query_registrar_licencia = "INSERT INTO licencia(tipo,cod_personal,fecha_inicio,fecha_fin,estado)
			VALUES ($tipo_licencia,$idusuario,'$fechain','$fechasal','1')";
	$query_insert = mysqli_query($conection, $query_registrar_licencia);

	if ($query_insert) {
		$alert = '<div class="alertSave">Licencia solicitada con éxito</div>';
	} else {
		$error = mysqli_error($conection);
		$alert = '<div class="alertError">Error al solicitar la licencia: ' . $error . '</div>';
	}
}
mysqli_close($conection);
