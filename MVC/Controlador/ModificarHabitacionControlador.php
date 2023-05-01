<?php 
	session_start();
	if($_SESSION['rol'] != 1)
	{
        header("location: ../Vista/Habitacion.php");
	}

	include "../Modelo/conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['piso']) || empty($_POST['precio'])  
			|| empty($_POST['descripcion']) || empty($_POST['categoria']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$idhabitacion 	= $_POST['idhabitacion'];
			$nombre 		= $_POST['nombre'];
			$piso  			= $_POST['piso'];
			$precio 		= $_POST['precio'];
			$descripcion 	= $_POST['descripcion'];
			$categoria 		= $_POST['categoria'];



			$query = mysqli_query($conection,"SELECT * FROM habitacion
								WHERE (num_habitacion = '$nombre' AND idhabitacion != $idhabitacion)");
			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert='<p class="msg_error">El numero de habitación ya existe </p>';
			}else{

				
				$sql_update = mysqli_query($conection,"UPDATE habitacion
										SET num_habitacion = '$nombre',idtipohabitacion = '$categoria',
										descripcion = '$descripcion',piso='$piso',precio = '$precio'
										WHERE idhabitacion= $idhabitacion ");

				

				if($sql_update){
					$alert='<p class="msg_save">Habitacion actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar la Habitación.</p>';
				}

			}


		}

	}

	//Mostrar Datos
	if(empty($_REQUEST['id']))
	{
		header("location: ../Vista/Habitacion.php");
		mysqli_close($conection);
	}
	$idhabitacion = $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT h.idhabitacion,(h.num_habitacion)AS nombre,
						(h.idtipohabitacion)AS idtipo,h.descripcion,h.piso,h.precio,
						(th.nombre_tipo)AS categoria
						FROM habitacion h
						INNER JOIN tipohabitacion th ON(h.idtipohabitacion=th.idtipohabitacion)
						WHERE idhabitacion= '$idhabitacion' ");
	
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header("location: ../Vista/Habitacion.php");
	}else{
		$option = '';
		while ($data = mysqli_fetch_array($sql)) {

			$idhabitacion  	= $data['idhabitacion'];
			$nombre 		= $data['nombre'];
			$descripcion 	= $data['descripcion'];
			$piso  			= $data['piso'];
			$precio 		= $data['precio'];
			$idtipo   		= $data['idtipo'];
			$categoria     	= $data['categoria'];

			if($idtipo  == 1){
				$option = '<option value="'.$idtipo.'" select>'.$categoria.'</option>';
			}else if($idtipo  == 2){
				$option = '<option value="'.$idtipo.'" select>'.$categoria.'</option>';	
			}else if($idtipo  == 3){
				$option = '<option value="'.$idtipo.'" select>'.$categoria.'</option>';
			}

            
		}
	}

 ?>