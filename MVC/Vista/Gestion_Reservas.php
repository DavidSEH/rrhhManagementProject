<?php 
    session_start();
 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Asistencia</title>
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
            <?php date_default_timezone_set('America/Lima'); 
                            $fecha=date("Y-m-d");;?>
            <section>
                <div class="cab-user">
                    <h2> <i class="fas fa-hotel"></i>Gestion de licencias </h2>
                    
                </div>
                <div class="listado-principal-tabla">
                    <div class="cab-tabla">
                    <div>
                            <input type="text" value="Fecha: <?php echo $fecha;?>" disabled>
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div class="cab__tabla_enlace">

                            <a href="../../Reportes/Reporte_Reservas_Generada.php?idUser=<?php echo $_SESSION['idUser']; ?>"
                            target="_blank" class="bg_success">
                            <i class="fas fa-file-pdf"></i>Generar Reporte</a>

                            <!--a href="../../Reportes/Reporte_Reservas_Confirmada.php?idUser=<?php echo $_SESSION['idUser']; ?>"
                            target="_blank" class="bg_confir">
                            <i class="fas fa-file-pdf"></i>Confirmadas</a>
                            
                            <a href="../../Reportes/Reporte_Reservas_Finalizada.php?idUser=<?php echo $_SESSION['idUser']; ?>"
                            target="_blank" class="bg_option">
                            <i class="fas fa-file-pdf"></i>Finalizadas</a>

                            <a href="../../Reportes/Reporte_Reservas_Expirada.php?idUser=<?php echo $_SESSION['idUser']; ?>"
                            target="_blank" class="bg_danger_second">
                            <i class="fas fa-file-pdf"></i>Expiradas</a>

                            <a href="../../Reportes/Reporte_Reservas_Anulada.php?idUser=<?php echo $_SESSION['idUser']; ?>"
                            target="_blank" class="bg_danger">
                            <i class="fas fa-file-pdf"></i>Anuladas</a-->

                        </div>
                    </div >
                    <div class="listado-tabla">
                        <table>
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    
                                    <th>Empleado</th>
                                    <th>DNI</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Termino</th>
                                    
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <?php 
                            include "../Modelo/conexion.php";
                            /*Paginador*/
                            $sql_registro = mysqli_query($conection,"SELECT COUNT(*)AS total_registro FROM reserva");
                            $result_register = mysqli_fetch_array($sql_registro);
			                $total_registro = $result_register['total_registro'];
                            $por_pagina = 14;
                             
                            if(empty($_GET['pagina']))
                            {
                                $pagina = 1;
                            }else{
                                $pagina = $_GET['pagina'];
                            }
                            $desde = ($pagina-1) * $por_pagina;
			                $total_paginas = ceil($total_registro / $por_pagina);

                            $msg='';
                            $query = mysqli_query($conection,"SELECT r.idreserva,r.fecha_ingreso,r.hora_ingreso,r.hora_salida,
                                                    r.fecha_salida,r.estatus,r.cant_noches,h.num_habitacion,(c.nombre)AS nom_cli,
                                                    c.dni
                                                    FROM reserva r 
                                                    INNER JOIN habitacion h ON (h.idhabitacion= r.idhabitacion)
                                                    INNER JOIN cliente c ON (c.idcliente=r.idcliente)
                                                    ORDER BY idreserva DESC LIMIT $desde,$por_pagina;");
                            mysqli_close($conection);
                            $result = mysqli_num_rows($query);
                            if($result > 0){
                                while ($data = mysqli_fetch_array($query)) {
                                    if ($data['estatus']==1) {
                                        $msg='<p class="msg_disp">Pendiente</p>';
                                    }
                                    if ($data['estatus']==2) {
                                        $msg='<p class="msg_reser" style="background: #2EB380">Aprobada</p>';
                                    }
                                    if ($data['estatus']==3) {
                                        $msg='<p class="msg_reser">Confirmada</p>';
                                    }
                                    if ($data['estatus']==4) {
                                        $msg='<p class="msg_reser" style="background: #2C2C98">Terminada</p>';
                                    }
                                    if ($data['estatus']==5) {
                                        $msg='<p class="msg_ocup">Denegada</p>';
                                    }
                                    if ($data['estatus']==6) {
                                        $msg='<p class="msg_ocup">Anulada</p>';
                                    }
                            ?>
                            <tbody>
                                <tr>
                                    <td>R0<?php echo $data['idreserva'];?></td>
                                    
                                    <td><?php echo $data['nom_cli'];?></td>
                                    <td><?php echo $data['dni'];?></td>
                                    <td><?php echo $data['fecha_ingreso'];?></td>
                                    <td><?php echo $data['fecha_salida'];?></td>
                                    
                                    <td><?php echo $msg ?></td>
                                    <td>
                                    <?php
                                    if ($data['estatus']==1 || $data['estatus']==2 || $data['estatus']==3) {

                                    ?>  
                                        <a href="Modificar_Reserva.php?id=<?php echo $data["idreserva"];?>"><i class="fas fa-edit"></i></a>
                                        <?php
                                            if ($data['estatus']==1) {
                                                
                                            
                                        ?>
                                        <a href="Eliminar_Reserva.php?id=<?php echo $data["idreserva"];?>"><i class="fas fa-window-close"></i></a>
                                    <?php 
                                        }
                                    }
                            
                                    ?>
                                    </td>
                            </tbody>
                            <?php 
                                }
                            }
                            ?>
                            <tfoot class="paginacion">
                                <tr >
                                    <td  colspan="9">
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