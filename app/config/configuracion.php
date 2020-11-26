<?php

	//error_reporting(false);
	//Ruta de la aplicacion
	define('RUTA_APP',dirname(dirname(__FILE__)));

	//Ruta url Ejemplo: http://localhost/ExamplePanoramex/
	define('RUTA_URL','http://localhost/manejadorArchivos/');
	

	define('NOMBRE_SITIO','Manejador Archivos');
	
	//Fecha
	$date = new DateTime("now", new DateTimeZone('America/Mexico_City'));
    $date = $date->format("Y-m-d H:i:s");
	define('DATE_NOW',$date);
	
	
	
	