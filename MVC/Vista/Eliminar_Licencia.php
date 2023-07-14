<?php
include "../Controlador/Eliminar_Licencia_Controlador.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Menu Administrador</title>
    <?php include "../Modelo/scripts.php" ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@72,700,1,200" />
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <!--Sidebar Inicio-->
    <?php include "./sidebarAdministrador.php" ?>
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
                         <span class="material-symbols-outlined">
                            scan_delete
                        </span>
                    </div>
                    <div class="section-eliminar">
                        <h2>¿Deseas eliminar la licencia?</h2>
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
                        <p>!Esta acción no se puede deshacer!</p>
                    </div>
                </div>
                <form method="post" action="">
                    <div class="footer-eliminar">
                        <input type="hidden" name="cod_licencia" value="<?php echo $cod_licencia; ?>">
                        <a href="Gestion_Licencias.php"><i class="fas fa-undo"></i> Regresar</a>
                        <button type="submit" name="btn_Eliminar"><i class="fas fa-check"></i> Aceptar</button>
                    </div>
                </form>
            </div>
        </section>
        <div class="alert">
            <?php echo isset($alert) ? $alert : ''; ?>
        </div>
    </div>
    <?php include "../Modelo/Footer.php" ?>
</body>

</html>