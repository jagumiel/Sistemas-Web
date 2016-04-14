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
			function checkEmail(){
				var email = document.getElementById("registro").email.value; 
				
				if (! /^[a-zA-Z]+\d{3}@ikasle\.ehu\.(es|eus)$/.test(email) ) {	
					alert("El e-mail no es válido.\n");
					return false;
				}
				return true;
			}
			
			function loadXMLDoc() {
				var xmlhttp = new XMLHttpRequest();
			  	xmlhttp.onreadystatechange = function(){
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
						myFunction(xmlhttp);
					}
			  	}
			  	xmlhttp.open("GET", "usuarios.xml", true);
			  	xmlhttp.send();
			}
			
			function myFunction(xml) {
				var i;
			  	var xmlDoc = xml.responseXML;
			 	var table="<tr><th>Nombre</th><th>Apellido 1</th><th>Apellido 2</th><th>Teléfono</th></tr>";
			  	var x = xmlDoc.getElementsByTagName("usuario");
				var miUsuario = document.getElementById('email').value
			  	for (i = 0; i <x.length; i++) {
					if(miUsuario==x[i].getElementsByTagName("email")[0].childNodes[0].nodeValue){
						table += "<tr><td>" +
						x[i].getElementsByTagName("nombre")[0].childNodes[0].nodeValue +
						"</td><td>" +
						x[i].getElementsByTagName("apellido1")[0].childNodes[0].nodeValue +
						"</td><td>"+
						x[i].getElementsByTagName("apellido2")[0].childNodes[0].nodeValue +
						"</td><td>"+
						x[i].getElementsByTagName("telefono")[0].childNodes[0].nodeValue +
						"</td></tr>";
					}
			  	}
			  	document.getElementById("demo").innerHTML = table;
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
                            <?php
                                if (empty($email)) {
                                    echo notLogged();
                                }
                                
                            ?>
                		</div>
                    	
                		<div class="dark-panel-bottom"></div>
              		</div>
                    <div class="dark-panel">
                    <div class="dark-panel-center">
                        <?php
								$profe = 'web000@ehu.es';
                                if (!empty($email)) {
									if (strcmp($email, $profe) === 0){
										echo menuProfe();
									}else{
                                    	echo menuRegistrado();
									}
                                } else {
                                    echo menuNoRegistrado();
                                }
                        ?>
                    </div>
                	<div class="dark-panel-bottom"></div>
              	</div>
            </div>
            
            <div class="right-column">
				<div class="right-column-content">
                	<div class="right-column-content-heading">
                  		<h1>&nbsp;</h1>
                        <h1>Obtener datos</h1>
                        <h2>&nbsp; </h2>
                        <h2>Introduzca una dirección de correo electrónico para visualizar los datos del usuario.</h2>
                	</div>
                	<div class="right-column-content-content">

						Dirección de correo (*)<br/>
						<input type="text" id="email" name="email" onBlur = "checkEmail()">
						<br/><br/>
                        
                        <button type="button" onclick="loadXMLDoc()">Obtener datos</button>
                        <br><br>
						<table id="demo"></table>

					</div>
              	</div>
			</div>
          </div>
        </div>
        <div class="footer-wrapper">
            <p align="center" class="date"><a href="layout.php">Volver</a><a href="https://github.com"></a></p>
        </div>
    </body>

</html>
