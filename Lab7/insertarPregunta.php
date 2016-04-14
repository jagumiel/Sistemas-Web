<?php
	include 'credenciales.php';
	include 'preguntas.php';
	include 'usuarios.php';
	
	session_start(); //Creamos una session

	$pregunta = $_POST['pregunta'];
	$respuesta = $_POST['respuesta'];
	$tema = $_POST['tema'];
	$complejidad = $_POST['complejidad'];
	$email = $_SESSION["email"];
	$dir_ip = get_client_ip();
		
	insertarAccion($dir_ip, $email, 1);
		
	insertarPreguntaXML($pregunta, $respuesta, $tema, $complejidad);
	
	if (insertarPregunta($dir_ip, $email, $pregunta, $respuesta, $tema, $complejidad)) {
		header('Location: red_pregunta.php?insert=1');
	} 
	header('Location: red_pregunta.php?insert=0');
	
?> 
