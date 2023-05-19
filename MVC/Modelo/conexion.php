<?php 

	$host = 'localhost:33065';
	$user = 'root';
	$password = '';
	$db = 'HotelDlux';

	$conection = @mysqli_connect($host,$user,$password,$db);

	if(!$conection){
		echo "Error en la conexión";
	}
        
?>