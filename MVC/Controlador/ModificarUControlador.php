<?php 
	session_start();
	if($_SESSION['rol'] != 1)
	{
        header("location: ../Vista/Usuario.php");
	}

	include "../Modelo/conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario'])  || empty($_POST['rol']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$idUsuario 	= $_POST['idUsuario'];
			$dni 		= $_POST['dni'];
			$nombre 	= $_POST['nombre'];
			$edad 		= $_POST['edad'];
			$correo  	= $_POST['correo'];
			$telefono 	= $_POST['telefono'];
			$domicilio 	= $_POST['domicilio'];
        	$usuario   	= $_POST['usuario'];
			$clave  	= md5($_POST['clave']);
			$rol    	= $_POST['rol'];


			$query = mysqli_query($conection,"SELECT * FROM usuario 
											WHERE (usuario = '$usuario' AND idusuario != $idUsuario)
											OR (correo = '$correo' AND idusuario != $idUsuario) ");
			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert='<p class="msg_error">El correo o el usuario ya existe.</p>';
			}else{

				if(empty($_POST['clave']))
				{

					$sql_update = mysqli_query($conection,"UPDATE usuario
												SET dni = '$dni',nombre = '$nombre',edad = '$edad',correo='$correo',
												telefono = '$telefono',domicilio = '$domicilio',usuario='$usuario',rol='$rol'
												WHERE idusuario= $idUsuario ");
				}else{
					$sql_update = mysqli_query($conection,"UPDATE usuario
												SET dni = '$dni',nombre = '$nombre',edad = '$edad',correo='$correo',
												telefono = '$telefono',domicilio = '$domicilio',usuario='$usuario',
												clave='$clave', rol='$rol'
												WHERE idusuario= $idUsuario ");

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
		header("location: ../Vista/Usuario.php");
		mysqli_close($conection);
	}
	$idusuario = $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT u.idusuario,u.dni,u.nombre,u.edad,u.correo,u.telefono,u.domicilio,
									u.usuario, (u.rol) as idrol, 
									(r.rol) as rol
									FROM usuario u
									INNER JOIN rol r
									on u.rol = r.idrol
									WHERE idusuario= $idusuario ");
	
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header("location: ../Vista/Usuario.php");
	}else{
		$option = '';
		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$idusuario  = $data['idusuario'];
			$dni 		= $data['dni'];
			$nombre 	= $data['nombre'];
			$edad 		= $data['edad'];
			$correo  	= $data['correo'];
			$telefono 	= $data['telefono'];
			$domicilio 	= $data['domicilio'];
        	$usuario   	= $data['usuario'];
			$idrol   	= $data['idrol'];
			$rol     	= $data['rol'];

			if($idrol == 1){
				$option = '<option value="'.$idrol.'" select>'.$rol.'</option>';
			}else if($idrol == 2){
				$option = '<option value="'.$idrol.'" select>'.$rol.'</option>';	
			}else if($idrol == 3){
				$option = '<option value="'.$idrol.'" select>'.$rol.'</option>';
			}

            
		}
	}

 ?>