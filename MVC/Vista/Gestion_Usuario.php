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
                <a href="../Modelo/salir.php" title="cerrar Sesion">
                    <span class="fas fa-sign-out-alt"></span></a>
            </div>
        </header>
        <!--Navbar Fin-->
        <section>
            <div class="cab-user">
                <h2>Gestion Usuario</h2>
                <a href="NuevoUsuario.php">Nuevo Usuario</a>
            </div>
            <div class="seccion-user ">
                <div class="search-p">
                    <div class="">
                        <p>Buscar Usuario</p>
                        <div class="search-med">
                            <input type="search" placeholder="Ingresar nombre de usuario">
                            <span class="las la-search"></span>
                        </div>
                    </div>
                </div>
                <form action="" method="GET" id="estado-form">
                    <h2 for="estado-checkbox">Mostrar usuarios deshabilitados:
                        <input type="checkbox" id="estado-checkbox" name="estado" onchange="document.getElementById('estado-form').submit()" <?php if (isset($_GET['estado']) && $_GET['estado'] == 'on') echo 'checked'; ?>>
                        <?php if (isset($_GET['estado']) && $_GET['estado'] == 'on') : ?>
                            <input type="submit" value="Actualizar" class="btnPassword">
                        <?php endif; ?>
                    </h2>
                </form>
                <div class="lista-user">
                    <?php
                    include "../Modelo/conexion.php";
                    $estado = isset($_GET['estado']) && $_GET['estado'] == 'on' ? 0 : 1;
                    $query = mysqli_query($conection, "SELECT u.cod_usuario, u.usuario, u.estado, r.rol, p.nombres AS nombre_usuario
                    FROM usuario u
                    INNER JOIN tipo_rol r ON u.id_rol = r.id_rol
                    INNER JOIN personal p ON u.cod_personal = p.cod_personal
                    WHERE u.estado = $estado
                    ORDER BY u.cod_usuario");
                    mysqli_close($conection);
                    if (!$query) {
                        $error = mysqli_error($conection);
                        echo "Error en la consulta: " . $error;
                    } else {
                        $result = mysqli_num_rows($query);
                        if ($result > 0) {
                            while ($data = mysqli_fetch_array($query)) {
                    ?>
                                <div class="lista-p">
                                    <div class="lista-sec">
                                        <div class="lista-datos">
                                            <div class="lista-datos-p">
                                                <h3><?php echo $data["nombre_usuario"]; ?></h3>
                                                <div class="lista-datos-personal">
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
                                        if ($estado == 0) {
                                            echo '<a href="AscenderUsuario.php?id=' .  $data["cod_usuario"] . '" class="btn-restore"><span class="material-symbols-outlined">
                                        person
                                        </span>Ascender</a>';
                                        } else {
                                            if ($data["cod_usuario"] != 1) {
                                                echo '<a href="EliminarUsuario.php?id=' . $data["cod_usuario"] . '" class="btn-delete"><span class="material-symbols-outlined">
                                            person_off
                                            </span>Cese</a>';
                                            }
                                            echo '<a href="ModificarUsuario.php?id=' .  $data["cod_usuario"] . '" class="btn-update"><span class="material-symbols-outlined">
                                        edit
                                        </span>Modificar</a>';
                                        }
                                        ?>
                                    </div>

                                </div>
                    <?php
                            }
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