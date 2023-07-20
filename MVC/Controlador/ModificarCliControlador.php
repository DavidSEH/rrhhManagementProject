<?php session_start();

include_once "../Modelo/conexion.php";

if (!empty($_POST)) {
	$alert = '';
	if (empty($_POST['nombres']) || empty($_POST['dni'])) {
		$alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
	} else {

		$cod_personal 	= $_POST['cod_personal'];
		$dni 		= $_POST['dni'];
		$nombres 	= $_POST['nombres'];
		$edad 		= $_POST['edad'];
		$correo  	= $_POST['correo'];
		$telefono 	= $_POST['telefonoo'];
		$direccion 	= $_POST['direccioon'];

		$sql_update = mysqli_query($conection, "UPDATE personal
												SET dni =$dni,nombres = '$nombres',edad = '$edad',correo='$correo',
												telefono = '$telefono',direccion = '$direccion'
												WHERE cod_personal= $cod_personal ");

		if ($sql_update) {
			$alert = '<p class="msg_save">Datos del empleado actualizados correctamente.</p>';
		} else {
			$alert = '<p class="msg_error">Error al actualizar datos del empleado.</p>';
		}
	}
}

//Mostrar Datos
if (empty($_REQUEST['id'])) {
	header("location: ../Vista/Gestion_Empleados.php");
	mysqli_close($conection);
}
$cod_personal = $_REQUEST['id'];

$sql = mysqli_query($conection, "SELECT cod_personal,dni,nombres,edad,telefono,direccion,correo
                                    FROM personal
									WHERE cod_personal= '$cod_personal'");

$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
	header("location: ../Vista/Gestion_Empleados.php");
} else {
	$option = '';
	while ($data = mysqli_fetch_array($sql)) {
		# code...
		$cod_personal  = $data['cod_personal'];
		$dni 		= $data['dni'];
		$nombres 	= $data['nombres'];
		$edad 		= $data['edad'];
		$telefonoo 	= $data['telefono'];
		$direccioon 	= $data['direccion'];
		$correo  	= $data['correo'];
	}
}
