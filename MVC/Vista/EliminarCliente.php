<?php
include "../Controlador/EliminarClienteControlador.php"
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
                <a href="../Modelo/salir.php"><span class="fas fa-sign-out-alt"></span></a>
            </div>
        </header>
        <!--Navbar Fin-->
        <section>
            <div class="container-eliminar">
                <div class="container-secion-eliminar">
                    <div class="icon-eliminar-user">
                        <i class="fas fa-user-times"></i>
                    </div>
                    <div class="section-eliminar">
                        <h2>¿Deseas cesar al Empleado?</h2>
                        <div class="section-eliminar-datos">
                            <div>
                                <p>Nombre: </p>
                                <p>Sueldo: </p>
                                <p>Fecha de ingreso: </p>
                                <p>Puesto de trabajo:</p>
                            </div>
                            <div class="segundary-eliminar-datos">
                                <p><?php echo $nombre; ?></p>
                                <p>S/. <?php echo $sueldo; ?></p>
                                <p><?php echo $fecha_ingreso; ?></p>
                                <p><?php echo $puesto_trabajo; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="footer-eliminar">
                        <div class="section-eliminar-datos">
                            <div>
                                <h3>Detalles de la cese</h3>
                                <p>Fecha de cese: </p>
                                <p>Motivo de cese: </p>
                            </div>
                            <div class="segundary-eliminar-datos">
                                <p> </p>
                                <p><?php echo fechaC(); ?></p>
                                
                                    <select name="motivo_cese" id="motivo">
                                        <option value="1">Despido</option>
                                        <option value="2">Termino de contrato</option>
                                        <option value="3">Incumplimiento de normas</option>
                                        <option value="4">Renuncia</option>
                                        <option value="5">Otros notivos</option>
                                        <i></i>
                                    </select>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <form method="post" action="">
                    <div class="footer-eliminar">
                        <input type="hidden" name="idcliente" value="<?php echo $idcliente; ?>">
                        <a href="Gestion_Clientes.php"><i class="fas fa-ban"></i> Cancelar</a>
                        <button type="submit" value="Aceptar"><i class="fas fa-check"></i> Confirmar</button>
                    </div>
                </form>
            </div>
        </section>
        <div class="alert">
            <?php echo isset($alert) ? $alert : ''; ?>
        </div>
    </div>
    <?php include "../Modelo/Footer.php" ?>
</body>

</html>