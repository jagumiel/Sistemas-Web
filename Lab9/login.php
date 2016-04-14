<?php
	include "usuarios.php";
	
	session_start(); //Creamos una session
	
	$logged = login($_POST['email'], $_POST['password']);
	
	switch($logged) {
		case '0':
			header("location:insertarPregunta_form.php");
			break;
		case '1':
			echo '<div class="error">Su usuario es incorrecto, inténtelo otra vez.</div>'; 
			header("location:layout.php");
			break;
		case '2':
			echo 'Ha superado el límite de intentos. Podrás volver a intentarlo en 30 minutos.';
			break;
		default:
			echo $logged;
			break;
	}
	
?>