<?php

session_start();

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

	$usuarioRegistrador = $_SESSION['nombreUsuario'];
	$ccmsRegistrador = $_SESSION['ccmsUsuario'];
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

	$query = "INSERT INTO solicitudPrevia_poli (usuarioRegistrador, ccmsRegistrador, ciudadPeticion, fechaSolicitud, fechaContratacion, tipoConvocatoria, tiempoTP, historiaTP, areaEvaluado, tipoIdentificacion, numeroIdentificacion, nombreEvaluado, cargoEvaluado, estadoPeticion, color) VALUES ('$usuarioRegistrador', '$ccmsRegistrador', '$ciudadPeticion', GETDATE(), '$fechaContratacion', '$tipoConvocatoria', '$tiempoTP', '$historiaTP', '$areaEvaluado', '$tipoIdentificacion', '$numeroIdentificacion', '$nombreEvaluado', '$cargoEvaluado', 'Solicitado', '#FF0000');";

	$datos = odbc_exec($connect, utf8_decode($query));

	if ($datos) {
		$foo = True;
		echo json_encode($foo);
	} else {
		$foo = False;
		echo json_encode($foo);
	}

	break;

	case 'actualizarCupo':

	$fecha = $_POST['fecha'];
	$hora = $_POST['hora'];
	$tipoIden = $_POST['tipoIden'];
	$numIden = $_POST['numIden'];
	$nombre = $_POST['nombre'];
	$cargo = $_POST['cargo'];
	$area = $_POST['area'];
	$tipoSite = $_POST['tipoSite'];	

	$query = "UPDATE solicitud_poli SET tipoIdentificacion = '$tipoIden', numeroIdentificacion = '$numIden', 
	nombreEvaluado = '$nombre', cargoEvaluado = '$cargo', areaEvaluado = '$area' 
	WHERE fechaPeticion = CONVERT(datetime, '$fecha') AND ciudadPeticion = '$tipoSite';";

	$datos = odbc_exec($connect, utf8_decode($query));

	if ($datos) {
		$foo = True;
		echo json_encode($foo);
	} else {
		$foo = False;
		echo json_encode($foo);
	}
	

	break;

	case 'insertar':

	$usuarioRegistrador = $_SESSION['nombreUsuario'];
	$ccmsRegistrador = $_SESSION['ccmsUsuario'];
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

	$query = "INSERT INTO solicitud_poli (usuarioRegistrador, ccmsRegistrador, ciudadPeticion, fechaSolicitud, fechaContratacion, tipoConvocatoria, tiempoTP, historiaTP, areaEvaluado, tipoIdentificacion, numeroIdentificacion, nombreEvaluado, cargoEvaluado, estadoPeticion, color) VALUES ('$usuarioRegistrador', '$ccmsRegistrador', '$ciudadPeticion', GETDATE(), '$fechaContratacion', '$tipoConvocatoria', '$tiempoTP', '$historiaTP', '$areaEvaluado', '$tipoIdentificacion', '$numeroIdentificacion', '$nombreEvaluado', '$cargoEvaluado', 'Solicitado', '#FF0000');";

	$datos = odbc_exec($connect, utf8_decode($query));

	if ($datos) {
		$foo = True;
		echo json_encode($foo);
	} else {
		$foo = False;
		echo json_encode($foo);
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

	case 'insertarVarios':

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

	$query = "INSERT INTO solicitud_poli (usuarioRegistrador, ccmsRegistrador, ciudadPeticion, fechaSolicitud, fechaContratacion, tipoConvocatoria, tiempoTP, historiaTP, areaEvaluado, tipoIdentificacion, numeroIdentificacion, nombreEvaluado, cargoEvaluado, estadoPeticion, color) 
	    SELECT usuarioRegistrador, ccmsRegistrador, ciudadPeticion, fechaSolicitud, fechaContratacion, tipoConvocatoria, tiempoTP, historiaTP, areaEvaluado, tipoIdentificacion, numeroIdentificacion, nombreEvaluado, cargoEvaluado, estadoPeticion, color FROM solicitudPrevia_poli WHERE ccmsRegistrador = '$ccmsRegistrador';

	    TRUNCATE TABLE solicitudPrevia_poli;";

	$datos = odbc_exec($connect, utf8_decode($query));

	if ($datos) {
		$foo = True;
		echo json_encode($foo);
	} else {
		$foo = False;
		echo json_encode($foo);
	}

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

	case 'limpiar':

	$ccmsRegistrador = $_SESSION['ccmsUsuario'];

	$query = "DELETE FROM notificaciones_poli WHERE ccmsRegistrador = '$ccmsRegistrador'";

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

	case 'modificar':
	echo "modificar";
	break;
	
	default:
	break;
}

/*
*/
?>