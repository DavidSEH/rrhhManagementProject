<?php
include_once "../Controlador/Modificar_Licencia_Administrador_Controlador.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Gestión Licencias</title>
    <?php include_once "../Modelo/scripts.php" ?>
</head>
<body>
    <input type="checkbox" id="menu-toggle">
    <!--Sidebar Inicio-->
    <?php include_once "./sidebarAdministrador.php" ?>
    <!--Sidebar Fin-->
    <div class="main-content">
        <!--Navbar Inicio-->
        <?php include_once "../Modelo/HeaderUsu.php" ?>
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
                        <p class="title-pagos">Estado de la licencia</p>
                        <div class="princ-metpago">
                            <form action="" method="post">
                                <div>
                                    <p>Estado</p>
                                    <select name="estado" id="estadoSelect">
                                        <option value="2">Aprobado</option>
                                        <option value="3">Denegado</option>
                                    </select>
                                </div>
                                <div id="motivoJustificacion" style="display: none;">
                                    <p>Motivo o justificación:</p>
                                    <input name="comentario" type="text">
                                </div>
                                <div>
                                    <button name="btn_Estado" class="bg_confir"><i class="fas fa-check-circle"></i> Confirmar</button>
                                    <?php echo isset($msg_print) ? $msg_print : ''; ?>
                                </div>
                            </form>
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
                <script src="../../js/Tramite_licencias.js"></script>
            </div>
    </div>
    </section>
    </div>
    <?php include_once "../Modelo/Footer.php" ?>
</body>

</html>