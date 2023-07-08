<?php
$mapeo_columnas = array(
    'nombres' => array('nombres', 'nombre', 'name', 'names', 'NOMBRES', 'NOMBRE', 'NAME', 'NAMES'),
    'apellidos' => array('apellidos', 'apellido', 'surname', 'surnames', 'last_name', 'last_names', 'lastname', 'lastnames', 'last', 'lasts', 'APELLIDOS', 'APELLIDO'),
    'edad' => array('edad', 'age', 'EDAD', 'AGE'),
    'dni' => array('dni', 'cedula', 'cedula_identidad', 'ceduladeidentidad', 'documentoidentidad', 'documentoid', 'documentoide', 'DNI'),
    'telefono' => array('telefono', 'teléfono', 'movil', 'móvil', 'celular', 'phone', 'mobile', 'cellphone', 'cell', 'telephone', 'TELEFONO'),
    'direccion' => array('direccion', 'domicilio', 'address', 'home', 'direccion', 'DIRECCION', 'DOMICILIO', 'ADDRESS', 'HOME'),
    'correo' => array('correo', 'email', 'e-mail', 'mail', 'CORREO', 'EMAIL', 'E-MAIL', 'MAIL'),
    'fecha_ingreso' => array('fecha_ingreso', 'fechaingreso', 'fecha_inicio'),
    'fecha_cese' => array('fecha_cese', 'fechacese', 'fecha_fin'),
    'sueldo' => array('sueldo', 'salario', 'salary', 'wage', 'SUELDO', 'SALARIO', 'SALARY', 'WAGE'),
);
// Incluye el archivo de conexión
include "../Modelo/conexion.php";
$alert = '';
// Verifica si se ha enviado un archivo
if (isset($_FILES['archivo_sql'])) {
    // Obtiene la ruta temporal del archivo cargado
    $archivo_temporal = $_FILES['archivo_sql']['tmp_name'];

    // Llama a la función para cargar y procesar el archivo SQL
    cargarArchivoSQL($archivo_temporal);
}

// Función para cargar y procesar el archivo SQL
function cargarArchivoSQL($archivo_temporal)
{
    // Lee el contenido del archivo SQL
    $contenido_sql = file_get_contents($archivo_temporal);

    // Busca una tabla con nombres conocidos en el archivo SQL
    $tablas = ['empleados', 'empleado', 'personas', 'personal', 'persona', 'cliente', 'clientes', 'usuarios', 'users', 'user', 'usuario'];
    $tabla_encontrada = '';

    foreach ($tablas as $tabla) {
        $patron_tabla = '/CREATE TABLE IF NOT EXISTS `' . $tabla . '`/';
        if (preg_match($patron_tabla, $contenido_sql)) {
            $tabla_encontrada = $tabla;
            break;
        }
    }

    if (!empty($tabla_encontrada)) {
        // Obtiene la estructura de la tabla encontrada
        $estructura_tabla = obtenerEstructuraTabla($contenido_sql);

        if ($estructura_tabla !== false) {
            // Compara las columnas de la tabla encontrada con las de la tabla "personal"
            $columnas_coincidentes = compararColumnas($estructura_tabla);
            $cadena = implode(", ", $columnas_coincidentes);
            echo $cadena;
            if (!empty($columnas_coincidentes)) {
                // Extrae los datos de inserción
                $patron_insert = '/INSERT INTO `' . $tabla_encontrada . '` \([^)]+\) VALUES ([^;]+);/';
                preg_match_all($patron_insert, $contenido_sql, $matches_insert);

                if (!empty($matches_insert[1])) {
                    $valores_insert = $matches_insert[1];

                    // Inserta los datos en la tabla "personal"
                    insertarDatos($tabla_encontrada, $columnas_coincidentes, $valores_insert);
                } else {
                    echo "No se encontraron datos de inserción en el archivo SQL.";
                }
            } else {
                echo "No se encontraron columnas coincidentes entre las tablas.";
            }
        } else {
            echo "No se pudo obtener la estructura de la tabla encontrada.";
        }
    } else {
        echo "No se encontró ninguna tabla en el archivo SQL.";
    }
}


// Función para insertar los datos en la tabla "personal"
function insertarDatos($nombre_tabla_encontrada, $columnas_coincidentes, $valores_insert)
{
    global $conection;

    // Prepara la consulta de inserción en la tabla "personal"
    $consulta_insertar = "INSERT INTO personal (" . implode(", ", $columnas_coincidentes) . ") VALUES ";

    // Recorre los datos de inserción y construye la consulta de inserción
    foreach ($valores_insert as $valores) {
        $consulta_insertar .= "(" . $valores . "), ";
    }

    // Elimina la última coma y espacio en blanco
    $consulta_insertar = rtrim($consulta_insertar, ", ");

    // Ejecuta la consulta de inserción
    $resultado_insertar = mysqli_query($conection, $consulta_insertar);

    if ($resultado_insertar) {
        echo "Los datos se han insertado correctamente en la tabla 'personal'.";
    } else {
        echo "Error al insertar los datos en la tabla 'personal': " . mysqli_error($conection);
    }
}

function obtenerEstructuraTabla($contenido_sql)
{
    // Busca los bloques de código CREATE TABLE
    preg_match_all('/CREATE TABLE IF NOT EXISTS `(\w+)` \((.*?)\);/s', $contenido_sql, $matches, PREG_SET_ORDER);

    $tabla_encontrada = '';
    $estructura_tabla_encontrada = null;

    foreach ($matches as $match) {
        $nombre_tabla = $match[1];
        $estructura_tabla = $match[2];

        if (empty($tabla_encontrada)) {
            $tabla_encontrada = $nombre_tabla;
            $estructura_tabla_encontrada = obtenerColumnasTabla($estructura_tabla);
        }
    }

    return $estructura_tabla_encontrada;
}

function obtenerColumnasTabla($estructura_tabla)
{
    $columnas = array();

    preg_match_all('/`(\w+)`/', $estructura_tabla, $matches);

    if (!empty($matches[1])) {
        $columnas = $matches[1];
    }

    return $columnas;
}

// Función para comparar las columnas de la tabla encontrada con la tabla "personal"
function compararColumnas($estructura_tabla_encontrada)
{
    global $mapeo_columnas;

    // Columnas de la tabla "personal"
    $columnas_personal = array_keys($mapeo_columnas);

    // Encuentra las columnas coincidentes o sus sinónimos
    $columnas_coincidentes = array();

    foreach ($estructura_tabla_encontrada as $columna) {
        // Verifica si la columna coincide directamente
        if (in_array($columna, $columnas_personal)) {
            $columnas_coincidentes[] = $columna;
        } else {
            // Verifica si la columna tiene sinónimos o equivalencias
            foreach ($mapeo_columnas as $columna_personal => $sinonimos) {
                if (in_array($columna, $sinonimos)) {
                    $columnas_coincidentes[] = $columna_personal;
                    break;
                }
            }
        }
    }

    return $columnas_coincidentes;
}
