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
        if (isset($_POST['regresar'])) {
            header('location: ../Vista/Check_In.php');
		    mysqli_close($conection);
        }
        if (isset($_POST['confirmar'])) {
            $alert='';
            $idreserva 	= $_POST['idreserva'];
            $idhabitacion = $_POST['idhabitacion'];
            $idusuario = $_POST['idusuario'];
            /*$query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario = '$user' OR correo = '$email' ");
            $result = mysqli_fetch_array($query);
    
            if($result > 0){
                $alert='<p class="msg_error">El correo o el usuario ya existe.</p>';
            }else{*/
            $query_confirmar = mysqli_query($conection,"UPDATE reserva SET estatus = 1,
                                        idusuario= $idusuario
                                        WHERE idreserva = $idreserva ");
            $query_confirmar2 = mysqli_query($conection,"UPDATE habitacion SET estatus = 1 
                            WHERE idhabitacion = $idhabitacion ");               
            if($query_confirmar & $query_confirmar2){
                $alert='<p class="msg_save">Licencia realizada.</p>';
            }else{
                $alert='<p class="msg_error">Error al realizar licencia.</p>';
            }
        
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
		header('location: ../Vista/Recepcion.php');
		mysqli_close($conection);
	}
	$idhabitacion= $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT h.idhabitacion,h.num_habitacion,h.descripcion,
                        h.precio,(h.estatus) AS estado_habitacion,c.idcliente,c.dni,c.nombre,c.telefono,
                        c.domicilio,c.correo,th.nombre_tipo,r.idreserva,r.fecha_ingreso,
                        r.hora_ingreso,r.fecha_salida,r.hora_salida,r.cant_noches,
                        (r.estatus) AS estado_reserva
                        FROM habitacion h
                        INNER JOIN reserva r ON(h.idhabitacion=r.idhabitacion)
                        INNER JOIN cliente  c ON(r.idcliente=c.idcliente)
                        INNER JOIN tipohabitacion th ON(h.idtipohabitacion=th.idtipohabitacion)
                        WHERE h.idhabitacion='$idhabitacion'");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		
	}else{
		//$option = '';
		while ($data = mysqli_fetch_array($sql)) {
			$idhabitacion       = $data['idhabitacion'];
            $idcliente          = $data['idcliente'];
            $idreserva          = $data['idreserva'];
			$numero             = $data['num_habitacion'];
			$descripcion        = $data['descripcion'];
			$precio             = $data['precio'];
			$tipo               = $data['nombre_tipo'];
            $estado_habitacion  = $data['estado_habitacion'];
            $dni                = $data['dni'];
            $nombre             = $data['nombre'];
            $telefono           = $data['telefono'];
            $domicilio          = $data['domicilio'];
            $correo             = $data['correo'];
            $fecha_ingreso      =$data['fecha_ingreso'];
            $hora_ingreso       =$data['hora_ingreso'];
            $fecha_salida       =$data['fecha_salida'];
            $hora_salida        =$data['hora_salida'];
            $cant_noches        =$data['cant_noches'];
		
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