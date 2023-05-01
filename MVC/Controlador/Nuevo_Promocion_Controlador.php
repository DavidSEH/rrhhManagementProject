<?php
include "../Modelo/conexion.php";

if(!empty($_POST))
{   
    $alert='';
    if(empty($_POST['idpromocion']) || empty($_POST['fecha_inicio']) || empty($_POST['fecha_fin']) 
    || empty($_POST['porcentaje']) || empty($_POST['id_tipohabitacion'])){

        $alert = '<div class="alertError">Campos vacios</div>';
        
    }else{
        
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];
        $porcentaje  = $_POST['porcentaje'];
        $id_tipohabitacion = $_POST['id_tipohabitacion'];
        $descripcion = $_POST['descripcion'];

        
        $query_insert = mysqli_query($conection,
                "INSERT INTO promocion(idtipohabitacion,fecha_inicio,fecha_fin,porcentaje,descripcion)
                VALUES('$id_tipohabitacion','$fecha_inicio','$fecha_fin','$porcentaje','$descripcion')");
        if($query_insert){
            $alert = '<div class="alertSave">!Registrado con Exito!  </div>';
        }else{
            $alert = '<div class="alertError">Error</div>';
        }

        
        

    }

}

?>