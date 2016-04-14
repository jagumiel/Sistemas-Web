<?php
	//incluimos la clase nusoap.php
	require_once("nusoap/lib/nusoap.php");
	require_once("nusoap/lib/class.wsdlcache.php");

	//Creamos el objeto de tipo soapclient, donde se encuentra el servicio SOAP que vamos a utilizar.
	$soapclient = new nusoap_client("http://jagumiel-sw.esy.es/olatz_fix_lab7/comprobarContrasena.php?wsdl",false);

	//Llamamos la función que habíamos implementado en el Web Service e imprimimos lo que nos devuelve.
	$pass = $_GET['pass'];
	$result = $soapclient->call('checkPassword', array('password'=>$pass));
	echo $result;
?>