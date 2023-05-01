                    
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
                        <input type="hidden" name="idcliente" value="<?php echo $idcliente;?>">
                                <div class="conten-p-upd">
                                    <div class="contenido-upd">
                                        <label for="dni">DNI:</label>
                                        <input type="number" name="dni" id="dni" placeholder="DNI" value="<?php echo $dni; ?>">
                                    </div>
                                    <div class="contenido-upd">
                                        <label for="nombre">Nombre:</label>
                                        <input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="<?php echo $nombre; ?>">
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
                                        <input type="number" name="telefono" id="telefono" placeholder="Telefono" value="<?php echo $telefono; ?>">
                                    </div>
                                    <div class="contenido-upd"> 
                                        <label for="domicilio">Domicilio:</label>
                                        <input type="text" name="domicilio" id="domicilio" placeholder="Domicilio" value="<?php echo $domicilio;?>">
                                    </div>
                                </div>
                                <div class="conten-p-upd">
                                    <div class="contenido-upd"> 
                                        <label for="usuario">Usuario:</label>
                                        <input type="text" name="usuario" id="usuario" placeholder="Usuario" value="<?php echo $usuario; ?>">
                                    </div>
                                    <div class="contenido-upd">  
                                        <label for="clave">Clave:</label>
                                        <input type="password" name="clave" id="clave" placeholder="Clave de acceso" value="">
                                    </div>
                                </div>
                        </div>
                        <div class="btn-actualizar-user">
                            <a href="Gestion_Clientes.php"><i class="fas fa-undo"></i>Regresar</a>
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
