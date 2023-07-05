<?php
include "../Controlador/Modificar_Licencia_Administrador_Controlador.php";

?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Gestión Licencias</title>
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
            const fechaInicio = new Date(document.getElementsByName('fecha_inicio')[0].value);
            const fechaFinal = new Date(document.getElementsByName('fecha_fin')[0].value);
            const fechaActual = new Date();
            if (fechaInicio < fechaActual || fechaFinal < fechaActual) {
                alert('Las fechas deben ser desde la fecha actual hacia adelante.');
                document.getElementsByName('fecha_inicio')[0].value = '';
                document.getElementsByName('fecha_fin')[0].value = '';
                return false;
            }

            if (fechaInicio > fechaFinal) {
                alert('La fecha de inicio debe ser anterior a la fecha final.');
                document.getElementsByName('fecha_ingreso')[0].value = '';
                document.getElementsByName('fecha_fin')[0].value = '';
                return false;
            }
            return true;
        }
    </script>
    <input type="checkbox" id="menu-toggle">
    <!--Sidebar Inicio-->
    <?php include "./sidebarAdministrador.php" ?>
    <!--Sidebar Fin-->
    <div class="main-content">
        <!--Navbar Inicio-->
        <?php include "../Modelo/HeaderUsu.php" ?>
        <!--Navbar Fin-->
        <section>
            <h2><i class="fas fa-sign-out-alt"></i> Gestión <span>/Licencia</span></h2>
            <input type="hidden" name="idusuario" value="<?php echo $_SESSION['idUser'] ?>">
            <div class="principal-genera-r">
                <div class="cab-datosh">
                    <p class="title-datosh">Datos de la licencia solicitada</p>
                    <div class="sec-datosh">
                        <div class="dh1">
                            <div class="dh1-sec">
                                <p>Empleado:</p>
                                <p>Licencia solicitada:</p>
                                <p>Descripción:</p>
                            </div>
                            <div>
                                <p><?php echo $nombres; ?></p>
                                <p><?php echo $tipo; ?></p>
                                <p><?php echo $descripcion; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="seccion-datos-ca">
                    <div class="seccion_metpago">
                        <p class="title-pagos">Editar duración de licencia</p>
                        <div class="princ-metpago">
                            <form action="" method="post" onsubmit="validarFechas();">

                                <div>
                                    <p>Fecha de inicio:</p>
                                    <input type="date" name="fecha_inicio" id="userdate" onchange="TDate()" value="<?php echo $fecha_inicio; ?>">
                                </div>
                                <input type="hidden" name="cod_licencia" value="<?php echo $cod_licencia; ?>">
                                <div>
                                    <p>Fecha de finalización:</p>
                                    <input type="date" name="fecha_fin" id="userdate" onchange="TDate()" value="<?php echo $fecha_fin; ?>">
                                </div>
                                <div class="btn-actualizar-user">
                                    <a href="Gestion_Licencias.php"><i class="fas fa-undo"></i>Regresar</a>
                                    <button type="submit" name="btn_Modificar"><i class="fas fa-edit"></i>Modificar</button>
                                </div>

                            </form>
                            <div>
                                <?php echo isset($alert) ? $alert : ''; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="seccion-datos-ca">
                    <div class="seccion_metpago">
                        <p class="title-pagos">Estado de la licencia</p>
                        <div class="princ-metpago">
                            <form action="" method="post">
                                <div>
                                    <p>Estado</p>
                                    <select name="estado" id="">
                                        <option value="2">Aprobado</option>
                                        <option value="3">Denegado</option>
                                    </select>
                                </div>
                                <div>
                                    <p>Motivo o justificación:</p>
                                    <input name="comentario" type="text" required>
                                </div>
                                <div>
                                    <button name="btn_Estado" class="bg_confir"><i class="fas fa-check-circle"></i> Confirmar</button>
                                    <?php echo isset($msg_print) ? $msg_print : ''; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
    <?php include "../Modelo/Footer.php" ?>
</body>

</html>