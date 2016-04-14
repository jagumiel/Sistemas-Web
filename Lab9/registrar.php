<?php
	include 'usuarios.php';
	
	////////// VALIDAR FORMULARIO //////////
	if ((preg_match("/^[a-zA-Z]+[ |a-zA-Z]*$/", $_POST['nombre'])) and 
		(preg_match("/^[a-zA-Z]+[ |a-zA-Z]*$/", $_POST['apellido1'])) and
		(preg_match("/^[a-zA-Z]+[ |a-zA-Z]*$/", $_POST['apellido2'])) and
		(preg_match("/^[a-zA-Z]+\d{3}@ikasle\.ehu\.(es|eus)$/", $_POST['email'])) and
		(strlen($_POST['pass']) >= 6) and
		(preg_match("/^\d{9}$/", $_POST['telefono'])) and
		(strlen($_POST['especialidad']) >= 5)) {
			
		// FOTO						

		$target_dir = "uploads/";
			
			$target_file = $target_dir . $_POST['email'] . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			// Comprueba si es una imagen
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check != false) {
					echo "El archivo es una imagen - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					echo "El archivo no es una imagen.";
					$uploadOk = 0;
				}
			}
			
			// Comprueba el tamanio
			if ($_FILES["fileToUpload"]["size"] > 500000000) {
				echo "El tamaño del archivo es demasiado grande.";
				$uploadOk = 0;
			}elseif ($_FILES["fileToUpload"]["size"] == 0){//Es una comprobacion, si no hay foto, ponemos una por defecto.
				$target_file = "imgs_web/user.png";
			}
			
			// Restriccion de formatos
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				echo "Solo se permiten los formatos JPG, JPEG, PNG & GIF.";
				$uploadOk = 0;
			}
			
			// Prueba se $uploadOk es 0 o si ha ocurrido un error
			if ($uploadOk == 0) {
				echo "El archivo no se ha subido.";
							   
			} else {	// Si todas las comprobaciones son correctas, se sube el archivo
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					echo "El archivo ". basename( $_FILES["fileToUpload"]["name"]). " ha sido subido.";
				} else {
					echo "Lo siento, hubo un problema con la subida del archivo.";
				}
			}
			
		registrarUsuario($_POST['email'], $_POST['nombre'], $_POST['apellido1'], $_POST['apellido2'], $_POST['pass'], 
						 $_POST['telefono'], $_POST['especialidad'], $_POST['intereses'], $target_file);
		
		header('Location: red_registro.php?insert=0');

	} else {
		header('Location: red_registro.php?insert=1');
	}
	
?> 
