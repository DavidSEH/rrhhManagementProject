
<?php 

	include "../Modelo/conexion.php";

    if(empty($_REQUEST['id']) ){
        header("location: ../Vista/ListaReservasCliente.php");
        mysqli_close($conection);
    }else{

        $idreserva = $_REQUEST['id'];

        $query = mysqli_query($conection,"SELECT * FROM reserva r
                                    INNER JOIN cliente c ON (r.idcliente=c.idcliente)
                                         WHERE idreserva = $idreserva ");
        
        $result = mysqli_num_rows($query);

        if($result > 0){
            while ($data = mysqli_fetch_array($query)) {
                $idreserva = $data['idreserva'];
                $fecha_ingreso = $data['fecha_ingreso'];
                $fecha_salida = $data['fecha_salida'];
                $nombre = $data['nombre'];
                $cant_noches = $data['cant_noches'];
                $idhabitacion = $data['idhabitacion'];
            }
        }else{
            header("location: ../Vista/Gestion_Reservas.php");
        }


    }


	if(!empty($_POST)){   
        
        $alert='';
        
        if (isset($_POST['btn_Eliminar'])) {

            $idreserva = $_POST['idreserva'];
            $idhabitacion = $_POST['idhabitacion'];


             $query_delete = mysqli_query($conection,
                "UPDATE reserva SET estatus = 6 WHERE idreserva = '$idreserva' ");

            $query_delete2= mysqli_query($conection,
            "UPDATE habitacion SET estatus = 1 WHERE idhabitacion = '$idhabitacion' ");
            
            
             if($query_delete & $query_delete2){
                $alert = '<div class="alertSave">!Reserva Anulada!  </div>';
            }else{
                $alert = '<div class="alertError">Error</div>';
            }

        }
		
		

	}

    
    
        
    
	


 ?>