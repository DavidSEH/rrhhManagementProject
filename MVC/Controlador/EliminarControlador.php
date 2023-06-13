
<?php 
	session_start();
	if($_SESSION['rol'] != 1)
	{
		header("location: ../Vista/Usuario.hp");
	}
	include "../Modelo/conexion.php";

	if(!empty($_POST))
	{
		if($_POST['idusuario'] == 1){
			header("location: ../Vista/Usuarios.php");
			mysqli_close($conection);
			exit;
		}
		$idusuario = $_POST['idusuario'];

		//$query_delete = mysqli_query($conection,"DELETE FROM usuario WHERE idusuario =$idusuario ");
		$query_delete = mysqli_query($conection,"UPDATE usuario SET estatus = 0 
										WHERE idusuario = $idusuario ");
		mysqli_close($conection);
		if($query_delete){
			header("location: ../Vista/Gestion_Usuario.php");
		}else{
			echo "Error al eliminar Administrador";
		}

	}

	if(empty($_REQUEST['id']) || $_REQUEST['id'] == 1 )
	{
		header("location: ../Vista/Usuario.php");
		mysqli_close($conection);
	}else{

		$idusuario = $_REQUEST['id'];

		$query = mysqli_query($conection,"SELECT u.nombre,u.usuario,r.rol
												FROM usuario u
												INNER JOIN
												rol r
												ON u.rol = r.idrol
												WHERE u.idusuario = $idusuario ");
		
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				$nombre = $data['nombre'];
				$usuario = $data['usuario'];
				$rol     = $data['rol'];
			}
		}else{
			header("location: ../Vista/Usuario.php");
		}


	}


 ?>