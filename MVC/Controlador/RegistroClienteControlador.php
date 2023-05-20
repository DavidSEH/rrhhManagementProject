<?php
include "../Modelo/conexion.php";

if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nombre']) || empty($_POST['correo'])|| empty($_POST['dni'])) {
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
        //$idusuario  = $_POST['idusuario'];

        // Verificar si ya existe un cliente con el mismo DNI
        $query_dni = mysqli_query($conection, "SELECT * FROM cliente WHERE dni = '$dni'");
        $result_dni = mysqli_fetch_array($query_dni);

        if ($result_dni) {
            $alert = '<p class="msg_error">Ya existe un usuario con el mismo DNI.</p>';
        } else {

            $query_insert = mysqli_query(
                $conection,
                "INSERT INTO cliente(dni,nombre,edad,correo,telefono,domicilio,fecha_ingreso)
                VALUES('$dni','$nombre','$edad','$correo','$telefono','$domicilio','$fecha_ingreso')"
            );
            
            if ($query_insert) {
                $alert = '<p class="msg_save">Usuario creado correctamente.</p>';
            } else {
                $error = mysqli_error($conection);
                $alert = '<p class="msg_error">Error al crear el usuario: ' . $error . '</p>';
            }
        }
    }
}
?>