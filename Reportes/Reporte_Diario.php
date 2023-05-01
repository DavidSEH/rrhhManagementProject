<?php 
    require "Plantilla.php";
    
    if(empty($_REQUEST['idUser']))
	{
		header('location: ../MVC/Vista/Check_Out.php');
		mysqli_close($conection);
	}else{

        $idusuario= $_REQUEST['idUser'];
        date_default_timezone_set('America/Lima'); 
        $fecha=date("Y-m-d");
        $fecha_cab=date("Y-m-d  /  "."H:m:s");
        /*Query Datos Usuario*/         
        $query_user=mysqli_query($conection,"SELECT r.rol,u.nombre,u.dni,u.domicilio
                    FROM usuario u
                    INNER JOIN rol r ON (u.rol=r.idrol)
                    WHERE u.idusuario=$idusuario");
                    
        while ($dataUs=mysqli_fetch_array($query_user)) {
            $nombre            = $dataUs['nombre'];
            $dni            = $dataUs['dni'];
            $domicilio            = $dataUs['domicilio'];
            $nombre            = $dataUs['nombre'];
            $nombre            = $dataUs['nombre'];
            $nombre            = $dataUs['nombre'];
            $nombre            = $dataUs['nombre'];
            
        }
        /*Query Datos Empresa*/ 
        $query_empresa=mysqli_query($conection,"SELECT * FROM empresa");
        while ($dataEmp=mysqli_fetch_array($query_empresa)) {
            $ruc            = $dataEmp['ruc'];
            $razon_social   = $dataEmp['razon_social'];
            $telefono            = $dataEmp['telefono'];
            $direccion            = $dataEmp['direccion'];
            $pagina_web            = $dataEmp['pagina_web'];
        }
        /*Query Datos Reportes Diarios*/ 
        $query_rDiarios = mysqli_query($conection,
                                    "SELECT p.idpago,p.fecha_pago,p.descuento,p.importe,p.total,r.hora_ingreso,r.hora_salida,
                                    r.adelantado,h.num_habitacion,th.nombre_tipo
                                    FROM pago p 
                                    INNER JOIN reserva r ON(r.idreserva=p.idreserva)
                                    INNER JOIN habitacion h ON(r.idhabitacion=h.idhabitacion)
                                    INNER JOIN tipohabitacion th ON(h.idtipohabitacion=th.idtipohabitacion)");
        
        $result = mysqli_num_rows($query_rDiarios);

        
        
        $pdf = new PDF("P","mm","A4");
        $pdf->AliasNbPages();
        $pdf->SetMargins(10,10,10);
        $pdf->AddPage("PORTRAIT","letter");


        $pdf->Cell(20,5,"",0,1,"C");
        $pdf->Ln(3);
        
        $pdf->SetFont("Arial","",9.5);
        $pdf->Cell(195,5,utf8_decode("N° RUC: ".$ruc),0,1,"C");
        $pdf->Cell(195,5,"Razon Social: ".$razon_social,0,1,"C");
        $pdf->Cell(195,5,"Telefono: ".$telefono,0,1,"C");
        $pdf->Cell(195,5,"Direccion: ".$direccion,0,1,"C");


        $pdf->Ln(10);
        $pdf->SetFont("Arial","B",15);
        $pdf->SetFillColor(41,165,161);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetDrawColor(229,229,229);
        $pdf->Cell(195,10," Reporte Diario",1,1,"C",2);

        
        $pdf->SetFillColor(210,245,244);

        $pdf->SetFont("Arial","B",11);
        $pdf->SetTextColor(1,1,1);
        $pdf->Cell(35,7,"Nombre: ",0,0,"C",1);
        $pdf->SetFont("Arial","",11);
        $pdf->Cell(160,7,$nombre,0,1,"D",1);
        

        $pdf->SetFont("Arial","B",11);
        $pdf->SetTextColor(1,1,1);
        $pdf->Cell(35,7,"DNI: ",0,0,"C",1);
        $pdf->SetFont("Arial","",11);
        $pdf->Cell(80,7,$dni,0,0,"D",1);
        $pdf->Cell(80,7,"Fecha:  ".$fecha_cab,0,1,"C",1);

        $pdf->SetFont("Arial","B",11);
        $pdf->SetTextColor(1,1,1);
        $pdf->Cell(35,7,"Direccion: ",0,0,"C",1);
        $pdf->SetFont("Arial","",11);
        $pdf->Cell(160,7,$domicilio,0,0,"D",1);
        

        $pdf->Ln(12);
        $pdf->SetFont("Arial","B",11);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFillColor(41,165,161);
        $pdf->Cell(10,12,utf8_decode("N°"),1,0,"C",1);
        $pdf->Cell(25,12,"Numero",1,0,"C",1);
        $pdf->Cell(25,12,"Adelantado",1,0,"C",1);
        $pdf->Cell(25,12,"Descuento",1,0,"C",1);
        $pdf->Cell(25,12,"Importe ",1,0,"C",1);
        $pdf->Cell(25,12,"Total ",1,0,"C",1);
        $pdf->Cell(30,12,"Hora Entrada",1,0,"C",1);
        $pdf->Cell(30,12,"Hora Salida",1,1,"C",1);
        
        $pdf->SetFont("Arial","",10);
        $pdf->SetTextColor(1,1,1);
        $pdf->SetFillColor(255,255,255);
        $num=0;
        $total_suma=0;
        if ($result>0) {
            while ($dataRD=mysqli_fetch_array($query_rDiarios)) {
                if ($dataRD['fecha_pago']==$fecha) {
                    $num+=1;
                    $total_suma+=$dataRD['total'];

                    $pdf->Cell(10,10,$num,1,0,"C",1);
                    $pdf->Cell(25,10,$dataRD['num_habitacion'],1,0,"C",1);
                    $pdf->Cell(25,10,$dataRD['adelantado'],1,0,"C",1);
                    $pdf->Cell(25,10,$dataRD['descuento'],1,0,"C",1);
                    $pdf->Cell(25,10,$dataRD['importe'],1,0,"C",1);
                    $pdf->Cell(25,10,$dataRD['total'],1,0,"C",1);
                    $pdf->Cell(30,10,$dataRD['hora_ingreso'],1,0,"C",1);
                    $pdf->Cell(30,10,$dataRD['hora_salida'],1,1,"C",1);
                }
            }
        }
        $pdf->SetFont("Arial","B",12);
        $pdf->SetFillColor(41,165,161);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetDrawColor(41,165,161);
        $pdf->Cell(110,10,"Total: ",1,0,"C",1);
        $pdf->Cell(85,10,"S/.".$total_suma,1,0,"D",1);
        
        /*
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

        $pdf->Cell(27,8,utf8_decode("N° Habitacion"),1,0,"C");
        $pdf->Cell(27,8,"Tipo",1,0,"C");
        $pdf->Cell(30,8,"Fecha Entrada",1,0,"C");
        $pdf->Cell(30,8,"Fecha Salida",1,0,"C");
        $pdf->Cell(30,8,utf8_decode("N° Dias"),1,0,"C");
        $pdf->Cell(25,8,"Precio ",1,0,"C");
        $pdf->Cell(25,8,"Adelantado",1,1,"C");

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
        $pdf->Cell(70,5,$importe,0,1,"D");
        $pdf->Ln(1);
        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(35,5,"Descuento: ",0,0,"D");
        $pdf->SetFont("Arial","",11);
        $pdf->Cell(70,5,$descuento,0,1,"D");
        $pdf->Ln(1);
        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(35,5,"IGV: ",0,0,"D");
        $pdf->SetFont("Arial","",11);
        $pdf->Cell(70,5,$igv,0,1,"D");
        $pdf->Ln(1);
        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(35,5,"Total: ",0,0,"D");
        $pdf->SetFont("Arial","",11);
        $pdf->Cell(70,5,$total,0,1,"D");

        $pdf->Ln(25);
        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(95,5,"................................",0,0,"C");
        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(95,5,"................................",0,0,"C");
        $pdf->Ln(8);
        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(95,5,"Administrador/Recepcionista",0,0,"C");
        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(95,5,"Cliente",0,0,"C");*/
        
        $pdf->Output();
    }
	


?>