
<?php
session_start();
if ($_SESSION['rol'] != 1) {
	//header("location: ../Vista/cliente.php");
}
include "../Modelo/conexion.php";

if (!empty($_POST)) {
	$alert = '';
	if ($_POST['idcliente'] == 1) {
		header("location: ../Vista/usuarios.php");
		mysqli_close($conection);
		exit;
	}
	$idcliente = $_POST['idcliente'];
	$fecha_cese = date('Y-m-d');
	$motivo_cese = $_POST['motivo_cese'];


	$query_delete = mysqli_query($conection, "UPDATE cliente SET estatus = 0, fecha_cese = '$fecha_cese', motivo_cese = '1'
										WHERE idcliente = $idcliente ");
	mysqli_close($conection);
	if ($query_delete) {
		header("location: ../Vista/Gestion_Clientes.php");
	} else {
		$error = mysqli_error($conection);
		$alert = '<p class="msg_error">Error al dar de baja al cliente: ' . $error . '</p>';
	}
}

if (empty($_REQUEST['id']) || $_REQUEST['id'] == 1) {
	//header("location: ../Vista/cliente.php");
	//mysqli_close($conection);
} else {

	$idcliente = $_REQUEST['id'];

	$query = mysqli_query($conection, "SELECT nombre,fecha_ingreso,sueldo,puesto_trabajo
												FROM cliente 
												WHERE idcliente = $idcliente ");

	mysqli_close($conection);
	$result = mysqli_num_rows($query);

	if ($result > 0) {
		while ($data = mysqli_fetch_array($query)) {
			$nombre = $data['nombre'];
			$fecha_ingreso = $data['fecha_ingreso'];
			$sueldo = $data['sueldo'];
			$puesto_trabajo = $data['puesto_trabajo'];
		}
	} else {
		header("location: ../Vista/usuarios.php");
	}
}


?>