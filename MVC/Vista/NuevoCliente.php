<?php
session_start();
include "../Controlador/RegistroClienteControlador.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Nuevo Empleado</title>
    <?php include "../Modelo/scripts.php" ?>
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <!--Sidebar Inicio-->
    <?php include "sidebar.php" ?>
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
            <div class="container-new-user">
                <div class="section-new-user">
                    <p>Nuevo Empleado</p>
                    <form action="" method="post">
                        <div class="formulario-new-user">
                            <input type="hidden" name="idusuario" value="<?php echo $_SESSION['idUser']; ?>">
                            <div class="conten-p-new">
                                <div class="contenido-new">
                                    <label for="dni">DNI:</label>
                                    <input type="number" name="dni" id="dni" placeholder="DNI" value="" min="00000000" max="99999999">
                                </div>
                                <div class="contenido-new">
                                    <label for="nombre">Nombres y apellidos:</label>
                                    <input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="">
                                </div>
                            </div>
                            <div class="conten-p-new">
                                <div class="contenido-new">
                                    <label for="edad">Edad:</label>
                                    <input type="number" name="edad" id="edad" placeholder="Edad" value="">
                                </div>
                                <div class="contenido-new">
                                    <label for="correo">Correo electrónico:</label>
                                    <input type="email" name="correo" id="correo" placeholder="Correo electrónico" value="">
                                </div>
                            </div>
                            <div class="conten-p-new">
                                <div class="contenido-new">
                                    <label for="telefono">Telefono:</label>
                                    <input type="number" name="telefono" id="telefono" placeholder="Telefono" value="">
                                </div>
                                <div class="contenido-new">
                                    <label for="domicilio">Domicilio:</label>
                                    <input type="text" name="domicilio" id="domicilio" placeholder="Domicilio" value="">
                                </div>
                            </div>
                            <div class="conten-p-new">
                                <div class="contenido-new">
                                    <label for="fecha_ingreso">Fecha Ingreso:</label>
                                    <input type="date" name="fecha_ingreso" id="fecha_ingreso" placeholder="Fecha Ingreso" value="">
                                </div>
                                <div class="contenido-new">
                                    <label for="puesto_trabajo">Puesto de trabajo:</label>
                                    <input type="text" id="puesto_trabajo" name="puesto_trabajo" list="items" placeholder="Seleccione un puesto">
                                    <datalist id="items">
                                        <?php
                                        // Conexión a la base de datos
                                        $servername = "localhost:3306";
                                        $username = "root";
                                        $password = "";
                                        $dbname = "HotelDlux";

                                        $conn = new mysqli($servername, $username, $password, $dbname);

                                        if ($conn->connect_error) {
                                            die("Error de conexión: " . $conn->connect_error);
                                        }

                                        // Consulta a la tabla "tipo_puesto"
                                        $sql = "SELECT id_tipo_puesto, puesto_trabajo FROM tipo_puesto";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            // Generar las opciones del select con los datos de la tabla "tipo_puesto"
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<option value="' . $row["id_tipo_puesto"] . '">' . $row["puesto_trabajo"] . '</option>';
                                            }
                                        }

                                        $conn->close();
                                        ?>
                                    </datalist>
                                </div>
                            </div>
                            <div class="conten-p-new">
                                <div class="contenido-new">
                                    <label for="sueldo">Sueldo:</label>
                                    <input type="number" name="sueldo" id="sueldo" placeholder="Monto a ganar" value="">
                                </div>

                            </div>
                        </div>
                        <div class="btn-new-user">
                            <a href="Gestion_Clientes.php"><i class="fas fa-undo"></i> Regresar</a>
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
    <?php include "../Modelo/Footer.php" ?>
</body>

</html>