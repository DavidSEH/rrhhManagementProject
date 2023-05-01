<?php 
	session_start();
	/*if($_SESSION['rol'] != 1)
	{
        header("location: ../Vista/Usuario.php");
	}
*/
	include "../Modelo/conexion.php";
	
	
	if(empty($_REQUEST['id']))
	{
		header('location: ../Vista/Check_Out.php');
		mysqli_close($conection);
	}
	$idhabitacion= $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT h.idhabitacion,h.num_habitacion,h.descripcion,
                        h.precio,(h.estatus) AS estado_habitacion,c.idcliente,c.dni,c.nombre,c.telefono,
                        c.domicilio,c.correo,th.nombre_tipo,r.idreserva,r.fecha_ingreso,
                        r.hora_ingreso,r.fecha_salida,r.hora_salida,r.cant_noches,r.adelantado,
                        (r.estatus) AS estado_reserva,r.idpromocion
                        FROM habitacion h
                        INNER JOIN reserva r ON(h.idhabitacion=r.idhabitacion)
                        INNER JOIN cliente  c ON(r.idcliente=c.idcliente)
                        INNER JOIN tipohabitacion th ON(h.idtipohabitacion=th.idtipohabitacion)
                        WHERE h.idhabitacion='$idhabitacion'");
	
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		
	}else{
		while ($data = mysqli_fetch_array($sql)) {
			$idhabitacion       = $data['idhabitacion'];
            $idcliente          = $data['idcliente'];
            $idreserva          = $data['idreserva'];
			$numero             = $data['num_habitacion'];
			$descripcion        = $data['descripcion'];
			$precio             = $data['precio'];
			$tipo               = $data['nombre_tipo'];
            $estado_habitacion  = $data['estado_habitacion'];
            $dni                = $data['dni'];
            $nombre             = $data['nombre'];
            $telefono           = $data['telefono'];
            $domicilio          = $data['domicilio'];
            $correo             = $data['correo'];
            $fecha_ingreso      =$data['fecha_ingreso'];
            $hora_ingreso       =$data['hora_ingreso'];
            $fecha_salida       =$data['fecha_salida'];
            $hora_salida        =$data['hora_salida'];
            $cant_noches        =$data['cant_noches'];
			$idpromocion        =$data['idpromocion'];
			$adelantado        =$data['adelantado'];

			$importe        	=($data['cant_noches']*$data['precio'])-$data['adelantado'];
			$total=0.00;
			$porcentaje=0.00;
			$igv=0.00;
			
            if($estado_habitacion == 0){
				$result = '<p class="msg_reser">Reservado</p>';
			}else if($estado_habitacion == 1){
				$result = '<p class="msg_disp">Disponible</p>';	
			}else if($estado_habitacion != 2){
				$result = '<p class="msg_ocup">Ocupado</p>';
			}
			/*Qrey Promocion*/ 
			if (isset($idpromocion)) {
				$sql_promo=mysqli_query($conection,"SELECT porcentaje FROM promocion 
										WHERE idpromocion= $idpromocion");
										
				while ($data2 = mysqli_fetch_array($sql_promo)){
					$porcentaje        	=$data2['porcentaje'];
				}
			}else{
			}
			$descuento        	=$porcentaje*$importe ;
			$igv=$importe*0.18;
			$total        		=($importe - $descuento)+$igv;
            
		}
	}

    
	if(!empty($_POST)){
		$alert='';
		$msg_return='';
		$msg_print='';

        if (isset($_POST['btnCancelar'])) {
            header('location: ../Vista/Check_Out.php');
		    mysqli_close($conection);
			exit();
        }
        if (isset($_POST['btnTerminar'])) {
            

				$idreserva 	= $_POST['idreserva'];
				$idhabitacion = $_POST['idhabitacion'];
				$idusuario = $_POST['idusuario'];
				$idtipopago = $_POST['tipopago'];
				$descripcion = $_POST['descripcion'];
				$fecha_pago = $_POST['fecha_pago'];

				$cantidad_pago = $_POST['cantidad_pago'];
				$precio_pago = $_POST['precio_pago'];
				$adelantado_pago = $_POST['adelantado_pago'];
				$porcentaje_pago = $_POST['porcentaje_pago'];

				$importe_pago=$cantidad_pago*$precio_pago-$adelantado_pago;
				$descuento_pago=$porcentaje_pago*$importe_pago;
				$igv_pago=$importe_pago*0.18;
				$total_pago=($importe_pago-$descuento_pago) + $igv_pago;

				$query_confirmar = mysqli_query($conection,"UPDATE reserva SET estatus = 4,
											idusuario= $idusuario
											WHERE idreserva = $idreserva ");
				$query_confirmar2 = mysqli_query($conection,"UPDATE habitacion SET estatus = 1 
								WHERE idhabitacion = $idhabitacion "); 
				
				$query_confirmar3 = mysqli_query($conection,"INSERT INTO pago(idreserva,idtipopago,descripcion,descuento,fecha_pago,importe,total)
												VALUES($idreserva,$idtipopago,'$descripcion',$descuento_pago,'$fecha_pago',$importe_pago,$total_pago)");

					
				if($query_confirmar & $query_confirmar2 & $query_confirmar3){
					$alert='<div class="alertSave">Termino Proceso Reserva</div>';
					$msg_print='<a href="../../Reportes/Reporte_Reservas.php?idreserva='.$idreserva.'" target="_blank">
					<i class="fas fa-print" ></i> Imprimir</a>';
				}else{
					$alert='<div class="alertError">Error de Proceso</div>';
				}
            
        
        }
        
	}
	
	
	
 ?>