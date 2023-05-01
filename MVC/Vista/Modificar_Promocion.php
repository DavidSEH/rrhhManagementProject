
<?php 
    include "../Controlador/Modificar_Promocion_Controlador.php";
 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Modificar Promocion</title>
        <?php include "../Modelo/scripts.php"?>
    </head>
    <body>
        <input type="checkbox" id="menu-toggle">
        <!--Sidebar Inicio-->
        <?php include "./sidebar.php" ?>
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
                        <p>Modificar Promocion</p>
                        <form action="" method="post">
                        <div class="formulario-actualizar-user">
                            <input type="hidden" name="idpromocion" value="<?php echo $idpromocion; ?>">
                                <div class="conten-p-upd">
                                    <div class="contenido-upd" style="width:100%">
                                        <label for="dni">Fecha Inicio:</label>
                                        <input type="date" name="fecha_in"   value="<?php echo $fecha_inicio ; ?>" disabled>
                                    </div>
                                </div>
                                <div class="conten-p-upd">
                                    <div class="contenido-upd" style="width:100%"> 
                                        <label for="edad">Fecha Fin:</label>
                                        <input type="date" name="fecha_fin"   value="<?php echo $fecha_fin; ?>">
                                    </div>

                                </div>
                                <div class="conten-p-upd">
                                    <div class="contenido-upd" style="width:100%"> 
                                        <label for="number">Porcentaje: </label>
                                        <input type="text" name="porcentaje"   value="<?php echo $porcentaje; ?>">
                                    </div>
                                    
                                </div>
                                <div class="conten-p-upd">
                                    <div class="contenido-upd" style="width:100%"> 
                                        <label for="usuario">Descripcion:</label>
                                        <input type="text" name="descripcion" placeholder="descripcion"  value="<?php echo $descripcion; ?>">
                                    </div>
                                </div>
                                
                                <label for="tipohabitacion">Tipo Habitacion</label>
                                <?php 
                                    $query_tipohabitacion = mysqli_query($conection,"SELECT * FROM tipohabitacion");
                                    mysqli_close($conection);
                                    $result_tipohabitacion = mysqli_num_rows($query_tipohabitacion);

                                ?>
                                <select name="id_tipohabitacion"  class="notItemOne">
                                    <?php
                                        echo $option; 
                                        if($result_tipohabitacion > 0)
                                        {
                                            while ($tipohabitacion = mysqli_fetch_array($query_tipohabitacion)) {
                                    ?>
                                            <option value="<?php echo $tipohabitacion['idtipohabitacion']; ?>">
                                            <?php echo $tipohabitacion['nombre_tipo'] ?></option>
                                    <?php 
                                                
                                            }
                                        }
                                    ?>
                                </select>
                        </div>
                        <div class="btn-actualizar-user">
                            <a href="Gestion_Promocion.php"><i class="fas fa-undo"></i>Regresar</a>
                            <button type="submit" name="btn_Modificar" value="Actualizar usuario"><i class="fas fa-edit"></i>Modificar</button>
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