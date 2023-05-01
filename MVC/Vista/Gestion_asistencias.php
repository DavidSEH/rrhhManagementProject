<?php
//session_start();
include '../Controlador/Crear_asistencia.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Asistencias</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.0/angular.min.js"></script>
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
            const fechaIngreso = new Date(document.getElementsByName("fechain")[0].value + "T" + document.getElementsByName("horain")[0].value);
            const fechaSalida = new Date(document.getElementsByName("fechasal")[0].value + "T" + document.getElementsByName("horasal")[0].value);

            // Obtener la fecha y hora actual
            const fechaActual = new Date();

            // Verificar si la fecha y hora de entrada son válidas (mayores que la actual)
            if (fechaIngreso <= fechaActual) {
                alert("La fecha y hora de ingreso deben ser mayores que la fecha y hora actual.");
                document.getElementsByName("fechain")[0].value = "";
                document.getElementsByName("horain")[0].value = "";
                return false;
            }

            // Verificar si la fecha y hora de salida son válidas (mayores que la fecha y hora de entrada)
            if (fechaSalida <= fechaIngreso) {
                alert("La fecha y hora de salida deben ser mayores que la fecha y hora de ingreso.");
                document.getElementsByName("fechasal")[0].value = "";
                document.getElementsByName("horasal")[0].value = "";
                return false;
            }

            // Verificar si la hora de salida es anterior a la hora de entrada
            if (fechaSalida.toDateString() === fechaIngreso.toDateString() && fechaSalida <= fechaIngreso) {
                alert("La hora de salida no puede ser anterior a la hora de ingreso si la fecha de salida es la misma que la fecha de ingreso.");
                document.getElementsByName("horasal")[0].value = "";
                return false;
            }

            // Si todas las validaciones pasan, retornar true para enviar el formulario
            return true;
        }
    </script>

    <input type="checkbox" id="menu-toggle">
    <!--Sidebar Inicio-->
    <?php include "./sidebar.php" ?>

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
                <a href="../Modelo/salir.php" title="cerrar Sesion">
                    <span class="fas fa-sign-out-alt"></span></a>
            </div>
        </header>
        <!--Navbar Fin-->
        <?php date_default_timezone_set('America/Lima');
        $fecha = date("Y-m-d");; ?>
        <section>
            <div class="cab-user">
                <h2> <i class="fas fa-hotel"></i>Registrar Asistencias </h2>
                <?php echo isset($msg2) ? $msg2 : ''; ?>
            </div>
            <form method="post" action="" onsubmit="validarFechas();">
                <input type="hidden" name="idusuario" value="<?php echo $_SESSION['idUser'] ?>">
                <input type="hidden" name="idcliente" value="<?php echo $idcliente; ?>">
                <div class="principal-genera-r">
                    <div class="seccion-datos-ca">
                        <div class="seccion-datos-cli">
                            <p>Datos del la asistencia</p>
                            <div class="datos-cli">
                            
                                <div class="seccion-datos-aloj">
                                    <div class="div-ext">
                                        <label for="">Nro de documento:</label>
                                        <div class="div-int">
                                            <i class="fas fa-address-card"></i>
                                            <input type="number" name="busqueda" value="<?php echo isset($dni) ? $dni : ''; ?>" maxlength="7" >
                                            <button type="submit" name="btnBuscar"> Buscar</button>
                                        </div>
                                    </div>
                                    <div class="div-ext">
                                        <label for="">Nombres:</label>
                                        <div class="div-int">
                                            <i class="fas fa-user-edit"></i>
                                            <input type="text" value="<?php echo isset($nombre) ? $nombre : ''; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="div-ext-part">
                                        <div class="datos-aloj">
                                            <div class="div-div-int">
                                                <label for="">Fecha Ingreso:</label>
                                                <div class="div-input-aloj">
                                                    <i class="fas fa-calendar-alt"></i>
                                                    <input type="date" name="fechain" value="" id="" onchange="">
                                                </div>
                                            </div>
                                            <div class="div-div-int" id="num-habitacion">
                                                <label for="">Hora Ingreso:</label>
                                                <div class="div-input-aloj">
                                                    <i class="fas fa-clock"></i>
                                                    <input type="time" name="horain" value="" id="userdate" onchange="TDate()">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="div-ext-part">
                                        <div class="datos-aloj">
                                            <div class="div-div-int" style="display: none;">
                                                <label for="">Fecha Salida:</label>
                                                <div class="div-input-aloj" >
                                                    <i class="fas fa-calendar-alt"></i>
                                                    <input type="date" name="fechasal" value="2037-12-31" id="userdate" onchange="TDate()">
                                                </div>
                                            </div>
                                            <div class="div-div-int" id="num-habitacion">
                                                <label for="">Hora Salida:</label>
                                                <div class="div-input-aloj">
                                                    <i class="fas fa-clock"></i>
                                                    <input type="time" name="horasal" value="" id="userdate" onchange="TDate()" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="seccion-datos-aloj">
                                    <div class="datos-aloj">
                                        <div class="div-ext-part">

                                            <div class="div-div-int">
                                                <button name="regresar">
                                                    <i class="fas fa-undo"></i>Regresar</button>
                                            </div>

                                            <div class="div-div-int">
                                                <button type="submit" name="btnGenerar">
                                                    <i class="fas fa-check-circle"></i>Confirmar</button>
                                            </div>

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