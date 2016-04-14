<?php
	include 'credenciales.php';
	session_start(); //Creamos una session


	function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

	$pregunta = $_POST['pregunta'];
	$respuesta = $_POST['respuesta'];
	$complejidad = $_POST['complejidad'];
	$email = $_SESSION["email"]; //puedo obtener asi el valor de la sesion?
	$dir_ip=get_client_ip();
	
	////////// VALIDAR FORMULARIO //////////
	if ((strlen($pregunta) >= 16) and 
		(strlen($respuesta) >= 2) and
		($complejidad >= 1 and $complejidad <= 5)) {
					
		////////// AÑADIR A LA BASE DE DATOS //////////			
		// Crear la conexion
		$conexion = new mysqli($servidor, $usuario_servidor, $password_servidor, $nombre_bd);
		
		// Comprobar la conexion
		if ($conexion->connect_error) {
			die("La conexion ha fallado: " . $conexion->connect_error);
		}
			
		$sql = "INSERT INTO ".$nombre_bd.".pregunta (id, pregunta, respuesta, complejidad, email)
		VALUES (DEFAULT, '{$pregunta}','{$respuesta}','{$complejidad}','{$email}')";
		
		$sql_accion = "INSERT INTO ".$nombre_bd.".acciones (id_accion, id_conexion, email, tipo, hora, ip)
		VALUES (DEFAULT, DEFAULT ,'{$email}', '1', DEFAULT, '{$dir_ip}')";
		//Vamos a suponer tipo=1 para insertar y tipo=2 para ver, ya que en nuestra tabla es un int.
		
		if ($conexion->query($sql_accion) === TRUE) {
			echo "La accion realizada se ha agregado a la base de datos correctamente.";
		} else {
			echo "Error: " . $sql_accion . "<br>" . $conexion->error;
		}
		//Las preguntas solo las pueden añadir los usuarios registrados, siempre hay un email.
			
		if ($conexion->query($sql) === TRUE) {
			echo "La pregunta se ha agregado a la base de datos correctamente.";
		} else {
			echo "Error: " . $sql . "<br>" . $conexion->error;
		}
		
		$conexion->close();
		header('Location: red_pregunta.php?insert=0');

	} else {
		header('Location: red_pregunta.php?insert=1');
		//echo "Error: El formulario no ha sido rellenado correctamente.";
	}
	/////////////


?> 
