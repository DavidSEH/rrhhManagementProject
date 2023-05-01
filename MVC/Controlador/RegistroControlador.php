<?php
include "../Modelo/conexion.php";
if(!empty($_POST))
{
    $alert='';
    if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['rol']))
    {
        $alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
    }else{

        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $edad = $_POST['edad'];
        $correo  = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $domicilio = $_POST['domicilio'];
        $user   = $_POST['usuario'];
        $clave  = md5($_POST['clave']);
        $rol    = $_POST['rol'];


        $query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario = '$user' OR correo = '$correo' ");
        $result = mysqli_fetch_array($query);

        if($result > 0){
            $alert='<p class="msg_error">El correo o el usuario ya existe.</p>';
        }else{

            $query_insert = mysqli_query($conection,
                                        "INSERT INTO usuario(dni,nombre,edad,correo,telefono,domicilio,usuario,clave,rol)
                                         VALUES('$dni','$nombre','$edad','$correo','$telefono',
                                         '$domicilio','$user','$clave','$rol')");
            if($query_insert){
                $alert='<p class="msg_save">Usuario creado correctamente.</p>';
            }else{
                $alert='<p class="msg_error">Error al crear el usuario.</p>';
            }

        }


    }

}

?>