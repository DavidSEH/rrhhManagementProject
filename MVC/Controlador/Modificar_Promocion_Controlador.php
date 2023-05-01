<?php 
	session_start();
	if($_SESSION['rol'] != 1)
	{
        header("location: ../Vista/Habitacion.php");
	}

	include "../Modelo/conexion.php";
    //Mostrar Datos
	if(empty($_REQUEST['id']))
	{
		header("location: ../Vista/Gestion_Promocion.php");
		mysqli_close($conection);
	}
	$id_promocion = $_REQUEST['id'];

	$sql_promocion= mysqli_query($conection,"SELECT idpromocion,p.idtipohabitacion,fecha_inicio,fecha_fin,porcentaje,p.estado,
                        descripcion,th.nombre_tipo
                        FROM promocion p
                        INNER JOIN tipohabitacion th ON (th.idtipohabitacion= p.idtipohabitacion)
						WHERE idpromocion= $id_promocion ");
	
	$result_sql = mysqli_num_rows($sql_promocion);

	if($result_sql == 0){
		//header("location: ../Vista/Habitacion.php");
	}else{
		$option = '';
		while ($data = mysqli_fetch_array($sql_promocion)) {

			$idpromocion  	= $data['idpromocion'];
			$fecha_inicio 		= $data['fecha_inicio'];
			$fecha_fin 	= $data['fecha_fin'];
			$porcentaje  			= $data['porcentaje'];
			$descripcion 		= $data['descripcion'];
			$idtipohabitacion   		= $data['idtipohabitacion'];
			$nombre_tipo   		= $data['nombre_tipo'];

			
			$option = '<option value="'.$idtipohabitacion.'" select>'.$nombre_tipo.'</option>';
			

            
		}
	}
 
	if(!empty($_POST)){
		$alert='';
		if (isset($_POST['btn_Modificar'])) {

			if(empty($_POST['idpromocion'])  || empty($_POST['fecha_fin'])  
			|| empty($_POST['id_tipohabitacion'])|| empty($_POST['porcentaje'])){

				$alert = '<div class="alertError">Todos los campos son obligatorios</div>';
			}else{

				$idpromocion 			= $_POST['idpromocion'];
				$fecha_fin  			= $_POST['fecha_fin'];
				$porcentaje 			= $_POST['porcentaje'];
				$descripcion 			= $_POST['descripcion'];
				$id_tipohabitacion 		= $_POST['id_tipohabitacion'];

					
				$sql_update = mysqli_query($conection,"UPDATE promocion
							SET idtipohabitacion = '$id_tipohabitacion',
							fecha_fin = '$fecha_fin',porcentaje='$porcentaje',descripcion = '$descripcion'
							WHERE idpromocion= '$idpromocion' ");
				if($sql_update){
					$alert = '<div class="alertSave">!Actualizado con Exito!  </div>';
				}else{
					$alert = '<div class="alertError"></div>';
				}

			}


		}
		  

	}
		
		

	

	

 ?>