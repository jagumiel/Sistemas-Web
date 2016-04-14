<?php
	include 'credenciales.php';
	include 'usuarios.php';
	
	session_start(); //Creamos una session
	
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
    
		<script>
			var xmlhttp = new XMLHttpRequest();

			function seleccionarPregunta( email, dir_ip, id_pregunta ) {
				alert("Seleccionada");
				document.getElementById(id_pregunta + "_pregunta").disabled = false;
				document.getElementById(id_pregunta + "_respuesta").disabled = false;
				document.getElementById(id_pregunta + "_tema").disabled = false;
				document.getElementById(id_pregunta + "_complejidad").disabled = false;
				
				document.getElementById(id_pregunta + "_button").value = "Enviar";
				document.getElementById(id_pregunta + "_button").setAttribute("onClick", "editarPregunta("+email+","+dir_ip+","+id_pregunta+");");
			}

			function editarPregunta( email, dir_ip, id_pregunta ) {						
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
						document.getElementById(id_pregunta + "_pregunta").disabled = true;
						document.getElementById(id_pregunta + "_respuesta").disabled = true;
						document.getElementById(id_pregunta + "_tema").disabled = true;
						document.getElementById(id_pregunta + "_complejidad").disabled = true;
						
						document.getElementById(id_pregunta + "_button").value = "&#9998";
						document.getElementById(id_pregunta + "_button").setAttribute("onClick", "seleccionarPregunta("+email+","+dir_ip+","+id_pregunta+");");
						
					}
				}
				//FALLA!!!!!!!!
				xmlhttp.open("GET","preguntas.php?funcion=editarPregunta&ip=" + dir_ip + "&email=" + email + 
													"&id_pregunta=" + id_pregunta +
													"&pregunta=" + pregunta + "&respuesta=" + respuesta + 
													"&tema=" + tema + "&complejidad=" + complejidad, true);
				
				alert("Editando");	
				xmlhttp.send();					
			}
			
			function insertarPregunta( email, dir_ip ) {							
				//Permite al usuario introducir una pregunta sin salir de la página actual.
				var form = document.getElementById("insertarPreguntaForm");
				var pregunta = form.pregunta;
				var respuesta = form.respuesta;
				var tema = form.tema;
				var complejidad = form.complejidad;
				
				// AJAX - Añadir pregunta
				
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState==4 && xmlhttp.status==200){
						if (xmlhttp.responseText == "true") {
							// Pregunta introducida
						} else {
							//
						}
						xmlhttp.responseText;
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
                        <ul>
                            <li>
                                <h1>Menú</h1>
                            </li>
                            <li class="date"><a href="layout.html">Inicio</a></li>
                            <li class="date"><a href="quizes">Preguntas</a></li>
                            <li class="date"><a href="creditos.html">Créditos</a></li>
                        </ul>
                        <p>&nbsp;</p>
                        <p class="date"><a href="logout.php">Logout</a></p>
                        <!--Con javascript se puede ocultar con la variable none.-->
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
								echo "<input type='button' value='Enviar pregunta' name='insertarPregunta' onClick = 'insertarPregunta(\"".$_SESSION['email']."\", \"".$dir_ip."\")'/>";							
							?>
							</form>

							<div id="answer"><b>La respuesta saldrá aquí...</b></div>
                	</div>
					
					<br/><br/>
					
					<?php
					
						//Miramos si esta logeado, en caso de no estarlo, FUERA!
						if(!isset($_SESSION['email'])){ 
							$mensaje="Lo sentimos, no puedes estar aquí si no estás registrado.";
							echo "<script type='text/javascript'>alert('$mensaje');</script>";
							sleep(5);
							header("Location: layout.php");
						}
						// Cargar BD
						// Sacar preguntas del usuario
						// Imprimir preguntas + Botón editar
						
							
						// CONEXIÓN BASE DE DATOS
						$conexion = new mysqli($servidor, $usuario_servidor, $password_servidor, $nombre_bd);

						if ($conexion->connect_error) {
							die("La conexion ha fallado: " . $conexion->connect_error);
						}
							
						// HACER CONSULTA
                        $sql = "SELECT * FROM pregunta WHERE pregunta.email='{$_SESSION['email']}'";     

						//SELECT * FROM pregunta WHERE pregunta.email = 'jagumiel001@ikasle.ehu.es'
						$result = mysqli_query($conexion, $sql);
                        $num_col = $result->num_rows;
                        
                        //Añado esto:
                        if ($num_col > 0) {
                            //Aquí dibujamos la primera fila (row) de la tabla.
                            $count = 1;
                            
                            // Con este while pretendemos escribir el contenido de la base de datos, rellenar las proximas filas.
                            while($row = $result->fetch_assoc()) {
                                echo "<table id='".$row["id"]."_table' border=1 width='100%'>
											<tr>
												<th width='38%'>Pregunta</th>
												<th width='38%'>Respuesta</th>
												<th width='14%'>Tema</th>
												<th width='5%'>Complejidad</th>
												<th width='5%'></th>
											</tr>
											<tr>
												<td><input id='".$row["id"]."_pregunta' type='text' disabled value='".$row["pregunta"]."'/></td>
												<td><input id='".$row["id"]."_respuesta' type='text' disabled value='".$row["respuesta"]."'/></td>
												<td><input id='".$row["id"]."_tema' type='text' disabled value='".$row["tema"]."'/></td>
												<td><input id='".$row["id"]."_complejidad' type='text' disabled value='".$row["complejidad"]."'/></td>
												<td><input id='".$row["id"]."_button' type='button' id='".$row["id"]."_button' value='&#9998;' onClick=seleccionarPregunta('".$_SESSION['email']."', '".$dir_ip."', '".$row['id']."');/></td>												
											</tr>
										</table>
										<div id='".$row["id"]."_div'></div>
										<br/><br/>";
								$count = $count + 1;
                            }
                        } else {
							echo "Todavía no has insertado ninguna pregunta. ¡No pasa nada! Puedes hacerlo aquí mismo $#8593;";
                        }
											
											
						$sql = "SELECT count( id ) AS num_rows FROM pregunta";
						$row = mysqli_query($conexion, $sql);
						$total_preguntas = $row->num_rows;
											
                        $conexion->close();
						
						echo "<p>Has introducido ".($count-1)."/".$total_preguntas." de nuestra base de datos. Congrats y eso.";	// Poner arriba modificando una etiqueta o algo
											
						//		Editar -> Carga formulario con datos de pregunta
						//			   -> El usuario modifica la pregunta y pulsa submit
						//			   -> La pregunta se sustituye y se actualiza la página, sin recargarla
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