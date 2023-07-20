<?php 
	session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Menu Empleado</title>
        <?php include "../Modelo/scripts2.php"?>
    </head>
    <body>
        <input type="checkbox" id="menu-toggle">
        <!--Sidebar Inicio--> 
            <?php include "./sidebarEmpleado.php" ?>
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
                    <h2>Vista General de Licencia</h2>
                    <div class="principal-recepcion">
                    </div>
                    <div  class="alert" >
                        <?php echo isset($alert) ? $alert : ''; ?>
                    </div>
            </section>
        </div>
           
        
    </body>
</html>