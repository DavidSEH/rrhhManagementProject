<?php 
	session_start();
    include "../Controlador/Modificar_Reserva_Cliente_Controlador.php";
    
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
            <section>
                <div class="container-actualizar-user">
                    <div class="section-actualizar-user">
                        <p>Modificar Reserva</p>
                        <form action="" method="post">
                        <div class="formulario-actualizar-user">
                            <input type="hidden" name="idreserva" value="<?php echo $idreserva; ?>">
                                <div class="conten-p-upd">
                                    <div class="contenido-upd" style="width:100%"> 
                                        <label for="usuario">N° :</label>
                                        <input type="text" name="adelantado" value="<?php echo $num_habitacion; ?>" disabled>
                                    </div>
                                </div>
                                <div class="conten-p-upd">
                                    <div class="contenido-upd" style="width:100%">
                                        <label for="dni">Fecha Ingreso:</label>
                                        <input type="date" name="fecha_ingreso"   value="<?php echo $fecha_ingreso ; ?>" >
                                    </div>
                                    <div class="contenido-upd" style="width:100%">
                                        <label for="dni">Hora Ingreso:</label>
                                        <input type="time" name="hora_ingreso"   value="<?php echo $hora_ingreso ; ?>" >
                                    </div>
                                </div>
                                <div class="conten-p-upd">
                                    <div class="contenido-upd" style="width:100%">
                                        <label for="dni">Fecha Salida:</label>
                                        <input type="date" name="fecha_salida"   value="<?php echo $fecha_salida ; ?>" >
                                    </div>
                                    <div class="contenido-upd" style="width:100%">
                                        <label for="dni">Hora Salida:</label>
                                        <input type="time" name="hora_salida"   value="<?php echo $hora_salida ; ?>" >
                                    </div>

                                </div>
                                <div class="conten-p-upd">
                                    <div class="contenido-upd" style="width:100%"> 
                                        <label for="number">N° Dias: </label>
                                        <input type="number" name="cant_noches"   value="<?php echo $cant_noches; ?>">
                                    </div>
                                    
                                </div>
                                
                               
                        </div>
                        <div class="btn-actualizar-user">
                            <a href="ListaReservasCliente.php"><i class="fas fa-undo"></i>Regresar</a>
                            <button type="submit" name="btn_Modificar"><i class="fas fa-edit"></i>Modificar</button>
                        </div>
                        </form>
                    </div>
                </div>              
            </section>
            <div  class="alert" >
                    <?php echo isset($alert) ? $alert : ''; ?>
                </div>
            
        </div>
           
        
    </body>
</html>