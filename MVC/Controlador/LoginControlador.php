<?php
$alert = '';
session_start();
if(!empty($_SESSION['active']))
{
    header('location: ../Vista/MenuUsuario.php');
}else{

    if(!empty($_POST))
    {
        if(empty($_POST['usuario']) || empty($_POST['clave']))
        {
            $alert = '<div class="alertLogin">Ingrese su usuario y su clave</div>';
        }else{

            require_once "../Modelo/conexion.php";
            $msg='';
            $user = mysqli_real_escape_string($conection,$_POST['usuario']);
            $pass = md5(mysqli_real_escape_string($conection,$_POST['clave']));

            $query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario= '$user' 
            AND clave = '$pass'");
            mysqli_close($conection);
            $result = mysqli_num_rows($query);

            if($result > 0)
            {
                $data = mysqli_fetch_array($query);
                $_SESSION['active']         = true;
                $_SESSION['idUser']         = $data['idusuario'];
                $_SESSION['nombre']         = $data['nombre'];
                $_SESSION['email']          = $data['correo'];
                $_SESSION['telefono']       = $data['telefono'];
                $_SESSION['domicilio']       = $data['domicilio'];
                $_SESSION['informacion']       = $data['informacion'];
                $_SESSION['user']           = $data['usuario'];
                $_SESSION['clave']          = $data['clave'];
                $_SESSION['rol']            = $data['rol'];



                header('location: MenuUsuario.php');
            }else{
                $alert = '<div class="alertLogin">El usuario o clave son incorrectos</div>';
                session_destroy();
            }


        }

    }
}


?>