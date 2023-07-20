<?php
session_start();
include "../Modelo/conexion.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Menu Empleado</title>
    <?php include "../Modelo/scripts2.php" ?>
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <!--Sidebar Inicio-->
    <?php include "./sidebarEmpleado.php" ?>
    <!--Sidebar Fin-->

    <div class="main-content">
        <!--Navbar Inicio-->
        <header>
            <div class="togle-p">
                <label for="menu-toggle" class="menu-toggler">
                    <span class="las la-bars"></span>
                </label>
                <p>Home</p>
            </div>

            <div class="head-icons">
                <span><?php echo fechaC(); ?></span>
                <a href="../Modelo/salir2.php"><span class="fas fa-sign-out-alt"></span></a>
            </div>
        </header>
        <!--Navbar Fin-->
        <section>
            <h2> <i class="fas fa-hotel"></i>Lista de Licencias <span>/Avance</span></h2>
            <div class="listado-principal-tabla">
                <div class="listado-tabla">
                    <table>
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Tipo Licencia</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Termino</th>
                                <th>Comentario</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "../Modelo/conexion.php";
                            /*Paginador*/
                            $sql_registro = mysqli_query($conection, "SELECT COUNT(*)AS total_registro FROM licencia");
                            $result_register = mysqli_fetch_array($sql_registro);
                            $total_registro = $result_register['total_registro'];
                            $por_pagina = 20;

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
                        WHERE l.cod_personal = '" . $_SESSION['idCli'] . "'
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
                                    <tr>
                                        <td><?php echo $data['cod_licencia']; ?></td>
                                        <td><?php echo $data['tipo']; ?></td>
                                        <td><?php echo $data['fecha_inicio']; ?></td>
                                        <td><?php echo $data['fecha_fin']; ?></td>
                                        <td><?php echo $data['comentario']; ?></td>
                                        <td><?php echo $msg ?></td>
                                        <td>
                                            <?php
                                            if ($data['estado'] == 1) {
                                            ?>

                                                <a href="Eliminar_Licencia_Empleado.php?id=<?php echo $data["cod_licencia"]; ?>" class="link_delete">
                                                    <i class="fas fa-window-close"></i>
                                                </a>
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


</body>

</html>