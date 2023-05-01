<?php
    include "../Controlador/Eliminar_Reserva_Controlador.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Menu Administrador</title>
        <?php include "../Modelo/scripts.php"?>
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
                <span ><?php echo fechaC(); ?></span>
                <a href="../Modelo/salir.php"><span class="fas fa-sign-out-alt"></span></a>    
            </div>
        </header>
        <!--Navbar Fin-->
        <section>
            <div class="container-eliminar">
                <div class="container-secion-eliminar">
                    <div class="icon-eliminar-user">
                    <i class="fab fa-resolving"></i>
                    </div>
                    <div class="section-eliminar">
                        <h2>¿Deseas dar de baja la Reserva?</h2>
                        <div class="section-eliminar-datos">
                            <div>
                                <p>ID Reserva: </p>
                                <p>Cliente: </p>
                                <p>Fecha Ingreso: </p>
                                <p>Fecha Salida: </p>
                                
                            </div>
                            <div class="segundary-eliminar-datos">
                                <p><?php echo $idreserva; ?></p>
                                <p><?php echo $nombre; ?></p>
                                <p><?php echo $fecha_ingreso; ?></p>
                                <p><?php echo $fecha_salida; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="footer_container">
                        <p>!Si procede a dar de baja es por que la reserva ya vencio!</p>
                    </div>
                </div>
                <form method="post" action="">
                    <div class="footer-eliminar">
                       <input type="hidden" name="idreserva" value="<?php echo $idreserva; ?>">
                       <input type="hidden" name="idhabitacion" value="<?php echo $idhabitacion; ?>">
                       <a href="Gestion_Reservas.php"><i class="fas fa-undo"></i>  Regresar</a>
                       <button type="submit" name="btn_Eliminar"><i class="fas fa-check"></i>  Aceptar</button>
                    </div>
               </form>
            </div>
        </section>
        <div  class="alert" >
            <?php echo isset($alert) ? $alert : ''; ?>
        </div>
    </div>
    <?php include "../Modelo/Footer.php" ?>
</body>
</html>