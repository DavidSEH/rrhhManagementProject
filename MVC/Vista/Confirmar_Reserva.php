
<?php 
	include '../Controlador/Confirmar_reserva_Controlador.php';
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Confirmar Reserva</title>
        <?php include "../Modelo/scripts.php"?>
    </head>
    <body>
        <input type="checkbox" id="menu-toggle">
        <!--Sidebar Inicio-->
        <?php include "./sidebar.php" ?>
        <!--Sidebar Fin-->
        <div class="main-content">
            <!--Navbar Inicio-->
            <?php include "../Modelo/HeaderUsu.php" ?>
            <!--Navbar Fin-->
            <section>
                <h2><i class="fas fa-sign-out-alt"></i>  Proceso Registro <span>/Confirmar</span></h2>
                <form  method="post" action="">
                <input type="hidden" name="idhabitacion" value="<?php echo $idhabitacion;?>">
                <input type="hidden" name="idcliente" value="<?php echo $idcliente;?>">
                <input type="hidden" name="idreserva" value="<?php echo $idreserva;?>">
                <input type="hidden" name="idusuario" value="<?php echo $_SESSION['idUser']?>">
                    <div class="principal-genera-r">
                        <div class="cab-datosh">
                            <p class="title-datosh">Datos de la Solicitud</p>
                            <div class="sec-datosh">
                                <div class="dh1">
                                    <div class="dh1-sec">
                                        <p>Nombre:</p>
                                        <p>Detalles:</p>
                                    </div>
                                    <div >
                                        <p><?php echo $numero;?></p>
                                        <p><?php echo $descripcion;?></p>
                                    </div>
                                </div>
                                <div class="dh2">
                                    <div class="dh1-sec">
                                        <p>Modo:</p>
                                        <p>Estado:</p>
                                    </div>
                                    <div >
                                        <p><?php echo $tipo;?></p>
                                        <?php echo $result;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="seccion-datos-ca">
                            <div class="seccion-datos-cli">
                                <p>Datos del Empleado</p>
                                <div  class="datos-cli">
                                    <div  class="div-ext">
                                    <label for="">Nro° Documento:</label>
                                        <div class="div-int">
                                            <i class="fas fa-address-card"></i>
                                            <input type="text" 
                                            value="<?php echo $dni;?>" disabled>
                                        </div>
                                    </div>
                                    <div class="div-ext">
                                        <label for="">Nombres:</label>
                                        <div class="div-int">
                                            <i class="fas fa-user-secret"></i>
                                            <input type="text"
                                            value="<?php echo $nombre;?>" disabled>
                                        </div>
                                    </div>
                                    <div class="div-ext">
                                        <label for="">Direccion</label>
                                        <div class="div-int">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <input type="text"
                                            value="<?php echo $domicilio;?>" disabled>
                                        </div>
                                    </div>
                                    <div class="div-ext">
                                        <label for="">Telefono:</label>
                                        <div class="div-int">
                                            <i class="fas fa-phone"></i>
                                            <input type="number"
                                            value="<?php echo $telefono;?>" disabled>
                                        </div>
                                    </div>
                                    <div class="div-ext">
                                        <label for="">Correo</label>
                                        <div class="div-int">
                                            <i class="fas fa-at"></i>
                                            <input type="email" 
                                            value="<?php echo $correo; ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Datos Alojamiento-->
                            <div class="seccion-datos-aloj">
                                <p>Datos de la Licencia</p>
                                
                                <div class="datos-aloj">
                                    <div class="div-tar-aloj">
                                        <label for="">Modo:</label>
                                        <div class="div-input-aloj">
                                            <i class="fas fa-bullseye"></i>
                                            <input type="text" value="<?php echo $tipo; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="div-ext-part">
                                        <div class="div-div-int">
                                            <label for="">Pago:</label>
                                            <div class="div-input-aloj">
                                                <i class="fas fa-money-bill-wave"></i>
                                                <input type="text" value="<?php echo 'S/.'.$precio;?>" disabled>
                                            </div>
                                        </div>
                                        <div class="div-div-int">
                                            <label for="">Cant Dias:</label>
                                            <div class="div-input-aloj">
                                                <i class="fas fa-cloud-moon"></i>
                                                <input type="number" name="cant"  
                                                value="<?php echo $cant_noches;?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="div-ext-part">
                                        <div class="div-div-int">
                                            <label for="">Fecha Ingreso:</label>
                                            <div class="div-input-aloj">
                                                <i class="fas fa-calendar-alt"></i>
                                                <input type="date" name="fechain" 
                                                value="<?php echo $fecha_ingreso;?>" disabled>
                                            </div>
                                        </div>
                                        <div class="div-div-int">
                                            <label for="">Hora:</label>
                                            <div class="div-input-aloj">
                                                <i class="fas fa-clock"></i>
                                                <input type="time" name="horain" 
                                                value="<?php echo $hora_ingreso;?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="div-ext-part">
                                        <div class="div-div-int">
                                            <label for="">Fecha Salida:</label>
                                            <div class="div-input-aloj">
                                            <i class="fas fa-calendar-alt"></i>
                                                <input type="date" name="fechasal" 
                                                value="<?php echo $fecha_salida;?>" disabled>
                                            </div>
                                        </div>
                                        <div class="div-div-int">
                                            <label for="">Hora:</label>
                                            <div class="div-input-aloj">
                                                <i class="fas fa-clock"></i>
                                                <input type="time" name="horasal" 
                                                value="<?php echo $hora_salida;?>" disabled >
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="div-ext-part">
                                        
                                        <div class="div-div-int">
                                            <button name="regresar">
                                            <i class="fas fa-undo"></i>Regresar</button>
                                        </div>
                                        
                                        <div class="div-div-int">
                                        
                                            <button type="submit" name="confirmar" 
                                            class="btn2-r-cancel">
                                            <i class="fas fa-check-circle"></i>Confirmar</button>
                                        
                                        </div>
                                    
                                    </div>
                                </div>
                                
                                </div>
                            </div>
                    </div>
                    <div  class="alert" >
                        <?php echo isset($alert) ? $alert : ''; ?>
                    </div>
                </form>     
            </section>
            
            
        </div>
           
        <?php include "../Modelo/Footer.php" ?>   
    </body>
</html>