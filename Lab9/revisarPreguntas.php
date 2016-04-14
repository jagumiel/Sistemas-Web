<?php
	include 'credenciales.php';
	include 'usuarios.php';
	
	session_start(); //Creamos una session
	
	$dir_ip = get_client_ip();
	$email = $_SESSION['email'];
	if (empty($email))
		header('location: layout.php');
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
			var xmlhttp = new XMLHttpRequest();
		    var email= "<?php echo $email; ?>";
		    var dir_ip= "<?php echo $dir_ip; ?>";

			function seleccionarPregunta( id_pregunta ) {
				document.getElementById(id_pregunta + "_pregunta").disabled = false;
				document.getElementById(id_pregunta + "_respuesta").disabled = false;
				document.getElementById(id_pregunta + "_tema").disabled = false;
				document.getElementById(id_pregunta + "_complejidad").disabled = false;
				
				document.getElementById(id_pregunta + "_button").value = "Enviar";
				document.getElementById(id_pregunta + "_button").setAttribute("onClick", "editarPregunta("+id_pregunta+");");
			}

			function editarPregunta( id_pregunta ) {						
				var pregunta = document.getElementById(id_pregunta + "_pregunta").value; 
				var respuesta = document.getElementById(id_pregunta + "_respuesta").value; 
				var tema = document.getElementById(id_pregunta + "_tema").value; 
				var complejidad = document.getElementById(id_pregunta + "_complejidad").value;
							
				if (window.XMLHttpRequest) {
					// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp = new XMLHttpRequest();
				} else {
					// code for IE6, IE5
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}
									
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						if (xmlhttp.responseText != "false") {
							document.getElementById(id_pregunta + "_pregunta").disabled = true;
							document.getElementById(id_pregunta + "_respuesta").disabled = true;
							document.getElementById(id_pregunta + "_tema").disabled = true;
							document.getElementById(id_pregunta + "_complejidad").disabled = true;
							
							document.getElementById(id_pregunta + "_button").value = "Editar";
							document.getElementById(id_pregunta + "_button").setAttribute("onClick", "seleccionarPregunta(" + id_pregunta + ");");
						} else {
							alert("Su pregunta no ha podido ser editada. Compruebe que ha rellenado los campos correctamente.");
						}
						
					}
				}
				
				xmlhttp.open("GET","preguntas.php?funcion=editarPregunta&ip=" + dir_ip + "&email=" + email + 
													"&id_pregunta=" + id_pregunta +
													"&pregunta=" + pregunta + "&respuesta=" + respuesta + 
													"&tema=" + tema + "&complejidad=" + complejidad, true);
				
				xmlhttp.send();					
			}
			
			function insertarPregunta() {		
				//Permite al usuario introducir una pregunta sin salir de la página actual.
				var form = document.getElementById("insertarPreguntaForm");
				var pregunta = form.pregunta.value;
				var respuesta = form.respuesta.value;
				var tema = form.tema.value;
				var complejidad = form.complejidad.value;
				
				// AJAX - Añadir pregunta
				
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState==4 && xmlhttp.status==200){
						if (xmlhttp.responseText != "false") {
							document.getElementById("insertarPreguntaForm").pregunta.value = "";
							document.getElementById("insertarPreguntaForm").respuesta.value = "";
							document.getElementById("insertarPreguntaForm").tema.value = "";
							document.getElementById("insertarPreguntaForm").complejidad.value = 1;
					/*		
							var tableRef = document.getElementById('preguntasTable');

							// Insert a row in the table at the last row
							var newRow   = tableRef.insertRow(tableRef.rows.length);

							// Insert a cell in the row at index 0
							var cellPregunta  = newRow.insertCell(0);							
							var cellRespuesta  = newRow.insertCell(1);
							var cellTema  = newRow.insertCell(2);
							var cellComplejidad  = newRow.insertCell(3);
							var cellButton  = newRow.insertCell(4);

							// Append a text node to the cell
							newCell.appendChild(newText);
							
					*/		
							
						} else { 
							alert("Su pregunta no ha podido ser procesada. Compruebe que ha rellenado los campos correctamente.");
						}
					}
				}
												
				xmlhttp.open("GET","preguntas.php?funcion=insertarPregunta&ip=" + dir_ip + "&email="  + email + 
													"&pregunta=" + pregunta + "&respuesta=" + respuesta + 
													"&tema=" + tema + "&complejidad=" + complejidad, true);
				xmlhttp.send();
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
                        <h1>Revisar Preguntas Propuestas</h1>
                        <h2>&nbsp; </h2>
                	</div>
					
                	<div class="right-column-content-content">
                  		<form id="insertarPreguntaForm"> <!--OJO, NO ESTAMOS HACIENDO LAS COMPROBACIONES DE VALIDACIÓN-->
							Pregunta (*)<br/>
							<input type="text" name="pregunta">
							<br/><br/>

							Respuesta (*)<br/>
								<input type="text" name="respuesta">
							<br/><br/>

							Tema (*)<br/>
								<input type="text" name="tema">
							<br/><br/>

							Complejidad (*)<br/>
							<input type="range" name="complejidad" min="1" max="5" value="1" oninput="document.getElementById('valor').textContent=value">
							<output id="valor">1</output>
							<br/><br/>
							<?php
								echo '<input type="button" value="Enviar pregunta" name="insertarPreguntaButton" onClick = insertarPregunta()></input><br/>';
							?>
						</form>
					</div>
					
					<br/><br/>
					
					<?php
					
						if (strcmp($_SESSION['rol'], "Prof")) {
							echo getAllPreguntas($email);
						} else {
							header('location: layout.php');			
						} 
					?>
					
					
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