
<?php 
	session_start();
    include "../Modelo/conexion.php";
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
                <h2> <i class="fas fa-hotel"></i>Lista de Licencias <span>/Avance</span></h2>
                <div class="listado-reserva">
                    <table>
                        <thead>
                            <tr>
                                <th>Modo</th>
                                <th>Descripcion</th>
                                <th>Fecha Ingreso</th>
                                <th>Fecha Salida</th>
                                <th>N° Dias</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            include "../Modelo/conexion.php";
                            /*Paginador*/
                            $sql_registro = mysqli_query($conection,"SELECT COUNT(*)AS total_registro FROM reserva");
                            $result_register = mysqli_fetch_array($sql_registro);
			                $total_registro = $result_register['total_registro'];
                            $por_pagina = 20;
                             
                            if(empty($_GET['pagina']))
                            {
                                $pagina = 1;
                            }else{
                                $pagina = $_GET['pagina'];
                            }
                            $desde = ($pagina-1) * $por_pagina;
			                $total_paginas = ceil($total_registro / $por_pagina);

                            $msg='';
                            $query = mysqli_query($conection,"SELECT r.idreserva,r.idcliente,r.fecha_ingreso,r.hora_ingreso,r.hora_salida,
                                                    r.fecha_salida,r.estatus,r.cant_noches,h.num_habitacion,h.descripcion,
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
                                        $msg='<p class="msg_disp">Inicializada</p>';
                                    }
                                    if ($data['estatus']==2) {
                                        $msg='<p class="msg_reser" style="background: #2EB380">Generada</p>';
                                    }
                                    if ($data['estatus']==3) {
                                        $msg='<p class="msg_reser">Confirmada</p>';
                                    }
                                    if ($data['estatus']==4) {
                                        $msg='<p class="msg_reser" style="background: #2C2C98">Finalizada</p>';
                                    }
                                    if ($data['estatus']==5) {
                                        $msg='<p class="msg_ocup">Expirada</p>';
                                    }
                                    if ($data['estatus']==6) {
                                        $msg='<p class="msg_ocup">Anulada</p>';
                                    }
                                    if($data['idcliente']==$_SESSION['idCli']){

                                    
                            ?>
                            
                                <tr>
                                    <td><?php echo $data['num_habitacion'];?></td>
                                    <td><?php echo $data['descripcion'];?></td>
                                    <td><?php echo $data['fecha_ingreso'];?></td>
                                    <td><?php echo $data['fecha_salida'];?></td>
                                    <td><?php echo $data['cant_noches'];?></td>
                                    <td><?php echo $msg ?></td>
                                    <td >
                                        <?php 
                                            if ($data['estatus']==1){
                                        ?>
                                        <a href="Modificar_Reserva_Cliente.php?id=<?php echo $data["idreserva"];?>" class="link_update">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <a href="Eliminar_Reserva_Cliente.php?id=<?php echo $data["idreserva"];?>" class="link_delete">
                                            <i class="fas fa-window-close"></i>
                                        </a>
                                        <?php 
                                            }
                                        ?>
                                        <?php 
                                            if ($data['estatus']==1 || $data['estatus']==2 || $data['estatus']==4){
                                        ?>
                                        <a href="../../Reportes/Reporte_Reserva_Cliente.php?id=<?php echo $data["idreserva"];?>" target="_blank" class="link_reporte">
                                            <i class="fas fa-file-pdf" ></i>
                                        </a>
                                        <?php 
                                            }
                                        ?>
                                    </td>
                            
                            <?php 
                                    }
                                }
                            }
                            ?>
                            </tbody>
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
            </section>
            
        </div>
           
        
    </body>
</html>