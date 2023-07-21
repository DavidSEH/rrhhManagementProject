<?php
// Conexion a la base de datos y otras configuraciones
session_start();

include "../Modelo/conexion.php";

$nombres = $_GET['nombre'];

$query = mysqli_query($conection, "SELECT cod_personal,dni,nombres,apellidos,telefono,fecha_ingreso,fecha_cese,cod_motivo_cese,cod_puesto,sueldo,correo,hijos
                                    from personal c 
                                   WHERE estado = 1 AND nombres LIKE '%$nombres%'
                                   ORDER BY cod_personal");
mysqli_close($conection);

$result = mysqli_num_rows($query);
if ($result > 0) {
    while ($data = mysqli_fetch_array($query)) {
?>
        <div class="lista-p">
            <div class="lista-sec">
                <div class="lista-datos">
                    <div class="lista-datos-p">
                        <h3><?php echo $data["nombres"]; ?>
                            <?php echo $data["apellidos"]; ?></h3>
                        <div class="lista-datos-personal">
                            <li>
                                <span class="fas fa-id-card"></span>
                                <span>DNI: <?php echo $data["dni"]; ?></span>
                            </li>
                            <li>
                                <span class="fas fa-at"></span>
                                <span>Correo:<?php echo $data["correo"]; ?></span>
                            </li>
                            <li>
                                <span class="fas fa-birthday-cake"></span>
                                <span>Fecha de ingreso:<?php echo $data["fecha_ingreso"]; ?></span>
                            </li>
                            <li>
                                <span class="fas fa-user-secret"></span>
                                <span>Puesto de trabajo:<?php echo $data["cod_puesto"]; ?></span>
                            </li>
                            <li>
                                <span class="fas fa-smile-beam"></span>
                                <span>Sueldo:<?php echo $data["sueldo"]; ?></span>
                            </li>
                        </div>
                    </div>
                </div>
                <div class="lista-img">
                    <img src="../../Imagenes/perfil.jpg" alt="">
                </div>
            </div>
            <div class="lista-btn">
                <?php
                if ($data["cod_personal"] != 1) {
                    echo '<a href="EliminarEmpleado.php?id=' . $data["cod_personal"] . '" class="btn-delete"><span class="material-symbols-outlined">person_off</span>Cese</a>';
                }
                ?>
                                <a href="../../Reportes/Reporte_Certificado.php?idUser=<?php echo $data["cod_personal"]; ?>"  class="btn-generate" target="_blank"><span class="material-symbols-outlined">task</span>Certificado</a>
                <a href="ModificarEmpleado.php?id=<?php echo $data["cod_personal"]; ?>" class="btn-update"><i class="fas fa-edit"></i>Modificar</a>
            </div>
        </div>
<?php
    }
} else {
    echo "No se encontraron empleados con los criterios de la busqueda.";
}
?>