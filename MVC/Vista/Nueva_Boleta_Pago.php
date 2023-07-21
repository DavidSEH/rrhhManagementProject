<?php
include '../Controlador/Nueva_Boleta_Pago_Controlador.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Generar Licencia</title>
    <?php include "../Modelo/scripts.php" ?>
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
            <div class="cab-user">
                <h3> Generar Boleta de Pago<h2> <span>/Solicitar</span></h2>
                </h3>
                <?php echo isset($msg2) ? $msg2 : ''; ?>
            </div>

            <form method="post" action="" onsubmit="">
                <input type="hidden" name="cod_personal" value="<?php echo isset($cod_personal_usu) ? $cod_personal_usu : ''; ?>">
                
                <div class="principal-genera-r">

                    <div class="seccion-datos-ca">
                        <div class="seccion-datos-cli">
                            <p>Datos del Empleado</p>
                            <div class="datos-cli">
                                <div class="div-ext">
                                    <label for="">DNI:</label>
                                    <div class="div-int">
                                        <i class="fas fa-address-card"></i>
                                        <input type="number" name="busqueda" value="<?php echo isset($dni_usu) ? $dni_usu : ''; ?>" maxlength="8">
                                        <button type="submit" name="btnBuscar"> Buscar </button>
                                    </div>
                                </div>
                                <div class="div-ext">
                                    <label for="">Nombres y apellidos:</label>
                                    <div class="div-int">
                                        <i class="fas fa-user-secret"></i>
                                        <input type="text" value="<?php echo isset($nombres_usu) ? $nombres_usu : ''; ?> " required disabled>
                                    </div>
                                </div>
                                <div class="div-ext">
                                    <label for="">Periodo (Mes)</label>
                                    <div class="div-int">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <input type="text" value="" name="periodo">
                                    </div>
                                </div>
                                <div class="div-ext">
                                    <label for="">Dias de trabajo</label>
                                    <div class="div-int">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <input type="number" value="" name="dias_trabajo">
                                    </div>
                                </div>
                                <div class="div-ext">
                                    <label for="">Horas de Trabajo</label>
                                    <div class="div-int">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <input type="number" value="" name="horas_trabajo">
                                    </div>
                                </div>
                                <div class="div-ext-part">

                                    <div class="div-div-int" style="display: flex;justify-content: center;align-items: center;">
                                        <button type="submit" name="regresar">
                                            <i class="fas fa-undo"></i>Regresar</button>
                                    </div>

                                    <div class="div-div-int" style="display: flex;justify-content: center;align-items: center;">
                                        <button type="submit" name="btnGenerar">
                                            <i class="fas fa-check-circle"></i>Generar Boleta</button>
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