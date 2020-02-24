<?php
include("../../config/connection.php");
session_start();

header('Content-Type: application/json');

$accion = (isset($_GET['accion']))?$_GET['accion']:'leer';
switch ($accion) {

	case 'asignar':

	$fecha = $_POST['fecha'];
	$hora = $_POST['hora'];
	$tipoIden = $_POST['tipoIden'];
	$numIden = $_POST['numIden'];
	$nombre = $_POST['nombre'];
	$cargo = $_POST['cargo'];
	$area = $_POST['area'];
	$estado = $_POST['estado'];
	$ccmsRegistrador = $_POST['ccmsRegistrador'];


	$sentenciaSQLi = "UPDATE solicitud_poli SET fechaPeticion = '$fecha', horaPeticion = '$hora', nombreEvaluado = '$nombre', areaEvaluado = '$area', cargoEvaluado = '$cargo', estadoPeticion = 'Asignado', color = '#1949B6' WHERE tipoIdentificacion = '$tipoIden' AND  numeroIdentificacion = '$numIden';

        INSERT INTO notificaciones_poli (tipoNotificacion, ccmsRegistrador) VALUES ('AsignoCita', '$ccmsRegistrador');
	    ";

	$datos = odbc_exec($connect, $sentenciaSQLi);

	if ($datos) {
		$foo = True;
		echo json_encode($foo);
	} else {
		$foo = False;
		echo json_encode($foo);
	}

	break;

	case 'mover':

	$fecha = $_POST['fecha'];
	$hora = $_POST['hora'];
	$tipoIden = $_POST['tipoIden'];
	$numIden = $_POST['numIden'];
	$nombre = $_POST['nombre'];
	$cargo = $_POST['cargo'];
	$area = $_POST['area'];
	$estado = $_POST['estado'];
	$tipoSite = $_POST['tipoSite'];	
	$ccmsRegistrador = $_POST['ccmsRegistrador'];

	$query = "UPDATE solicitud_poli SET ciudadPeticion = '$tipoSite', estadoPeticion = 'Solicitado', color = '#FF0000' WHERE numeroIdentificacion = '$numIden' AND tipoIdentificacion = '$tipoIden' AND estadoPeticion = '$estado' AND ccmsRegistrador = '$ccmsRegistrador';";

	$datos = odbc_exec($connect, utf8_decode($query));

	if ($datos) {
		$foo = True;
		echo json_encode($foo);
	} else {
		$foo = False;
		echo json_encode($foo);
	}

	break;

	
	case 'actualizarPerfil':

	$nombre = $_POST['nombre'];
	$genero = $_POST['genero'];
	$ccms = $_SESSION['ccmsUsuario'];

	$query = "UPDATE usuarios_polig SET nombre = '$nombre', genero = '$genero' WHERE ccms = '$ccms';";

	$datos = odbc_exec($connect, utf8_decode($query));

	if ($datos) {
		$foo = True;
		echo json_encode($foo);
	} else {
		$foo = False;
		echo json_encode($foo);
	}

	break;

	case 'actualizarContra':

	$pass = $_POST['pass'];
	$ccms = $_SESSION['ccmsUsuario'];
	$contrasena = md5($pass);

	$query = "UPDATE usuarios_polig SET contra = '$contrasena' WHERE ccms = '$ccms';";

	$datos = odbc_exec($connect, utf8_decode($query));

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
	
	default:

    $ciudad = $_SESSION['ciudadUsuario'];

    	$sentenciaSQL = "SELECT fechaPeticion AS start, horaPeticion AS title, nombreEvaluado, tipoIdentificacion, numeroIdentificacion, cargoEvaluado, areaEvaluado, nombreSolicitante AS solicitante, ccmsRegistrador AS ccmsSoli, estadoPeticion, ciudadPeticion AS tipoSite, color FROM solicitud_poli;";
 
	

	$datos = odbc_exec($connect, utf8_decode($sentenciaSQL));

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