<?php
	include "usuarios.php";
	
	session_start(); //Creamos una session
	
	if (changePassword($_POST['email'], $_POST['telefono'], $_POST['nuevaPassword'])) {
		header('Location: red_contrasena.php?insert=0');
	
	} else {
		header('Location: red_contrasena.php?insert=1');
	}
?>