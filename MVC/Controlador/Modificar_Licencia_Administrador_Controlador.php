<?php
session_start();

include_once "../Modelo/conexion.php";
//Mostrar Datos
if (empty($_REQUEST['id'])) {
	header("location: ../Vista/Gestion_Licencias.php");
	mysqli_close($conection);
}
$cod_licencia = $_REQUEST['id'];

$sql = mysqli_query($conection, "SELECT l.cod_licencia,t.nom_licencia AS tipo, l.fecha_inicio, 
								l.fecha_fin, l.tipo, p.nombres, t.descripcion
                                 FROM licencia l
                                 INNER JOIN personal p ON l.cod_personal = p.cod_personal
                                 INNER JOIN tipo_licencia t ON l.tipo = t.cod_licencia
                                 WHERE l.cod_licencia = '$cod_licencia'");

$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
	header("location: ../Vista/Gestion_Licencias.php");
} else {
	while ($data = mysqli_fetch_array($sql)) {
		$fecha_inicio 		= $data['fecha_inicio'];
		$fecha_fin 		= $data['fecha_fin'];
		$tipo = $data['tipo'];
		$nombres =  $data['nombres'];
		$descripcion= $data['descripcion'];
	}
}

if (!empty($_POST)) {
	$alert = '';
	if (isset($_POST['btn_Modificar'])) {

		$cod_licencia 				= $_POST['cod_licencia'];
		$fecha_inicio         = $_POST['fecha_inicio'];
		$fecha_fin  			= $_POST['fecha_fin'];

		$sql_update = mysqli_query($conection, "UPDATE licencia
						SET fecha_inicio = '$fecha_inicio', fecha_fin = '$fecha_fin'
						WHERE cod_licencia= '$cod_licencia' ");
		if ($sql_update) {
			$alert = '<div class="alertSave">¡Licencia actualizada con éxito!</div>';
		} else {
			$error = mysqli_error($conection);
			$alert = '<p class="msg_error">Error al actualizar la licencia: ' . $error . '</p>';
		}
	}
	if (isset($_POST['btn_Estado'])) {

		$estado    	= $_POST['estado'];
		$comentario    	= $_POST['comentario'];
		$sql_update = mysqli_query($conection, "UPDATE licencia
						SET estado = '$estado', comentario = '$comentario'
						WHERE cod_licencia= '$cod_licencia' ");
		if ($sql_update) {
			$msg_print = '<div class="alertSave">¡Licencia gestionada con éxito!</div>';
		} else {
			$error = mysqli_error($conection);
			$msg_print = '<p class="msg_error">Error al gestionar la licencia: ' . $error . '</p>';
		}
	}
}

