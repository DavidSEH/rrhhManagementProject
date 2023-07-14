<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Configuración</title>
    <?php include "../Modelo/scripts.php" ?>
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <!--Sidebar Inicio-->
    <?php include "sidebarAdministrador.php" ?>
    <!--Sidebar Fin-->

    <div class="main-content">
        <!--Navbar Inicio-->
        <?php
        include "../Modelo/HeaderUsu.php"
        ?>
        <!--Navbar Fin-->
        <section>
            <div class="cab-user">
                <h2> <i class="fas fa-anchor"></i>Ceses</h2>
            </div>
            <div class="listado-principal-tabla">
                <div class="cab-tabla">
                    <div>

                    </div>

                </div>
                <div class="listado-tabla">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th></th>
                            </tr>
                        </thead>
                        <?php
                        include "../Modelo/conexion.php";
                        /*Paginador*/
                        $sql_registro = mysqli_query($conection, "SELECT COUNT(*)AS total_registro FROM tipo_motivo_cese");
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

                        $msg = '';
                        $query = mysqli_query($conection, "SELECT *
                                                    FROM tipo_motivo_cese
                                                    ORDER BY cod_motivo_cese ASC LIMIT $desde,$por_pagina;");
                        mysqli_close($conection);
                        $result = mysqli_num_rows($query);
                        if ($result > 0) {
                            while ($data = mysqli_fetch_array($query)) {
                        ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $data['cod_motivo_cese']; ?></td>
                                        <td>
                                            <input type="text" value="<?php echo $data['descripcion'] ? $data['descripcion'] : ''; ?> " disabled>
                                        </td>
                                        <td>
                                            <a href="Eliminar_Categoria.php?id=<?php echo $data["cod_motivo_cese"]; ?>"><i class="fas fa-window-close"></i></a>

                                        </td>
                                </tbody>

                        <?php
                            }
                        }
                        ?>
                        <tbody>
                            <td></td>
                            <td><input type="text"></td>
                            <td>
                                <a href="Eliminar_Categoria.php?id=<?php echo $data["cod_motivo_cese"]; ?>"><i class="fas fa-window-close"></i></a>

                            </td>
                        </tbody>
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