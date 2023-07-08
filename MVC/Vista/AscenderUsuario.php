<?php
session_start();
include "../Modelo/conexion.php";

if (isset($_GET['id'])) {
    $cod_usuario = $_GET['id'];

    // Actualizar el estatus del usuario a 1 (ascender)
    $query = "UPDATE usuario SET estado = 1 WHERE cod_usuario = $cod_usuario";
    $result = mysqli_query($conection, $query);

    if ($result) {
        // Redireccionar a la página principal
        header("Location: Gestion_Usuario.php");
        exit();
    } else {
        // Manejar el error en caso de fallo en la consulta
        echo "Error al ascender al usuario.";
    }

    mysqli_close($conection);
} else {
    // Manejar el error si no se proporciona el ID del Admin
    echo "ID de usuario no proporcionado.";
}
?>
