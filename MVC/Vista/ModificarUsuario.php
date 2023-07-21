<?php
include_once "../Controlador/ModificarUControlador.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Modificar Usuario</title>
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
            <div class="container-actualizar-user">
                <div class="section-actualizar-user">
                    <p>Actualizar usuario</p>
                    <form action="" method="post">
                        <div class="formulario-actualizar-user">
                            <input type="hidden" name="cod_usuario" value="<?php echo $cod_usuario; ?>">
                            <div class="conten-p-upd">
                                <div class="contenido-upd">
                                    <label for="usuario">Usuario:</label>
                                    <input type="text" name="usuario" id="usuario" placeholder="Usuario" value="<?php echo $usuario; ?>">
                                </div>
                                <div class="contenido-upd">
                                    <label for="clave">Clave:</label>
                                    <input type="password" name="clave" id="clave" placeholder="Clave de acceso" value="">
                                </div>
                            </div>
                            <label for="rol">Tipo Usuario</label>
                            <?php
                            $query_rol = mysqli_query($conection, "SELECT * FROM tipo_rol");
                            mysqli_close($conection);
                            $result_rol = mysqli_num_rows($query_rol);
                            ?>
                            <select name="id_rol" id="id_rol">
                                <?php
                                echo $option;
                                if ($result_rol > 0) {
                                    while ($rol = mysqli_fetch_array($query_rol)) {
                                ?>
                                        <option value="<?php echo $rol["id_rol"]; ?>">
                                            <?php echo $rol["rol"] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="btn-actualizar-user">
                            <a href="Gestion_Usuario.php"><i class="fas fa-undo"></i>Regresar</a>
                            <button type="submit" value="Actualizar usuario"><i class="fas fa-edit"></i>Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <div class="alert">
            <?php echo isset($alert) ? $alert : ''; ?>
        </div>
    </div>
    <?php include_once "../Modelo/Footer.php" ?>
</body>

</html>