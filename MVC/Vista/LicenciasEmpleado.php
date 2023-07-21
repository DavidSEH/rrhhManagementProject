
<?php 
	session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Menu</title>
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
                
                    <h2>Licencias</h2>
                    <div class="principal-recepcion">
                        <div class="cab-recepcion">
                                <p><i class="fas fa-flag-checkered"></i>Items</p>
                                <div class="cab-sec-recepcion">
                                    
                                </div>
                        </div>
                        <div class="seccion-recepcion">
                        <?php 
                        include "../Modelo/conexion.php";
                   
                        $query = mysqli_query($conection, "SELECT * FROM tipo_licencia");
                        mysqli_close($conection);
                        $result = mysqli_num_rows($query);
                        if($result > 0){
                            while ($data = mysqli_fetch_array($query)) {     
                                                     
                        ?>
                            <div class="seccion-hab-recepcion">
                                <div class="princ-hab-recepcion">
                                    <div class="sec-hab-rec-m1">
                                        <h1><?php echo $data["cod_licencia"]; ?></h1>
                                        <p><?php echo $data["nom_licencia"]; ?></p>
                                    </div>
                                    <div class="sec-hab-rec-m2">   
                                        <i class="fas fa-file-signature"></i>
                                    </div>
                                </div>
                                <div class="footer-hab-recpcion">
                                    <a href="Nueva_Licencia_Empleado.php?id=<?php echo $data["cod_licencia"]; ?>">Tramitar
                                        <i class="fas fa-arrow-alt-circle-right"></i></a>
                                </div>
                            </div>
                            <?php 
                                        
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <div  class="alert" >
                        <?php echo isset($alert) ? $alert : ''; ?>
                    </div>
            </section>
        </div>
    </body>
</html>