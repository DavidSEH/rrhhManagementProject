<?php 
	include "../Modelo/conexion.php";
    //Mostrar Datos
	if(empty($_REQUEST['id']))
	{
		header("location: ../Vista/ListaReservasCliente.php");
		mysqli_close($conection);
	}
	$id_reserva = $_REQUEST['id'];

	$sql_promocion= mysqli_query($conection,"SELECT r.idreserva,r.idhabitacion,r.fecha_ingreso,
					r.hora_ingreso,r.fecha_salida,r.hora_salida,r.cant_noches,r.adelantado, 
					h.num_habitacion 
					FROM reserva r
					INNER JOIN habitacion h ON (h.idhabitacion=r.idhabitacion)
					WHERE r.idreserva='$id_reserva'");
	
	$result_sql = mysqli_num_rows($sql_promocion);

	if($result_sql == 0){
		//header("location: ../Vista/ListaReservasCliente.php");
	}else{
		$option = '';
		while ($data = mysqli_fetch_array($sql_promocion)) {

			$idreserva  		= $data['idreserva'];
			$idhabitacion 		= $data['idhabitacion']; 	
			$fecha_ingreso 		= $data['fecha_ingreso'];
			$hora_ingreso  		= $data['hora_ingreso'];
			$fecha_salida 		= $data['fecha_salida'];
			$hora_salida   		= $data['hora_salida'];
			$cant_noches   		= $data['cant_noches'];
			$adelantado   		= $data['adelantado'];
			$num_habitacion   	= $data['num_habitacion'];

			
			$option = '<option value="'.$idhabitacion.'" select>'.$num_habitacion.'</option>';

		}
	}
 
	if(!empty($_POST)){
		$alert='';
		if (isset($_POST['btn_Modificar'])) {

			if(empty($_POST['idreserva'])  || empty($_POST['fecha_salida'])  
			|| empty($_POST['hora_salida'])|| empty($_POST['cant_noches'])){

				$alert = '<div class="alertError">Campos vacios</div>';
			}else{

				$idreserva 				= $_POST['idreserva'];
                $fecha_ingreso  		= $_POST['fecha_ingreso'];
				$hora_ingreso 			= $_POST['hora_ingreso'];
				$fecha_salida  			= $_POST['fecha_salida'];
				$hora_salida 			= $_POST['hora_salida'];
				$cant_noches 			= $_POST['cant_noches'];
				
				$sql_update = mysqli_query($conection,"UPDATE reserva SET 
						fecha_ingreso = '$fecha_ingreso',hora_ingreso='$hora_ingreso',
                        fecha_salida = '$fecha_salida',hora_salida='$hora_salida',cant_noches = '$cant_noches'
						WHERE idreserva= '$idreserva' ");
				if($sql_update ){
					$alert = '<div class="alertSave">!Actualizado con Exito!  </div>';
				}else{
					$alert = '<div class="alertError">Error</div>';
				}
				
			}


		}
		  

	}
		
		

	

	

 ?>