<!DOCTYPE html>

<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Menu Administrador</title>
    <?php include "../Modelo/scripts.php";
    session_start(); ?>
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
                <p>Importar</p>
            </div>

            <div class="head-icons">
                <span><?php echo fechaC(); ?></span>
                <a href="../Modelo/salir.php"><span class="fas fa-sign-out-alt"></span></a>
            </div>
        </header>
        <!--Navbar Fin-->
        <section>
            <div class="container-eliminar">
                <div class="cab-user">
                    <form action="../Controlador/Importar_Datos_Empleado.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="archivo_sql" accept=".sql" required>
                        <button type="submit">Cargar Archivo</button>
                    </form>

                    <a href="Gestion_Empleados.php"><i class="fas fa-ban"></i> Cancelar</a>

                </div>
            </div>
    </div>
    </section>
    </div>
    <?php include "../Modelo/Footer.php" ?>
</body>

</html>