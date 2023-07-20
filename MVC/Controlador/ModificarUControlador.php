<?php
session_start();
if ($_SESSION['rol'] != 1) {
	header("location: ../Vista/Usuario.php");
}
include_once "../Modelo/conexion.php";
if (!empty($_POST)) {
	$alert = '';
	if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario'])  || empty($_POST['rol'])) {
		$alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
	} else {

		$cod_usuario 	= $_POST['cod_usuario'];
		$dni 		= $_POST['dni'];
		$nombre 	= $_POST['nombre'];
		$edad 		= $_POST['edad'];
		$correo  	= $_POST['correo'];
		$telefono 	= $_POST['telefono'];
		$domicilio 	= $_POST['domicilio'];
		$usuario   	= $_POST['usuario'];
		$clave  	= md5($_POST['clave']);
		$rol    	= $_POST['rol'];
		$query = mysqli_query($conection, "SELECT * FROM usuario WHERE (usuario = '$usuario' AND cod_usuario != $cod_usuario)
											OR (correo = '$correo' AND cod_usuario != $cod_usuario)");
		$result = mysqli_fetch_array($query);

		if ($result > 0) {
			$alert = '<p class="msg_error">El correo o el usuario ya existe.</p>';
		} else {
			if (empty($_POST['clave'])) {

				$sql_update = mysqli_query($conection, "UPDATE usuario
												SET dni = '$dni',nombre = '$nombre',edad = '$edad',correo='$correo',
												telefono = '$telefono',domicilio = '$domicilio',usuario='$usuario',rol='$rol' WHERE cod_usuario= $cod_usuario ");
			} else {
				$sql_update = mysqli_query($conection, "UPDATE usuario
												SET dni = '$dni',nombre = '$nombre',edad = '$edad',correo='$correo',
												telefono = '$telefono',domicilio = '$domicilio',usuario='$usuario',
												clave='$clave', rol='$rol' WHERE cod_usuario= $cod_usuario ");
			}
			if ($sql_update) {
				$alert = '<p class="msg_save">Usuario actualizado correctamente.</p>';
			} else {
				$alert = '<p class="msg_error">Error al actualizar el usuario.</p>';
			}
		}
	}
}

//Mostrar Datos
if (empty($_REQUEST['id'])) {
	header("location: ../Vista/Gestion_Usuario.php");
	mysqli_close($conection);
}
$cod_usuario = $_REQUEST['id'];

$sql = mysqli_query($conection, "SELECT u.usuario,r.rol
	FROM usuario u
	INNER JOIN tipo_rol r ON u.id_rol = r.id_rol
	WHERE u.cod_usuario = $cod_usuario ");

$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
	header("location: ../Vista/Gestion_Usuario.php");
} else {
	$option = '';
	while ($data = mysqli_fetch_array($sql)) {
		$usuario   	= $data['usuario'];
		$rol     	= $data['rol'];
	}
}
