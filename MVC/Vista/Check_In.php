
<?php 
	session_start();
 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Licencia</title>
        <?php include "../Modelo/scripts.php"?>
    </head>
    <body>
        <input type="checkbox" id="menu-toggle">
        <!--Sidebar Inicio-->
        <?php include "./sidebar.php" ?>
        <!--Sidebar Fin-->
       
        <!--Sidebar Fin-->
        <div class="main-content">
            <!--Navbar Inicio-->
            <?php include "../Modelo/HeaderUsu.php" ?>
            <!--Navbar Fin-->
            <section >
                <div>
                    <h2><i class="fas fa-sign-out-alt"></i> Licencia <span>/Registro</span></h2>
                    <div class="principal-recepcion">
                        <div class="cab-recepcion">
                                
                                
                        </div>
                        <div class="seccion-recepcion">
                        <?php 
                        include "../Modelo/conexion.php";
                        $title='';
                        $msg='';
                        $query = mysqli_query($conection,"SELECT h.idhabitacion,h.num_habitacion,h.idtipohabitacion,h.descripcion, h.piso ,h.precio,
                                                            th.nombre_tipo,h.estatus FROM habitacion h 
                                                            INNER JOIN tipohabitacion th ON 
                                                            h.idtipohabitacion = th.idtipohabitacion
                                                            ORDER BY h.num_habitacion");
                        mysqli_close($conection);
                        $result = mysqli_num_rows($query);
                        
                        if($result > 0){
                            while ($data = mysqli_fetch_array($query)) {
                                if ($data["estatus"]==0) {
                                    $title='princ-hab-recepcion2';
                                    $title2='footer-hab-recpcion2';
                                    $msg='<a href="Confirmar_Reserva.php?id='.$data['idhabitacion'].'">No Tramitable <i class="fas fa-spinner"></i></a>';
                                }
                                if ($data["estatus"]==1) {
                                    $title='princ-hab-recepcion';
                                    $title2='footer-hab-recpcion';
                                    $msg='<a href="Generar_Reserva.php?id='.$data['idhabitacion'].' ">Tramitar <i class="fas fa-arrow-alt-circle-right"></i></a>';
                                }
                                if ($data["estatus"]==2) {
                                    $title='princ-hab-recepcion';
                                    $title2='footer-hab-recpcion';
                                    $msg='<a href="Generar_Reserva.php?id='.$data['idhabitacion'].' ">Tramitar <i class="fas fa-arrow-alt-circle-right"></i></a>';
                                }
                               
                                    if ($data["estatus"]==2 || $data["estatus"]==1) {
                                        ?>
                                            <div class="seccion-hab-recepcion">
                                                <div class="<?php echo $title ?>">
                                                    <div class="sec-hab-rec-m1">
                                                        <h1 id="num-habitacion" style="display: none";><?php echo $data["num_habitacion"]; ?></h1>
                                                        <p><?php echo $data["nombre_tipo"]; ?></p>
                                                    </div>
                                                    <div class="sec-hab-rec-m2">   
                                                        <i class="fas fa-file-signature"></i>
                                                    </div>
                                                </div>
                                                <div class="<?php echo $title2 ?>">
                                                    <?php echo $msg ?>
                                                </div>
                                            </div>
                                            <?php 
                                            }
                                         
                                    }
                                }
                            ?>
                        </div>
                </div>
            </section>
        </div>
        <?php include "../Modelo/Footer.php" ?>
    </body>
</html>