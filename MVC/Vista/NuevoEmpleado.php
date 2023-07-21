<?php
session_start();
include "../Controlador/RegistroEmpleadoControlador.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Nuevo Empleado</title>
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
                                    <label for="nombre">Nombres:</label>
                                    <input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="">
                                    <label for="apellido">Apellidos:</label>
                                    <input type="text" name="apellido" id="apellido" placeholder="Apellido completo" value="">
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
                                    <label for="fecha_ingreso">Fecha de ingreso:</label>
                                    <input type="date" name="fecha_ingreso" id="fecha_ingreso" placeholder="Fecha Ingreso" value="">
                                </div>
                                <div class="contenido-new">
                                    <label for="puesto_trabajo">Puesto de trabajo:</label>
                                    <select name="cod_puesto" id="motivo">
                                        <?php echo $options; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="conten-p-new">
                                <div class="contenido-new">
                                    <label for="sueldo">Sueldo:</label>
                                    <input type="number" name="sueldo" id="sueldo" placeholder="Monto a ganar" value="">
                                </div>
                                <div class="contenido-new">
                                    <label for="hijos">Tiene hijos:</label>
                                    <select name="hijos" id="hijos">
                                        <option value="1">Si</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="conten-p-new">
                                <div class="contenido-new">
                                    <label for="hijos">Tipo de pensión:</label>
                                    <select name="id_pension_tipo" id="id_pension_tipo">
                                        <option value="1">SNP</option>
                                        <option value="0">AFP</option>
                                    </select>
                                </div>
                                <div class="contenido-new">
                                    <label for="cuenta_bancaria">Número de cuenta:</label>
                                    <input type="text" name="cuenta_bancaria" id="cuenta_bancaria" placeholder="XXX-XXXXXXXXXX" value="">
                                </div>
                            </div>
                        </div>
                        <div class="btn-new-user">
                            <a href="Gestion_Empleados.php"><i class="fas fa-undo"></i> Regresar</a>
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