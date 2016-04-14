<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Registro de Preguntas</title>
        <link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'/>
        <link href="estilos/personalizado.css" rel="stylesheet" type="text/css" />
        <link rel='stylesheet' 
               type='text/css' 
               media='only screen and (min-width: 530px) and (min-device-width: 481px)'
               href='estilos/wide.css' />
        <link rel='stylesheet' 
               type='text/css' 
               media='only screen and (max-width: 480px)'
               href='estilos/smartphone.css' />
        
    	<style type="text/css">
            #s1 div table tr td {
            text-align: center;
            }
			#page-wrap div #h1 h2 {
				color: #000;
			}
		</style>
	</head>

    <body>
        <div id='page-wrap'>
			<header class='main' id='h1'> 
				<div align='center'>
				<?php
					if ($_GET['insert'] == 0) {		
						echo("<h2>¡Tu pregunta ha sido añadida!</h2>");			
					} else {		
						echo("<h2>Lo sentimos, no hemos podido añadir tu pregunta</h2>");	
					}
				?>
				</div>
			</header>     
	
			<section class='main' id='s1' style='width:100%; height:100%'>
				<div align='center'>
					<a href='insertarPregunta.html'>Pulsa aquí para añadir una nueva pregunta.</a>	<br/>
					<a href='verPreguntas.php'>Pulsa aquí para ver todas nuestras preguntas.</a>
				</div>
			</section>
		</div>
    	        			 
		<footer>
			<a href='layout.html'>Inicio</a>
		</footer>
            
    </body>
</html>