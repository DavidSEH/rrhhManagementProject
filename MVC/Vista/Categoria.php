
<?php 
    session_start();
 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Habitaciones</title>
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
                    <h2> <i class="fas fa-anchor"></i>Categorias</h2>
                    <a href="Nuevo_Categoria.php">Nuevo Categoria</a>
                </div>
                <div class="listado-principal-tabla">
                    <div class="cab-tabla">
                        <div>
                            
                        </div>
                        <div class="cab__tabla_enlace">

                            <a href="../../Reportes/Reporte_Categoria.php?idUser=<?php echo $_SESSION['idUser']; ?>"
                            target="_blank" class="bg_primary">
                            <i class="fas fa-file-pdf"></i>Imprimir</a>

                        </div>
                    </div >
                    <div class="listado-tabla">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Categoria</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <?php 
                            include "../Modelo/conexion.php";
                            /*Paginador*/
                            $sql_registro = mysqli_query($conection,"SELECT COUNT(*)AS total_registro FROM tipohabitacion");
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
                            $query = mysqli_query($conection,"SELECT *
                                                    FROM tipohabitacion
                                                    ORDER BY idtipohabitacion ASC LIMIT $desde,$por_pagina;");
                            mysqli_close($conection);
                            $result = mysqli_num_rows($query);
                            if($result > 0){
                                while ($data = mysqli_fetch_array($query)) {   
                            ?>
                            <tbody>
                                <tr>
                                    <td>R0<?php echo $data['idtipohabitacion'];?></td>
                                    <td><?php echo $data['nombre_tipo'];?></td>
                                    
                                    <td>

                                        <a href="Modificar_Categoria.php?id=<?php echo $data["idtipohabitacion"];?>"><i class="fas fa-edit"></i></a>
                                        <a href="Eliminar_Categoria.php?id=<?php echo $data["idtipohabitacion"];?>"><i class="fas fa-window-close"></i></a>

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