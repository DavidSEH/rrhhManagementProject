<?php
session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Empleados</title>
    <?php include "../Modelo/scripts.php" ?>

</head>

<body>
    <script>
        function buscarCliente(nombre) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.querySelector(".lista-user").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "buscar_cliente.php?nombre=" + nombre, true);
            xmlhttp.send();
        }
    </script>
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
                <h2>Gestion Empleado</h2>
                <a href="NuevoCliente.php">Nuevo empleado</a>
            </div>
            <div class="seccion-user ">

                <div class="search-p">
                    <div class="">
                        <p>Buscar empleado</p>
                        <div class="search-med">
                            <input type="search" placeholder="Ingresar Empleado" onkeyup="buscarCliente(this.value)">
                            <span class="las la-search"></span>
                        </div>
                    </div>
                </div>
                <form action="" method="GET" id="estatus-form">
                    <div class="cab-user">
                        <div class="ckbx-style-8">

                            <h2>Mostrar empleados cesados</h2>
                            <input type="checkbox" id="estatus-checkbox" name="estatus" onchange="document.getElementById('estatus-form').submit()" <?php if (isset($_GET['estatus']) && $_GET['estatus'] == 'on') echo 'checked'; ?>>
                            <label for="estatus-checkbox"></label>

                            <?php if (isset($_GET['estatus']) && $_GET['estatus'] == 'on') : ?>
                                <input type="submit" value="Actualizar" class="btnPassword">
                            <?php endif; ?>

                        </div>
                    </div>
                </form>
                <div class="lista-user">
                    <?php
                    include "../Modelo/conexion.php";
                    $estatus = isset($_GET['estatus']) && $_GET['estatus'] == 'on' ? 0 : 1;
                    $query = mysqli_query($conection, "SELECT idcliente,dni,nombre,telefono,fecha_ingreso,fecha_cese,motivo_cese,sueldo,correo,usuario_cli,clave_cli
                                                    from cliente c 
                                                    WHERE estatus = $estatus ORDER BY idcliente");
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
                                                    <span class="fas fa-id-card"></span>
                                                    <span>DNI: <?php echo $data["dni"]; ?></span>
                                                </li>
                                                <li>
                                                    <span class="fas fa-at"></span>
                                                    <span>Correo:<?php echo $data["correo"]; ?></span>
                                                </li>
                                                <?php
                                                if ($estatus == 0) {
                                                    echo '<li>';
                                                    echo '<span class="fas fa-calendar-alt"></span>';
                                                    echo '<span>Fecha Cese:' . $data["fecha_cese"] . '</span>';
                                                    echo '</li>';
                                                    echo '<li>';
                                                    echo '<span class="fas fa-info-circle"></span>';
                                                    echo '<span>Motivo Cese:' . $data["motivo_cese"] . '</span>';
                                                    echo '</li>';
                                                } else {
                                                    echo '<li>';
                                                    echo '<span class="fas fa-calendar-alt"></span>';
                                                    echo '<span>Fecha Ingreso:' . $data["fecha_ingreso"] . '</span>';
                                                    echo '</li>';
                                                    echo '<li>';
                                                    echo '<span class="fas fa-calendar-alt"></span>';
                                                    echo '<span>Salario:' . $data["sueldo"] . '</span>';
                                                    echo '</li>';
                                                    echo '<li>';
                                                    echo '<span class="fas fa-smile-beam"></span>';
                                                    echo '<span>Usuario:' . $data["usuario_cli"] . '</span>';
                                                    echo '</li>';
                                                }
                                                ?>

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
                                        echo '<a href="AscenderEmpleado.php?id=' . $data["idcliente"] . '" class="btn-restore"><i class="fas fa-level-up-alt"></i>Ascender</a>';
                                    } else {
                                        if ($data["idcliente"] != 1) {
                                            echo '<a href="EliminarCliente.php?id=' . $data["idcliente"] . '" class="btn-delete"><i class="fas fa-level-down-alt"></i>Cese</a>';
                                        }
                                        echo '<a href="ModificarCliente.php?id=' . $data["idcliente"] . '" class="btn-update"><i class="fas fa-edit"></i>Modificar</a>';
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