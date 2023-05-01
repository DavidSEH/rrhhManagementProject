<?php 
include "MVC/Modelo/conexion.php";

date_default_timezone_set('America/Lima'); 
    $id_mes=$_POST['id_mes'];
    $fecha=date("m");
    if ($fecha==$id_mes) {
        print 'Son Iguales';
    }else{
        print 'Son Diferentes';
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <div class="cab_sec">
            <p>Mes: </p>
            <select name="id_mes" id="">
            <?php
                $query_mes=mysqli_query($conection,"SELECT id_mes,name_mes FROM mes");
                $result_mes = mysqli_num_rows($query_mes);
                if ($result_mes>0) {
                    while ($dataMes=mysqli_fetch_array($query_mes)) {
            ?>
            
                <option value="<?php echo $dataMes['id_mes'] ?>"><?php echo $dataMes['name_mes'] ?></option>
            
            <?php 
                }
            }
            ?>
            </select>
        </div>
        <button type="submit" class="btn btn-">Enviar</button>
    </form>
</body>
</html>