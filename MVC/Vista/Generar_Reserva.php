<?php
include '../Controlador/Generar_Reserva_Controlador.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Generar Licencia</title>
    <?php include "../Modelo/scripts.php" ?>
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
    <?php include "./sidebar.php" ?>
    <!--Sidebar Fin-->
    <div class="main-content">
        <!--Navbar Inicio-->
        <?php include "../Modelo/HeaderUsu.php" ?>
        <!--Navbar Fin-->
        <section>
            <div class="cab-user">
                <h2><i class="fas fa-sign-out-alt"></i> Proceso de registro <span>/Generar</span></h2>
                <?php echo isset($msg2) ? $msg2 : ''; ?>
            </div>

            <form method="post" action="" onsubmit="validarFechas();">
                <input type="hidden" name="idhabitacion" value="<?php echo $idhabitacion; ?>">
                <input type="hidden" name="idcliente" value="<?php echo $idcliente; ?>">
                <input type="hidden" name="idusuario" value="<?php echo $_SESSION['idUser'] ?>">
                <input type="hidden" name="idpromocion" value="<?php echo isset($idpromocion) ? $idpromocion : ''; ?>">
                <div class="principal-genera-r">
                    <div class="cab-datosh">

                        <p class="title-datosh">Datos de la solicitud de licencia</p>
                        <p id="num-habitacion" style="display: none;">Nombre:</p>
                        <div class="sec-datosh">

                            <div class="dh1">
                                <div class="dh1-sec">
                                    <p>Nombre:</p>
                                    <p>Detalles:</p>
                                </div>
                                <div>
                                    <div>
                                        <p><?php echo $tipo; ?></p>
                                        <p id="num-habitacion" style="display: none;"><?php echo $numero ?> </p><?php echo $msg3; ?>
                                    </div>
                                    <p><?php echo $descripcion; ?></p>

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
                                        <input type="number" name="busqueda" value="<?php echo isset($dni) ? $dni : ''; ?>" maxlength="7" required>
                                        <button type="submit" name="btnBuscar"> Buscar </button>
                                    </div>
                                </div>
                                <div class="div-ext">
                                    <label for="">Nombres y apellidos:</label>
                                    <div class="div-int">
                                        <i class="fas fa-user-secret"></i>
                                        <input type="text" value="<?php echo isset($nombre) ? $nombre : ''; ?> " required disable>
                                    </div>
                                </div>
                                <div class="div-ext">
                                    <label for="">Direccion</label>
                                    <div class="div-int">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <input type="text" value="<?php echo isset($domicilio) ? $domicilio : ''; ?>" disabled>
                                    </div>
                                </div>
                                <div class="div-ext">
                                    <label for="">Telefono:</label>
                                    <div class="div-int">
                                        <i class="fas fa-phone"></i>
                                        <input type="number" value="<?php echo isset($telefono_cli) ? $telefono_cli : ''; ?>" disabled>
                                    </div>
                                </div>
                                <div class="div-ext">
                                    <label for="">Correo</label>
                                    <div class="div-int">
                                        <i class="fas fa-at"></i>
                                        <input type="email" value="<?php echo isset($correo) ? $correo : ''; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Datos Alojamiento-->
                        <div class="seccion-datos-aloj">
                            <p>Detalles de la Licencia</p>

                            <div class="datos-aloj">
                                <div class="div-ext-part" style="justify-content: center;align-items: center;">
                                    <div class="div-div-int">
                                        <label for="">Tipo:</label>
                                        <div class="div-input-aloj">
                                            <i class="fas fa-bullseye"></i>
                                            <input type="text" value="<?php echo $tipo; ?>" disabled>
                                        </div>
                                    </div>


                                </div>
                                <div class="div-div-part" style="justify-content: center;align-items: center;">

                                    <div class="div-div-int" id="num-habitacion" style="display: none;">
                                        <label for="">Adelantado:</label>
                                        <div class="div-input-aloj">
                                            <i class="fas fa-money-bill-wave"></i>
                                            <input type="number" name="adelantado" value="0">
                                            <input type="time" name="horain" value="">
                                            <input type="number" name="cant" value="1">
                                            <input type="text" value="<?php echo 'S/.' . $precio; ?>" disabled>
                                            <input type="time" name="horasal" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="div-ext-part" style="justify-content: center;align-items: center;">
                                    <div class="div-div-int">
                                        <label for="">Fecha Inicio:</label>
                                        <div class="div-input-aloj">
                                            <i class="fas fa-calendar-alt"></i>
                                            <input type="date" name="fechain" value="" id="userdate" onchange="TDate()">
                                        </div>
                                    </div>

                                </div>
                                <div class="div-ext-part" style="justify-content: center;align-items: center;">
                                    <div class="div-div-int">
                                        <label for="">Fecha Final:</label>
                                        <div class="div-input-aloj">
                                            <i class="fas fa-calendar-alt"></i>
                                            <input type="date" name="fechasal" value="" id="userdate" onchange="TDate()">
                                        </div>
                                    </div>

                                </div>

                                <div class="div-ext-part">

                                    <div class="div-div-int" style="display: flex;justify-content: center;align-items: center;">
                                        <button name="regresar">
                                            <i class="fas fa-undo"></i>Regresar</button>
                                    </div>

                                    <div class="div-div-int" style="display: flex;justify-content: center;align-items: center;">
                                        <button type="submit" name="btnGenerar">
                                            <i class="fas fa-check-circle"></i>Confirmar</button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <?php echo isset($alert) ? $alert : ''; ?>

            </form>
        </section>


    </div>

    <?php include "../Modelo/Footer.php" ?>
</body>

</html>