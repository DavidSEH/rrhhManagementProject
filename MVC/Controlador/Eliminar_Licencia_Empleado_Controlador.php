<?php session_start();
include_once "../Modelo/conexion.php";

if (empty($_REQUEST['id'])) {
    header("location: ../Vista/ListaReservasCliente.php");
    mysqli_close($conection);
} else {

    $cod_licencia = $_REQUEST['id'];

    $query = mysqli_query($conection, "SELECT * FROM licencia l INNER JOIN personal p ON (l.cod_personal=p.cod_personal)
                                         WHERE cod_licencia = $cod_licencia ");

    $result = mysqli_num_rows($query);

    if ($result > 0) {
        while ($data = mysqli_fetch_array($query)) {
            $cod_licencia = $data['cod_licencia'];
            $fecha_inicio = $data['fecha_inicio'];
            $fecha_fin = $data['fecha_fin'];
            $nombres = $data['nombres'];
        }
    } else {
        header("location: ../Vista/ListaLicenciasEmpleado.php");
    }
}

if (!empty($_POST)) {

    $alert = '';

    if (isset($_POST['btn_Eliminar'])) {

        $cod_licencia = $_POST['cod_licencia'];

        $query_delete = mysqli_query(
            $conection,
            "DELETE FROM licencia WHERE cod_licencia = '$cod_licencia' "
        );

        if ($query_delete) {
            header("location: ../Vista/ListaLicenciasEmpleado.php");
        } else {
            $alert = '<div class="alertError">Error</div>';
        }
    }
}
