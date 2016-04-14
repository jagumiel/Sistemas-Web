<?php
	include 'credenciales.php';
	include 'usuarios.php';

	switch($_GET['funcion']) {
		case "insertarPregunta":
			insertarAccion($_GET['ip'], $_GET['email'], 1);
			insertarPreguntaXML($_GET['pregunta'], $_GET['respuesta'], $_GET['tema'], $_GET['complejidad']);
			insertarPregunta($_GET['ip'], $_GET['email'], $_GET['pregunta'], $_GET['respuesta'], $_GET['tema'], $_GET['complejidad']);
			break;
		case "editarPregunta":
			insertarAccion($_GET['ip'], $_GET['email'], 3);
			editarPreguntaXML($_GET['id_pregunta'], $_GET['pregunta'], $_GET['respuesta'], $_GET['tema'], $_GET['complejidad']);
			editarPregunta($_GET['id_pregunta'], $_GET['pregunta'], $_GET['respuesta'], $_GET['tema'], $_GET['complejidad']);
			break;
	} 
	
	function insertarPregunta($dir_ip, $email, $pregunta, $respuesta, $tema, $complejidad){				
		////////// VALIDAR FORMULARIO //////////
		if ((strlen($pregunta) >= 16) and 
			(strlen($respuesta) >= 2) and
			(strlen($tema) >= 3) and
			($complejidad >= 1 and $complejidad <= 5)) {
						
			////////// AÑADIR A LA BASE DE DATOS //////////			
		
			$conexion = new mysqli($servidor, $usuario_servidor, $password_servidor, $nombre_bd);	// Crear la conexion
			if ($conexion->connect_error) {		// Comprobar la conexion
				return false;
			}
				
			$sql = "INSERT INTO ".$nombre_bd.".pregunta (id, pregunta, respuesta, tema, complejidad, email)
			VALUES (DEFAULT, '{$pregunta}','{$respuesta}','{$tema}','{$complejidad}','{$email}')";

			//Las preguntas solo las pueden añadir los usuarios registrados, siempre hay un email.
				
			$inserted = ($conexion->query($sql));
			
			$conexion->close();
				
			return $inserted;
		}
	}
	
		function insertarPreguntaAsincrona($dir_ip, $email, $pregunta, $respuesta, $tema, $complejidad){				
		////////// VALIDAR FORMULARIO //////////
		$dir_ip=$_POST["dir_ip"];
		$email=$_POST["email"];
		
		$pregunta=$_POST["pregunta"];
		$respuesta=$_POST["respuesta"];
		$tema=$_POST["tema"];
		$complejidad=$_POST["complejidad"];
		
		if ((strlen($pregunta) >= 16) and 
			(strlen($respuesta) >= 2) and
			(strlen($tema) >= 3) and
			($complejidad >= 1 and $complejidad <= 5)) {
						
			////////// AÑADIR A LA BASE DE DATOS //////////			
		
			$conexion = new mysqli($servidor, $usuario_servidor, $password_servidor, $nombre_bd);	// Crear la conexion
			if ($conexion->connect_error) {		// Comprobar la conexion
				return false;
			}
				
			$sql = "INSERT INTO ".$nombre_bd.".pregunta (id, pregunta, respuesta, tema, complejidad, email)
			VALUES (DEFAULT, '{$pregunta}','{$respuesta}','{$tema}','{$complejidad}','{$email}')";

			//Las preguntas solo las pueden añadir los usuarios registrados, siempre hay un email.
				
			$inserted = ($conexion->query($sql));
			
			$conexion->close();
				
			return $inserted;
		}
	}
	
	

	function insertarPreguntaXML($pregunta, $respuesta, $tema, $complejidad){	
		$xml = simplexml_load_file("preguntas.xml");
		
		$preguntaXML = $xml->addChild('assessmentItem');
			$preguntaXML->addAttribute('complexity', $complejidad); 
			$preguntaXML->addAttribute('subject', $tema); 
		
		$itemBody = $preguntaXML->addChild('itemBody');
			$itemBody->addChild('p', $pregunta);
			
		$correctResponse = $preguntaXML->addChild('correctResponse'); 
			$correctResponse->addChild('value', $respuesta);
	
		$xml->asXML('preguntas.xml');	// Guardar el fichero XML
		
		return true;  
	}

	
	function editarPregunta($id_pregunta, $pregunta, $respuesta, $tema, $complejidad) {
			////////// VALIDAR FORMULARIO //////////
		if ((strlen($pregunta) >= 16) and 
			(strlen($respuesta) >= 2) and
			(strlen($tema) >= 3) and
			($complejidad >= 1 and $complejidad <= 5)) {
						
			////////// AÑADIR A LA BASE DE DATOS //////////			
		
			$conexion = new mysqli($servidor, $usuario_servidor, $password_servidor, $nombre_bd);	// Crear la conexion
			if ($conexion->connect_error) {		// Comprobar la conexion
				return false;
			}
				
			$sql = "UPDATE pregunta 
					SET pregunta = '$pregunta', respuesta = '$respuesta',
					tema = '$tema', complejidad = '$complejidad'  
					WHERE id='$id_pregunta'";

			//Las preguntas solo las pueden añadir los usuarios registrados, siempre hay un email.			
			$changed = ($conexion->query($sql));
			
			$conexion->close();
				
			return $changed;
		}
	}
	
	function editarPreguntaXML($id_pregunta, $pregunta, $respuesta, $tema, $complejidad) {
		
	}
	
?>