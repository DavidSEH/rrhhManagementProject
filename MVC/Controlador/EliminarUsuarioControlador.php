
<?php 
	session_start();
	/*if($_SESSION['rol'] != 1)
	{
		header("location: ../Vista/Usuario.hp");
	}*/
	include "../Modelo/conexion.php";

	if(!empty($_POST))
	{
		if($_POST['cod_usuario'] == 1){
			header("location: ../Vista/Usuarios.php");
			mysqli_close($conection);
			exit;
		}
		$cod_usuario = $_POST['cod_usuario'];
		$query_delete = mysqli_query($conection,"UPDATE usuario SET estado = 0 
										WHERE cod_usuario = $cod_usuario ");
		mysqli_close($conection);
		if($query_delete){
			header("location: ../Vista/Gestion_Usuario.php");
		}else{
			echo "Error al eliminar Usuario";
		}

	}

	if(empty($_REQUEST['id']) || $_REQUEST['id'] == 1 )
	{
		/*header("location: ../Vista/Usuario.php");
		mysqli_close($conection);*/
	}else{

		$cod_usuario = $_REQUEST['id'];

		$query = mysqli_query($conection,"SELECT u.usuario,r.rol
												FROM usuario u
												INNER JOIN tipo_rol r ON u.id_rol = r.id_rol
												WHERE u.cod_usuario = $cod_usuario ");
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				
				$usuario = $data['usuario'];
				$rol     = $data['rol'];
			}
		}else{
			header("location: ../Vista/Usuario.php");
		}


	}


 ?>