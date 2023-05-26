<?php
session_start();
include "../Modelo/conexion.php";

if (isset($_GET['id'])) {
    $idcliente = $_GET['id'];

    // Actualizar el estatus del empleado a 1 (ascender)
    $query = "UPDATE cliente SET estatus = 1 WHERE idcliente = $idcliente";
    $result = mysqli_query($conection, $query);

    if ($result) {
        // Redireccionar a la página principal
        header("Location: Gestion_Clientes.php");
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
