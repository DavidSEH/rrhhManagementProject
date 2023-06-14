<?php
session_start();


?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Usuarios</title>
    <?php include "../Modelo/scripts.php" ?>
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <!--Sidebar Inicio-->

    <?php include "./sidebar.php" ?>

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
                <a href="../Modelo/salir.php" title="cerrar Sesion">
                    <span class="fas fa-sign-out-alt"></span></a>
            </div>
        </header>
        <!--Navbar Fin-->
        <section>
            <div class="cab-user">
                <h2>Gestion Administrador</h2>
                <a href="NuevoUsuario.php">Nuevo Admin</a>
            </div>
            <div class="seccion-user ">
                <div class="search-p">
                    <div class="">
                        <p>Buscar Administrador</p>
                        <div class="search-med">
                            <input type="search" placeholder="Ingresar nombre de usuario">
                            <span class="las la-search"></span>
                        </div>
                    </div>
                </div>
                <form action="" method="GET" id="estatus-form">
                    <h2 for="estatus-checkbox">Mostrar administradores deshabilitados:

                        <input type="checkbox" id="estatus-checkbox" name="estatus" onchange="document.getElementById('estatus-form').submit()" <?php if (isset($_GET['estatus']) && $_GET['estatus'] == 'on') echo 'checked'; ?>>

                        <?php if (isset($_GET['estatus']) && $_GET['estatus'] == 'on') : ?>
                            <input type="submit" value="Actualizar" class="btnPassword">
                        <?php endif; ?>
                    </h2>
                </form>
                <div class="lista-user">
                    <?php
                    include "../Modelo/conexion.php";
                    $estatus = isset($_GET['estatus']) && $_GET['estatus'] == 'on' ? 0 : 1;
                    $query = mysqli_query($conection, "SELECT u.idusuario,u.dni, u.nombre,u.edad, u.correo,u.telefono,
                                        u.domicilio,u.usuario, r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol 
                                        WHERE estatus = $estatus ORDER BY u.idusuario ");
                    mysqli_close($conection);
                    $result = mysqli_num_rows($query);
                    if ($result > 0) {
                        while ($data = mysqli_fetch_array($query)) {
                    ?>

                            <div class="lista-p">
                                <div class="lista-sec">
                                    <div class="lista-datos">
                                        <div class="lista-datos-p">
                                            <h3><?php echo $data["nombre"]; ?></h3>
                                            <div class="lista-datos-personal">
                                                <li>
                                                    <span class="material-symbols-outlined">
                                                        badge
                                                    </span>
                                                    <span>DNI: <?php echo $data["dni"]; ?></span>
                                                </li>
                                                <li>
                                                    <span class="material-symbols-outlined">
                                                        alternate_email
                                                    </span>
                                                    <span>Correo:<?php echo $data["correo"]; ?></span>
                                                </li>
                                                <li>
                                                    <span class="material-symbols-outlined">
                                                        call
                                                    </span>
                                                    <span>Telefono:<?php echo $data["telefono"]; ?></span>
                                                </li>
                                                <li>
                                                    <span class="material-symbols-outlined">
                                                        account_circle
                                                    </span>
                                                    <span>Usuario:<?php echo $data["usuario"]; ?></span>
                                                </li>
                                                <li>
                                                    <span class="fas fa-smile-beam"></span>
                                                    <span>rol:<?php echo $data["rol"]; ?></span>
                                                </li>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="lista-img">
                                        <img src="../../Imagenes/perfil.jpg" alt="">
                                    </div>
                                </div>
                                <div class="lista-btn">
                                    <?php
                                    if ($estatus == 0) {
                                        echo '<a href="AscenderUsuario.php?id=' .  $data["idusuario"] . '" class="btn-restore"><span class="material-symbols-outlined">
                                        person
                                        </span>Ascender</a>';
                                    } else {
                                        if ($data["idusuario"] != 1) {
                                            echo '<a href="EliminarUsuario.php?id=' . $data["idusuario"] . '" class="btn-delete"><span class="material-symbols-outlined">
                                            person_off
                                            </span>Cese</a>';
                                        }
                                        echo '<a href="ModificarUsuario.php?id=' .  $data["idusuario"] . '" class="btn-update"><span class="material-symbols-outlined">
                                        edit
                                        </span>Modificar</a>';
                                    }
                                    ?>
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