<?php
session_start();
if (!isset($_SESSION['idUser'])) {
    header('location: loginAdministrador.php');
}
?>

<!DOCTYPE html>
<html lang="en">

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
                    <iframe title="Report Section" width="1450" height="850" src="https://app.powerbi.com/view?r=eyJrIjoiZDVmZWExMmItZTkyZS00M2E3LTg4ZDQtNGM5NzhhMWVlZWRmIiwidCI6ImM0YTY2YzM0LTJiYjctNDUxZi04YmUxLWIyYzI2YTQzMDE1OCIsImMiOjR9" frameborder="0" allowFullScreen="true"></iframe>
                </div>
            </div>

        </section>
    </div>
    <?php include "../Modelo/Footer.php" ?>
</body>

</html>