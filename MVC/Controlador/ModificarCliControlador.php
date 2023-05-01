<?php 
	session_start();

	include "../Modelo/conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$idcliente 	= $_POST['idcliente'];
			$dni 		= $_POST['dni'];
			$nombre 	= $_POST['nombre'];
			$edad 		= $_POST['edad'];
			$correo  	= $_POST['correo'];
			$telefono 	= $_POST['telefono'];
			$domicilio 	= $_POST['domicilio'];
        	$usuario   	= $_POST['usuario'];
			$clave  	= md5($_POST['clave']);


			$query = mysqli_query($conection,"SELECT * FROM cliente
											WHERE (usuario_cli = '$usuario' AND idcliente != $idcliente)
											OR (correo = '$correo' AND idcliente != $idcliente) ");
			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert='<p class="msg_error">El correo o el usuario ya existe.</p>';
			}else{

				if(empty($_POST['clave']))
				{

					$sql_update = mysqli_query($conection,"UPDATE cliente
												SET dni =$dni,nombre = '$nombre',edad = '$edad',correo='$correo',
												telefono = '$telefono',domicilio = '$domicilio',usuario_cli='$usuario'
												WHERE idcliente= $idcliente ");
				}else{
					$sql_update = mysqli_query($conection,"UPDATE cliente
												SET dni = $dni,nombre = '$nombre',edad = '$edad',correo='$correo',
												telefono = '$telefono',domicilio = '$domicilio',usuario_cli='$usuario',
												clave_cli='$clave'
												WHERE idcliente= $idcliente ");

				}

				if($sql_update){
					$alert='<p class="msg_save">Usuario actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el usuario.</p>';
				}

			}


		}

	}

	//Mostrar Datos
	if(empty($_REQUEST['id']))
	{
		header("location: ../Vista/Clientes.php");
		mysqli_close($conection);
	}
	$idcliente = $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT idcliente,dni,nombre,edad,telefono,domicilio,correo,usuario_cli,clave_cli 
                                    FROM cliente
									WHERE idcliente= '$idcliente'");
	
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header("location: ../Vista/Clientes.php");
	}else{
		$option = '';
		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$idcliente  = $data['idcliente'];
			$dni 		= $data['dni'];
			$nombre 	= $data['nombre'];
			$edad 		= $data['edad'];
			$telefono 	= $data['telefono'];
			$domicilio 	= $data['domicilio'];
			$correo  	= $data['correo'];
        	$usuario   	= $data['usuario_cli'];
			$clave   	= $data['clave_cli'];
            
		}
	}

 ?>