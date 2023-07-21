<div class="sidebar">
    <div class="brand">
        <img src="../../Imagenes/logo_hotel.jpg" alt="">
        <h3> Talenty S.A.</h3>
    </div>
    <div class="sidemenu">
        <div class="side-user">
            <div class="side-img-p">
                <img class="side-img" src="../../Imagenes/imgmen.jpg" alt="">
            </div>
            <div class="user">
                    <p><?php echo $_SESSION['user']; ?></p>
                <?php
                $msg = '';
                if ($_SESSION['rol'] == 1) {
                    $msg = 'Administrador';
                }
                if ($_SESSION['rol'] == 2) {
                    $msg = 'Empleado';
                }
                ?>
                <small><?php echo $msg; ?></small>
            </div>
        </div>
        <div class="sider-ul">
            <div class="acordion">
                <div class="contentBx">
                    <div class="label" >
                    <a href="MenuAdministrador.php">
                        <i class="fas fa-home"></i>Portal</a>
                    </div>
                </div>
                <div class="contentBx">
                    <div class="label">
                        <i class="fas fa-file-invoice"></i> Licencia
                    </div>
                    <div class="content">
                        <a href="Licencias.php"><i class="far fa-circle"></i>Tramitar Licencia</a>
                        <a href="Gestion_Licencias.php"><i class="far fa-circle"></i>Listar Licencias</a>
                    </div>
                </div>
                <div class="contentBx">
                    <div class="label">
                        <i class="fas fa-users"></i></i> Asistencia
                    </div>
                    <div class="content">
                        <a href="Nueva_Asistencia.php"><i class="far fa-circle"></i>Agregar Asistencia</a>
                        <a href="Listar_asistencias.php"><i class="far fa-circle"></i>Listar Asistencia</a>
                    </div>
                </div>
                <div class="contentBx">
                    <div class="label">
                        <i class="fas fa-users-cog"></i> Gestión
                    </div>
                    <div class="content">
                        <a href="Gestion_Empleados.php"><i class="far fa-circle"></i>Empleados</a>
                        <?php
                        if ($_SESSION['rol'] == 1) {
                        ?>
                            <a href="Gestion_Usuario.php"><i class="far fa-circle"></i>Usuarios</a>
                        <?php
                        }
                        ?>
 			<a href="Nueva_Boleta_Pago.php"><i class="far fa-circle"></i>Pagos</a>
                    </div>
                </div>
                <?php
                if ($_SESSION['rol'] == 1) {
                ?>
                    <div class="contentBx">
                        <div class="label">
                            <i class="fas fa-wrench"></i> Configurar
                        </div>
                        <div class="content">
                            <?php
                            include "../Modelo/conexion.php";
                            $query = mysqli_query($conection, "SELECT * FROM empresa");
                            while ($data = mysqli_fetch_array($query)) {
                                $ruc            = $data['ruc'];
                                $razon_social    = $data['razon_social'];
                                $telefono       = $data['telefono'];
                                $direccion      = $data['direccion'];
                                $pagina_web      = $data['web'];
                            }
                            ?>
                            <a href="Datos_Empresa.php?ruc=<?php echo  $ruc; ?>"><i class="far fa-circle"></i>Datos Empresa</a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

        </div>
    </div>
</div>