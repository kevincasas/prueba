<?php

$server = 'TPCV359-85.teleperformance.co\SQL2016STD,5081';
$_SESSION['server'] = $server;

$database = 'HR_Analytics';
$_SESSION['database'] = $database;

$user = 'HRDevelopment';
$_SESSION['user'] = $user;

$pass = 'Aplicaciones2020';
$_SESSION['pass'] = $pass;

//$con = "";
$con = "Native Client 11.0";
$_SESSION['nat'] = $con;


$connect = odbc_connect("Driver={SQL Server ".$_SESSION['nat']."};Server=".$_SESSION['server'].";Database=".$_SESSION['database'].";", $_SESSION['user'], $_SESSION['pass']);

?>


