<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Asistencias</title>
    <?php include "../Modelo/scripts.php" ?>
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <!--Sidebar Inicio-->
    <?php include "./sidebarAdministrador.php" ?>
    <!--Sidebar Fin-->

    <div class="main-content">
        <!--Navbar Inicio-->
        <?php
        include "../Modelo/HeaderUsu.php"
        ?>
        <!--Navbar Fin-->
        <section>
            <div class="cab-user">
                <h2> <i class="fas fa-ad"></i> Asistencias</h2>
                <a href="Nueva_Asistencia.php">Nueva Asistencia</a>
            </div>
            <div class="listado-principal-tabla">
                <div class="cab-tabla">
                    <div>
                    </div>
                    <div>
                        <a href="../../Reportes/Reporte_Asistencias.php?idUser=<?php echo $_SESSION['idUser']; ?>" target="_blank" class="bg_primary">
                            Imprimir</a>
                    </div>


                </div>
                <div class="listado-tabla">
                    <table>
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nombre del empleado</th>
                                <th>Registrado por</th>
                                <th>Modificado por</th>
                                <th>Fecha</th>
                                <th>Hora de entrada</th>
                                <th>Hora de salida</th>
                                <th></th>
                            </tr>
                        </thead>
                        <?php
                        include "../Modelo/conexion.php";
                        /*Paginador*/
                        $sql_registro = mysqli_query($conection, "SELECT COUNT(*) AS total_registro FROM asistencia");
                        $result_register = mysqli_fetch_array($sql_registro);
                        $total_registro = $result_register['total_registro'];
                        $por_pagina = 15;

                        if (empty($_GET['pagina'])) {
                            $pagina = 1;
                        } else {
                            $pagina = $_GET['pagina'];
                        }
                        $desde = ($pagina - 1) * $por_pagina;
                        $total_paginas = ceil($total_registro / $por_pagina);
                        $query = mysqli_query($conection, "SELECT a.cod_asistencia, a.cod_personal, a.registrado_por, a.fecha_ingreso, a.hora_ingreso, a.hora_salida, a.modificado_por
                                            FROM asistencia a
                                            ORDER BY a.cod_asistencia DESC LIMIT $desde,$por_pagina;");
                        if (!$query) {
                            die("Error en la consulta: " . mysqli_error($conection));
                        }
                        $msg = '';

                        $result = mysqli_num_rows($query);
                        if ($result > 0) {
                            while ($data = mysqli_fetch_array($query)) {
                        ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $data['cod_asistencia']; ?></td>
                                        <td><?php echo $data['cod_personal']; ?></td>
                                        <td><?php echo $data['registrado_por']; ?></td>
                                        <td><?php echo $data['modificado_por']; ?></td>
                                        <td><?php echo $data['fecha_ingreso']; ?></td>
                                        <td><?php echo $data['hora_ingreso']; ?></td>
                                        <td><?php echo $data['hora_salida']; ?></td>
                                        <td>
                                            <a href="Modificar_asistencia.php?id=<?php echo $data["cod_asistencia"]; ?>"><i class="fas fa-edit"></i></a>
                                            <a href="Eliminar_asistencia.php?id=<?php echo $data["cod_asistencia"]; ?>">
                                                <i class="fas fa-window-close"></i>
                                            </a>
                                        </td>
                                </tbody>
                        <?php
                            }
                        }
                        mysqli_close($conection); ?>
                        <tfoot class="paginacion">
                            <tr>
                                <td colspan="9">
                                    <ul>
                                        <?php
                                        if ($pagina != 1) {
                                        ?>
                                            <li><a href="?pagina=<?php echo 1; ?>">|<< /a>
                                            </li>
                                            <li><a href="?pagina=<?php echo $pagina - 1; ?>">
                                                    <<< /a>
                                            </li>
                                        <?php
                                        }
                                        for ($i = 1; $i <= $total_paginas; $i++) {
                                            # code...
                                            if ($i == $pagina) {
                                                echo '<li class="pageSelected">' . $i . '</li>';
                                            } else {
                                                echo '<li><a href="?pagina=' . $i . '">' . $i . '</a></li>';
                                            }
                                        }

                                        if ($pagina != $total_paginas) {
                                        ?>
                                            <li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
                                            <li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
                                        <?php } ?>
                                    </ul>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <?php include "../Modelo/Footer.php" ?>
</body>

</html>