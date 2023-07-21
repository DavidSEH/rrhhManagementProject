<?php
include "../Controlador/Modificar_Asistencia_Controlador.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Modificar Asistencia</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.0/angular.min.js"></script>
    <?php include "../Modelo/scripts.php" ?>
</head>

<body>
    <script>
        function TDate() {
            var UserDate = document.getElementById("fecha_ingreso").value;
            var ToDate = new Date();
            console.log(ToDate.toISOString());
            if (new Date(UserDate).toISOString() >= ToDate.toISOString()) {
                alert("La fecha debe ser menor o igual a (actual): " + ToDate);
                return false;
            }
            return true;
        }
        function validarFechas() {
            const fechaIngreso = new Date(document.getElementsByName("fecha_ingreso")[0].value + "T" + document.getElementsByName("hora_ingreso")[0].value);
            const fechaSalida = new Date(document.getElementsByName("fecha_salida")[0].value + "T" + document.getElementsByName("hora_salida")[0].value);
            alert(fechaIngreso);
            // Obtener la fecha y hora actual
            const fechaActual = new Date();

            // Verificar si la fecha y hora de entrada son válidas (mayores que la actual)
            if (fechaIngreso <= fechaActual) {
                alert("La fecha y hora de ingreso deben ser mayores que la fecha y hora actual.");
                document.getElementsByName("fecha_ingreso")[0].value = "";
                document.getElementsByName("hora_ingreso")[0].value = "";
                return false;
            }

            // Verificar si la fecha y hora de salida son válidas (mayores que la fecha y hora de entrada)
            if (fechaSalida <= fechaIngreso) {
                alert("La fecha y hora de salida deben ser mayores que la fecha y hora de ingreso.");
                document.getElementsByName("fecha_salida")[0].value = "";
                document.getElementsByName("hora_salida")[0].value = "";
                return false;
            }

            // Verificar si la hora de salida es anterior a la hora de entrada
            if (fechaSalida.toDateString() === fechaIngreso.toDateString() && fechaSalida <= fechaIngreso) {
                alert("La hora de salida no puede ser anterior a la hora de ingreso si la fecha de salida es la misma que la fecha de ingreso.");
                document.getElementsByName("hora_salida")[0].value = "";
                return false;
            }

            // Si todas las validaciones pasan, retornar true para enviar el formulario
            return true;
        }
    </script>
    <input type="checkbox" id="menu-toggle">
    <!--Sidebar Inicio-->
    <?php include "./sidebarAdministrador.php" ?>
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
                <a href="../Modelo/salir.php"><span class="fas fa-sign-out-alt"></span></a>
            </div>
        </header>
        <!--Navbar Fin-->
        <section>
            <div class="container-actualizar-user">
                <div class="section-actualizar-user">
                    <p>Actualizar Asistencia</p>
                    <form action="" method="post" onsubmit="return validarFechas();">
                        <input type="hidden" name="idusuario" value="<?php echo $_SESSION['idUser'] ?>">
                        <div class="formulario-actualizar-user">
                            <input type="hidden" name="cod_asistencia" id="cod_asistencia" value="<?php echo $cod_asistencia; ?>">
                            <div class="conten-p-upd">
                                <div class="contenido-upd">
                                    <label for="nombre">Nombre del empelado:</label>
                                    <input type="text" name="nombres" id="nombres" value="<?php echo $nombres; ?>" disabled>
                                </div>
                            </div>
                            <div class="conten-p-upd">
                                <div class="contenido-upd">
                                    <label for="fecha_ingreso">Dia Entrada:</label>
                                    <input type="date" name="fecha_ingreso" id="fecha_ingreso" value="<?php echo $fecha_ingreso; ?>" onchange="TDate()">
                                </div>
                            </div>
                            <div class="conten-p-upd">
                                <div class="contenido-upd">
                                    <label for="hora_ingreso">Hora Entrada:</label>
                                    <input type="time" name="hora_ingreso" id="hora_ingreso" value="<?php echo $hora_ingreso; ?>" onchange="TDate()">
                                </div>
                                <div class="contenido-upd">
                                    <label for="hora salida">Hora Salida:</label>
                                    <input type="time" name="hora_salida" id="hora_salida" value="<?php echo $hora_salida; ?>" onchange="TDate()">
                                </div>
                            </div>
                        </div>
                        <div class="btn-actualizar-user">
                            <a href="Listar_asistencias.php"><i class="fas fa-undo"></i>Regresar</a>
                            <button type="submit" value="Actualizar"><i class="fas fa-edit"></i>Actualizar</button>
                        </div>
                        <div class="alert">
                            <?php echo isset($alert) ? $alert : ''; ?>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>
    <?php include "../Modelo/Footer.php" ?>
</body>

</html>