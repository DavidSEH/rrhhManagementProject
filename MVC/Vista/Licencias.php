<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Licencia</title>
    <?php include "../Modelo/scripts.php" ?>
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <!--Sidebar Inicio-->
    <?php include "./sidebarAdministrador.php" ?>
    <!--Sidebar Fin-->

    <!--Sidebar Fin-->
    <div class="main-content">
        <!--Navbar Inicio-->
        <?php include "../Modelo/HeaderUsu.php" ?>
        <!--Navbar Fin-->
        <section>
            <div>
                <h2><i class="fas fa-sign-out-alt"></i> Licencia <span>/Tramitar</span></h2>
                <div class="principal-recepcion">
                    <div class="cab-recepcion">
                    </div>
                    <div class="seccion-recepcion">
                        <?php
                        include "../Modelo/conexion.php";
                        $title = '';
                        $msg = '';
                        $query = mysqli_query($conection, "SELECT * FROM tipo_licencia");
                        mysqli_close($conection);
                        $result = mysqli_num_rows($query);

                        if ($result > 0) {
                            while ($data = mysqli_fetch_array($query)) {
                                $title = 'princ-hab-recepcion';
                                $title2 = 'footer-hab-recpcion';
                                $msg = '<a href="Nueva_Licencia_Administrador.php?id=' . $data['cod_licencia'] . ' ">Tramitar <i class="fas fa-arrow-alt-circle-right"></i></a>';
                        ?>
                                <div class="seccion-hab-recepcion">
                                    <div class="<?php echo $title ?>">
                                        <div class="sec-hab-rec-m1">
                                            <h1 id="num-habitacion" style="display: none" ;><?php echo $data["cod_licencia"]; ?></h1>
                                            <p><?php echo $data["nom_licencia"]; ?></p>
                                        </div>
                                        <div class="sec-hab-rec-m2">
                                            <i class="fas fa-file-signature"></i>
                                        </div>
                                    </div>
                                    <div class="<?php echo $title2 ?>">
                                        <?php echo $msg ?>
                                    </div>
                                </div>
                        <?php

                            }
                        }
                        ?>
                    </div>
                </div>
        </section>
    </div>
    <?php include "../Modelo/Footer.php" ?>
</body>

</html>