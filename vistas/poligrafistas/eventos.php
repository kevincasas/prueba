<?php
include("../../config/connection.php");
session_start();

header('Content-Type: application/json');

$accion = (isset($_GET['accion']))?$_GET['accion']:'leer';
switch ($accion) {

	case 'asignar':

	$fechaPeticio = $_POST['fecha'];
	$horaPeticion = $_POST['hora'];
	$fechaPeticion = "";
	$fechaPeticionR = "";
	$tipoIden = $_POST['tipoIden'];
	$numIden = $_POST['numIden'];
	$nombre = $_POST['nombre'];
	$cargo = $_POST['cargo'];
	$area = $_POST['area'];
	$estado = $_POST['estado'];
	$ccmsRegistrador = $_POST['ccmsRegistrador'];

	$horas = odbc_result(odbc_exec($connect, "SELECT hora FROM horario_poli WHERE idHora = '$horaPeticion'"), 'hora');

	$fechaPeticionR = odbc_result(odbc_exec($connect, "SELECT (CONVERT (date ,'$fechaPeticio')) AS f"), 'f');

	$fechaPeticion .= $fechaPeticionR." ".$horas;


	$sentenciaSQLi = "UPDATE solicitud_poli SET fechaPeticion = (CONVERT(datetime, '".$fechaPeticion."', 121)), horaPeticion = (SELECT hora FROM horario_poli WHERE idHora = '$horaPeticion'), nombreEvaluado = '$nombre', areaEvaluado = '$area', cargoEvaluado = '$cargo', estadoPeticion = 'Asignado', color = '#1949B6' WHERE tipoIdentificacion = '$tipoIden' AND  numeroIdentificacion = '$numIden';

	INSERT INTO notificaciones_poli (tipoNotificacion, ccmsRegistrador) VALUES ('AsignoCita', '$ccmsRegistrador');
	";

	$datos = odbc_exec($connect, utf8_decode($sentenciaSQLi));

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

	$query = "UPDATE solicitud_poli SET ciudadPeticion = '$tipoSite', estadoPeticion = 'Solicitado', color = '#FF0000' WHERE numeroIdentificacion = '$numIden' AND tipoIdentificacion = '$tipoIden' AND estadoPeticion = '$estado' AND ccmsRegistrador = '$ccmsRegistrador';

	INSERT INTO notificaciones_poli (tipoNotificacion, ccmsRegistrador) VALUES ('Movimiento', '$ccmsRegistrador');";

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

	case 'validador1':

	$usuarioRegistrador = $_SESSION['nombreUsuario'];
	$ccmsRegistrador = $_SESSION['ccmsUsuario'];
	$ciudadPeticion = $_POST['ciudadPeticion'];
	$fechaContratacion = $_POST['fechaContratacion'];
	$tipoConvocatoria = $_POST['tipoConvocatoria'];
	$tiempoTP = $_POST['tiempoTP'];
	$historiaTP = $_POST['historiaTP'];
	$areaEvaluado = $_POST['areaEvaluado'];
	$tipoIdentificacion = $_POST['tipoIdentificacion'];
	$numeroIdentificacion = $_POST['numeroIdentificacion'];
	$nombreEvaluado = $_POST['nombreEvaluado'];
	$cargoEvaluado = $_POST['cargoEvaluado'];

	$query1 = "

	SELECT * FROM solicitud_poli WHERE numeroIdentificacion = '$numeroIdentificacion' AND tipoIdentificacion = '$tipoIdentificacion' AND estadoPeticion <> 'Cancelado';";

	$datos1 = odbc_exec($connect, utf8_decode($query1));
	$hayCupo = odbc_fetch_row($datos1);

	if ($hayCupo > 0){
		$foo1 = True;
		echo json_encode($foo1);
	} else {
		$foo1 = False;
		echo json_encode($foo1);
	}

	break;

	case 'validador2':

	$usuarioRegistrador = $_SESSION['nombreUsuario'];
	$ccmsRegistrador = $_SESSION['ccmsUsuario'];
	$ciudadPeticion = $_POST['ciudadPeticion'];
	$fechaContratacion = $_POST['fechaContratacion'];
	$tipoConvocatoria = $_POST['tipoConvocatoria'];
	$tiempoTP = $_POST['tiempoTP'];
	$historiaTP = $_POST['historiaTP'];
	$areaEvaluado = $_POST['areaEvaluado'];
	$tipoIdentificacion = $_POST['tipoIdentificacion'];
	$numeroIdentificacion = $_POST['numeroIdentificacion'];
	$nombreEvaluado = $_POST['nombreEvaluado'];
	$cargoEvaluado = $_POST['cargoEvaluado'];

	$query2 = "

	SELECT * FROM solicitudPrevia_poli WHERE numeroIdentificacion = '$numeroIdentificacion' AND tipoIdentificacion = '$tipoIdentificacion' AND estadoPeticion <> 'Cancelado';";

	$datos2 = odbc_exec($connect, utf8_decode($query2));
	$hayCupo = odbc_fetch_row($datos2);

	if ($hayCupo > 0){
		$foo2 = True;
		echo json_encode($foo2);
	} else {
		$foo2 = False;
		echo json_encode($foo2);
	}

	break;

	case 'insertarSolicitud':

	$usuarioRegistrador = $_SESSION['nombreUsuario'];
	$ccmsRegistrador = $_SESSION['ccmsUsuario'];
	$fechaPeticio = $_POST['fechaPeticion'];
	$horaPeticion = $_POST['horaPeticion'];
	$fechaPeticion = "";
	
	$ciudadPeticion = $_POST['ciudadPeticion'];
	$_SESSION['sitePoligrafiaE'] = $ciudadPeticion;
	$fechaContratacion = $_POST['fechaContratacion'];
	$tipoConvocatoria = $_POST['tipoConvocatoria'];
	$tiempoTP = $_POST['tiempoTP'];
	$historiaTP = $_POST['historiaTP'];
	$areaEvaluado = $_POST['areaEvaluado'];
	$tipoIdentificacion = $_POST['tipoIdentificacion'];
	$numeroIdentificacion = $_POST['numeroIdentificacion'];
	$nombreEvaluado = $_POST['nombreEvaluado'];
	$cargoEvaluado = $_POST['cargoEvaluado'];

	$horas = odbc_result(odbc_exec($connect, "SELECT hora FROM horario_poli WHERE idHora = '$horaPeticion'"), 'hora');

	$fechaPeticion .= $fechaPeticio." ".$horas;

	$query = "INSERT INTO solicitud_poli (usuarioRegistrador, nombreSolicitante, cargoSolicitante, ccmsRegistrador, ciudadPeticion, fechaSolicitud, fechaContratacion, tipoConvocatoria, tiempoTP, historiaTP, areaEvaluado, tipoIdentificacion, numeroIdentificacion, nombreEvaluado, cargoEvaluado, estadoPeticion, color, fechaPeticion, horaPeticion) VALUES ('$usuarioRegistrador', '$usuarioRegistrador', 'Analista', '$ccmsRegistrador', '$ciudadPeticion', GETDATE(), '$fechaContratacion', '$tipoConvocatoria', '$tiempoTP', '$historiaTP', '$areaEvaluado', '$tipoIdentificacion', '$numeroIdentificacion', '$nombreEvaluado', '$cargoEvaluado', 'Solicitado', '#FF0000', (CONVERT(datetime, '".$fechaPeticion."', 121)), (SELECT hora FROM horario_poli WHERE idHora = '$horaPeticion'));";


	// $query = "INSERT INTO solicitud_poli (usuarioRegistrador, nombreSolicitante, cargoSolicitante, ccmsRegistrador, ciudadPeticion, fechaSolicitud, fechaContratacion, tipoConvocatoria, tiempoTP, historiaTP, areaEvaluado, tipoIdentificacion, numeroIdentificacion, nombreEvaluado, cargoEvaluado, estadoPeticion, color, fechaPeticion, horaPeticion) VALUES ('$usuarioRegistrador', '$usuarioRegistrador', 'Analista', '$ccmsRegistrador', '$ciudadPeticion', GETDATE(), '$fechaContratacion', '$tipoConvocatoria', '$tiempoTP', '$historiaTP', '$areaEvaluado', '$tipoIdentificacion', '$numeroIdentificacion', '$nombreEvaluado', '$cargoEvaluado', 'Solicitado', '#FF0000', (CONVERT(datetime, '$fechaPeticion', 121)), '".$_POST['horaPeticion']."');";

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
	
	default:

	$ciudad = $_SESSION['ciudadUsuario'];

	if ($ciudad == "Bogotá"){
		$sentenciaSQL = "SELECT fechaPeticion AS start, horaPeticion AS title, nombreEvaluado, 
		tipoIdentificacion, numeroIdentificacion, cargoEvaluado, areaEvaluado, 
		nombreSolicitante, ccmsRegistrador, estadoPeticion, ciudadPeticion AS tipoSite, 
		color, cargoSolicitante, fechaContratacion, tipoConvocatoria, tiempoTP, historiaTP
		FROM solicitud_poli WHERE ciudadPeticion = 'Bogotá' AND estadoPeticion <> 'Cancelado';";
	} else if ($ciudad == "Bogotá - Zona Franca"){
		$sentenciaSQL = "SELECT fechaPeticion AS start, horaPeticion AS title, nombreEvaluado, 
		tipoIdentificacion, numeroIdentificacion, cargoEvaluado, areaEvaluado, 
		nombreSolicitante, ccmsRegistrador, estadoPeticion, ciudadPeticion AS tipoSite, 
		color, cargoSolicitante, fechaContratacion, tipoConvocatoria, tiempoTP, historiaTP
		FROM solicitud_poli WHERE ciudadPeticion = 'Bogotá - Zona Franca' AND estadoPeticion <> 'Cancelado';";
	} else if ($ciudad == "Medellín"){
		$sentenciaSQL = "SELECT fechaPeticion AS start, horaPeticion AS title, nombreEvaluado, 
		tipoIdentificacion, numeroIdentificacion, cargoEvaluado, areaEvaluado, 
		nombreSolicitante, ccmsRegistrador, estadoPeticion, ciudadPeticion AS tipoSite, 
		color, cargoSolicitante, fechaContratacion, tipoConvocatoria, tiempoTP, historiaTP
		FROM solicitud_poli WHERE ciudadPeticion = 'Medellín' AND estadoPeticion <> 'Cancelado';";
	}

	

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