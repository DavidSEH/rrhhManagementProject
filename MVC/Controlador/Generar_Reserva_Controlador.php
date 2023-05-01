<?php 
	session_start();
	include "../Modelo/conexion.php";
	//Mostrar Datos
	$alert='';
	$msg2='';
	$msg3='';
	if(empty($_REQUEST['id']))
	{
		header('location: ../Vista/Chek_In.php');
		mysqli_close($conection);
	}else{

		$idhabitacion= $_REQUEST['id'];
		
		$sql= mysqli_query($conection,"SELECT h.idhabitacion,h.num_habitacion,h.descripcion,
                        h.precio,(h.estatus) AS estado_habitacion,th.nombre_tipo
                        FROM habitacion h
                        INNER JOIN tipohabitacion th ON(h.idtipohabitacion=th.idtipohabitacion)
                        WHERE h.idhabitacion='$idhabitacion'");
						
		$result_sql = mysqli_num_rows($sql);
		
		if($result_sql == 0){
		}else{
			while ($data = mysqli_fetch_array($sql)) {
				$idhabitacion       = $data['idhabitacion'];
				$numero             = $data['num_habitacion'];
				$descripcion        = $data['descripcion'];
				$precio             = $data['precio'];
				$estado_habitacion  = $data['estado_habitacion'];
				$tipo  = $data['nombre_tipo'];
			
				if($estado_habitacion == 0){
					$result = '<p class="msg_reser">Reservado</p>';
				}else if($estado_habitacion == 1){
					$result = '<p class="msg_disp">Disponible</p>';	
				}else if($estado_habitacion == 2){
					$result = '<p class="msg_ocup">Ocupado</p>';
				}
			}
		}
		/*Query Promocion*/ 
		$sql_promocion =mysqli_query($conection,"SELECT p.idpromocion FROM habitacion h
					INNER JOIN tipohabitacion th ON (th.idtipohabitacion=h.idtipohabitacion)
					INNER JOIN promocion p ON (p.idtipohabitacion=th.idtipohabitacion)
					WHERE h.idhabitacion='$idhabitacion' AND p.estado=1"); 

		$result_sql_promocion = mysqli_num_rows($sql_promocion);

		if($result_sql_promocion == 0){
			$msg3='';
		}else{
			$msg3='<p class="msg_promo"><i class="fas fa-percentage"></i> Promocion</p>';
			while ($data_promo = mysqli_fetch_array($sql_promocion)){
				$idpromocion       = $data_promo['idpromocion'];
			}
		}
	}
	if(!empty($_POST)){

        if (isset($_POST['regresar'])) {
            header('location: ../Vista/Check_In.php');
		    mysqli_close($conection);
        }
		if (isset($_POST['btnBuscar'])) {
			if (empty($_POST['busqueda'])) {
				$alert='<div class="alertError">Ingrese N° DNI</div>';
			}else{
				$busqueda 	= $_POST['busqueda'];
				$query_busqueda=mysqli_query($conection,"SELECT * FROM cliente WHERE dni='$busqueda'");
				$result_busqueda=mysqli_num_rows($query_busqueda);
				if ($result_busqueda==0) {
					$alert='<div class="alertError">Empleado no Registrado</div>';
					$msg2='<a href="NuevoCliente.php">Nuevo Empleado</a>';
				}else{
					if ($query_busqueda) {
						while ($data2=mysqli_fetch_array($query_busqueda)) {
						$idcliente		= $data2['idcliente'];
						$dni			= $data2['dni'];
						$nombre			= $data2['nombre'];
						$domicilio		= $data2['domicilio'];
						$telefono_cli		= $data2['telefono'];
						$correo			= $data2['correo'];
						}
					}else{
					}
				}
			}
		    
        }
        if (isset($_POST['btnGenerar'])) {
            
            $idhabitacion 	= $_POST['idhabitacion'];
        	$idcliente 		= $_POST['idcliente'];
			$idusuario 		= $_POST['idusuario'];
			$idpromocion 	= $_POST['idpromocion'];
        	$fechain    	= $_POST['fechain'];
			$horain    		= $_POST['horain'];
			$fechasal    	= $_POST['fechasal'];
			$horasal    	= $_POST['horasal'];
			$cant   		= $_POST['cant'];
			$adelantado		= $_POST['adelantado'];
            
			if (empty($idpromocion)){
				$query_insert = mysqli_query($conection,
								"INSERT INTO reserva(idhabitacion,idcliente,idusuario,fecha_ingreso,hora_ingreso,fecha_salida,hora_salida,cant_noches,adelantado,estatus)
								VALUES ($idhabitacion,$idcliente,$idusuario,'$fechain','$horain','$fechasal','$horasal',$cant,$adelantado,'2')");
				$query_update = mysqli_query($conection,"UPDATE habitacion SET estatus = 2 
								WHERE idhabitacion = $idhabitacion ");               
				if($query_insert & $query_update){
					$alert='<div class="alertSave">Licencia realizada</div>';
				}else{
					$alert='<div class="alertError">Error al generar licencia.</div>';
				}
			}else{
				
				$query_insert = mysqli_query($conection,
								"INSERT INTO reserva(idhabitacion,idcliente,idusuario,idpromocion,fecha_ingreso,hora_ingreso,fecha_salida,hora_salida,cant_noches,adelantado,estatus)
								VALUES ($idhabitacion,$idcliente,$idusuario,$idpromocion,'$fechain','$horain','$fechasal','$horasal',$cant,$adelantado,'2')");
				$query_update = mysqli_query($conection,"UPDATE habitacion SET estatus = 2 
								WHERE idhabitacion = $idhabitacion ");               
				if($query_insert & $query_update){
					$alert='<div class="alertSave">Licencia realizada</div>';
				}else{
					$alert='<div class="alertError">Error al generar licencia.</div>';
				}
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
