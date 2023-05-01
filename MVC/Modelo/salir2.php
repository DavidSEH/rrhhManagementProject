<?php 
	
	session_start();
	session_destroy();

	header('location: ../Vista/loginCliente.php');

 ?>