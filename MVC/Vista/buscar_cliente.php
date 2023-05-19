<?php
// Conexion a la base de datos y otras configuraciones
session_start();

include "../Modelo/conexion.php";

$nombre = $_GET['nombre'];

$query = mysqli_query($conection, "SELECT idcliente, dni, nombre, telefono, domicilio, correo, usuario_cli, clave_cli
                                   FROM cliente c
                                   WHERE estatus = 1 AND nombre LIKE '%$nombre%'
                                   ORDER BY idcliente");
mysqli_close($conection);

$result = mysqli_num_rows($query);
if ($result > 0) {
    while ($data = mysqli_fetch_array($query)) {
        ?>
        <div class="lista-p">
            <div class="lista-sec">
                <div class="lista-datos">
                    <div class="lista-datos-p">
                        <h3><?php echo $data["nombre"]; ?></h3>
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
                                <span>Edad:22</span> 
                            </li>
                            <li>
                                <span class="fas fa-user-secret"></span>
                                <span>Usuario:<?php echo $data["usuario_cli"]; ?></span> 
                            </li>
                            <li>
                                <span class="fas fa-user-secret"></span>
                                <span>Telefono:<?php echo $data["telefono"]; ?></span> 
                            </li>
                            <li>
                                <span class="fas fa-smile-beam"></span>
                                <span>Dirección:<?php echo $data["domicilio"]; ?></span> 
                            </li>
                        </div>
                    </div>
                </div>
                <div class="lista-img">
                    <img src="../../Imagenes/perfil.jpg" alt="">
                </div>
            </div>
            <div class="lista-btn">
                <a href="ModificarCliente.php?id=<?php echo $data["idcliente"]; ?>" class="btn-update"><i class="fas fa-edit"></i>Modificar</a>
            </div>
        </div>
        <?php
    }
} else {
    echo "No se encontraron clientes.";
}
?>

