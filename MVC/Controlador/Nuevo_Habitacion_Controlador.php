<?php
session_start();
include "../Modelo/conexion.php";

if(!empty($_POST))
{   
    $alert='';
    if(empty($_POST['nombre']) || empty($_POST['piso']) || empty($_POST['precio']) 
    || empty($_POST['descripcion']) || empty($_POST['categoria'])){

        $alert = '<div class="alertError">Campos vacios</div>';
        
    }else{
        
        $nombre = $_POST['nombre'];
        $piso = $_POST['piso'];
        $precio  = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $categoria = $_POST['categoria'];

        $query_confirm =mysqli_query($conection,"SELECT * FROM  habitacion WHERE num_habitacion='$nombre'");
        
        $result=mysqli_num_rows($query_confirm);
        if($result>0){
            $alert = '<div class="alertError">N° de Habitacion Existe</div>';
        }else{

             $query_insert = mysqli_query($conection,
                "INSERT INTO habitacion(num_habitacion,idtipohabitacion,descripcion,piso,precio)
                VALUES('$nombre','$categoria','$descripcion','$piso','$precio')");
            if($query_insert){
                $alert = '<div class="alertSave">!Registrado con Exito!  </div>';
            }else{
                $alert = '<div class="alertError">Error</div>';
            }

        }

       
        
        

    }

}

?>