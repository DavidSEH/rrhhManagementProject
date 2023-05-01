<?php 
	session_start();
    include "../Controlador/DP_Cliente_Controlador.php"
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Menu Empleado</title>
        <?php include "../Modelo/scripts2.php"?>
    </head>
    <body>
        <input type="checkbox" id="menu-toggle">
        <!--Sidebar Inicio-->
        
            <?php include "./sidebarCliente.php" ?>
        
       
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
                    <a href="../Modelo/salir2.php"><span class="fas fa-sign-out-alt"></span></a>    
                </div>
            </header>
            <!--Navbar Fin-->
            <section >
                <form action="" method="post">
                <input type="hidden" name="idcliente" value="<?php echo $_SESSION['idCli']; ?>">
                <div class="principal-datos-p">
                    <h2><i class="fas fa-user"></i> Datos Personales</h2>
                    <div class="principal-datospersonales">
                        <div class="seccion-datospersonales">
                            <div class="sdp1">
                                <div class="section-img-datos-p">
                                    <img src="../../Imagenes/people.jpg" alt="">
                                    <p><?php echo $nombre; ?></p>
                                </div>
                                <div class="section-datos-p">
                                    <div>
                                        <p class="sec-parr-mdp">Edad</p>
                                        <p><?php echo $edad; ?></p>
                                    </div>
                                    <div>
                                        <p class="sec-parr-mdp">DNI</p>
                                        <p><?php echo $dni; ?></p>
                                    </div>
                                </div>
                                <div class="footer-btn-smdp">
                                    <button type="submit" name="btnPassword">Cambiar Password</button>
                                </div>
                            </div>
                            <div class="sdp2">
                                <div  class="cab-sdp2">
                                    <p>Sobre mi</p>
                                </div>
                                <div class="section-sdp2">
                                    <div>
                                        <p class="parr-sect-sdp2"><i class="fas fa-phone"></i>Telefono</p>
                                        <p ><?php echo $telefono; ?></p>
                                    </div>
                                    <div>
                                        <p class="parr-sect-sdp2"><i class="fas fa-map-marker-alt"></i>Domicilio</p>
                                        <p ><?php echo $domicilio;?></p>
                                    </div>
                                    <div>
                                        <p class="parr-sect-sdp2"><i class="fas fa-at"></i>Correo</p>
                                        <p ><?php echo $correo;?></p>
                                    </div>
                                    <div>
                                        <p class="parr-sect-sdp2"><i class="fas fa-pen-alt"></i>Informacion Adicional</p>
                                        <p ><?php echo $informacion;?></p>
                                    </div>
                                </div>
                                <div class="section-btn-datos-p">
                                    <button id="btnEnviar" name="btnEnviar">Editar</button>
                                </div>
                            </div>
                        </div>
                        <div class="modifcar-datospersonales">
                            <div class="modificar-dp">
                                <div class="cab-mdp">
                                    <p>Editar Datos Personales</p>
                                </div>
                                <div class="sec-mdp">
                                    <div class="mod1">
                                        <p >Telefono</p>
                                        <p>Domiclio</p>
                                        <p>Correo</p>
                                        <p>Informacion Adicional</p>
                                    </div>
                                    <div class="mod2">
                                        <input type="text" name="telefono"  value="<?php echo isset($telefono2) ? $telefono2 : '';?>">
                                        <input type="text" name="domicilio" value="<?php echo isset($domicilio2) ? $domicilio2 : '';?>">
                                        <input type="email" name="correo" value="<?php echo isset($correo2) ? $correo2 : '';?>">
                                        <input type="tel" name="informacion" class="txt-ip" value="<?php echo isset($informacion2) ? $informacion2 : '';?>">
                                        <button type="submit" name="btnGuardar">Guardar</button>
                                    </div>
                                </div>
                                <div class="footer-mdp">
                                    <p>Cuidado con ingresar datos erroneos</p>
                                </div>
                            </div>
                            <?php echo isset($result) ? $result : ''; ?>
                        </div>
                    </div>
                </form>
            </section>
            <div  class="alert" >
                    <?php echo isset($alert) ? $alert : ''; ?>
            </div>
        </div>
            
        
    </body>
</html>