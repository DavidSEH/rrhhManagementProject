<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/estiloLC.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Sistema</title>
</head>
<body>
<body >
        <div class="container">
            <div class="forms-container">
                <div class="signun-signup">
                <?php 
                    include "../Controlador/Login_Administrador_Controlador.php";
                ?>
                    <!--Formulario Acceso -->
                    <form action=""  method="post"class="sign-in-form">
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
                            <input type="submit"  value="Iniciar Sesion" class="btn solid">
                        </div>

                    </form>
                    
                </div>
                
            
            <div class="panels-container">
                <div class="panel left-panel">
                    <div class="content">
                        <h3>!Bienvenido!</h3>
                        <p>Ingresa tus datos para que puedas acceder al sistema.
                        </p>
                    </div>
                    <img src="../../Imagenes/imgAcceso1.svg"  class="image" alt="">
                </div>
                
            </div>
        </div>
        <div>
            <?php echo isset($alert) ? $alert : ''; ?>
        </div>
        
        
        
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