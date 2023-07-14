<?php
include '../Controlador/Datos_Empresa_Controlador.php'
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Datos Empresa</title>
    <?php include "../Modelo/scripts.php" ?>
    <style>
        #dropArea {
            border: 2px dashed #ccc;
            width: 300px;
            height: 200px;
            padding: 20px;
            text-align: center;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <input type="checkbox" id="menu-toggle">
    <!--Sidebar Inicio-->
    <?php include "./sidebarAdministrador.php" ?>
    <!--Sidebar Fin-->
    <div class="main-content">
        <!--Navbar Inicio-->
        <?php include "../Modelo/HeaderUsu.php" ?>
        <!--Navbar Fin-->
        <section>
            <form action="" method="post">
                <input type="hidden" name="ruc" value="<?php echo $ruc; ?>">
                <h2><i class="fas fa-hotel"></i>Datos de la Empresa</h2>
                <div class="container-dh">
                    <div class="section-dh">
                        <div>
                            <p>RUC</p>
                            <P><?php echo $ruc; ?></P>
                        </div>
                        <div>
                            <p>Razon Social</p>
                            <P><?php echo $razon_social; ?></P>
                        </div>
                        <div>
                            <p>Telefono</p>
                            <P>(01)<?php echo $telefono; ?></P>
                        </div>
                        <div>
                            <p>Dirección</p>
                            <P><?php echo $direccion; ?></P>
                        </div>
                        <div>
                            <p>Pagina Web</p>
                            <P><?php echo $pagina_web; ?></P>
                        </div>
                        <div>
                            <p>Logo:</p>
                            <img src="../../Imagenes/logo_hotel.png" alt="">
                        </div>
                        <div>
                            <button name="btnEditar"><i class="far fa-edit"></i> Editar</button>
                        </div>
                    </div>
                    <div class="section2-mdh">
                        <div class="cab-mdh">
                            <p>Editar Datos de la empresa</p>
                        </div>
                        <div class="sec-datos-mdh">
                            <div>
                                <label for="">Razon Social</label>
                                <input type="text" name="razon" value="<?php echo isset($razon) ? $razon : ''; ?>">
                            </div>
                            <div>
                                <label for="">Telefono</label>
                                <input type="text" name="telefono" value="<?php echo isset($telefono2) ? $telefono2 : ''; ?>">
                            </div>
                            <div>
                                <label for="">Direccion</label>
                                <input type="text" name="direccion" value="<?php echo isset($direccion2) ? $direccion2 : ''; ?>">
                            </div>
                            <div>
                                <label for="">Pagina Web</label>
                                <input type="text" name="pagina" value="<?php echo isset($pagina_web2) ? $pagina_web2 : ''; ?>">
                            </div>
                            <div>
                                <label for="">Logo</label>
                                <div id="dropArea">
                                    Arrastra y suelta una imagen aquí
                                </div>
                            </div>
                            <div>
                                <button type="submit" name="btnGuardar">Guardar</button>
                            </div>
                        </div>
                        <div class="footer-mdhotel">
                            <p>Esta informacion es importante para la emision de reportes</p>
                        </div>
                    </div>
                </div>
            </form>
        </section>
        <div>
            <?php echo isset($alert) ? $alert : ''; ?>
        </div>
    </div>
    <?php include "../Modelo/Footer.php" ?>
    <script>
        // Función para evitar el comportamiento predeterminado de la acción de arrastrar y soltar
        function preventDefault(event) {
            event.preventDefault();
            event.stopPropagation();
        }

        // Función para manejar el evento de soltar el archivo
        function handleDrop(event) {
            preventDefault(event);

            // Obtener el archivo que se soltó
            var file = event.dataTransfer.files[0];

            // Validar que sea una imagen
            if (file.type.startsWith('image/')) {
                // Crear un objeto de tipo FileReader
                var reader = new FileReader();

                // Leer el contenido del archivo
                reader.onload = function() {
                    // Mostrar la imagen en la página
                    var imgElement = document.createElement('img');
                    imgElement.src = reader.result;
                    document.body.appendChild(imgElement);
                };

                reader.readAsDataURL(file);
            } else {
                alert('Por favor, arrastra solo imágenes.');
            }
        }

        // Obtener el elemento del área de soltar
        var dropArea = document.getElementById('dropArea');

        // Asignar los controladores de eventos necesarios
        dropArea.addEventListener('dragenter', preventDefault, false);
        dropArea.addEventListener('dragover', preventDefault, false);
        dropArea.addEventListener('drop', handleDrop, false);
    </script>
</body>

</html>