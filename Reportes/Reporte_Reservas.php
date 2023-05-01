<?php 
    require "Plantilla.php";
    
    if(empty($_REQUEST['idreserva']))
	{
		header('location: ../MVC/Vista/Check_Out.php');
		mysqli_close($conection);
	}else{
        $igv=0.00;
        $idreserva= $_REQUEST['idreserva'];
        $query_empresa=mysqli_query($conection,"SELECT * FROM empresa");
        while ($dataEmp=mysqli_fetch_array($query_empresa)) {
            $ruc            = $dataEmp['ruc'];
            $razon_social   = $dataEmp['razon_social'];
            $telefono            = $dataEmp['telefono'];
            $direccion            = $dataEmp['direccion'];
            $pagina_web            = $dataEmp['pagina_web'];
        }


        $query_reserva=mysqli_query($conection,"SELECT c.nombre,c.dni,c.telefono,c.domicilio,h.num_habitacion,h.precio,th.nombre_tipo,
                                    r.fecha_ingreso,r.fecha_salida,r.cant_noches,r.adelantado,p.descuento,p.importe,p.total
                                    FROM reserva r
                                    INNER JOIN cliente c ON (c.idcliente=r.idcliente)
                                    INNER JOIN habitacion h ON (h.idhabitacion= r.idhabitacion)
                                    INNER JOIN tipohabitacion th ON (th.idtipohabitacion=h.idtipohabitacion)
                                    INNER JOIN pago p ON (p.idreserva=r.idreserva)
                                    WHERE r.idreserva='$idreserva'");

        while ($dataRes=mysqli_fetch_array($query_reserva)) {
            $nombre_cli         = $dataRes['nombre'];
            $dni_cli            = $dataRes['dni'];
            $telefono_cli       = $dataRes['telefono'];
            $domicilio_cli      = $dataRes['domicilio'];
            $num_habitacion     = $dataRes['num_habitacion'];
            $precio_hab         = $dataRes['precio'];
            $nombre_tipo        = $dataRes['nombre_tipo'];
            $cant_noches        = $dataRes['cant_noches'];
            $adelantado         = $dataRes['adelantado'];
            $fecha_ingreso      = $dataRes['fecha_ingreso'];
            $fecha_salida       = $dataRes['fecha_salida'];
            $importe            = $dataRes['importe'];
            $descuento          = $dataRes['descuento'];
            $total              = $dataRes['total'];
        }
        $igv=$importe *0.18;
        
        $pdf = new PDF("P","mm","A4");
        $pdf->AliasNbPages();
        $pdf->SetMargins(10,10,10);
        $pdf->AddPage("PORTRAIT","letter");


        $pdf->Cell(20,5,"Nro 00000".$idreserva,0,1,"C");
        $pdf->Ln(3);

        $pdf->SetFont("Arial","",9.5);
        $pdf->Cell(195,5,utf8_decode("N° RUC: ".$ruc),0,1,"C");
        $pdf->Cell(195,5,"Razon Social: ".$razon_social,0,1,"C");
        $pdf->Cell(195,5,"Telefono: ".$telefono,0,1,"C");
        $pdf->Cell(195,5,"Direccion: ".$direccion,0,1,"C");


        $pdf->Ln(18);
        
        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(35,5,"Nombre: ",0,0,"D");
        $pdf->SetFont("Arial","",11);
        $pdf->Cell(70,5,$nombre_cli,0,0,"D");

        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(40,5,"Documento: ",0,0,"D");
        $pdf->SetFont("Arial","",11);
        $pdf->Cell(1,5,$dni_cli,0,1,"D");

        $pdf->Ln(1);
        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(35,5,"Telefono: ",0,0,"D");
        $pdf->SetFont("Arial","",11);
        $pdf->Cell(70,5,$telefono_cli,0,0,"D");

        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(40,5,"Direccion : ",0,0,"D");
        $pdf->SetFont("Arial","",11);
        $pdf->Cell(1,5,$domicilio_cli,0,1,"D");

        $pdf->Ln(1);
        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(35,5,"Fecha:",0,0,"D");
        $pdf->SetFont("Arial","",11);
        $pdf->Cell(80,5,fechaC(),0,0,"D");



        $pdf->Ln(10);
        $pdf->SetFont("Arial","B",10);
        $pdf->SetFillColor(41,165,161);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetDrawColor(229,229,229);
        $pdf->Cell(27,8,utf8_decode("N° "),1,0,"C",1);
        $pdf->Cell(27,8,"Tipo",1,0,"C",1);
        $pdf->Cell(30,8,"Fecha Entrada",1,0,"C",1);
        $pdf->Cell(30,8,"Fecha Salida",1,0,"C",1);
        $pdf->Cell(30,8,utf8_decode("N° Dias"),1,0,"C",1);
        $pdf->Cell(25,8,"Precio ",1,0,"C",1);
        $pdf->Cell(25,8,"Adelantado",1,1,"C",1);

        $pdf->SetTextColor(1,1,1);
        $pdf->SetFont("Arial","",10);  
        $pdf->Cell(27,20,$num_habitacion,1,0,"C");
        $pdf->Cell(27,20,$nombre_tipo,1,0,"C");
        $pdf->Cell(30,20,$fecha_ingreso,1,0,"C");
        $pdf->Cell(30,20,$fecha_salida ,1,0,"C");
        $pdf->Cell(30,20,$cant_noches,1,0,"C");
        $pdf->Cell(25,20,"S/.".$precio_hab,1,0,"C");
        $pdf->Cell(25,20,"S/.".$adelantado,1,1,"C");


        $pdf->Ln(8);
        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(35,5,"Importe: ",0,0,"D");
        $pdf->SetFont("Arial","",11);
        $pdf->Cell(70,5,"S/. ".$importe,0,1,"D");
        $pdf->Ln(1);
        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(35,5,"Descuento: ",0,0,"D");
        $pdf->SetFont("Arial","",11);
        $pdf->Cell(70,5,"S/. ".$descuento,0,1,"D");
        $pdf->Ln(1);
        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(35,5,"IGV: ",0,0,"D");
        $pdf->SetFont("Arial","",11);
        $pdf->Cell(70,5,"S/. ".$igv,0,1,"D");
        $pdf->Ln(1);
        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(35,5,"Total: ",0,0,"D");
        $pdf->SetFont("Arial","",11);
        $pdf->Cell(70,5,"S/. ".$total,0,1,"D");

        $pdf->Ln(25);
        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(95,5,"................................",0,0,"C");
        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(95,5,"................................",0,0,"C");
        $pdf->Ln(8);
        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(95,5,"Administrador/Recepcionista",0,0,"C");
        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(95,5,"Cliente",0,0,"C");
        
        $pdf->Output();
    }
	


?>