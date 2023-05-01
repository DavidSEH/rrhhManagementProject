<?php
session_start();
include "../Modelo/conexion.php";
//Mostrar Datos
$alert = '';
$msg2 = '';
$msg3 = '';
if (!empty($_POST)) {

	if (isset($_POST['regresar'])) {
		header('location: ../Vista/MenuUsuario.php');
		mysqli_close($conection);
	}
	if (isset($_POST['btnBuscar'])) {
		if (empty($_POST['busqueda'])) {
			$alert = '<div class="alertError">Ingrese un N° DNI</div>';
		} else {
			$busqueda 	= $_POST['busqueda'];
			$query_busqueda = mysqli_query($conection, "SELECT * FROM cliente WHERE dni='$busqueda'");
			$result_busqueda = mysqli_num_rows($query_busqueda);
			if ($result_busqueda == 0) {
				$alert = '<div class="alertError">Empleado no Registrado</div>';
				$msg2 = '<a href="NuevoCliente.php">Nuevo Empleado</a>';
			} else {
				if ($query_busqueda) {
					while ($data2 = mysqli_fetch_array($query_busqueda)) {
						$idcliente		= $data2['idcliente'];
						$dni			= $data2['dni'];
						$nombre			= $data2['nombre'];
					}
				} else {
				}
			}
		}
	}
	if (isset($_POST['btnGenerar'])) {
		$idusuario 		= $_POST['idusuario'];
		//$idsasistencia	= $_POST['idasistencia'];
		$idcliente 		= $_POST['idcliente'];
		$fechain    	= $_POST['fechain'];
		$horain    		= $_POST['horain'];
		$fechasal    	= $_POST['fechasal'];
		$horasal    	= $_POST['horasal'];

		$query_insert = mysqli_query(
			$conection,
			"INSERT INTO asistencia(idcliente,idusuario,fecha_ingreso,hora_ingreso,fecha_salida,hora_salida,estatus)
								VALUES ('$idcliente','$idusuario','$fechain','$horain','$fechasal','$horasal','1')"
		);
		if ($query_insert) {
			$alert = '<div class="alertSave">Asistencia registrada</div>';
		} else {
			$alert = '<div class="alertError">Error al registrar la asistencia.</div>';
		}
	}
}
