<?php session_start();
function location(){return header("location: ../Vista/Gestion_Usuario.php");}
if ($_SESSION['rol'] != 1) {location();}
include_once "../Modelo/conexion.php";
if (!empty($_POST)) {
	if ($_POST['cod_usuario'] == 1) {
		location();
		mysqli_close($conection);
		exit;
	}
	$cod_usuario = $_POST['cod_usuario'];
	$query_delete = mysqli_query($conection, "UPDATE usuario SET estado = 0 WHERE cod_usuario = $cod_usuario ");
	mysqli_close($conection);
	if ($query_delete) {
		location();
	} else {
		echo "Error al eliminar Usuario";
	}
}
if (empty($_REQUEST['id']) || $_REQUEST['id'] == 1) {
	location();
	mysqli_close($conection);
} else {
	$cod_usuario = $_REQUEST['id'];
	$query = mysqli_query($conection, "SELECT u.usuario,r.rol FROM usuario u INNER JOIN tipo_rol r ON u.id_rol = r.id_rol
												WHERE u.cod_usuario = $cod_usuario ");
	mysqli_close($conection);
	$result = mysqli_num_rows($query);
	if ($result > 0) {
		while ($data = mysqli_fetch_array($query)) {
			$usuario = $data['usuario'];
			$rol     = $data['rol'];
		}
	} else {
		location();
	}
}
