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
                <a href="DatosPersonales.php?id=<?php echo  $_SESSION['idUser']; ?>">
                    <p><?php echo $_SESSION['user']; ?></p>
                </a>
                <?php
                $msg = '';
                if ($_SESSION['rol'] == 1) {
                    $msg = 'Administrador';
                }
                if ($_SESSION['rol'] == 2) {
                    $msg = 'Recepcionista';
                }
                ?>
                <small><?php echo $msg; ?></small>
            </div>
        </div>
        <div class="sider-ul">
            <div class="acordion">
                <div class="contentBx">
                    <div class="label">
                        <i class="fas fa-home"></i> <a href="MenuUsuario.php">Portal</a>
                    </div>


                </div>
                <div class="contentBx">
                    <div class="label">
                        <i class="fas fa-file-invoice"></i> Licencia
                    </div>
                    <div class="content">
                        <a href="Check_In.php"><i class="far fa-circle"></i>TramitarLicencia</a>
                        <a href="Gestion_Reservas.php"><i class="far fa-circle"></i>Licencias</a>
                        <a href="Check_Out.php"><i class="far fa-circle"></i>TerminarLicencia</a>

                    </div>
                </div>
                <div class="contentBx">
                    <div class="label">
                        <i class="fas fa-users"></i></i> Asistencia
                    </div>
                    <div class="content">
                        <a href="Gestion_asistencias.php"><i class="far fa-circle"></i>Agregar</a>
                        <a href="Listar_asistencias.php"><i class="far fa-circle"></i>Listar</a>
                    </div>
                </div>
                <div class="contentBx">
                    <div class="label">
                        <i class="fas fa-users-cog"></i> Gestión
                    </div>
                    <div class="content">
                        <a href="Gestion_Clientes.php"><i class="far fa-circle"></i>Empleados</a>
                        <?php
                        if ($_SESSION['rol'] == 1) {

                        ?>
                            <a href="Gestion_Usuario.php"><i class="far fa-circle"></i>Administrador</a>
                            <a href="Gestion_Promocion.php"><i class="far fa-circle"></i>Licencias</a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="contentBx">
                    <div class="label">
                        <i class="fas fa-file-invoice-dollar"></i> Reportes
                    </div>
                    <div class="content">
                        <a href="Reporte_Diario.php"><i class="far fa-circle"></i>Reporte Diario</a>
                        <a href="Reporte_Mensual.php"><i class="far fa-circle"></i>Reporte Mensual</a>
                    </div>
                </div>
                <?php
                if ($_SESSION['rol'] == 1) {

                ?>
                    <div class="contentBx">
                        <div class="label">
                            <i class="fas fa-wrench"></i> Configuracion
                        </div>
                        <div class="content">
                            <a href="Habitacion.php"><i class="far fa-circle"></i>Licencias</a>
                            <a href="Categoria.php"><i class="far fa-circle"></i>Categorias</a>
                            <?php
                            include "../Modelo/conexion.php";
                            $query = mysqli_query($conection, "SELECT * FROM empresa");
                            while ($data = mysqli_fetch_array($query)) {
                                $ruc            = $data['ruc'];
                                $razon_social    = $data['razon_social'];
                                $telefono       = $data['telefono'];
                                $direccion      = $data['direccion'];
                                $pagina_web      = $data['pagina_web'];
                            }
                            ?>
                            <a href="Datos_Hotel.php?ruc=<?php echo  $ruc; ?>"><i class="far fa-circle"></i>Datos Empresa</a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

        </div>
    </div>
</div>