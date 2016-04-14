<?php
	//incluimos la clase nusoap.php
	require_once("nusoap/lib/nusoap.php");
	require_once("nusoap/lib/class.wsdlcache.php");
	//creamos el objeto de tipo soapclient.
	//donde se encuentra el servicio SOAP que vamos a u	tilizar.
	$soapclient = new nusoap_client( 'http://sw14.hol.es/ServiciosWeb/comprobarmatricula.php?wsdl',true);
	//Obtenemos el email introducido
	$email=$_GET['email'];
	//Llamamos la función que habíamos implementado en el Web Service e imprimimos lo que nos devuelve
	$result = $soapclient->call('comprobar', array('x'=>$email));//Le pasamos "x" y llamamos a la funcion comprobar
	echo $result;
?>