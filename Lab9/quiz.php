<?php
    $email = $_SESSION["email"]; 
	if (strlen($email) > 7){
        header("location:insertarPregunta.html");
    }else{
        header("location:verPreguntas.php");
    }
?>