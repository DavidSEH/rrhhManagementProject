<?php 
    include "../../MVC/Modelo/conexion.php";
$html='
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Telefono</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>'.$dni.'</td>
                <td>1</td>
                <td>1</td>
                <td>2</td>
                <td>43</td>
                <td>43</td>
            </tr>
            <tr>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>2</td>
                <td>43</td>
                <td>4322</td>
            </tr>
        </tbody>

    </table>
</body>
</html>';

?>