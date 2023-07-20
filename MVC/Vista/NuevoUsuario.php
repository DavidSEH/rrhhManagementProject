<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Nuevo Usuario</title>
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
            <?php
            include_once "../Controlador/RegistroControlador.php";
            ?>
            <div class="container-new-user">
                <div class="section-new-user">
                    <p>Nuevo Usuario</p>
                    <form action="" method="post">
                        <div class="formulario-new-user">
                            <div class="conten-p-new">
                                <div class="contenido-new">
                                    <label for="dni">Seleccione un miembro del personal:</label>
                                    <select name="cod_personal" id="cod_personal">
                                        <?php echo $options; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="conten-p-new">
                                <div class="contenido-new">
                                    <label for="usuario">Usuario:</label>
                                    <input type="text" name="usuario" id="usuario" placeholder="Usuario" value="">
                                </div>
                                <div class="contenido-new">
                                    <label for="clave">Clave:</label>
                                    <input type="password" name="clave" id="clave" placeholder="Clave de acceso">
                                </div>
                            </div>
                            <label for="id_rol">Tipo Usuario:</label>
                            <?php
                            $query_rol = mysqli_query($conection, "SELECT * FROM tipo_rol");
                            mysqli_close($conection);
                            $result_rol = mysqli_num_rows($query_rol);
                            ?>
                            <select name="id_rol" id="id_rol">
                                <?php
                                if ($result_rol > 0) {
                                    while ($rol = mysqli_fetch_array($query_rol)) {
                                ?>
                                        <option value="<?php echo $rol["id_rol"]; ?>"><?php echo $rol["rol"] ?></option>
                                <?php

                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="btn-new-user">
                            <a href="Gestion_Usuario.php"><i class="fas fa-undo"></i> Regresar</a>
                            <button type="submit"><i class="fas fa-edit"></i> Registrar</button>
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