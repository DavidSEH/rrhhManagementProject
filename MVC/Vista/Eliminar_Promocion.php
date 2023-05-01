<?php
    include "../Controlador/Eliminar_Promocion_Controlador.php"
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
                    <i class="fab fa-product-hunt"></i>
                    </div>
                    <div class="section-eliminar">
                        <h2>¿Deseas Finalizar la Promoción?</h2>
                        <div class="section-eliminar-datos">
                            <div>
                                <p>ID Promocion: </p>
                                <p>Fecha Inicio: </p>
                                <p>Fecha Fin: </p>
                                <p>Porcentaje: </p>
                            </div>
                            <div class="segundary-eliminar-datos">
                                <p><?php echo $idpromocion; ?></p>
                                <p><?php echo $fecha_inicio; ?></p>
                                <p><?php echo $fecha_fin; ?></p>
                                <p><?php echo $porcentaje; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <form method="post" action="">
                    <div class="footer-eliminar">
                       <input type="hidden" name="idpromocion" value="<?php echo $idpromocion; ?>">
                       <a href="Gestion_Promocion.php"><i class="fas fa-undo"></i>  Regresar</a>
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