<?php
$alert = '';
session_start();
require_once "../Modelo/conexion.php";

if (!empty($_SESSION['active'])) {
    header('location: ../Vista/MenuEmpleado.php');
    exit(); 
}

if (!empty($_POST) && isset($_POST['Acceso'])) {
    if (empty($_POST['usuario']) || empty($_POST['clave'])) {
        $alert = '<div class="alertLogin">Ingrese su usuario y clave</div>';
    } else if ($_POST['g-recaptcha-response'] == '') {
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

        $query = mysqli_query($conection, "SELECT * FROM usuario WHERE usuario = '$user' 
                                            AND clave = '$pass' AND ID_ROL = 2");

        $result = mysqli_num_rows($query);

        if ($result > 0) {
            $data = mysqli_fetch_array($query);
            if ($data['estado'] != 0) {
                $_SESSION['active'] = true;
                $_SESSION['idCli'] = $data['cod_usuario'];
                // Obtener datos del usuario desde la tabla "personal"
                $codPersonal = $data['cod_personal'];
                $personalQuery = mysqli_query($conection, "SELECT * FROM personal 
                                                            WHERE cod_personal = '$codPersonal'");
                $personalData = mysqli_fetch_array($personalQuery);

                $_SESSION['nombre'] = $personalData['nombres'];
                $_SESSION['email'] = $personalData['correo'];
                $_SESSION['telefono'] = $personalData['telefono'];
                $_SESSION['domicilio'] = $personalData['direccion'];
                $_SESSION['dni'] = $personalData['dni'];
                $_SESSION['user'] = $data['usuario'];
                $_SESSION['clave'] = $data['clave'];
                $_SESSION['estatus'] = $data['estado'];

                header('location: MenuEmpleado.php');
                mysqli_close($conection);
                exit(); 
            } else {
                $alert = '<div class="alertLogin">El usuario esta desactivado. 
                            Contacta con un administrador</div>';
                session_destroy();
            }
        } else {
            $alert = '<div class="alertLogin">El usuario o clave son incorrectos</div>';
            session_destroy();
        }
    }
}

