<?php 
	session_start();
    
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Menu Cliente</title>
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
            <section>
                <h2> <i class="fas fa-hotel"></i>Promociones Vigente <span>/Avance</span></h2>
                <div class="section">
                    <div class="section__content">
                        <div class="conten__imgs img1">
                            <div class="conten__imgs__secc">
                                <h3>Double Room</h3>
                                <p>Disponible Hasta el 20 de julio en todas las habitaciones Dobles</p>
                                <span>Descuento : 15% </span>
                            </div>
                        </div>
                        <div class="conten__imgs img2">
                            <div class="conten__imgs__secc">
                                <h3>Deluxe Room</h3>
                                <p>Disponible Hasta el 15 de Agosto en todas las habitaciones Matrimoniales</p>
                                <span>Descuento : 25% </span>
                            </div>
                        </div>
                        <div class="conten__imgs img3">
                            <div class="conten__imgs__secc">
                                <h3>Deluxe Room</h3>
                                <p>Disponible Hasta el 12 de julio en todas las habitaciones Individuales</p>
                                <span>Descuento : 10% </span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
        </div>

           
        
    </body>
</html>