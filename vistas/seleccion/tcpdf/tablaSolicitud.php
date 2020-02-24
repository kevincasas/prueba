<?php

header('Content-Type: application/json');

$server = 'TPCV359-85.teleperformance.co\SQL2016STD,5081';
$database = 'HR_Analytics';
$user = 'HRDevelopment';
$pass = 'Aplicaciones2020';

/*
$server = 'LAPTOP-4Q0SU99P';
$database = 'HR_Analytics';,
$user = '666';
$pass = '777';*/

$connect = odbc_connect("Driver={SQL Server Native Client 11.0};Server=$server;Database=$database;", $user, $pass);

$accion = (isset($_GET['accion']))?$_GET['accion']:'leer';
switch ($accion) {

	case 'agregar':

	$fechaInicio = $_POST['start'];
	$titulo = $_POST['title'];
	$descripcion = $_POST['descripcion'];

	$sentenciaSQLi = "INSERT INTO ejemploCalendario (fechaInicio, titulo, descripcion) VALUES ('$fechaInicio', '$titulo', '$descripcion')";

	$datos = odbc_exec($connect, $sentenciaSQLi);
      
	if ($datos) {
		$foo = True;
		echo json_encode($foo);
	} else {
		$foo = False;
		echo json_encode($foo);
	}

	break;

	case 'eliminar':
	echo "eliminar";
 
	break;

	case 'modificar':
	echo "modificar";
	break;
	
	default:
	$sentenciaSQL = "SELECT titulo as title, descripcion, fechaInicio as start FROM ejemploCalendario;";

	$datos = odbc_exec($connect, $sentenciaSQL);

	$datos2 = array();
	$i = 0;

	while($resultado = odbc_fetch_array($datos)) {

		$datos2[] = mb_convert_encoding($resultado, "UTF-8", "iso-8859-1");

		$i++;
	}
	echo json_encode($datos2);
	break;
}

/*
*/
 ?>