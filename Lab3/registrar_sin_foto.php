<?php
	$servidor 	= "mysql.hostinger.es";
	$usuario 	= "u837753965_root"; 	//Nombre de usuario para acceder a la BD.
	$password 	= "soyelroot"; 			//Password de la BD en Hostinger
	$nombre_bd 	= "u837753965_quiz";	//Nuestra base de datos se llama "quiz".
	
	// Crear la conexion
	$conexion = new mysqli($servidor, $usuario, $password, $nombre_bd);
	
	// Comprobar la conexion
	if ($conexion->connect_error) {
		die("La conexion ha fallado: " . $conexion->connect_error);
	}
	
	$sql = "INSERT INTO u837753965_quiz.usuario (Email, Nombre, Apellido1, Apellido2, Password, Teléfono, Especialidad, Intereses, Foto)
	VALUES ('{$_POST['email']}','{$_POST['nombre']}', '{$_POST['apellido1']}', '{$_POST['apellido2']}', '{$_POST['pass']}', '{$_POST['telefono']}', '{$_POST['especialidad']}', '{$_POST['intereses']}', null)";


//INSERT INTO `u837753965_quiz`.`usuario` (`Email`, `Nombre`, `Apellido1`, `Apellido2`, `Password`, `Teléfono`, `Especialidad`, `Intereses`, `Foto`) VALUES ('nuevouser001 2ikasle.ehu.es', 'Nuevo', 'Test', 'Prubas', '123456', '123456789', 'Software', NULL, 
	//VALUES (email, nombre, apellido1, apellido2, pass, telefono, especialidad, intereses, fileToUpload)";
	
	if ($conexion->query($sql) === TRUE) {
		echo "El nuevo registro se ha agregado a la base de datos correctamente.";
	} else {
		echo "Error: " . $sql . "<br>" . $conexion->error;
	}
	
	$conexion->close();
?>

<a href="VerUsuarios.php">Ver todos los datos de la tabla</a>
<!--Nota: Si meto esto en HTML podré meter estilo o algo más vistoso.-->
<!--Fuente:http://www.w3schools.com/php/php_mysql_insert.asp-->