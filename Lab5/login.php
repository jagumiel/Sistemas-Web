<?php
	session_start(); //Creamos una session
	include "credenciales.php"; //Con esto podemos tener nuestros datos de la BD en un archivo separado.
	// Crear la conexion
	$conexion = new mysqli($servidor, $usuario_servidor, $password_servidor, $nombre_bd);
	
	// Comprobar la conexion
	if ($conexion->connect_error) {
		die("La conexion ha fallado: " . $conexion->connect_error);
	}

	/*Condición: Si el usuario y la contraseña se corresponden, se acepta. Probablemente inseguro*/
	$sql = "SELECT Password FROM usuario WHERE Email = '" . $_POST['email'] . "' and Password = '" . $_POST['password'] . "'";	
	$rec = $conexion->query($sql);
	$count = 0;
	while($row = mysqli_fetch_object($rec))
	{
		$count++;
		$result = $row;
	}

	//Aqui metemos el comando para anadir los datos a la tabla de conexion:
	$sql = "INSERT INTO u837753965_quiz.conexion (id, email, hora)
	VALUES (DEFAULT, '{$_POST['email']}', DEFAULT)";
	//Los DEFAULT sirven para que sea la base de datos la que meta el valor. En este caso AI y TIMESTAMP.
	$conexion->query($sql);


	if($count == 1) //Si el boton fue presionado llamamos a la función verificar_login() dentro de otra condición preguntando si resulta verdadero y le pasamos los valores ingresados como parámetros.
	{
		/*Si el login fue correcto, registramos la variable de sesión y al mismo tiempo refrescamos la pagina index.php.*/
		$_SESSION["email"] = $_POST['email'];
		header("location:insertarPregunta.html");
	}
	else
	{
		echo '<div class="error">Su usuario es incorrecto, intente nuevamente.</div>'; //Si la función verificar_login() no pasa, que se muestre un mensaje de error.
	}

?>