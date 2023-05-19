<?php
include "../Modelo/conexion.php";
if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else {

        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $edad = $_POST['edad'];
        $correo  = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $domicilio = $_POST['domicilio'];
        $fecha_ingreso = $_POST['fecha_ingreso'];
        //$puesto_trabajo = $_POST['puesto_trabajo'];
        $user   = $_POST['usuario'];
        $clave  = md5($_POST['clave']);
        $idusuario  = $_POST['idusuario'];

        $query = mysqli_query($conection, "SELECT * FROM cliente WHERE usuario_cli = '$user' OR correo = '$correo' ");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<p class="msg_error">El correo o el usuario ya existe.</p>';
        } else {

            $query_insert = mysqli_query(
                $conection,
                "INSERT INTO cliente(dni,nombre,edad,correo,telefono,domicilio,fecha_ingreso,/* puesto_trabajo,*/usuario_cli,clave_cli,idusuario)
                                         VALUES('$dni','$nombre','$edad','$correo','$telefono',
                                         '$domicilio','$fecha_ingreso',/*'$puesto_trabajo',*/'$user','$clave','$idusuario')"
            );
            if ($query_insert) {
                $alert = '<p class="msg_save">Usuario creado correctamente.</p>';
            } else {
                $alert = '<p class="msg_error">$alert</p>';
            }
        }
    }
}
