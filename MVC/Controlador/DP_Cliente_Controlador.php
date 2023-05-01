<?php
include "../Modelo/conexion.php";

if(empty($_REQUEST['id'])){
    header("location: ../Vista/MenuCliente.php");
    mysqli_close($conection);
}else{
    $idcliente = $_REQUEST['id'];

    $sql= mysqli_query($conection,"SELECT *
                        FROM cliente 
                        WHERE idcliente= '$idcliente' ");

    $result_sql = mysqli_num_rows($sql);

    if($result_sql == 0){
        header("location: ../Vista/MenuCliente.php");
    }else{
        $option = '';
        while ($data = mysqli_fetch_array($sql)) {

            $idcliente  	= $data['idcliente'];
            $nombre  	= $data['nombre'];
            $dni		    = $data['dni'];
            $edad		    = $data['edad'];
            $correo 	    = $data['correo'];
            $telefono  		= $data['telefono'];
            $domicilio 		= $data['domicilio'];
            $informacion   	= $data['informacion'];

        }
    }

}


if(!empty($_POST)){
    
    if (isset($_POST['btnEnviar'])) {

        $idcliente 	= $_POST['idcliente'];

        $query_envio = mysqli_query($conection,"SELECT * FROM cliente WHERE idcliente = $idcliente");

        if ($query_envio) {
            while ($data2=mysqli_fetch_array($query_envio)) {
                $idcliente2		    = $data2['idusuario'];
                $dni2			    = $data2['dni'];
                $nombre2	        = $data2['nombre'];
                $domicilio2		    = $data2['domicilio'];
                $telefono2		    = $data2['telefono'];
                $correo2			    = $data2['correo'];
                $informacion2		= $data2['informacion'];
            }
        }else{
            $alert='<p class="msg_error">Error al enviar los Datos.</p>';
        }
        

    }
    if (isset($_POST['btnGuardar'])) {

        if (empty($_POST['telefono']) || empty($_POST['correo']) 
            || empty($_POST['domicilio']) || empty($_POST['informacion'])) {
                $alert='<p class="msg_error">Error:Campos vacios</p>';
        }else{
            $alert='';
            $idcliente 	    = $_POST['idcliente'];
            $telefono 	    = $_POST['telefono'];
            $correo         = $_POST['correo'];
            $domicilio      = $_POST['domicilio'];
            $informacion 	= $_POST['informacion'];

            $query_guardar = mysqli_query($conection,"UPDATE cliente SET telefono= $telefono,
                                        correo='$correo', domicilio='$domicilio', informacion ='$informacion'
                                        WHERE idcliente= $idcliente ");

            if($query_guardar){
                $alert='<p class="msg_save">Datos Editados Correctamente</p>';
            }else{
                $alert='<p class="msg_error">Error: editar datos.</p>';
            }
        }
        
    
    }
    $result='';
    if (isset($_POST['btnPassword'])) {
        
        $idcliente 	    = $_POST['idcliente'];
        $result='<div class="modificar-pas">
                    <div class="cab-mp">
                        <p>Editar Password</p>
                    </div>
                    <div class="sec-mp">
                        <div >
                            <p>Password Actual</p>
                            <p>Password Nuevo</p>
                        </div>
                        <div >
                            <input type="password" name="passActual">
                            <input type="password" name="passNuevo" >
                        </div>
                    </div>
                    <div class="footer-mp">
                        <button type="submit" name="btnCancelar">Cancelar</button>
                        <button type="submit" name="btnGuardarPas">Guardar</button>
                    </div>
                </div>
                </div>';
        
    }
    if (isset($_POST['btnCancelar'])) {
    }
    if (isset($_POST['btnGuardarPas'])){
        $alert='';
        $idcliente 	= $_POST['idcliente'];
        $passActual = md5($_POST['passActual']);
        $passNuevo  = md5($_POST['passNuevo']);
        if (empty($_POST['passActual']) || empty($_POST['passNuevo'])) {
            $alert='<p class="msg_error">Error:Campos Incompletos</p>';
            $result='<div class="modificar-pas">
                    <div class="cab-mp">
                        <p>Editar Password</p>
                    </div>
                    <div class="sec-mp">
                        <div >
                            <p>Password Actual</p>
                            <p>Password Nuevo</p>
                        </div>
                        <div >
                            <input type="password" name="passActual">
                            <input type="password" name="passNuevo" >
                        </div>
                    </div>
                    <div class="footer-mp">
                        <button type="submit" name="btnCancelar">Cancelar</button>
                        <button type="submit" name="btnGuardarPas">Guardar</button>
                    </div>
                </div>
                </div>';
        }else if ($passActual==$passNuevo) {
            $alert='<p class="msg_error">Error: Contraseñas Iguales</p>';
            $result='<div class="modificar-pas">
                    <div class="cab-mp">
                        <p>Editar Password</p>
                    </div>
                    <div class="sec-mp">
                        <div >
                            <p>Password Actual</p>
                            <p>Password Nuevo</p>
                        </div>
                        <div >
                            <input type="password" name="passActual">
                            <input type="password" name="passNuevo" >
                        </div>
                    </div>
                    <div class="footer-mp">
                        <button type="submit" name="btnCancelar">Cancelar</button>
                        <button type="submit" name="btnGuardarPas">Guardar</button>
                    </div>
                </div>
                </div>';
        }else {
            $query_validar=mysqli_query($conection,"SELECT clave_cli FROM cliente 
                                        WHERE idcliente='$idcliente'");
            $sql_result = mysqli_num_rows($query_validar);                    
            
            if ($sql_result > 0) {
                while ($data = mysqli_fetch_array($query_validar)){
                    $clave = $data['clave_cli'];
                    if ($clave != $passActual) {
                        $alert='<p class="msg_error">Error:Password Actual Incorrecto</p>';
                        $result='<div class="modificar-pas">
                                <div class="cab-mp">
                                    <p>Editar Password</p>
                                </div>
                                <div class="sec-mp">
                                    <div >
                                        <p>Password Actual</p>
                                        <p>Password Nuevo</p>
                                    </div>
                                    <div >
                                        <input type="password" name="passActual">
                                        <input type="password" name="passNuevo" >
                                    </div>
                                </div>
                                <div class="footer-mp">
                                    <button type="submit" name="btnCancelar">Cancelar</button>
                                    <button type="submit" name="btnGuardarPas">Guardar</button>
                                </div>
                                </div>
                                </div>';
                    }else{

                        $query_guardarPas = mysqli_query($conection,"UPDATE cliente SET clave_cli= '$passNuevo'
                                    WHERE idcliente= $idcliente");

                        if($query_guardarPas){
                            $alert='<p class="msg_save">Password Editado Correctamente.</p>';
                        }else{
                            $alert='<p class="msg_error">Error:Password no editado.</p>';
                        }
                    }
                }
                
            }
                
        }

    }

    
}

?>