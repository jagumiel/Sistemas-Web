<?php
	include 'credenciales.php';
	include 'usuarios.php';
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
		<script>
			
			function checkPassword() {
				var pass = document.getElementById("registro").pass.value;
	
				if (pass.length < 6) {
					return false;
				}
				
				var pass = document.getElementById("registro").pass.value;
				var validPassword;
				
				xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function(){
					if (xmlhttp.readyState == 4){
						switch(xmlhttp.responseText) {
							case "VALIDA":
								validPassword = true;
								break;
							case "INVALIDA":
								alert("La contraseña que ha introducido no cumple los requisitos de seguridad necesarios. Por favor, elija otra.");
								validPassword = false;
								break;
							default:
								alert("Nuestro sistema de verificación de contraseñas no funciona correctamente. Perdone las molestias.");
								validPassword = false;
								break;			
						}
					 }
				}
				
				xmlhttp.open("GET", "comprobarContrasenaCall.php?pass=" + pass, true);
				xmlhttp.send();
				
				return validPassword;
			}
		
		</script>
		
	</head>
    <body>
        <div class="wrapper">
        	<div class="logo-menu-container">
            	<div class="logo">Quiz: el juego de las preguntas</div>
          	</div>
          	<div class="page">
            	<div class="left-column">
              		<div class="dark-panel">
                		<div class="dark-panel-center">
                            <?php echo notLogged(); ?>
                		</div>
                    	
                		<div class="dark-panel-bottom"></div>
              		</div>
                    <div class="dark-panel">
                    <div class="dark-panel-center">
                        <?php  echo menuNoRegistrado(); ?>
                    </div>
                	<div class="dark-panel-bottom"></div>
              	</div>
            </div>
            
            <div class="right-column">
				<div class="right-column-content">
                	<div class="right-column-content-heading">
                  		<h1>&nbsp;</h1>
                        <h1>Gestión de tus Preguntas</h1>
                        <h2>&nbsp; </h2>
                	</div>
					
                	<div class="right-column-content-content">
						<p>Introduzca correctamente su número de teléfono para que podamos comprobar que, efectivamente, es usted quien está registrado en ésta, nuestra aplicación.</p>
                  		<form id="cambiarContrasenaForm" onSubmit="return checkPassword()" action="cambiarContrasena.php" method = "post"> <!--OJO, NO ESTAMOS HACIENDO LAS COMPROBACIONES DE VALIDACIÓN-->
							Email (*)<br/>
							<input type="text" name="email">
							<br/><br/>

							Teléfono (*)<br/>
								<input type="text" name="telefono">
							<br/><br/>

							Nueva Password (*)<br/>
								<input type="password" name="nuevaPassword">
							<br/><br/>
							
							<input type="submit" value="Cambiar contraseña" name="insertarPreguntaButton"></input><br/>
						</form>
					</div>
					<br/><br/>					
              	</div>
			</div>
          </div>
        </div>
        <div class="footer-wrapper">
            <p align="center" class="date"><a href="http://es.wikipedia.org/wiki/Quiz">¿Qué es un Quiz?</a></p>
            <p align="center" class="date"><a href="https://github.com">Link Github</a></p>
        </div>
    </body>

</html>