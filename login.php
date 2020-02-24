<?php

session_start();
if (isset($_POST['submit'])) {
    $uname = $_POST['usuarioCCMS'];
    $password = $_POST['usuarioContra'];
    $contrasena = md5($password);
    $_SESSION['contraLibre'] = $password;
    
    include("config/connection.php");

    $sql = "select ccms,nombre,contra,genero,ciudad,rol from usuarios_polig where ccms=".$uname." and contra='" .$contrasena. "'";
    $result = odbc_exec($connect, utf8_decode($sql));
    $count = odbc_fetch_row($result);
    $try = odbc_result(odbc_exec($connect, $sql), 'rol');
    $nom = odbc_result(odbc_exec($connect, $sql), 'nombre');
    $gen = odbc_result(odbc_exec($connect, $sql), 'genero');
    $ciu = utf8_encode(odbc_result(odbc_exec($connect,  $sql), 'ciudad')) ;
    $ccms = odbc_result(odbc_exec($connect, $sql), 'ccms');


    $alone = "";

    if ($try == "Desarrollador") {
        $_SESSION['nombreUsuario'] = $nom;
        $_SESSION['rolUsuario'] = $try;
        $_SESSION['generoUsuario'] = $gen;
        $_SESSION['ciudadUsuario'] = $ciu;
        $_SESSION['ccmsUsuario'] = $ccms;
        $_SESSION['sitePoligrafiaE'] = $alone;
        $_SESSION['tipoIdentificacionE'] = $alone;
        $_SESSION['numeroIdentificacionE'] = $alone;
        $_SESSION['nombreE'] = $alone;
        $_SESSION['cargoE'] = $alone;
        $_SESSION['areaE'] = $alone;
        $_SESSION['nombreSoliE'] = $alone;
        $_SESSION['cargoSoliE'] = $alone;
        header("location:vistas/jefe/inicioJefe.php");
        
    } else if ($try == "Analista") {
        $_SESSION['nombreUsuario'] = $nom;
        $_SESSION['rolUsuario'] = $try;
        $_SESSION['generoUsuario'] = $gen;
        $_SESSION['ciudadUsuario'] = $ciu;
        $_SESSION['ccmsUsuario'] = $ccms;
        $_SESSION['sitePoligrafiaE'] = $alone;
        $_SESSION['tipoIdentificacionE'] = $alone;
        $_SESSION['numeroIdentificacionE'] = $alone;
        $_SESSION['nombreE'] = $alone;
        $_SESSION['cargoE'] = $alone;
        $_SESSION['areaE'] = $alone;
        $_SESSION['nombreSoliE'] = $alone;
        $_SESSION['cargoSoliE'] = $alone;
        header("location:vistas/seleccion/inicioSeleccion.php");
        
    } else if ($try == "Administrador") {
        $_SESSION['nombreUsuario'] = $nom;
        $_SESSION['rolUsuario'] = $try;
        $_SESSION['generoUsuario'] = $gen;
        $_SESSION['ciudadUsuario'] = $ciu;
        $_SESSION['ccmsUsuario'] = $ccms;
        header("location:vistas/jefe/inicioJefe.php");
        
    }  else if ($try == "Poligrafista") {
        $_SESSION['nombreUsuario'] = $nom;
        $_SESSION['rolUsuario'] = $try;
        $_SESSION['generoUsuario'] = $gen;
        $_SESSION['ciudadUsuario'] = $ciu;
        $_SESSION['ccmsUsuario'] = $ccms;
        $_SESSION['sitePoligrafiaE'] = $alone;
        $_SESSION['tipoIdentificacionE'] = $alone;
        $_SESSION['numeroIdentificacionE'] = $alone;
        $_SESSION['nombreE'] = $alone;
        $_SESSION['cargoE'] = $alone;
        $_SESSION['areaE'] = $alone;
        $_SESSION['nombreSoliE'] = $alone;
        $_SESSION['cargoSoliE'] = $alone;
        header("location:vistas/poligrafistas/inicioPoligrafistas.php");
        
    } else {
        echo "Datos inválidos para permitir el acceso. Por favor espere...";
        header("refresh:2;url=index.php");

    }
}
?>