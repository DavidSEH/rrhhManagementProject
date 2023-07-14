<?php
include "../Modelo/conexion.php";

if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['id_rol'])) {
        $error = mysqli_error($conection);
        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else {

        $cod_personal = $_POST['cod_personal'];
        $user   = $_POST['usuario'];
        $clave  = md5($_POST['clave']);
        $id_rol    = $_POST['id_rol'];

        $query_insert = mysqli_query(
            $conection,
            "INSERT INTO usuario(cod_personal,usuario,clave,id_rol, estado)
                                         VALUES('$cod_personal','$user','$clave','$id_rol',1)"
        );
        if ($query_insert) {
            $alert = '<p class="msg_save">Usuario creado correctamente.</p>';
        } else {
            $alert = '<p class="msg_error">Error al crear el usuario.</p>';
        }
    }
}

// Realizar la consulta a la base de datos para obtener empleados activos que no tengan un usuario asociado
$query = "SELECT cod_personal, CONCAT(nombres, ' ', apellidos) AS nombre_completo FROM personal where estado=1 AND cod_personal NOT IN (SELECT cod_personal FROM usuario)";
$result = mysqli_query($conection, $query);

// Verificar si se obtuvieron resultados
if ($result && mysqli_num_rows($result) > 0) {
    $options = ""; // Variable para almacenar las opciones del select

    // Recorrer los resultados y generar las opciones
    while ($row = mysqli_fetch_assoc($result)) {
        $cod_personal = $row['cod_personal'];
        $nombre_completo = $row['nombre_completo'];
        $options .= "<option value=\"$cod_personal\">$nombre_completo</option>";
    }
} else {
    // Manejar el caso en que no se obtuvieron resultados
    $options = "<option value=\"\">No hay empleados disponibles</option>";
}
