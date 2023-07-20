<?php
include_once "../Controlador/Eliminar_Licencia_Empleado_Controlador.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Menu Empleado</title>
    <?php include_once "../Modelo/scripts2.php" ?>
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <!--Sidebar Inicio-->

    <?php include_once "./sidebarEmpleado.php" ?>

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
            <div class="container-eliminar">
                <div class="container-secion-eliminar">
                    <div class="icon-eliminar-user">
                        <i class="fab fa-resolving"></i>
                    </div>
                    <div class="section-eliminar">
                        <h2>¿Deseas eliminar tu solicitud de licencia?</h2>
                        <div class="section-eliminar-datos">
                            <div>
                                <p>N° Licencia: </p>
                                <p>Empleado: </p>
                                <p>Fecha Inicio: </p>
                                <p>Fecha Final: </p>

                            </div>
                            <div class="segundary-eliminar-datos">
                                <p><?php echo $cod_licencia; ?></p>
                                <p><?php echo $nombres; ?></p>
                                <p><?php echo $fecha_inicio; ?></p>
                                <p><?php echo $fecha_fin; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="footer_container">
                        <p>!Tendrá que generar una nueva licencia!</p>
                    </div>
                </div>
                <form method="post" action="">
                    <div class="footer-eliminar">
                        <input type="hidden" name="cod_licencia" value="<?php echo $cod_licencia; ?>">
                        <a href="ListaLicenciasEmpleado.php"><i class="fas fa-undo"></i> Regresar</a>
                        <button type="submit" name="btn_Eliminar"><i class="fas fa-check"></i> Aceptar</button>
                    </div>
                </form>
            </div>
        </section>
        <div class="alert">
            <?php echo isset($alert) ? $alert : ''; ?>
        </div>
    </div>


</body>

</html>