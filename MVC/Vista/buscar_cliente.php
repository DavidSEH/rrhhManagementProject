<?php
// Conexion a la base de datos y otras configuraciones
session_start();

include "../Modelo/conexion.php";

$nombre = $_GET['nombre'];

$query = mysqli_query($conection, "SELECT cod_personal, dni, nombres,apellidos, edad, telefono, direccion, correo
                                   FROM personal c
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
                                <span>Edad:<?php echo $data["edad"]; ?></span>
                            </li>
                            <li>
                                <span class="fas fa-user-secret"></span>
                                <span>Telefono:<?php echo $data["telefono"]; ?></span>
                            </li>
                            <li>
                                <span class="fas fa-smile-beam"></span>
                                <span>Dirección:<?php echo $data["direccion"]; ?></span>
                            </li>
                        </div>
                    </div>
                </div>
                <div class="lista-img">
                    <img src="../../Imagenes/perfil.jpg" alt="">
                </div>
            </div>
            <div class="lista-btn">
                <a href="ModificarEmpleado.php?id=<?php echo $data["cod_personal"]; ?>" class="btn-update"><i class="fas fa-edit"></i>Modificar</a>
                <a href="EliminarEmpleado.php?id=<?php echo $data["cod_personal"]; ?>" class="btn-delete"><i class="fas fa-level-down-alt"></i>Descender</a>
            </div>
        </div>
<?php
    }
} else {
    echo "No se encontraron empleados con los criterios de la busqueda.";
}
?>