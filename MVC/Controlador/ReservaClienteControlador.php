<?php 
	session_start();
	/*if($_SESSION['rol'] != 1)
	{
        header("location: ../Vista/Usuario.php");
	}
*/
	include "../Modelo/conexion.php";
	/*if(!empty($_POST))
	{
		/*if($_POST['idusuario'] == 1){
			header("location: ../Vista/Usuarios.php");
			mysqli_close($conection);
			exit;
		}
		$idhabitacion  = $_POST['idhabitacion'];

		//$query_delete = mysqli_query($conection,"DELETE FROM usuario WHERE idusuario =$idusuario ");
		$query_delete = mysqli_query($conection,"UPDATE habitacion SET estatus = 0 
										WHERE idhabitacion = $idhabitacion ");
		mysqli_close($conection);
		if($query_delete){
			header("location: ../Vista/ReservaCliente.php");
		}else{
			echo "Error al eliminar";
		}

	}*/
	if(!empty($_POST)){

    	$alert='';
        $idhabitacion 	= $_POST['idhabitacion'];
        $idcliente 		= $_POST['idcliente'];
        $fechain    	= $_POST['fechain'];
		$horain    		= $_POST['horain'];
		$fechasal    	= $_POST['fechasal'];
		$horasal    	= $_POST['horasal'];
		$cant   		= $_POST['cant'];
        /*$query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario = '$user' OR correo = '$email' ");
        $result = mysqli_fetch_array($query);

        if($result > 0){
            $alert='<p class="msg_error">El correo o el usuario ya existe.</p>';
        }else{*/

            $query_insert = mysqli_query($conection,
							"INSERT INTO reserva(idhabitacion,idcliente,fecha_ingreso,hora_ingreso,fecha_salida,hora_salida,cant_noches)
							VALUES ($idhabitacion,$idcliente,'$fechain','$horain','$fechasal','$horasal',$cant)");
            $query_delete = mysqli_query($conection,"UPDATE habitacion SET estatus = 1 
							WHERE idhabitacion = $idhabitacion ");
			if($query_insert & $query_delete){
                $alert='<p class="msg_save">!Su licencia ha sido generada!.</p>';
            }else{
                $alert='<p class="msg_error">Error al crear la licencia.</p>';
            }
	}
	
	/*if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario'])  || empty($_POST['rol']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$idUsuario = $_POST['idUsuario'];
			$nombre = $_POST['nombre'];
			$email  = $_POST['correo'];
			$user   = $_POST['usuario'];
			$clave  = md5($_POST['clave']);
			$rol    = $_POST['rol'];


			$query = mysqli_query($conection,"SELECT * FROM usuario 
													   WHERE (usuario = '$user' AND idusuario != $idUsuario)
													   OR (correo = '$email' AND idusuario != $idUsuario) ");

			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert='<p class="msg_error">El correo o el usuario ya existe.</p>';
			}else{

				if(empty($_POST['clave']))
				{

					$sql_update = mysqli_query($conection,"UPDATE usuario
															SET nombre = '$nombre', correo='$email',usuario='$user',rol='$rol'
															WHERE idusuario= $idUsuario ");
				}else{
					$sql_update = mysqli_query($conection,"UPDATE usuario
															SET nombre = '$nombre', correo='$email',usuario='$user',clave='$clave', rol='$rol'
															WHERE idusuario= $idUsuario ");

				}

				if($sql_update){
					$alert='<p class="msg_save">Usuario actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el usuario.</p>';
				}

			}
		}
	}*/
	//Mostrar Datos
	if(empty($_REQUEST['id']))
	{
		header("location: ../Vista/ReservaCliente.php");
		mysqli_close($conection);
	}
	$idhabitacion= $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT h.idhabitacion,(h.num_habitacion)as numero , h.descripcion, h.piso,h.precio,
                        (th.nombre_tipo)as tipo,h.estatus 
						FROM habitacion h 
                        INNER JOIN tipohabitacion th ON (h.idtipohabitacion = th.idtipohabitacion)
                        WHERE idhabitacion= $idhabitacion");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header("location: ../Vista/ReservaCliente.php");
	}else{
		//$option = '';
		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$idhabitacion   	= $data['idhabitacion'];
			$numero         	= $data['numero'];
			$descripcion    	= $data['descripcion'];
			$piso           	= $data['piso'];
			$precio         	= $data['precio'];
			$tipo           	= $data['tipo'];
			$estado_habitacion	= $data['estatus'];

			if($estado_habitacion == 0){
				$result = '<p class="msg_reser">Reservado</p>';
			}else if($estado_habitacion == 1){
				$result = '<p class="msg_disp">Disponible</p>';	
			}else if($estado_habitacion == 2){
				$result = '<p class="msg_ocup">Ocupado</p>';
			}   
		}
	}

 ?>