
<?php 
    session_start();
 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Licencias</title>
        <?php include "../Modelo/scripts.php"?>
    </head>
    <body>
        <input type="checkbox" id="menu-toggle">
        <!--Sidebar Inicio-->
        <?php include "sidebar.php" ?>
        <!--Sidebar Fin-->

        <div class="main-content">
            <!--Navbar Inicio-->
        <?php  
            include "../Modelo/HeaderUsu.php" 
        ?>
            <!--Navbar Fin-->
            <section>
                <div class="cab-user">
                    <h2> <i class="fas fa-couch"></i> Mantenimiento de Licencias</h2>
                    <a href="Nuevo_Habitacion.php">Nueva Licencia</a>
                </div>
                <div class="listado-principal-tabla">
                    <div class="cab-tabla">
                        <div>
                        </div>
                        <div>
                            <a href="../../Reportes/Reporte_Habitacion.php?idUser=<?php echo $_SESSION['idUser']; ?>"
                            target="_blank" class="bg_primary">
                            <i class="fas fa-file-pdf"></i>Imprimir</a>
                        </div>
                        
                    </div >
                    <div class="listado-tabla">
                        <table>
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Detalle</th>
                                    <!--th>Piso</th>
                                    <th>Precio</th-->
                                    <th>Categoria</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <?php 
                            include "../Modelo/conexion.php";
                            /*Paginador*/
                            $sql_registro = mysqli_query($conection,"SELECT COUNT(*)AS total_registro FROM habitacion");
                            $result_register = mysqli_fetch_array($sql_registro);
			                $total_registro = $result_register['total_registro'];
                            $por_pagina = 15;

                            if(empty($_GET['pagina']))
                            {
                                $pagina = 1;
                            }else{
                                $pagina = $_GET['pagina'];
                            }
                            $desde = ($pagina-1) * $por_pagina;
			                $total_paginas = ceil($total_registro / $por_pagina);

                            $msg='';
                            $query = mysqli_query($conection,"SELECT h.idhabitacion,h.num_habitacion,h.descripcion,
                                                    h.piso,h.precio,(th.nombre_tipo)AS categoria,h.estatus
                                                    FROM habitacion h
                                                    INNER JOIN tipohabitacion th ON (h.idtipohabitacion=th.idtipohabitacion)
                                                    ORDER BY num_habitacion ASC LIMIT $desde,$por_pagina;");
                            mysqli_close($conection);
                            $result = mysqli_num_rows($query);
                            if($result > 0){
                                while ($data = mysqli_fetch_array($query)) {   
                                    if ($data['estatus']==0) {
                                        $msg='<p class="msg_reser">Reservado</p>';
                                    }
                                    if ($data['estatus']==1) {
                                        $msg='<p class="msg_disp">Disponible</p>';
                                    }
                                    if ($data['estatus']==2) {
                                        $msg='<p class="msg_ocup">Ocupado</p>';
                                    }                 
                            ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $data['num_habitacion'];?></td>
                                    <td><?php echo $data['descripcion'];?></td>
                                    <!--td><//?php echo $data['piso'];?>°</td>
                                    <td>S/.<//?php echo $data['precio'];?></td-->
                                    <td><?php echo $data['categoria'];?></td>
                                    <td><?php echo $msg; ?></td>
                                    
                                    <td>
                                        <a href="ModificarHabitacion.php?id=<?php echo $data["idhabitacion"];?>"><i class="fas fa-edit"></i></a>
                                    </td>
                                
                            </tbody>
                            <?php 
                                }
                            }
                            ?>
                            <tfoot class="paginacion">
                                <tr >
                                    <td  colspan="7">
                                        <ul >
                                            <?php 
			                                	if($pagina != 1)
			                                	{
			                                 ?>
			                                	<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
			                                	<li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
			                                <?php 
			                                	}
			                                	for ($i=1; $i <= $total_paginas; $i++) { 
			                                		# code...
			                                		if($i == $pagina)
			                                		{
			                                			echo '<li class="pageSelected">'.$i.'</li>';
			                                		}else{
			                                			echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
			                                		}
			                                	}
                                            
			                                	if($pagina != $total_paginas)
			                                	{
			                                 ?>
			                                	<li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
			                                	<li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
			                                <?php } ?>
                                        </ul>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </section>
        </div>
        <?php include "../Modelo/Footer.php" ?>
    </body>
</html>