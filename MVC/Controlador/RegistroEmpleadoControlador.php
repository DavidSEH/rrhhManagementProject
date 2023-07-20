<?php include_once "../Modelo/conexion.php";

// Realizar la consulta a la base de datos para obtener los puestos
$query = "SELECT cod_puesto, descripcion FROM tipo_puesto";
$result = mysqli_query($conection, $query);

// Verificar si se obtuvieron resultados
if ($result && mysqli_num_rows($result) > 0) {
    $options = ""; // Variable para almacenar las opciones del select

    // Recorrer los resultados y generar las opciones
    while ($row = mysqli_fetch_assoc($result)) {
        $cod_puesto = $row['cod_puesto'];
        $descripcion = $row['descripcion'];
        $options .= "<option value=\"$cod_puesto\">$descripcion</option>";
    }
} else {
    // Manejar el caso en que no se obtuvieron resultados
    $options = "<option value=\"\">No hay puestos disponibles</option>";
}

if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['dni'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
    } else {

        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $edad = $_POST['edad'];
        $correo  = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $domicilio = $_POST['domicilio'];
        $fecha_ingreso = $_POST['fecha_ingreso'];
        $sueldo = $_POST['sueldo'];
        $hijos = $_POST['hijos'];
        $cod_puesto = $_POST['cod_puesto'];

        // Verificar si ya existe un cliente con el mismo DNI
        $query_dni = mysqli_query($conection, "SELECT * FROM personal WHERE dni = '$dni'");
        $result_dni = mysqli_fetch_array($query_dni);

        if ($result_dni) {
            $alert = '<p class="msg_error">Ya está registrado un empleado con el mismo DNI.</p>';
        } else {

            $query_insert = mysqli_query(
                $conection,
                "INSERT INTO personal(dni,nombres,edad,correo,telefono,direccion,fecha_ingreso, sueldo,cod_puesto,hijos, estado)
                VALUES('$dni','$nombre','$edad','$correo','$telefono','$domicilio','$fecha_ingreso','$sueldo','$cod_puesto','$hijos',1)"
            );

            if ($query_insert) {
                $alert = '<p class="msg_save">¡Empleado registrado correctamente!.</p>';
            } else {
                $error = mysqli_error($conection);
                $alert = '<p class="msg_error">Error al registrar el empleado: ' . $error . '</p>';
            }
        }
    }
}
