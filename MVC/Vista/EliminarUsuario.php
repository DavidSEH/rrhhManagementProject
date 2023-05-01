<?php
    include "../Controlador/EliminarControlador.php"
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
                        <i class="fas fa-user-times"></i>
                    </div>
                    <div class="section-eliminar">
                        <h2>¿Deseas dar de baja al Usuario?</h2>
                        <div class="section-eliminar-datos">
                            <div>
                                <p>IDusuario: </p>
                                <p>Nombre: </p>
                                <p>Usuario: </p>
                                <p>Tipo Usuario:</p>
                            </div>
                            <div class="segundary-eliminar-datos">
                                <p><?php echo $idusuario; ?></p>
                                <p><?php echo $nombre; ?></p>
                                <p><?php echo $usuario; ?></p>
                                <p><?php echo $rol; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <form method="post" action="">
                    <div class="footer-eliminar">
                       <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
                       <a href="Gestion_Usuario.php"><i class="fas fa-ban"></i>  Cancelar</a>
                       <button type="submit" value="Aceptar"><i class="fas fa-check"></i>  Aceptar</button>
                    </div>
               </form>
            </div>
        </section>
    </div>
    <?php include "../Modelo/Footer.php" ?>
</body>
</html>