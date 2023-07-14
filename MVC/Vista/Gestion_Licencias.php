<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Licencias</title>
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
        <?php date_default_timezone_set('America/Lima');
        $fecha = date("Y-m-d");; ?>
        <section>
            <div class="cab-user">
                <h2> <i class="fas fa-hotel"></i>Licencias Generadas</h2>

            </div>
            <div class="listado-principal-tabla">
                <div class="cab-tabla">
                    <div>
                        <input type="text" value="Fecha: <?php echo $fecha; ?>" disabled>
                        <i class="fas fa-calendar-day"></i>
                    </div>
                    <div class="cab__tabla_enlace">

                        <a href="../../Reportes/Reporte_Reservas_Generada.php?idUser=<?php echo $_SESSION['idUser']; ?>" target="_blank" class="bg_success">
                            <i class="fas fa-file-pdf"></i>Generar Reporte</a>
                    </div>
                </div>
                <div class="listado-tabla">
                    <table>
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Empleado</th>
                                <th>DNI</th>
                                <th>Tipo Licencia</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Termino</th>
                                <th>Estado</th>
                                <th>Justificación</th>
                                <th></th>
                            </tr>
                        </thead>
                        <?php
                        include "../Modelo/conexion.php";
                        /*Paginador*/
                        $sql_registro = mysqli_query($conection, "SELECT COUNT(*)AS total_registro FROM licencia");
                        $result_register = mysqli_fetch_array($sql_registro);
                        $total_registro = $result_register['total_registro'];
                        $por_pagina = 14;

                        if (empty($_GET['pagina'])) {
                            $pagina = 1;
                        } else {
                            $pagina = $_GET['pagina'];
                        }
                        $desde = ($pagina - 1) * $por_pagina;
                        $total_paginas = ceil($total_registro / $por_pagina);

                        $msg = '';
                        $query = mysqli_query($conection, "SELECT l.cod_licencia, t.nom_licencia AS tipo, p.nombres AS nombres, p.dni AS dni, l.fecha_inicio, l.fecha_fin, l.estado,l.comentario
                        FROM licencia l
                        INNER JOIN personal p ON l.cod_personal = p.cod_personal
                        INNER JOIN tipo_licencia t ON l.tipo = t.cod_licencia
                        ORDER BY l.cod_licencia DESC LIMIT $desde, $por_pagina;");
                        mysqli_close($conection);
                        $result = mysqli_num_rows($query);
                        if ($result > 0) {
                            while ($data = mysqli_fetch_array($query)) {
                                if ($data['estado'] == 1) {
                                    $msg = '<p class="msg_reser style="background: #eba134">Pendiente</p>';
                                }
                                if ($data['estado'] == 2) {
                                    $msg = '<p class="msg_reser" style="background: #2EB380">Aprobada</p>';
                                }
                                if ($data['estado'] == 3) {
                                    $msg = '<p class="msg_ocup">Denegada</p>';
                                }
                        ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $data['cod_licencia']; ?></td>
                                        <td><?php echo $data['nombres']; ?></td>
                                        <td><?php echo $data['dni']; ?></td>
                                        <td><?php echo $data['tipo']; ?></td>
                                        <td><?php echo $data['fecha_inicio']; ?></td>
                                        <td><?php echo $data['fecha_fin']; ?></td>

                                        <td><?php echo $msg ?></td>
                                        <td><?php echo $data['comentario']; ?></td>
                                        <td>
                                            <?php
                                            if ($data['estado'] == 1) {
                                            ?>
                                                <a href="Tramite_Licencias.php?id=<?php echo $data["cod_licencia"]; ?>"><span class="material-symbols-outlined">
                                                        edit_square
                                                    </span></a>
                                            <?php
                                            }
                                            if ($data['estado'] == 3) {
                                            ?>
                                                <a href="Eliminar_Licencia.php?id=<?php echo $data["cod_licencia"]; ?>"><i class="fas fa-window-close"></i></a>
                                            <?php
                                            }
                                            if ($data['estado'] == 2) {
                                            ?>
                                                <a href="Modificar_Licencia_Administrador.php?id=<?php echo $data["cod_licencia"]; ?>"><span class="material-symbols-outlined">
                                                        edit
                                                    </span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>

                                </tbody>
                        <?php
                            }
                        }
                        ?>
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