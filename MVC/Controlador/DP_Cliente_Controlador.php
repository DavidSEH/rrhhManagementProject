<?php
include "../Modelo/conexion.php";

if(empty($_REQUEST['id'])){
    header("location: ../Vista/MenuCliente.php");
    mysqli_close($conection);
}else{
    $cod_personal = $_REQUEST['id'];

    $sql= mysqli_query($conection,"SELECT *
                        FROM personal 
                        WHERE cod_personal= '$cod_personal' ");

    $result_sql = mysqli_num_rows($sql);

    if($result_sql == 0){
        header("location: ../Vista/MenuCliente.php");
    }else{
        $option = '';
        while ($data = mysqli_fetch_array($sql)) {

            $cod_personal  	= $data['cod_personal'];
            $nombre  	= $data['nombres'];
            $dni		    = $data['dni'];
            $edad		    = $data['edad'];
            $correo 	    = $data['correo'];
            $telefono  		= $data['telefono'];
            $domicilio 		= $data['direccion'];

        }
    }

}


if(!empty($_POST)){
    
    if (isset($_POST['btnEnviar'])) {

        $cod_personal 	= $_POST['cod_personal'];

        $query_envio = mysqli_query($conection,"SELECT * FROM cliente WHERE cod_personal = $cod_personal");

        if ($query_envio) {
            while ($data2=mysqli_fetch_array($query_envio)) {
                $cod_personal2		    = $data2['cod_personal'];
                $dni2			    = $data2['dni'];
                $nombre2	        = $data2['nombre'];
                $domicilio2		    = $data2['direccion'];
                $telefono2		    = $data2['telefono'];
                $correo2			    = $data2['correo'];
            }
        }else{
            $alert='<p class="msg_error">Error al enviar los Datos.</p>';
        }
        

    }
    if (isset($_POST['btnGuardar'])) {

        if (empty($_POST['telefono']) || empty($_POST['correo']) 
            || empty($_POST['domicilio'])) {
                $alert='<p class="msg_error">Error:Campos vacios</p>';
        }else{
            $alert='';
            $cod_personal 	    = $_POST['cod_personal'];
            $telefono 	    = $_POST['telefono'];
            $correo         = $_POST['correo'];
            $domicilio      = $_POST['direccion'];

            $query_guardar = mysqli_query($conection,"UPDATE cliente SET telefono= $telefono,
                                        correo='$correo', domicilio='$domicilio', informacion ='$informacion'
                                        WHERE cod_personal= $cod_personal ");

            if($query_guardar){
                $alert='<p class="msg_save">Datos Editados Correctamente</p>';
            }else{
                $alert='<p class="msg_error">Error: editar datos.</p>';
            }
        }
        
    
    }
    $result='';
    if (isset($_POST['btnPassword'])) {
        
        $cod_personal 	    = $_POST['cod_personal'];
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
        $cod_personal 	= $_POST['cod_personal'];
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
                                        WHERE cod_personal='$cod_personal'");
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
                                    WHERE cod_personal= $cod_personal");

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