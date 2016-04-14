<?php
	include 'preguntas.php';
	
	session_start(); //Creamos una session
	
	
	//Miramos si esta logeado, en caso de no estarlo, FUERA!
	if(!isset($_SESSION['email'])){ 
		$mensaje="Lo sentimos, no puedes estar aquí si no estás registrado.";
		echo "<script type='text/javascript'>alert('$mensaje');</script>";
		sleep(5);
		header("Location: layout.php");
	}else{

		$pregunta = $_POST['pregunta'];
		$respuesta = $_POST['respuesta'];
		$tema = $_POST['tema'];
		$complejidad = $_POST['complejidad'];
		$email = $_SESSION["email"];
		$dir_ip = get_client_ip();
			
		insertarPreguntaXML($pregunta, $respuesta, $tema, $complejidad);
		
		if (insertarPregunta($dir_ip, $email, $pregunta, $respuesta, $tema, $complejidad)) {
			header('Location: red_pregunta.php?insert=1');
		} 
		header('Location: red_pregunta.php?insert=0');
	}
	
?> 
