<?php
include "../Controlador/ReservaClienteControlador.php";

?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Menu Empleado</title>
    <?php include "../Modelo/scripts2.php" ?>
</head>

<body>
<script>
        function TDate() {
            var UserDate = document.getElementById("userdate").value;
            var ToDate = new Date();
            console.log(ToDate.toISOString());
            if (new Date(UserDate).toISOString() <= ToDate.toISOString()) {
                alert("La fecha debe ser mayor a (actual): " + ToDate);
                return false;
            }
            return true;
        }

        function validarFechas() {
        const fechaInicio = new Date(document.getElementsByName('fechain')[0].value);
        const fechaFinal = new Date(document.getElementsByName('fechasal')[0].value);
        const fechaActual = new Date();

        if (fechaInicio < fechaActual || fechaFinal < fechaActual) {
          alert('Las fechas deben ser desde la fecha actual hacia adelante.');
          document.getElementsByName('fechain')[0].value = '';
          document.getElementsByName('fechasal')[0].value = '';
          return false;
        }

        if (fechaInicio > fechaFinal) {
          alert('La fecha de inicio debe ser anterior a la fecha final.');
          document.getElementsByName('fechain')[0].value = '';
          document.getElementsByName('fechasal')[0].value = '';
          return false;
        }

        return true;
      }
        
    </script>

    <input type="checkbox" id="menu-toggle">
    <!--Sidebar Inicio-->
    <?php include "./sidebarCliente.php" ?>
    <!--Sidebar Fin-->
    <div class="main-content">
        <!--Navbar Inicio-->
        <header>
            <div class="togle-p">
                <label for="menu-toggle" class="menu-toggler">
                    <span class="las la-bars"></span>
                </label>
                <p>Home</p>
            </div>

            <div class="head-icons">
                <span><?php echo fechaC(); ?></span>
                <a href="../Modelo/salir2.php"><span class="fas fa-sign-out-alt"></span></a>
            </div>
        </header>
        <!--Navbar Fin-->
        <section>
            <h2>Procesar Solicitud</h2>
            <form method="post" action="" onsubmit="validarFechas();">
                <input type="hidden" name="idhabitacion" value="<?php echo $idhabitacion; ?>">
                <input type="hidden" name="idcliente" value="<?php echo $_SESSION['idCli']; ?>">
                <div class="principal-genera-r">
                    <div class="cab-datosh">
                        <p class="title-datosh">Datos de solicitud de licencia</p>
                        <div class="sec-datosh">
                            <div class="dh1">
                                <div class="dh1-sec">
                                    <p>Nombre:</p>
                                    <p>Detalles:</p>
                                </div>
                                <div>
                                    <p><?php echo $tipo ?></p>
                                    <p><?php echo $descripcion ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="seccion-datos-ca">
                        <div class="seccion-datos-cli">
                            <p>Datos del Empleado</p>
                            <div class="datos-cli">
                                <div class="div-ext">
                                    <label for="">DNI:</label>
                                    <div class="div-int">
                                        <i class="fas fa-address-card"></i>
                                        <input type="text" value="<?php echo $_SESSION['dni']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="div-ext">
                                    <label for="">Nombres y apellidos:</label>
                                    <div class="div-int">
                                        <i class="fas fa-user-secret"></i>
                                        <input type="text" value="<?php echo $_SESSION['nombre']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="div-ext">
                                    <label for="">Direccion</label>
                                    <div class="div-int">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <input type="text" value="<?php echo $_SESSION['direccion']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="div-ext">
                                    <label for="">Telefono:</label>
                                    <div class="div-int">
                                        <i class="fas fa-phone"></i>
                                        <input type="number" value="<?php echo $_SESSION['telefono']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="div-ext">
                                    <label for="">Correo</label>
                                    <div class="div-int">
                                        <i class="fas fa-at"></i>
                                        <input type="email" value="<?php echo $_SESSION['email']; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Datos Alojamiento-->
                        <div class="seccion-datos-aloj">
                            <p>Datos de la Licencia</p>

                            <div class="datos-aloj">
                                <div class="div-tar-aloj">
                                    <label for="">Tipo:</label>
                                    <div class="div-input-aloj">
                                        <i class="fas fa-bullseye"></i>
                                        <input type="text" value="<?php echo $tipo ?>" disabled>
                                    </div>
                                </div>
                                <div class="div-ext-part" id="num-habitacion" style="display: none;">
                                    <input type="text" value="<?php echo 'S/.' . $precio ?>" disabled>
                                    <input type="time" name="horain">
                                    <input type="number" name="cant" value="1">
                                    <input type="time" name="horasal">
                                </div>
                                <div class="div-ext-part">
                                    <div class="div-div-int">
                                        <label for="">Fecha Inicio:</label>
                                        <div class="div-input-aloj">
                                            <i class="fas fa-calendar-alt"></i>
                                            <input type="date" name="fechain" required id="userdate" onchange="TDate()">
                                        </div>
                                    </div>
                                </div>
                                <div class="div-ext-part">
                                    <div class="div-div-int">
                                        <label for="">Fecha Salida:</label>
                                        <div class="div-input-aloj">
                                            <i class="fas fa-calendar-alt"></i>
                                            <input type="date" name="fechasal" required id="userdate" onchange="TDate()">
                                        </div>
                                    </div>
                                </div>

                                <div class="div-ext-part">

                                    <div class="div-div-int">
                                        <a href="./ReservaCliente.php" class="btn1-r-cancel">
                                            <i class="fas fa-undo"></i> Regresar
                                        </a>
                                    </div>

                                    <div class="div-div-int">

                                        <button type="submit" class="btn2-r-cancel" value="Reservar">
                                            <i class="fas fa-check-circle"></i> Solicitar</button>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="alert">
                    <?php echo isset($alert) ? $alert : ''; ?>
                </div>
            </form>
        </section>


    </div>


</body>

</html>