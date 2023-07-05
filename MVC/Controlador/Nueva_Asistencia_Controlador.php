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
	if (isset($_POST['btnBuscar'])) {
		if (empty($_POST['busqueda'])) {
			$alert = '<div class="alertError">Ingrese un N° DNI</div>';
		} else {
			$busqueda 	= $_POST['busqueda'];
			if (strlen($busqueda) == 8) {
				$query_busqueda = mysqli_query($conection, "SELECT * FROM personal WHERE dni='$busqueda'");
				$result_busqueda = mysqli_num_rows($query_busqueda);
				if ($result_busqueda == 0) {
					$alert = '<div class="alertError">Empleado no Registrado</div>';
					$msg2 = '<a href="NuevoCliente.php">Nuevo Empleado</a>';
				} else {
					if ($query_busqueda) {
						while ($data2 = mysqli_fetch_array($query_busqueda)) {
							$cod_personal		= $data2['cod_personal'];
							$dni			= $data2['dni'];
							$nombres			= $data2['nombres'];
						}
					}
				}
			} else {
				$alert = '<div class="alertError">Por favor, ingrese solo 8 digitos.</div>';
			}
		}
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
