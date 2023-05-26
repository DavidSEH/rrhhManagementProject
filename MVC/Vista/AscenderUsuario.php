<?php
session_start();
include "../Modelo/conexion.php";

if (isset($_GET['id'])) {
    $idusuario = $_GET['id'];

    // Actualizar el estatus del Admin a 1 (ascender)
    $query = "UPDATE usuario SET estatus = 1 WHERE idusuario = $idusuario";
    $result = mysqli_query($conection, $query);

    if ($result) {
        // Redireccionar a la página principal
        header("Location: Gestion_Usuario.php");
        exit();
    } else {
        // Manejar el error en caso de fallo en la consulta
        echo "Error al ascender al Admin.";
    }

    mysqli_close($conection);
} else {
    // Manejar el error si no se proporciona el ID del Admin
    echo "ID de Admin no proporcionado.";
}
?>
