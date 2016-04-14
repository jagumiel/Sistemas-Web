<?php
	switch($_GET['funcion']) {
		case "insertarPregunta":
			insertarPreguntaXML($_GET['pregunta'], $_GET['respuesta'], $_GET['tema'], $_GET['complejidad']);
			echo insertarPregunta($_GET['ip'], $_GET['email'], $_GET['pregunta'], $_GET['respuesta'], $_GET['tema'], $_GET['complejidad']);
			break;
		case "editarPregunta":
			//editarPreguntaXML($_GET['id_pregunta'], $_GET['pregunta'], $_GET['respuesta'], $_GET['tema'], $_GET['complejidad']);
			echo editarPregunta($_GET['ip'], $_GET['email'], $_GET['id_pregunta'], $_GET['pregunta'], $_GET['respuesta'], $_GET['tema'], $_GET['complejidad']);
			break;
	} 
	
	function insertarPregunta($dir_ip, $email, $pregunta, $respuesta, $tema, $complejidad){	
		include 'usuarios.php';
	
		insertarAccion($dir_ip, $email, 1);
		
		
		////////// VALIDAR FORMULARIO //////////
		if ((strlen($pregunta) >= 16) and 
			(strlen($respuesta) >= 2) and
			(strlen($tema) >= 3) and
			($complejidad >= 1 and $complejidad <= 5)) {
						
			////////// AÑADIR A LA BASE DE DATOS //////////			

			if (makeQuery("INSERT INTO pregunta (pregunta, respuesta, tema, complejidad, email) VALUES ('{$pregunta}','{$respuesta}','{$tema}','{$complejidad}','{$email}')"))
				return "true";
		}
		
		return "false";
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
		
		return "true";  
	}	
	
	function editarPregunta($dir_ip, $email, $id_pregunta, $pregunta, $respuesta, $tema, $complejidad) {
		include 'usuarios.php';
		
		insertarAccion($dir_ip, $email, 3);
	
			////////// VALIDAR FORMULARIO //////////
		if ((strlen($pregunta) >= 16) and 
			(strlen($respuesta) >= 2) and
			(strlen($tema) >= 3) and
			($complejidad >= 1 and $complejidad <= 5)) {
						
			////////// AÑADIR A LA BASE DE DATOS //////////			
						
			if (makeQuery("UPDATE pregunta
							SET pregunta = '{$pregunta}', respuesta = '{$respuesta}', tema = '{$tema}', complejidad = '{$complejidad}'  
							WHERE id='{$id_pregunta}'"))
				return "true";
		}
		
		return "false";
	}
	
	
?>