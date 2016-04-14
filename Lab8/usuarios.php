<?php
	include 'credenciales.php';

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

	function registrarUsuario($nombre, $apellido1, $apellido2, $email, $pass, $tlf, $especialidad, $foto) {
		//
	}
	
	function login($email, $password) {
		if(comprobarUsuario($email,  $password))
		{
			insertarConnection($email);
			$_SESSION["email"] = $email;
			header("location:insertarPregunta.html");
		}
		else
		{
			header("location:layout.php"); 
		}	
	}
	
	function logout() {
		session_destroy(); 
		header('location: layout.php');
	}
	
	function comprobarUsuarioPassword($email, $password) {
		$conexion = new mysqli($servidor, $usuario_servidor, $password_servidor, $nombre_bd);// Crear la conexion

		if ($conexion->connect_error) {	// Comprobar la conexion
			return false;
		}

		/*Condición: Si el usuario y la contraseña se corresponden, se acepta. Probablemente inseguro*/
		$sql = "SELECT Password FROM usuario WHERE Email = '" . $_POST['email'] . "' and Password = '" . $_POST['password'] . "'";	
		$rec = $conexion->query($sql);
	
		return ($rec->num_rows == 1);
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	function insertarAccion($dir_ip, $email, $code) { // Tipo 1: Insertar - Tipo 2: Ver - Tipo 3: Editar			
		$conexion = new mysqli($servidor, $usuario_servidor, $password_servidor, $nombre_bd);	// Crear la conexion
		
		if ($conexion->connect_error) {		// Comprobar la conexion
			return false;
		}
		
		$sql_accion = "INSERT INTO ".$nombre_bd.".acciones (id_accion, id_conexion, email, tipo, hora, ip)
		VALUES (DEFAULT, DEFAULT ,'{$email}', '{$code}', DEFAULT, '{$dir_ip}')";
		
		return ($conexion->query($sql_accion));	
	}

	function insertarConnection($email) { // Tipo 1: Insertar - Tipo 2: Ver - Tipo 3: Editar			
		$conexion = new mysqli($servidor, $usuario_servidor, $password_servidor, $nombre_bd);	// Crear la conexion
		
		if ($conexion->connect_error) {		// Comprobar la conexion
			return false;
		}
			
		$sql = "INSERT INTO u837753965_quiz.conexion (id, email, hora)
			     VALUES (DEFAULT, '{$email}', DEFAULT)";
		
		return ($conexion->query($sql));	
	}
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	function notLogged() {							
        return '<form action="login.php" method="post" name="login">
            <h1>Login</h1>
            <ul>
                <li class="username">
                    <input name = "email" type = "text" class = "login-input" />
                </li>
                <li class="password">
                    <input name = "password" type = "password" class = "login-input" />
                </li>
            </ul>
            <input type = "submit" value = "Entrar" name = "Entrar"/>
        </form>';
	}
?>