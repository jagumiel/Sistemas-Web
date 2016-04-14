<?php

	//ESTO ES UN SERVICIO WEB.
	//incluimos la clase nusoap.php
	require_once('nusoap/lib/nusoap.php');
	require_once('nusoap/lib/class.wsdlcache.php');

	//creamos el objeto de tipo soap_server
	$ns="http://jagumiel-sw.esy.es/olatz_fix_lab7/nusoap/samples";
	$server = new soap_server;
	$server->configureWSDL('checkPassword',$ns);
	$server->wsdl->schemaTargetNamespace=$ns;

	//registramos la función que vamos a implementar
	$server->register('checkPassword',array('password'=>'xsd:string'),array('z'=>'xsd:string'),$ns);

	//implementamos la función
	function checkPassword( $password ) {		
		$file = fopen("toppasswords.txt", "r") or die("Unable to open file!");
		while(!feof($file)){
			$line = fgets($file);
			if ( strcmp(substr($line, 0, strlen($line)-2),$password)==0) {
					fclose($file);
					return "INVALIDA";
			}
		}
		fclose($file);
		return "VALIDA";
	}
	//llamamos al método service de la clase nusoap
	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
	$server->service($HTTP_RAW_POST_DATA);

?>