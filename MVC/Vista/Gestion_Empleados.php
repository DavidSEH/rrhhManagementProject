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
                <h3>Gestion Empleado</h3>
                <a href="NuevoEmpleado.php">Nuevo empleado</a>
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
                <form action="" method="GET" id="estado-form">
                    <div class="cab-user">
                        <h3>Mostrar empleados cesados</h3>
                        <div class="ckbx-style-8">
                            <input type="checkbox" id="estado-checkbox" name="estado" onchange="document.getElementById('estado-form').submit()" <?php if (isset($_GET['estado']) && $_GET['estado'] == 'on') echo 'checked'; ?>>
                            <label for="estado-checkbox"></label>
                            <?php if (isset($_GET['estado']) && $_GET['estado'] == 'on') : ?>
                                <input type="submit" value="Actualizar" class="btnPassword" hidden>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
                <div class="lista-user">
                    <?php
                    include "../Modelo/conexion.php";
                    $estado = isset($_GET['estado']) && $_GET['estado'] == 'on' ? 0 : 1;
                    $query = mysqli_query($conection, "SELECT cod_personal,dni,nombres,apellidos,telefono,fecha_ingreso,fecha_cese,cod_motivo_cese,cod_puesto,sueldo,correo
                                                    from personal c 
                                                    WHERE estado = $estado ORDER BY cod_personal");
                    mysqli_close($conection);
                    $result = mysqli_num_rows($query);
                    if ($result > 0) {
                        while ($data = mysqli_fetch_array($query)) {
                    ?>

                            <div class="lista-p">
                                <div class="lista-sec">
                                    <div class="lista-datos">
                                        <div class="lista-datos-p">
                                            <h3><?php echo $data["nombres"]; ?>
                                                <?php echo $data["apellidos"]; ?>
                                            </h3>
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
                                                if ($estado == 0) {
                                                    echo '<li>';
                                                    echo '<span class="fas fa-calendar-alt"></span>';
                                                    echo '<span>Fecha Cese:' . $data["fecha_cese"] . '</span>';
                                                    echo '</li>';
                                                    echo '<li>';
                                                    echo '<span class="fas fa-info-circle"></span>';
                                                    echo '<span>Motivo Cese:' . $data["cod_motivo_cese"] . '</span>';
                                                    echo '</li>';
                                                } else {
                                                    echo '<li>';
                                                    echo '<span class="fas fa-calendar-alt"></span>';
                                                    echo '<span>Fecha Ingreso:' . $data["fecha_ingreso"] . '</span>';
                                                    echo '</li>';
                                                    echo '<li>';
                                                    echo '<span class="fas fa-calendar-alt"></span>';
                                                    echo '<span>Puesto de trabajo:' . $data["cod_puesto"] . '</span>';
                                                    echo '</li>';
                                                    echo '<li>';
                                                    echo '<span class="fas fa-calendar-alt"></span>';
                                                    echo '<span>Salario:' . $data["sueldo"] . '</span>';
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
                                    if ($estado == 0) {
                                        echo '<a href="AscenderEmpleado.php?id=' . $data["cod_personal"] . '" class="btn-restore"><span class="material-symbols-outlined">person</span>Ascender</a>';
                                        echo '<a href="../../Reportes/Reporte_Certificado_cesado.php?idUser=' . $data["cod_personal"] . '" class="btn-generate" target="_blank"><span class="material-symbols-outlined">task</span>Certificado</a>';
                                        echo '<a href="../../Reportes/Reporte_Recomendacion.php?idUser=' . $data["cod_personal"] . '" class="btn-generate" target="_blank"><span class="material-symbols-outlined">task</span>Recomend.</a>';
                                        echo '<a href="../../Reportes/Liquidacion.php?idUser=' . $data["cod_personal"] . '" class="btn-generate" target="_blank"><span class="material-symbols-outlined">task</span>Liquidación</a>';
                                    } else {

                                        if ($data["cod_personal"] != 1) {
                                            echo '<a href="EliminarEmpleado.php?id=' . $data["cod_personal"] . '" class="btn-delete"><span class="material-symbols-outlined">person_off</span>Cese</a>';
                                        }
                                        echo '<a href="../../Reportes/Reporte_Certificado.php?idUser=' . $data["cod_personal"] . '" class="btn-generate" target="_blank"><span class="material-symbols-outlined">task</span>Certificado</a>';
                                        echo '<a href="../../Reportes/Reporte_Certificado.php?idUser=' . $data["cod_personal"] . '" class="btn-generate" target="_blank"><span class="material-symbols-outlined">task</span>Boleta de pagos</a>';
                                        echo '<a href="ModificarEmpleado.php?id=' . $data["cod_personal"] . '" class="btn-update"><span class="material-symbols-outlined">edit</span>Modificar</a>';
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
    <?php echo isset($alert) ? $alert : ''; ?>
    <?php include "../Modelo/Footer.php" ?>
</body>

</html>