<?php
include "../Controlador/Modificar_Licencia_Administrador_Controlador.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Modificar Licencia</title>
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
            <div class="container-actualizar-user" style="margin:auto 15%;">
                <div class="section-actualizar-user">
                    <p>Modificar Licencia</p><br><br>
                    <form action="" method="post" style="margin:auto;width:80%" onsubmit="validarFechas();">
                        <div class="formulario-actualizar-user" style="text-align:center; background:white">
                            <input type="hidden" name="cod_licencia" value="<?php echo $cod_licencia; ?>">
                            <div class="conten-p-upd" style="width:auto;justify-content: center;">
                                <div class="contenido-upd">
                                    <label for="usuario">N° :</label>
                                    <input type="text" style="text-align:center;" name="adelantado" value="<?php echo $cod_licencia; ?>" disabled>
                                </div>
                            </div>
                            <div class="conten-p-upd" style="width:auto;justify-content: center;">
                                <div class="contenido-upd">
                                    <label for="dni">Fecha de inicio:</label>
                                    <input type="date" name="fecha_inicio" style="text-align:center;" id="userdate" onchange="TDate()" value="<?php echo $fecha_inicio; ?>">
                                </div>
                            </div>
                            <div class="conten-p-upd" id="num-habitacion" style="width:auto;justify-content: center;">
                                <div class="contenido-upd">
                                    <label for="dni">Fecha de finalización:</label>
                                    <input type="date" name="fecha_fin" style="text-align:center;" id="userdate" onchange="TDate()" value="<?php echo $fecha_fin; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="btn-actualizar-user" style="text-align:center; background:white">
                            <a href="Gestion_Licencias.php"><i class="fas fa-undo"></i>Regresar</a>
                            <button type="submit" name="btn_Modificar"><i class="fas fa-edit"></i>Modificar</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <div class="alert">
            <?php echo isset($alert) ? $alert : ''; ?>
        </div>
    </div>
    <?php include "../Modelo/Footer.php" ?>
</body>

</html>