<?php
include "../Modelo/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idcliente = $_POST["idcliente"];
    $estado = isset($_POST["estado"]) ? 1 : 0;

    $query = "UPDATE cliente SET estatus = $estado WHERE idcliente = $idcliente";
    $result = mysqli_query($conection, $query);

    if ($result) {
        echo "Estado actualizado correctamente";
    } else {
        echo "Error al actualizar el estado";
    }
}

mysqli_close($conection);
?>