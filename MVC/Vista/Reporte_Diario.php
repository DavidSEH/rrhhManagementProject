
<?php 
    session_start();
 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Registros</title>
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
                            $fecha=date("Y-m-d");?>
            <section>
                <div class="cab-user">
                    <h2> <i class="fas fa-file-invoice-dollar"></i> Registros</h2>
                    
                </div>
                <div class="listado-principal-tabla">
                    <div class="cab-tabla">
                        <div>
                            <input type="text" value="Fecha: <?php echo $fecha;?>" disabled>
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div >
                            <a href="./../../Reportes/Reporte_Diario.php?idUser=<?php echo $_SESSION['idUser']; ?>"
                            target="_blank" class="bg_primary">
                            Imprimir</a>
                        </div>
                        
                    </div >
                    <div class="listado-tabla">
                        <table>
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Lista</th>
                                    <th>Tipo</th>
                                    <th>Adelantado</th>
                                    <th>Descuento</th>
                                    <th>Importe</th>
                                    <th>Total</th>
                                    <th>H-Ingreso</th>
                                    <th>H-Salida</th>
                                </tr>
                            </thead>
                            <?php 
                            include "../Modelo/conexion.php";
                            /*Paginador*/
                            $sql_registro = mysqli_query($conection,"SELECT COUNT(*)AS total_registro FROM reserva");
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
                            $query = mysqli_query($conection,
                                    "SELECT p.idpago,p.fecha_pago,p.descuento,p.importe,p.total,r.hora_ingreso,r.hora_salida,
                                    r.adelantado,h.num_habitacion,th.nombre_tipo
                                    FROM pago p 
                                    INNER JOIN reserva r ON(r.idreserva=p.idreserva)
                                    INNER JOIN habitacion h ON(r.idhabitacion=h.idhabitacion)
                                    INNER JOIN tipohabitacion th ON(h.idtipohabitacion=th.idtipohabitacion)
                                    WHERE p.fecha_pago='$fecha'");
                            $result = mysqli_num_rows($query);
                            $num=0;
                            $total_suma=0;
                            if($result > 0){
                                while ($data = mysqli_fetch_array($query)) {
                                    if ($data['fecha_pago']==$fecha) {
                                        $num+=1;
                                        $total_suma+=$data['total'];
                            ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $num;?></td>
                                    <td>S/.<?php echo $data['num_habitacion'];?></td>
                                    <td><?php echo $data['nombre_tipo'];?></td>
                                    <td>S/.<?php echo $data['adelantado'];?></td>
                                    <td>S/.<?php echo $data['descuento'];?></td>
                                    <td>S/.<?php echo $data['importe'];?></td>
                                    <td>S/.<?php echo $data['total'];?></td>
                                    <td><?php echo $data['hora_ingreso'];?></td>
                                    <td><?php echo $data['hora_salida'];?></td>
                                </tr>
                                
                                    
                            </tbody>
                            <?php 
                                     }
                                }
                            }
                            ?>
                            
                            <tfoot class="paginacion">
                                <tr class="total_impdiario">
                                    <td colspan="9">
                                        <p>Total:S/. <?php echo $total_suma; ?></p>  
                                    </td>
                                </tr>
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