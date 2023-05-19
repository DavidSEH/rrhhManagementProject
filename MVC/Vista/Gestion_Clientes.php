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
                <a href="NuevoCliente.php">Nuevo Empleado</a>
            </div>
            <div class="seccion-user ">
                <div class="search-p">
                    <div class="">
                        <p>Buscar Empleado</p>
                        <div class="search-med">
                            <input type="search" placeholder="Ingresar Empleado" onkeyup="buscarCliente(this.value)">
                            <span class="las la-search"></span>
                        </div>
                    </div>
                </div>
                <div class="lista-user">
                    <?php
                    include "../Modelo/conexion.php";

                    $query = mysqli_query($conection, "SELECT idcliente,dni,nombre,telefono,domicilio,correo,usuario_cli,clave_cli
                                                    from cliente c 
                                                    WHERE estatus = 1 ORDER BY idcliente");
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
                                                <li>
                                                    <span class="fas fa-birthday-cake"></span>
                                                    <span>Edad:22</span>
                                                </li>
                                                <li>
                                                    <span class="fas fa-user-secret"></span>
                                                    <span>Usuario:<?php echo $data["usuario_cli"]; ?></span>
                                                </li>
                                                <li>
                                                    <span class="fas fa-user-secret"></span>
                                                    <span>Telefono:<?php echo $data["telefono"]; ?></span>
                                                </li>
                                                <li>
                                                    <span class="fas fa-smile-beam"></span>
                                                    <span>Dirección:<?php echo $data["domicilio"]; ?></span>
                                                </li>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="lista-img">
                                        <img src="../../Imagenes/perfil.jpg" alt="">
                                    </div>
                                </div>
                                <div class="lista-btn">
                                    
                                    <a href="ModificarCliente.php?id=<?php echo $data["idcliente"]; ?> " class="btn-update"><i class="fas fa-edit"></i>Modificar</a>
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