<?php
session_start();
if (!isset($_SESSION['idUser'])) {
    header('location: loginAdministrador.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Menu Administrador</title>
    <?php include "../Modelo/scripts.php" ?>
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <!--Sidebar Inicio-->
    <?php include "./sidebarAdministrador.php" ?>
    <!--Sidebar Fin-->
    <div class="main-content">
        <!--Navbar Inicio-->
        <?php include "../Modelo/HeaderUsu.php" ?>
        <!--Navbar Fin-->
        <section>
            <div class="conteneder-cabecera">
                <i class="fab fa-accessible-icon"></i>
                <div>
                    <p> Hola <?php echo $_SESSION['nombre'] ?></p>
                    <h4>Bienvenido al panel de control</h4>
                </div>
            </div>

            <div class="contenedor__main">
                <div class="container__graphic">

                </div>
                <div class="container__graphic">

                </div>
            </div>

        </section>
    </div>
    <?php include "../Modelo/Footer.php" ?>
</body>

</html>