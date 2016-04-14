<?php
	$servidor = "localhost";
	$usuario = "root"; 		//Nombre de usuario para acceder a la BD. Root?
	$password = ""; 	//Password es root?
	$nombre_bd = "quiz";	//Nuestra base de datos se llama "quiz".
	
	// Crear la conexion
	$conexion = new mysqli($servidor, $usuario, $password, $nombre_bd);
	
	// Comprobar la conexion
	if ($conexion->connect_error) {
		die("La conexion ha fallado: " . $conexion->connect_error);
	}
	
	$sql = "INSERT INTO usuario (Email, Nombre, Apellido1, Apellido2, Password, Teléfono, Especialidad, Intereses, Foto)
	VALUES ('{$_POST['email']}','{$_POST['nombre']}', '{$_POST['apellido1']}', '{$_POST['apellido2']}', '{$_POST['pass']}', '{$_POST['telefono']}', '{$_POST['especialidad']}', '{$_POST['intereses']}', null)";

	//VALUES (email, nombre, apellido1, apellido2, pass, telefono, especialidad, intereses, fileToUpload)";
	
	if ($conexion->query($sql) === TRUE) {
		echo "El nuevo registro se ha agregado a la base de datos correctamente.";
	} else {
		echo "Error: " . $sql . "<br>" . $conexion->error;
	}
	
	$conexion->close();
?>

<a href="VerUsuariosConFoto.php">Ver todos los datos de la tabla</a>
<!--Nota: Si meto esto en HTML podré meter estilo o algo más vistoso.-->
<!--Fuente:http://www.w3schools.com/php/php_mysql_insert.asp-->