<?php

        $host = 'localhost:3306';
        $user = 'root';
        $password = '';
        $db = 'tutrabajo';

        $conection = @mysqli_connect($host,$user,$password,$db);

        if(!$conection){
            echo "Error en la conexión";
        }

?>