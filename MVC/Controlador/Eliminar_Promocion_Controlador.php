
<?php 
	session_start();
	if($_SESSION['rol'] != 1)
	{
		header("location: ../Vista/Gestion_Promocion.hp");
	}
	include "../Modelo/conexion.php";


    if(empty($_REQUEST['id']) ){
        header("location: ../Vista/Gestion_Promocion.php");
        mysqli_close($conection);
    }else{

        $idpromocion = $_REQUEST['id'];

        $query = mysqli_query($conection,"SELECT * FROM promocion 
                                                WHERE idpromocion = $idpromocion ");
        
        $result = mysqli_num_rows($query);

        if($result > 0){
            while ($data = mysqli_fetch_array($query)) {
                $fecha_inicio = $data['fecha_inicio'];
                $fecha_fin = $data['fecha_fin'];
                $porcentaje = $data['porcentaje'];
            }
        }else{
            header("location: ../Vista/Gestion_Promocion.php");
        }


    }


	if(!empty($_POST)){   
        
        $alert='';
        
        if (isset($_POST['btn_Eliminar'])) {

            $idpromocion = $_POST['idpromocion'];

             $query_delete = mysqli_query($conection,
             "UPDATE promocion SET estado = 2 WHERE idpromocion = $idpromocion ");
            
             if($query_delete){
                $alert = '<div class="alertSave">!Finalizado con Exito!  </div>';
            }else{
                $alert = '<div class="alertError">Error</div>';
            }

        }
		
		

	}

    
    
        
    
	


 ?>