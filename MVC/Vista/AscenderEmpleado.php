<?php
session_start();
include "../Modelo/conexion.php";

if (isset($_GET['id'])) {
    $cod_personal = $_GET['id'];

    // Actualizar el estado del empleado a 1 (ascender)
    $query = "UPDATE personal SET estado = 1 WHERE cod_personal = $cod_personal";
    $query_update_usuario = mysqli_query($conection, "UPDATE usuario SET estado = 1 WHERE cod_personal = $cod_personal ");
    $result = mysqli_query($conection, $query);

    if ($result) {
        // Redireccionar a la página principal
        header("Location: Gestion_Empleados.php");
        exit();
    } else {
        // Manejar el error en caso de fallo en la consulta
        echo "Error al ascender al empleado.";
    }

    mysqli_close($conection);
} else {
    // Manejar el error si no se proporciona el ID del empleado
    echo "ID de empleado no proporcionado.";
}
?>
