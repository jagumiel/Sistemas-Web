<?php
    $email = $_SESSION["email"]; //puedo obtener asi el valor de la sesion?
    //if (preg_match("/^[a-zA-Z]+\d{3}@ikasle\.ehu\.(es|eus)$/", $_POST['email'])){
	if (strlen($email) > 7){
        header("location:insertarPregunta.html");
    }else{
        header("location:verPreguntas.php");
    }
?>