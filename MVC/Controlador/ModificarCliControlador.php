<?php 
	session_start();

	include "../Modelo/conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombres']) || empty($_POST['correo']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$cod_personal 	= $_POST['cod_personal'];
			$dni 		= $_POST['dni'];
			$nombres 	= $_POST['nombres'];
			$edad 		= $_POST['edad'];
			$correo  	= $_POST['correo'];
			$telefono 	= $_POST['telefono'];
			$direccion 	= $_POST['direccion'];


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
					$alert='<p class="msg_save">Daatos del empleado actualizados correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar datos del empleado.</p>';
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
	$cod_personal = $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT cod_personal,dni,nombres,edad,telefono,direccion,correo
                                    FROM personal
									WHERE cod_personal= '$cod_personal'");
	
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header("location: ../Vista/Clientes.php");
	}else{
		$option = '';
		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$cod_personal  = $data['cod_personal'];
			$dni 		= $data['dni'];
			$nombres 	= $data['nombres'];
			$edad 		= $data['edad'];
			$telefono 	= $data['telefono'];
			$direccion 	= $data['direccion'];
			$correo  	= $data['correo'];
		}
	}

 ?>