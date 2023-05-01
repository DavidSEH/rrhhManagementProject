<?php 
session_start();

include "../Modelo/conexion.php";

if(empty($_REQUEST['ruc']) ){
    header("location: ../Vista/MenuUsuario.php");
    mysqli_close($conection);
}else{
    $ruc = $_REQUEST['ruc'];
    $query=mysqli_query($conection,"SELECT * FROM empresa WHERE ruc =$ruc");
    $result=mysqli_num_rows($query);
    if ($result>0) {
        while ($data=mysqli_fetch_array($query)) {
            $ruc            =$data['ruc'];
            $razon_social    =$data['razon_social'];
            $telefono       =$data['telefono'];
            $direccion      =$data['direccion'];
            $pagina_web      =$data['pagina_web'];
        }
    }
}
    

if (isset($_POST)) {
    $alert='';
    if (isset($_POST['btnEditar'])) {
        $query_editar=mysqli_query($conection,"SELECT * FROM empresa");
        $result=mysqli_num_rows($query_editar);
        if ($result>0) {
            while ($data=mysqli_fetch_array($query_editar)) {
                $razon          =$data['razon_social'];
                $telefono2       =$data['telefono'];
                $direccion2     =$data['direccion'];
                $pagina_web2     =$data['pagina_web'];
            }
        }
    }
    if (isset($_POST['btnGuardar'])) {
        if (empty($_POST['ruc']) || empty($_POST['telefono']) || empty($_POST['razon']) 
        || empty($_POST['direccion']) || empty($_POST['pagina'])) {
            $alert = '<div class="alertError">Campos Vacios</div>';
        }else{
            $nro_ruc        =$_POST['ruc'];
            $razon_social3  =$_POST['razon'];
            $telefono3      =$_POST['telefono'];
            $direccion3     =$_POST['direccion'];
            $pagina_web3    =$_POST['pagina'];
            $query_update=mysqli_query($conection,"UPDATE  empresa SET razon_social='$razon_social3',
                                telefono='$telefono3',direccion='$direccion3',pagina_web='$pagina_web3' 
                                WHERE ruc=$nro_ruc");
            if ($query_update) {
                $alert = '<div class="alertSave">Datos Modificados Correctamente</div>';
            }
        }
       
    }
}
?>