<?php
include("../../config/connection.php");
session_start();

header('Content-Type: application/json');

$site = $_SESSION['sitePoligrafiaE'];
$tipoIdentificacion = $_SESSION['tipoIdentificacionE'];
$numeroIdentificacion = $_SESSION['numeroIdentificacionE'];
$nombre = $_SESSION['nombreE'];
$cargo = $_SESSION['cargoE'];
$area = $_SESSION['areaE'];
$nombreSoli = $_SESSION['nombreSoliE'];
$cargoSoli = $_SESSION['cargoSoliE'];
$ccmsRegistrador = $_SESSION['ccmsUsuario'];

$accion = (isset($_GET['accion']))?$_GET['accion']:'leer';
switch ($accion) {

	case 'asignar':

	$fech = $_POST['start'];
	$hora = $_POST['hora'];
	$fecha = "";
	$fecha .= $fech." ".$hora;

	$sql = "UPDATE solicitud_poli SET fechaPeticion = (CONVERT(datetime, '".$fecha."', 121)), horaPeticion = '$hora'
	WHERE ccmsRegistrador = '$ccmsRegistrador' AND fechaPeticion is null AND horaPeticion is null;";

	$datos = odbc_exec($connect, utf8_decode($sql));



	if ($datos) {
		$foo = True;
		echo json_encode($foo);

	} else {
		$foo = False;
		echo json_encode($foo);

	}

	break;
	
	default:

	
	$sql = "SELECT fechaPeticion AS start, horaPeticion AS title FROM solicitud_poli WHERE ciudadPeticion = '$site';";
	$datos = odbc_exec($connect, utf8_decode($sql));

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