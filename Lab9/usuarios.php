<?php

	header('Content-Type: text/html; charset=ISO-8859-1'); 
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

	function registrarUsuario($email, $nombre, $apellido1, $apellido2, $password, $telefono, $especialidad, $intereses, $dirFoto) {
	
		$hashedPassword = hash("sha256", $password, false);

		$registro = makeQuery("INSERT INTO ".$nombre_bd.".usuario (Email, Nombre, Apellido1, Apellido2, Password, Teléfono, Especialidad, Intereses, Foto)
							   VALUES ('{$email}','{$nombre}', '{$apellido1}', '{$apellido2}', '{$hashedPassword}', 
									   '{$telefono}', '{$especialidad}', '{$intereses}', '{$dirFoto}')");
			
		return $registro;
	}
	
	function login($email, $password) {
		$intentos = 0;
		if (isset($_COOKIE['intentos'])){ 
			$intentos = $_COOKIE['intentos'];
		}
				
		if ($intentos <= 3){
			$hashedPassword = hash("sha256", $password, false);
							
			if(comprobarUsuarioPassword($email,  $hashedPassword))
			{
				insertarConnection($email); 
				$_SESSION["email"] = $email;
				
				$rol = makeQuery("SELECT Rol FROM usuario WHERE email='{$email}'");
				$_SESSION['rol'] = $rol;
				
				setcookie( 'intentos', 0, time() + 1800 ); //30 minutos
				
				return '0';	// Loggeado.
			} else if ($intentos < 3) {
				setcookie( 'intentos', $intentos + 1, time() + 1800 ); //30 minutos
				
				return '1'; // Loggin failed.
			}
		} 
		
		setcookie( 'intentos', 0, time() + 1800);
		return '2';	// Superado el límite de intentos.
	
	}
	
	function changePassword($email, $telefono, $nuevaPassword) {	
		$hashedPassword = hash("sha256", $password, false);		
		return makeQuery("UPDATE usuario SET Password='{$hashedPassword}' WHERE Email='{$email}' AND Teléfono='{$telefono}'");
	}
	
	function comprobarUsuarioPassword($email, $password) {		
		$truePassword = mysqli_fetch_array(makeQuery("SELECT Password FROM usuario WHERE Email = '{$email}'"));
		
		if (strcmp($truePassword[0], $password) == 0)
			return true;
		
		return false;
	}
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	function insertarAccion($dir_ip, $email, $code) { // Tipo 1: Insertar - Tipo 2: Ver - Tipo 3: Editar			
		return makeQuery("INSERT INTO acciones (id_accion, id_conexion, email, tipo, hora, ip)
				VALUES (DEFAULT, DEFAULT ,'{$email}', '{$code}', DEFAULT, '{$dir_ip}')");	
	}

	function insertarConnection($email) { 
		return makeQuery("INSERT INTO conexion (email) VALUES ('{$email}')");
	}
	
	function getAllPreguntas($email) {
		insertarAccion($dir_ip, $email, 2);
																				
		// HACER CONSULTA
		$result = makeQuery("SELECT * FROM pregunta");     	
		$num_rows = $result->num_rows;
		
		$s = "";
		
		if ($num_rows > 0) {
			//Aquí dibujamos la primera fila (row) de la tabla.
			
			echo "<table id='preguntasTable'><tr><td>";
			// Con este while pretendemos escribir el contenido de la base de datos, rellenar las proximas filas.
			while($row = $result->fetch_assoc()) {
				$s = $s."<table id='".$row["id"]."_table' border=0px width='100%'>
							<tr>
								<th width='38%'>Pregunta</th>
								<th width='38%'>Respuesta</th>
								<th width='14%'>Tema</th>
								<th width='5%'>Complejidad</th>
								<th width='5%'>Autor</th>
								<th width='5%'></th>
							</tr>
							<tr>
								<td><input id='".$row["id"]."_pregunta' type='text' disabled value='".$row["pregunta"]."'/></td>
								<td><input id='".$row["id"]."_respuesta' type='text' disabled value='".$row["respuesta"]."'/></td>
								<td><input id='".$row["id"]."_tema' type='text' disabled value='".$row["tema"]."'/></td>
								<td><input id='".$row["id"]."_complejidad' type='text' disabled value='".$row["complejidad"]."'/></td>
								<td><input id='".$row["id"]."_autor' type='text' disabled value='".$row["email"]."'/></td>
								<td><input id='".$row["id"]."_button' type='button' id='".$row["id"]."_button' value='Editar' onClick='seleccionarPregunta(".$row['id'].")'/></td>												
							</tr>
						</table>
						<div id='".$row["id"]."_div'></div>
						<br/><br/>";
			}
			$s = $s."</td></tr></table>";
		} else {
			$s = "Todavía no has insertado ninguna pregunta. ¡No pasa nada! Puedes hacerlo aquí mismo.";
		}
		return $s;
	}
	
	function getUserPreguntas($email) {
		insertarAccion($dir_ip, $email, 2);
																				
		// HACER CONSULTA
		$result = makeQuery("SELECT * FROM pregunta WHERE pregunta.email='{$email}'");     	
		$num_rows = $result->num_rows;
		
		$s = "";
		
		if ($num_rows > 0) {
			//Aquí dibujamos la primera fila (row) de la tabla.
			
			echo "<table id='preguntasTable'><tr><td>";
			// Con este while pretendemos escribir el contenido de la base de datos, rellenar las proximas filas.
			while($row = $result->fetch_assoc()) {
				$s = $s."<table id='".$row["id"]."_table' border=0px width='100%'>
							<tr>
								<th width='38%'>Pregunta</th>
								<th width='38%'>Respuesta</th>
								<th width='14%'>Tema</th>
								<th width='5%'>Complejidad</th>
								<th width='5%'></th>
							</tr>
							<tr>
								<td><input id='".$row["id"]."_pregunta' type='text' disabled value='".$row["pregunta"]."'/></td>
								<td><input id='".$row["id"]."_respuesta' type='text' disabled value='".$row["respuesta"]."'/></td>
								<td><input id='".$row["id"]."_tema' type='text' disabled value='".$row["tema"]."'/></td>
								<td><input id='".$row["id"]."_complejidad' type='text' disabled value='".$row["complejidad"]."'/></td>
								<td><input id='".$row["id"]."_button' type='button' id='".$row["id"]."_button' value='Editar' onClick='seleccionarPregunta(".$row['id'].")'/></td>												
							</tr>
						</table>
						<div id='".$row["id"]."_div'></div>
						<br/><br/>";
			}
			$s = $s."</td></tr></table>";
		} else {
			$s = "Todavía no has insertado ninguna pregunta. ¡No pasa nada! Puedes hacerlo aquí mismo.";
		}
		return $s;
	}
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
	function makeQuery($sql) {
		include 'credenciales.php';
									
		$conexion = new mysqli($servidor, $usuario_servidor, $password_servidor, $nombre_bd);	// Crear la conexion
		if ($conexion->connect_error) {		// Comprobar la conexion
			return false;
		}
		$query = $conexion->query($sql);
		$conexion->close();
		return $query;
	}
	
	function notLogged() {							
        return '<p>Hola, usuario anónimo</p>
		<form action="login.php" method="post" name="login">
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
        </form>
		<p><a href="cambiarContrasena_form.php">¿Ha olvidado la contraseña?</a></p>
		<p>¿Aún no tienes una cuenta? <a href="registro.html">Regístrate</a>.</p>';
	}
	
	function menuNoRegistrado(){
		return '<ul>
					<li>
						<h1>Menú</h1>
					</li>
					<li class="date"><a href="layout.php">Inicio</a></li>
					<li class="date"><a href="quiz.php">¡Comenzar Quiz!</a></li>
					<li class="date"><a href="creditos.html">Créditos</a></li>
				</ul>';
	}
	
	function menuRegistrado(){
		return '<ul>
					<li>
						<h1>Menú</h1>
					</li>
					<li class="date"><a href="layout.php">Inicio</a></li>
					<li class="date"><a href="verUsuarios.php">Ver Usuarios</a></li>
					
					<li class="date"><a href="verPreguntas.php">Ver Preguntas</a></li>
					<li class="date"><a href="verPreguntasXML.php">Ver Preguntas (del XML)</a></li>
					
					<li class="date"><a href="insertarPregunta_form.php">Insertar Pregunta</a></li>
					<li class="date"><a href="gestionPreguntas.php">Gestionar Preguntas</a></li>
					
					<li class="date"><a href="quiz.php">¡Comenzar Quiz!</a></li>
					
					<li class="date"><a href="creditos.html">Créditos</a></li>
				</ul>
				<br/>
				<a href="logout.php">Log out</a>';
	}
		
	function menuProfe(){
		return '<ul>
					<li>
						<h1>Menú</h1>
					</li>
					<li class="date"><a href="layout.php">Inicio</a></li>
					<li class="date"><a href="verUsuarios.php">Ver Usuarios</a></li>
					<li class="date"><a href="obtenerDatos.php">Obtener Datos de un Usuario</a></li>
					
					<li class="date"><a href="verPreguntas.php">Ver Preguntas</a></li>
					<li class="date"><a href="verPreguntasXML.php">Ver Preguntas (del XML)</a></li>
					
					<li class="date"><a href="insertarPregunta_form.php">Insertar Pregunta</a></li>
					<li class="date"><a href="gestionPreguntas.php">Gestionar Preguntas</a></li>
					<li class="date"><a href="revisarPreguntas.php">Revisar Preguntas Propuestas</a></li>
					
					<li class="date"><a href="quiz.php">¡Comenzar Quiz!</a></li>
					
					<li class="date"><a href="creditos.html">Créditos</a></li>
				</ul>
				<br/>
				<a href="logout.php">Log out</a>';
	}

?>