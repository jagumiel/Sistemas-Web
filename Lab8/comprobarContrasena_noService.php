<?php
	function checkPassword( $password ) {		
		$myfile = fopen("toppasswords.txt", "r") or die("Unable to open file!");
		
		while(!feof($myfile)) {
			if (fgets($myfile) == $password) {
				return "INVALIDA";
			}
		}
		
		fclose($myfile);
	
		return "VALIDA";
	}
?>