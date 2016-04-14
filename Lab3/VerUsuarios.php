<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Usuarios Registrados</title>
        <link rel='stylesheet' type='text/css' href='estilos/style.css' />
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
					<h2>Lista de Usuarios</h2>
				</div>
			</header> <!--Fin encabezado-->
            
    
			<section class="main" id="s1" style="width:100%; height:100%">
				<div align="center">
            		<!--Aqui metemos el PHP para que se haga la conexion con la BD-->
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
                    
                        $sql = "SELECT * FROM usuario";		//Sentencia, seleccionar todos los campos de la tabla usuario.
                        $result = mysqli_query($conexion, $sql);
                        $num_col = $result->num_rows;
                        
                        //Anado esto:
                        if ($num_col > 0) {
                            //Aqui dibujamos la primera fila (row) de la tabla.
                            echo "
                            <table border=3>
                                <tr>
                                    <th>Email</th>												
                                    <th>Nombre</th>
                                    <th>Apellido 1</th>
                                    <th>Apellido 2</th>
                                    <th>Especialidad</th>
                                    <th>Intereses</th>
                                    <th>Foto</th>
                                </tr>
                            "; 
                            
                            // Con este while pretendemos escribir el contenido de la base de datos, rellenar las proximas filas.
                            while($row = $result->fetch_assoc()) {
                                echo "
                                <tr>
                                    <td>".$row["Email"]."</td>
                                    <td>".$row["Nombre"]."</td>
                                    <td>".$row["Apellido1"]."</td>
                                    <td>".$row["Apellido2"]."</td>
                                    <td>".$row["Especialidad"]."</td>
                                    <td>".$row["Intereses"]."</td>
                                    <td><img src=".$row["Foto"]." width='"."20%"."' height='"."auto"."'></td>
                                </tr>";
                            }
							//Los nombres entrecomillados de arriba tienen que ser iguales a los nombres de los campos de la BD que hemos creado.
							//Para la foto probar con: <td><img src=".$row["Foto"]." width='"."20%"."' height='"."auto"."'></td>
							//Antes: <td>".$row["Foto"]."</td>


                            echo "</table>";
                        } else {
                            echo "La tabla está vacía. No hay entradas en la base de datos.";
                        }
                        $conexion->close();
                    ?>
                    <!--Fuente: http://www.w3schools.com/php/php_mysql_select.asp-->
				</div>
			</section>
            
            
			<footer>
				<a href='layout.html'>Inicio</a>
			</footer>
		</div>            
            
    </body>
</html>