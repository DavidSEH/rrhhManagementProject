<?php
$alert = '';
session_start();
require_once "../Modelo/conexion.php";

if (!empty($_SESSION['active'])) {
    header('location: ../Vista/MenuCliente.php');
} else {
    if (!empty($_POST)) {
        if (isset($_POST['Acceso'])) {
            if (empty($_POST['usuario']) || empty($_POST['clave'])) {
                $alert = '<div class="alertLogin">Ingrese su usuario y clave</div>';
            } else {
                if ($_POST['g-recaptcha-response'] == '') {
                    $alert = '<div class="alertLogin">No se ha completado el Captcha</div>';
                } else {
                    $obj = new stdClass();
                    $obj->secret = "6LfRSNISAAAAACKaHw2e-JvgeG-3src_dRGpL-Ql";
                    $obj->response = $_POST['g-recaptcha-response'];
                    $obj->remoteip = $_SERVER['REMOTE_ADDR'];
                    $url = 'https://www.google.com/recaptcha/api/siteverify';

                    $options = array(
                        'http' => array(
                            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                            'method' => 'POST',
                            'content' => http_build_query($obj)
                        )
                    );
                    $context = stream_context_create($options);
                    $result = file_get_contents($url, false, $context);

                    $validar = json_decode($result);
                    
                    $user = mysqli_real_escape_string($conection, $_POST['usuario']);
                    $pass = md5(mysqli_real_escape_string($conection, $_POST['clave']));

                    $query = mysqli_query($conection, "SELECT * FROM cliente WHERE usuario_cli= '$user' and clave_cli= '$pass'");

                    $result = mysqli_num_rows($query);
                    if ($result > 0) {
                        $data = mysqli_fetch_array($query);
                        $_SESSION['active']     = true;
                        $_SESSION['idCli']      = $data['idcliente'];
                        $_SESSION['dni']        = $data['dni'];
                        $_SESSION['nombre']     = $data['nombre'];
                        $_SESSION['telefono']   = $data['telefono'];
                        $_SESSION['direccion']  = $data['domicilio'];
                        $_SESSION['email']      = $data['correo'];
                        $_SESSION['user']       = $data['usuario_cli'];
                        $_SESSION['clave']      = $data['clave_cli'];
                        $_SESSION['estatus']    = $data['estatus'];

                        header('location: MenuCliente.php');
                    } else {
                        $alert = '<div class="alertLogin">El usuario o clave son incorrectos</div>';
                    }
                }
            }
        }
        if(isset($_POST['Grabar'])){
            if(empty($_POST['dni']) || empty($_POST['nombre']) 
            || empty($_POST['telefono'])|| empty($_POST['username'])|| empty($_POST['pass'])){

                $alert = '<div class="alertLogin">Todos los campos son obligatorios</div>';

            }else{
                $dni        =$_POST['dni'];
                $nombre     =$_POST['nombre'];
                $telefono   =$_POST['telefono'];
                $username   = $_POST['username'];
                $password   = md5($_POST['pass']);

                $query_insertar=mysqli_query($conection,"INSERT  INTO 
                        cliente(dni,nombre,telefono,usuario_cli,clave_cli)
                        VALUES('$dni','$nombre','$telefono','$username','$password')");
            if($query_insertar){
                $alert = '<div class="alertLoginSave">!Registrado con Exito!  </div>';
            }else{
                $alert = '<div class="alertLogin">Error</div>';
            }

            }
        }
    }
}
?>
