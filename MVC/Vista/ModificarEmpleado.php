                    
<?php 
    include "../Controlador/ModificarCliControlador.php";
 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Modificar Empleado</title>
        <?php include "../Modelo/scripts.php"?>
    </head>
    <body>
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
                    <span ><?php echo fechaC(); ?></span>
                    <a href="../Modelo/salir.php"><span class="fas fa-sign-out-alt"></span></a>    
                </div>
            </header>
            <!--Navbar Fin-->
            <section>
                <div class="container-actualizar-user">
                    <div class="section-actualizar-user">
                        <p>Actualizar Empleado</p>
                        <form action="" method="post">
                        <div class="formulario-actualizar-user">
                        <input type="hidden" name="cod_personal" value="<?php echo $cod_personal;?>">
                                <div class="conten-p-upd">
                                    <div class="contenido-upd">
                                        <label for="dni">DNI:</label>
                                        <input type="number" name="dni" id="dni" placeholder="DNI" value="<?php echo $dni; ?>">
                                    </div>
                                    <div class="contenido-upd">
                                        <label for="nombres">Nombre:</label>
                                        <input type="text" name="nombres" id="nombres" placeholder="Nombre completo" value="<?php echo $nombres; ?>">
                                    </div>
                                </div>
                                <div class="conten-p-upd">
                                    <div class="contenido-upd"> 
                                        <label for="edad">Edad:</label>
                                        <input type="number" name="edad" id="edad" placeholder="Edad" value="<?php echo $edad; ?>">
                                    </div>
                                    <div class="contenido-upd">
                                        <label for="correo">Correo electrónico:</label>
                                        <input type="email" name="correo" id="correo" placeholder="Correo electrónico" value="<?php echo $correo; ?>">
                                    </div>
                                </div>
                                <div class="conten-p-upd">
                                    <div class="contenido-upd"> 
                                        <label for="telefono">Telefono:</label>
                                        <input type="number" name="telefonoo" id="telefono" placeholder="Telefono" value="<?php echo $telefonoo; ?>">
                                    </div>
                                    <div class="contenido-upd"> 
                                        <label for="domicilio">Domicilio:</label>
                                        <input type="text" name="direccioon" id="direccion" placeholder="Domicilio" value="<?php echo $direccioon;?>">
                                    </div>
                                </div> 
                        </div>
                        <div class="btn-actualizar-user">
                            <a href="Gestion_Empleados.php"><i class="fas fa-undo"></i>Regresar</a>
                            <button type="submit" value="Actualizar usuario"><i class="fas fa-edit"></i>Actualizar</button>
                        </div>
                        </form>
                    </div>
                </div>              
            </section>
                <div  class="alert" >
                    <?php echo isset($alert) ? $alert : ''; ?>
                </div>
        </div>
        <?php include "../Modelo/Footer.php" ?>
    </body>
</html>
