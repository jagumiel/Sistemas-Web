<?php
	include 'credenciales.php';
	include 'usuarios.php';
	
	session_start(); //Creamos una session
	$email = $_POST['email'];
	$dir_ip = get_client_ip();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Preguntas</title>
        <link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'/>
        <link href="estilos/personalizado.css" rel="stylesheet" type="text/css" />
        <link rel='stylesheet' 
       	type='text/css' 
       	media='only screen and (max-width: 480px)'
       	href='estilos/smartphone.css' />
        <style type="text/css">
        .wrapper .page div .right-column-content-heading div table tr td p {
	font-family: Verdana, Geneva, sans-serif;
}
        .wrapper .page div .right-column-content-heading div table tr td p {
	font-family: Verdana, Geneva, sans-serif;
}
        </style>
</head>
    <body>
        <div class="wrapper">
        	<div class="logo-menu-container">
            	<div class="logo">Quiz: el juego de las preguntas</div>
          	</div>
          	<div class="page">
          	  <div>
               	<div class="right-column-content-heading">
                  		<h1>&nbsp;</h1>
                        <h1>Lista de Preguntas</h1>
                        <h2>&nbsp; </h2>
                  <h2>&nbsp;</h2>
                  <div align="center">
            		<!--Aqui metemos el PHP para que se haga la conexion con la BD-->
                    <?php                   
                        // Crear la conexion
                        $conexion = new mysqli($servidor, $usuario_servidor, $password_servidor, $nombre_bd);
                        
                        // Comprobar la conexion
                        if ($conexion->connect_error) {
                            die("La conexion ha fallado: " . $conexion->connect_error);
                        }
						
                        //Aqui dibujamos la primera fila (row) de la tabla.
						echo "<table border=1>
                                <tr>
                                    <th>Pregunta</th>
                                    <th>Complejidad</th>
                                    <th>Tema</th>
                                    <th>Respuesta</th>
                                </tr>";
						
						$xml = simplexml_load_file("preguntas.xml");
							
                            // Escribimos el contenido del XML, rellenando las proximas filas.
						foreach ($xml->assessmentItem as $pregunta){
								if ($pregunta->getName()=='assessmentItem'){

									 echo "<tr><td>".$pregunta->itemBody->p."</td>
											<td>".$pregunta->attributes()->complexity."</td>
											<td>".$pregunta->attributes()->subject."</td>
											<td>".$pregunta->correctResponse->value."</td></tr>";
										

								}
							
						}
                        
                        $conexion->close();
						
						insertarAccion($dir_ip, 2);
                    ?>
                    <!--Fuente: http://www.w3schools.com/php/php_mysql_select.asp-->
				</div>
               	</div>
          	  </div>
          </div>
        </div>
        <div class="footer-wrapper">
          <p align="center" class="date"><a href="layout.html">Volver</a><a href="https://github.com"></a></p>
        </div>
</body>

</html>
