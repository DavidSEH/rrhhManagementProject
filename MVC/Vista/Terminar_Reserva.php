
<?php 
	include '../Controlador/Terminar_reserva_Controlador.php';
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Finalizar Reserva</title>
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
                <h2><i class="fas fa-sign-out-alt"></i>  Proceso Final <span>/Salida</span></h2>
                <form  method="post" action="">
                <input type="hidden" name="idhabitacion" value="<?php echo $idhabitacion;?>">
                <input type="hidden" name="idcliente" value="<?php echo $idcliente;?>">
                <input type="hidden" name="idreserva" value="<?php echo $idreserva;?>">
                <input type="hidden" name="idusuario" value="<?php echo $_SESSION['idUser']?>">
                <?php 
                    date_default_timezone_set('America/Lima'); 
                    $fecha_pago=date("Y-m-d");
                ?>
                <input type="hidden" name="fecha_pago" value="<?php echo $fecha_pago;?>">
                <input type="hidden" name="precio_pago" value="<?php echo $precio;?>">
                <input type="hidden" name="cantidad_pago" value="<?php echo $cant_noches;?>">
                <input type="hidden" name="adelantado_pago" value="<?php echo isset($adelantado) ? $adelantado : '0.00';?>">
                <input type="hidden" name="porcentaje_pago" value="<?php echo isset($porcentaje) ? $porcentaje : '0.00';?>">    
                <div class="principal-genera-r">
                        <div class="cab-datosh">
                            <p class="title-datosh">Datos de la Licencia</p>
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
                                        <p>Tipo:</p>
                                        <p>Costo por dia:</p>
                                    </div>
                                    <div >
                                        
                                        <p><?php echo $tipo;?></p>
                                        <p>S./<?php echo $precio;?></p>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cab-datosh">
                            <p class="title-datosh">Datos del Registro</p>
                            <div class="sec-datosh">
                                <div class="dh1">
                                    <div class="dh1-sec">
                                        <p>Nombre Empleado:</p>
                                        <p>DNI Emplado:</p>
                                        <p>Direccion Emplado:</p>
                                        <p>Telefono Emplado:</p>
                                    </div>
                                    <div >
                                        <p><?php echo $nombre;?></p>
                                        <p><?php echo $dni;?></p>
                                        <p><?php echo $domicilio;?></p>
                                        <p><?php echo $telefono;?></p>
                                    </div>
                                </div>
                                <div class="dh1">
                                    <div class="dh1-sec">
                                        <p>Inicio Licencia:</p>
                                        <p id="num-habitacion" style="display: none;">Hora Ingreso:</p>
                                        <p>Fin Licencia:</p>
                                        <p id="num-habitacion" style="display: none;">Hora Salida:</p>
                                    </div>
                                    <div >
                                        <p><?php echo $fecha_ingreso;?></p>
                                        <p id="num-habitacion" style="display: none;"><?php echo $hora_ingreso;?></p>
                                        <p><?php echo $fecha_salida;?></p>
                                        <p id="num-habitacion" style="display: none;"><?php echo $hora_salida;?></p>
                                    </div>
                                </div>
                                
                                <div class="dh1" id="num-habitacion" style="display: none;">
                                    <div class="dh1-sec">
                                        <p>Cantidad de dias:</p>
                                        <p>Adelantado:</p>
                                    </div>
                                    <div >
                                        
                                        <p><?php echo $cant_noches;?></p>
                                        <p><?php echo $adelantado;?></p>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="seccion-datos-ca" >
                            <div class="seccion_metpago">
                                <p class="title-pagos">Metodo y Condiciones de Pago</p>
                                <div class="princ-metpago">
                                    
                                    <div >
                                        <p>Metodo de Pago</p>
                                        <?php 
                                            $query_rol = mysqli_query($conection,"SELECT * FROM tipopago");
                                            mysqli_close($conection);
                                            $result_rol = mysqli_num_rows($query_rol);

                                        ?>
                                        <select name="tipopago" id="">
                                        <?php
                                        
                                        if($result_rol > 0){
                                                while ($tipopago = mysqli_fetch_array($query_rol)) {
                                        ?>
                                                <option value="<?php echo $tipopago["idtipopago"]; ?>">
                                                <?php echo $tipopago["nombre"] ?></option>
                                        <?php 
                                                   
                                                }
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <p>Descripcion:</p>
                                        <input name="descripcion" type="text" value=" ">
                                    </div>
                                    <div >

                                    <button name="btnCancelar" class="bg_confir"><i class="fas fa-undo"></i> Regresar</button>
                                    
                                        
                                    </div>
                                </div>
                            </div>
                            <!--Datos Pagos-->
                            <div class="seccion_pago">
                                <p class="title-pagos">Proceso Pago</p>
                                <div class="princ-pago">
                                    <div id="num-habitacion" style="display: none";>
                                        <p>Importe:</p>
                                        <input type="number" name="imp" value="<?php echo $importe;?>" disabled>
                                    </div>
                                    <div id="num-habitacion" style="display: none";>
                                        <p>Descuento :</p>
                                        
                                        <input type="number"  name="des" value="<?php echo $descuento;?>" disabled>
                                    </div>
                                    <div id="num-habitacion" style="display: none";>
                                        <p>IGV :</p>
                                        <input type="number"  value="<?php echo $igv;?>" disabled>
                                    </div>
                                    <div id="num-habitacion" style="display: none";>
                                        <p>Total:</p>
                                        <input type="number"  name="tot" value="<?php echo $total;?>" disabled>
                                    </div>
                                    <div>
                                        <button name="btnTerminar"><i class="fas fa-check-circle"></i> Confirmar</button>
                                        <?php echo isset($msg_print) ? $msg_print : ''; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div>
                        <?php echo isset($alert) ? $alert : ''; ?>
                    </div>
                     
            </section>
            
            
        </div>
           
        <?php include "../Modelo/Footer.php" ?>   
    </body>
</html>