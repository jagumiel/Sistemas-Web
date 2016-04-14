<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Usuarios Registrados</title>
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
			<header class='main' id='h1'> <!--Encabezado-->
				<div align="center">
					<?php
					if ($_GET['insert'] == 0) {		
						echo("<h2>¡Te has registrado correctamente!</h2>");			
					} else {		
						echo("<h2>Lo sentimos, no hemos podido registrarte en nuestra base datos</h2>");	
					}
					?>
				</div>
			</header> <!--Fin encabezado-->      
    
			<section class="main" id="s1" style="width:100%; height:100%">
				<div align="center">
					<?php
						if ($_GET['insert'] == 0) {		
							echo("<a href='layout.html'>Pulsa aquí para volver a la página principal.</a>	<br/>");			
						} else {	
							echo("<a href='javascript:window.history.back()'>Pulsa aquí para volver a la página de registro.</a>	<br/>");		
						}
					?>
					<a href='verUsuarios.php'>Pulsa aquí para ver quién más se ha registrado con nosotros.</a>
				</div>
			</section>
                     
			<!--<footer>
				<a href='layout.html'>Inicio</a>
			</footer>-->
		</div>            
            
    </body>
</html>