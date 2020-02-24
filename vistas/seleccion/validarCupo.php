<?php
include("../../config/connection.php");

$horaEstimada = ($_GET['horaEstimada']);
$consulta = "SELECT * FROM solicitud_poli WHERE horaPeticion = '' ";
$validarFecha = odbc_exec($connect, $consulta);
$hayCupo = odbc_fetch_row($validarFecha);


if ($hayCupo > 0){
	echo "<script>
	alert ('se supone que no hay cupos')
	</script>";
} else {
	echo "<script>
	alert ('hay cupos!!!')
	</script>";
}


?>