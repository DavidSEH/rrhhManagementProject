<?php 
    include "../Controlador/LoginCliControlador.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/estiloLC.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<body >
        <div class="container">
            <div class="forms-container">
                <div class="signun-signup">
                
                    <!--Formulario Acceso -->
                    <form action=""  method="post" class="sign-in-form">
                        <h2 class="title">Acceso</h2>
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" name="usuario" placeholder="Usuario">
                        </div>
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="clave" placeholder="Password">
                        </div>
                        <div class="g-recaptcha" data-sitekey="6Lf1jwsdAAAAAB7aKmco5N7ivABQF-HdhYm6zRuA"></div>
                        <div>
                            <input type="submit" name="Acceso" value="Iniciar Sesion" class="btn solid">
                        </div>  
                    </form>
                     
                    
                    <!-- Formulario Registar -->
                    <form action="" class="sign-up-form" method="post">
                        <h2 class="title">Registrarse</h2>
                        <div class="input-field">
                            <i class="fas fa-shield-alt"></i>
                            <input type="number" name="dni" placeholder="DNI">
                        </div>
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" name="nombre" placeholder="Nombre">
                        </div>
                        <div class="input-field">
                            <i class="fas fa-users-cog"></i>
                            <input type="text" name="telefono" placeholder="Telefono">
                        </div>
                        <div class="input-field">
                            <i class="fas fa-user-secret"></i>
                            <input type="text" name="username" placeholder="Username">
                        </div>
                        <div class="input-field">
                            <i class="fas fa-key"></i>
                            <input type="password" name="pass" placeholder="Password">
                        </div>
                        <div>
                            <input type="submit" name="Grabar" value="Grabar" class="btn solid">
                        </div>

                        <p class="social-text">O ingresar con otras plataformas</p>
                        <div class="social-media">
                            <a href="" class="social-icon">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="" class="social-icon">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="" class="social-icon">
                                <i class="fab fa-google"></i>
                            </a>
                            <a href="" class="social-icon">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="panels-container">
                <div class="panel left-panel">
                    <div class="content">
                        <h3>Eres Nuevo?</h3>
                        <p>Si eres nuevo y aun no te haz registrado en la plataforma 
                            , presione el boton para registrarse</p>
                        <button class="btn transparent" id="sign-up-btn">Registrar </button>
                    </div>

                    <img src="../../Imagenes/imgAcceso1.svg"  class="image" alt="">
                </div>
                
                <div class="panel right-panel">
                    <div class="content">
                        <h3>Eres uno de nosotros?</h3>
                        <p>Si ya estas registrado en la  empresa y estas registrado en la plataforma del HotelDluxo 
                            , presione el boton para acceder</p>
                        <button class="btn transparent" id="sign-in-btn">Acceder  </button>
                    </div>

                    <img src="../../Imagenes/imgAcceso2.svg"  class="image" alt="">
                </div>
            </div>
        </div>

        <?php echo isset($alert) ? $alert : ''; ?>
        <script >
            const sign_in_btn = document.querySelector("#sign-in-btn");
            const sign_up_btn = document.querySelector("#sign-up-btn");
            const container = document.querySelector(".container");

            sign_up_btn.addEventListener("click", () => {
              container.classList.add("sign-up-mode");
            });

            sign_in_btn.addEventListener("click", () => {
              container.classList.remove("sign-up-mode");
            });
        </script>
    </body>
</body>
</html>