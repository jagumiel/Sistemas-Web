<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!--La cabecera almacena información que no tiene por qué ser mostrada.-->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Subida de archivos</title>
        <style type="text/css"></style>
    </head>

    <body>
        <div>
            <ul class="contenedor">
                <div>
                    <?php
                    $target_dir = "uploads/";
                    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                    // Comprueba si es una imagen
                    if(isset($_POST["submit"])) {
                        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                        if($check !== false) {
                            echo "El archivo es una imagen - " . $check["mime"] . ".";
                            $uploadOk = 1;
                        } else {
                            echo "El archivo no es una imagen.";
                            $uploadOk = 0;
                        }
                    }
                    // Comprueba si existe el archivo
                    if (file_exists($target_file)) {
                        echo "El archivo ya existe.";
                        $uploadOk = 0;
                    }
                    // Comprueba el tamanio
                    if ($_FILES["fileToUpload"]["size"] > 500000000) {
                        echo "El tamaño del archivo es demasiado grande.";
                        $uploadOk = 0;
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
                    // Si todas las comprobaciones son correctas, se sube el archivo
                    } else {
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                            echo "El archivo ". basename( $_FILES["fileToUpload"]["name"]). " ha sido subido.";
                        } else {
                            echo "Lo siento, hubo un problema con la subida del archivo.";
                        }
                    }
                    ?> 
                    <p><a href="./layout.html" class="links">Volver atrás.</a></p>
                    <p><a href="./uploads" class="links">Ver subidas. (Solo funciona en hosting).</a></p>
        
                </div>
            </ul>
        </div>
        
    </body>

</html> 