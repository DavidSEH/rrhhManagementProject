<?php
include "../Controlador/Login_Empleado_Controlador.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="../../css/style.css">
    <title>Sistema</title>
</head>

<body>

    <div class="center">
        <h1>Ingreso del empleado</h1>
        <form action="" method="post">
            <div class="txt_field">
                <input type="text" name="usuario" required>
                <span></span>
                <label>Usuario</label>
            </div>
            <div class="txt_field">
                <input type="password" name="clave" required>
                <span></span>
                <label>Contraseña</label>
            </div>
            <div class="txt_field">
                <span></span>
                <div class="g-recaptcha" data-sitekey="6Lf1jwsdAAAAAB7aKmco5N7ivABQF-HdhYm6zRuA"></div>
            </div>
            <input type="submit" name="Acceso" value="Iniciar Sesion">
            <div class="signup_link">
                <a href="/ProyectoIntegrador">Regresar</a>
            </div>
        </form>
    </div>
    <img src="../../Imagenes/imgAcceso1.svg" class="image" alt="">
    <img src="../../Imagenes/imgAcceso2.svg" class="image" alt="">
    <div>
        <?php echo isset($alert) ? $alert : ''; ?>
    </div>
</body>

</html>