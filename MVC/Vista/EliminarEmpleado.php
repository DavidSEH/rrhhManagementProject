<?php
include "../Controlador/EliminarEmpleadoControlador.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Menu Administrador</title>
    <?php include_once "../Modelo/scripts.php" ?>
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <!--Sidebar Inicio-->
    <?php include_once "./sidebarAdministrador.php" ?>
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
                <a href="../Modelo/salir.php"><span class="fas fa-sign-out-alt"></span></a>
            </div>
        </header>
        <!--Navbar Fin-->
        <section>
            <div class="container-eliminar">
                <div class="container-secion-eliminar">
                    <div class="icon-eliminar-user">
                        <i class="fas fa-user-times"></i>
                    </div>
                    <div class="section-eliminar">
                        <h2>¿Deseas cesar al Empleado?</h2>
                        <div class="section-eliminar-datos">
                            <div>
                                <p>Nombre: </p>
                                <p>Sueldo: </p>
                                <p>Fecha de ingreso: </p>
                                <p>Puesto de trabajo:</p>
                            </div>
                            <div class="segundary-eliminar-datos">
                                <p><?php echo $nombres; ?></p>
                                <p>S/. <?php echo $sueldo; ?></p>
                                <p><?php echo $fecha_ingreso; ?></p>
                                <p><?php echo $cod_puesto; ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="footer-eliminar">
                        <div class="section-eliminar-datos">
                            <div>
                                <h3>Detalles de la cese</h3>
                                <p>Fecha de cese: </p>
                                <p>Motivo de cese: </p>
                            </div>
                            <form method="post" action="">
                                <div class="segundary-eliminar-datos">
                                    <p> </p>
                                    <p><?php echo fechaC(); ?></p>
                                    <select name="cod_motivo_cese" id="motivo">
                                        <?php echo $options; ?>
                                    </select>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="footer-eliminar">
                    <input type="hidden" name="cod_personal" value="<?php echo $cod_personal; ?>">
                    <a href="Gestion_Empleados.php"><i class="fas fa-ban"></i> Cancelar</a>
                    <button type="submit" name="submit" value="Aceptar"><i class="fas fa-check"></i> Confirmar</button>
                </div>
                </form>
            </div>
        </section>
        <div class="alert">
            <?php echo isset($alert) ? $alert : ''; ?>
        </div>
    </div>
    <?php include_once "../Modelo/Footer.php" ?>
</body>

</html>