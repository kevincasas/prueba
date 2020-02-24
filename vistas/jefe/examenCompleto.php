<?php
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename=mydick.pdf');

$output = '';  

$connect = odbc_connect("Driver={SQL Server ".$_SESSION['nat']."};Server=".$_SESSION['server'].";Database=".$_SESSION['database'].";", $_SESSION['user'], $_SESSION['pass']);

/*
$result = odbc_exec($connect, "SELECT examenfinal FROM datos_generales_poli  WHERE no_id = 1007363899;");
$documento = odbc_free_result($result,'examenfinal');

$base64 =
$binary = base64_decode($base64);
echo $documento;
*/

$sql = "SELECT examenfinal FROM datos_generales_poli  WHERE no_id = 1007363899;";  
$result = odbc_exec($connect, $sql); 
$row = odbc_result(odbc_exec($connect, $sql), 'examenfinal');
$s = $row['examenfinal'];

echo $s;


 /*
   $result = mysql_query("SELECT file FROM ce WHERE userid=12", $c) or die("six");
   $document1=mysql_result($result, 0, 'file'); 
   header('Content-type: application/pdf');
   echo $document1;
