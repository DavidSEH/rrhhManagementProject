
<?php 
	include "../Controlador/ModificarHabitacionControlador.php";
 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Modificar Licencias</title>
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
                <div class="container-actualizar-hab">
                    <div class="section-actualizar-hab">
                        <p>Actualizar Licencia</p>
                        <form action="" method="post">
                        <input type="hidden" name="idhabitacion" value="<?php echo $idhabitacion; ?>">
                        <div class="formulario-actualizar-hab">
                            <label for="">Número de Licencia</label>
                            <input type="text" name="nombre" value="<?php echo $nombre; ?>">
                            <label for="">Prioridad:</label>
                            <input type="text" name="piso" value="<?php echo $piso; ?>"> 
                            <label for="">Pago:</label>
                            <input type="text" name="precio" value="<?php echo $precio; ?>">
                            <label for="">Descripcion</label>
                            <input type="text" name="descripcion" value="<?php echo $descripcion; ?>">
                            <label for="">Categoria:</label>
                            <?php 
                                $query_tipo = mysqli_query($conection,"SELECT * FROM tipohabitacion");
                                mysqli_close($conection);
                                $result_tipo = mysqli_num_rows($query_tipo);
                            ?>
                            <select name="categoria" id="categoria" class="notItemOne">
                                <?php
                                    echo $option; 
                                    if($result_tipo > 0)
                                    {
                                        while ($cat = mysqli_fetch_array($query_tipo)) {
                                ?>
                                        <option value="<?php echo $cat["idtipohabitacion"]; ?>">
                                        <?php echo $cat["nombre_tipo"] ?></option>
                                <?php 
                                            
                                        }
                                    }
                                ?>
                            </select>
                            
                        </div>
                        <div class="btn-actualizar-hab">
                            <a href="Habitacion.php"><i class="fas fa-undo"></i>Regresar</a>
                            <button type="submit" ><i class="fas fa-edit"></i>Actualizar</button>
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