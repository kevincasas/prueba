<?php 
include("../../config/connection.php");
session_start();
$ccmsUsu = $_SESSION['ccmsUsuario'];

if (!isset($_SESSION['rolUsuario']) || $_SESSION['rolUsuario'] != "Administrador" && $_SESSION['rolUsuario'] != "Desarrollador"){

  header('location: ../../index.php');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Poligrafía TP</title>
  <link rel="icon" type="" href="css/pluma.ico">
  <link rel="stylesheet" href="css/enviadoss.css">
  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <script src="js/jquery-3.2.1.js"></script>
  <script src="js/main.js"></script>
  <script src="js/sweetalert.js"></script>
</head>
<body >
  <header>
    <span id="button-menu" class="fa fa-bars"></span>

    <nav class="navegacion">
      <ul class="menu">
        <!-- TITULAR -->
        <li class="title-menu"><i id = "logoUsuario" class="fa fa-user-circle" aria-hidden="true" style="font-size: 70px;"></i><br><br>
          <label><?php echo utf8_encode($_SESSION['nombreUsuario']) ?></label><br>
          <label><?php echo utf8_encode($_SESSION['rolUsuario'])?></label><br></li>

          <!-- TITULAR -->

          <li><a href="inicioJefe.php" class="irInicio"><span class="fa fa-home icon-menu"></span>Inicio</a></li>
          <li><a href="agenda.php" class="irInicio"><span class="fa fa-calendar-check-o icon-menu"></span>Agenda</a></li>
          <li><a href="solicitudes.php" class="irInicio"><span class="fa fa-envelope icon-menu"></span>Solicitudes</a></li>
          

          <li><a href="busqueda.php" class="buscarDatos"><span class="fa fa-search icon-menu"></span>Busqueda</a></li>
          <li class="item-submenu" menu="1">
           <a href="#"><span class="fa fa-pencil-square-o icon-menu"></span>Editar</a>
           <ul class="submenu">
            <li class="title-menu"><span class="fa fa-pencil-square-o icon-menu" style="font-size: 70px;"></span><br><br>Editar</li>
            <li class="go-back">Atrás</li>

            <li><a href="editarPerfil.php"><span class="fa fa-cogs icon-menu"></span>Perfil</a></li>
            <li><a href="editarUsuarios.php"><span class="fa fa-users icon-menu"></span>Usuarios</a></li>
          </ul>
        </li>
        <li><a href="#" class="cerrarSesion"><span class="fa fa-sign-out icon-menu"></span>Log out</a><br><br><br><br></li>
      </ul>
    </nav>
    <label class="p">Poligrafía</label>
    <img src="css/logof4.jpg" align="right">
  </header>
  <div class="containerEnviados" align="center">
    <br><br>

    <br><br>
    <br>
    <br><br>
    <div class="row justify-content-center" style="color: white; background-color: rgba(0, 0, 0, 0.8);border-radius:9px; width: 95%;">
      <br />
      <div class="usu">
        <h2>Exámenes</h2>
        <style>h2 { font-size: 55 }</style><br>
        <div class="form-group" style="width: 100%;">
          <label class="checkbox-inline" style="font-size: 13px; font-family: 'Segoe UI';">
            <input type="checkbox" id="checkboxBogota" value="opcion_3" onclick="mostrarBogota()"> Bogotá
          </label>
          <label class="checkbox-inline" style="font-size: 13px; font-family: 'Segoe UI';">
            <input type="checkbox" id="checkboxZF" value="opcion_3" onclick="mostrarZF()"> Bogotá - ZF
          </label>
          <label class="checkbox-inline" style="font-size: 13px; font-family: 'Segoe UI';">
            <input type="checkbox" id="checkboxMedellin" value="opcion_3" onclick="mostrarMedellin()"> Medellín
          </label>
          <label class="checkbox-inline" style="font-size: 13px; font-family: 'Segoe UI';">
            <input type="checkbox" id="checkboxTodos" value="opcion_3" onclick="mostrarTodos()"> Todos
          </label>
        </div>
        <div class="Bogota" hidden>
          <table class="table table-bordered table-responsive" style="width: 95%;">
            <tr>
              <!--<td>ID</td>-->
              <td><b>Fecha</b></td>
              <td><b>Nombre</b></td>
              <td><b>Tipo Identificación</b></td>
              <td><b>Número Identificación</b></td>
              <td><b>Cargo</b></td>
              <td><b>Área</b></td>
              <td><b>Solicitante</b></td>
              <td><b>Site</b></td>
              <td><b>Tipo Examen</b></td>
              <td><b>Motivo Examen</b></td>
              <td><b>Estado</b></td>
            </tr>

            <?php
            $consulta = "USE HR_Analytics; SELECT fechacreacion, nombre, t_identificacion, no_id, 
            cargoaspira, areaaspira, solicitador, ciudadexamen, 
            tipoexamen, motivoexamen, estadoexamen FROM datos_generales_poli WHERE ciudadexamen = 'Bogotá';";

            $ejecutar = odbc_exec($connect, utf8_decode($consulta));

            $i = 0;

            while($fila = odbc_fetch_array($ejecutar)){
              $fechacreacion = $fila['fechacreacion'];
              $nombre = $fila['nombre'];
              $tipoIdentificacion = $fila['t_identificacion'];
              $numeroIdentificacion = $fila['no_id'];
              $cargoEvaluado = $fila['cargoaspira'];
              $areaEvaluado = $fila['areaaspira'];
              $nombreSolicitante = $fila['solicitador'];
              $ciudadPeticion = $fila['ciudadexamen'];
              $tipoexamen = $fila['tipoexamen'];
              $motivoexamen = $fila['motivoexamen'];
              $estadoexamen = $fila['estadoexamen'];
              $i++;

              ?>

              <tr align="center">
                <!--<td><?php //echo $id; ?></td>-->

                <td><?php echo utf8_encode($fechacreacion); ?></td>
                <td><?php echo utf8_encode($nombre); ?></td>
                <td><?php echo utf8_encode($tipoIdentificacion); ?></td>
                <td><?php echo utf8_encode($numeroIdentificacion); ?></td>
                <td><?php echo utf8_encode($cargoEvaluado); ?></td>
                <td><?php echo utf8_encode($areaEvaluado); ?></td>
                <td><?php echo utf8_encode($nombreSolicitante); ?></td>
                <td><?php echo utf8_encode($ciudadPeticion); ?></td>
                <td><?php echo utf8_encode($tipoexamen); ?></td>
                <td><?php echo utf8_encode($motivoexamen); ?></td>
                <td><?php echo utf8_encode($estadoexamen); ?></td>
              </i></a></td>
            </tr>

          <?php } ?>
          <br>
        </table>
      </div>
      <div class="ZF" hidden>
        <table class="table table-bordered table-responsive" style="width: 95%;">
          <tr>
            <!--<td>ID</td>-->
            <td><b>Fecha</b></td>
            <td><b>Nombre</b></td>
            <td><b>Tipo Identificación</b></td>
            <td><b>Número Identificación</b></td>
            <td><b>Cargo</b></td>
            <td><b>Área</b></td>
            <td><b>Solicitante</b></td>
            <td><b>Site</b></td>
            <td><b>Tipo Examen</b></td>
            <td><b>Motivo Examen</b></td>
            <td><b>Estado</b></td>
          </tr>

          <?php
          $consulta = "USE HR_Analytics; SELECT fechacreacion, nombre, t_identificacion, no_id, 
          cargoaspira, areaaspira, solicitador, ciudadexamen, 
          tipoexamen, motivoexamen, estadoexamen FROM datos_generales_poli WHERE ciudadexamen = 'Bogotá - Zona Franca';";

          $ejecutar = odbc_exec($connect, utf8_decode($consulta));

          $i = 0;

          while($fila = odbc_fetch_array($ejecutar)){
            $fechacreacion = $fila['fechacreacion'];
            $nombre = $fila['nombre'];
            $tipoIdentificacion = $fila['t_identificacion'];
            $numeroIdentificacion = $fila['no_id'];
            $cargoEvaluado = $fila['cargoaspira'];
            $areaEvaluado = $fila['areaaspira'];
            $nombreSolicitante = $fila['solicitador'];
            $ciudadPeticion = $fila['ciudadexamen'];
            $tipoexamen = $fila['tipoexamen'];
            $motivoexamen = $fila['motivoexamen'];
            $estadoexamen = $fila['estadoexamen'];
            $i++;

            ?>

            <tr align="center">
              <!--<td><?php //echo $id; ?></td>-->

              <td><?php echo utf8_encode($fechacreacion); ?></td>
              <td><?php echo utf8_encode($nombre); ?></td>
              <td><?php echo utf8_encode($tipoIdentificacion); ?></td>
              <td><?php echo utf8_encode($numeroIdentificacion); ?></td>
              <td><?php echo utf8_encode($cargoEvaluado); ?></td>
              <td><?php echo utf8_encode($areaEvaluado); ?></td>
              <td><?php echo utf8_encode($nombreSolicitante); ?></td>
              <td><?php echo utf8_encode($ciudadPeticion); ?></td>
              <td><?php echo utf8_encode($tipoexamen); ?></td>
              <td><?php echo utf8_encode($motivoexamen); ?></td>
              <td><?php echo utf8_encode($estadoexamen); ?></td>
            </i></a></td>
          </tr>

        <?php } ?>
        <br>
      </table>
    </div>
    <div class="Medellin" hidden>
      <table class="table table-bordered table-responsive" style="width: 95%;">
        <tr>
          <!--<td>ID</td>-->
          <td><b>Fecha</b></td>
          <td><b>Nombre</b></td>
          <td><b>Tipo Identificación</b></td>
          <td><b>Número Identificación</b></td>
          <td><b>Cargo</b></td>
          <td><b>Área</b></td>
          <td><b>Solicitante</b></td>
          <td><b>Site</b></td>
          <td><b>Tipo Examen</b></td>
          <td><b>Motivo Examen</b></td>
          <td><b>Estado</b></td>
        </tr>

        <?php
        $consulta = "USE HR_Analytics; SELECT fechacreacion, nombre, t_identificacion, no_id, 
        cargoaspira, areaaspira, solicitador, ciudadexamen, 
        tipoexamen, motivoexamen, estadoexamen FROM datos_generales_poli WHERE ciudadexamen = 'Medellín';";

        $ejecutar = odbc_exec($connect, utf8_decode($consulta));

        $i = 0;

        while($fila = odbc_fetch_array($ejecutar)){
          $fechacreacion = $fila['fechacreacion'];
          $nombre = $fila['nombre'];
          $tipoIdentificacion = $fila['t_identificacion'];
          $numeroIdentificacion = $fila['no_id'];
          $cargoEvaluado = $fila['cargoaspira'];
          $areaEvaluado = $fila['areaaspira'];
          $nombreSolicitante = $fila['solicitador'];
          $ciudadPeticion = $fila['ciudadexamen'];
          $tipoexamen = $fila['tipoexamen'];
          $motivoexamen = $fila['motivoexamen'];
          $estadoexamen = $fila['estadoexamen'];
          $i++;

          ?>

          <tr align="center">
            <!--<td><?php //echo $id; ?></td>-->

            <td><?php echo utf8_encode($fechacreacion); ?></td>
            <td><?php echo utf8_encode($nombre); ?></td>
            <td><?php echo utf8_encode($tipoIdentificacion); ?></td>
            <td><?php echo utf8_encode($numeroIdentificacion); ?></td>
            <td><?php echo utf8_encode($cargoEvaluado); ?></td>
            <td><?php echo utf8_encode($areaEvaluado); ?></td>
            <td><?php echo utf8_encode($nombreSolicitante); ?></td>
            <td><?php echo utf8_encode($ciudadPeticion); ?></td>
            <td><?php echo utf8_encode($tipoexamen); ?></td>
            <td><?php echo utf8_encode($motivoexamen); ?></td>
            <td><?php echo utf8_encode($estadoexamen); ?></td>
          </i></a></td>
        </tr>

      <?php } ?>
      <br>
    </table>
  </div>
  <div class="Todos" hidden>
    <table class="table table-bordered table-responsive" style="width: 95%;">
      <tr>
        <!--<td>ID</td>-->
        <td><b>Fecha</b></td>
        <td><b>Nombre</b></td>
        <td><b>Tipo Identificación</b></td>
        <td><b>Número Identificación</b></td>
        <td><b>Cargo</b></td>
        <td><b>Área</b></td>
        <td><b>Solicitante</b></td>
        <td><b>Site</b></td>
        <td><b>Tipo Examen</b></td>
        <td><b>Motivo Examen</b></td>
        <td><b>Estado</b></td>
      </tr>

      <?php
      $consulta = "USE HR_Analytics; SELECT fechacreacion, nombre, t_identificacion, no_id, 
      cargoaspira, areaaspira, solicitador, ciudadexamen, 
      tipoexamen, motivoexamen, estadoexamen FROM datos_generales_poli;";

      $ejecutar = odbc_exec($connect, utf8_decode($consulta));

      $i = 0;

      while($fila = odbc_fetch_array($ejecutar)){
        $fechacreacion = $fila['fechacreacion'];
        $nombre = $fila['nombre'];
        $tipoIdentificacion = $fila['t_identificacion'];
        $numeroIdentificacion = $fila['no_id'];
        $cargoEvaluado = $fila['cargoaspira'];
        $areaEvaluado = $fila['areaaspira'];
        $nombreSolicitante = $fila['solicitador'];
        $ciudadPeticion = $fila['ciudadexamen'];
        $tipoexamen = $fila['tipoexamen'];
        $motivoexamen = $fila['motivoexamen'];
        $estadoexamen = $fila['estadoexamen'];
        $i++;

        ?>

        <tr align="center">
          <!--<td><?php //echo $id; ?></td>-->

          <td><?php echo utf8_encode($fechacreacion); ?></td>
          <td><?php echo utf8_encode($nombre); ?></td>
          <td><?php echo utf8_encode($tipoIdentificacion); ?></td>
          <td><?php echo utf8_encode($numeroIdentificacion); ?></td>
          <td><?php echo utf8_encode($cargoEvaluado); ?></td>
          <td><?php echo utf8_encode($areaEvaluado); ?></td>
          <td><?php echo utf8_encode($nombreSolicitante); ?></td>
          <td><?php echo utf8_encode($ciudadPeticion); ?></td>
          <td><?php echo utf8_encode($tipoexamen); ?></td>
          <td><?php echo utf8_encode($motivoexamen); ?></td>
          <td><?php echo utf8_encode($estadoexamen); ?></td>
        </i></a></td>
      </tr>

    <?php } ?>
    <br>
  </table>
</div>

<br><br>
</div>

</div>
</div><br><br>
<script type="text/javascript">
  function mostrarValidar(){
    if ((document.getElementById("checkboxBogota").checked==false) && (document.getElementById("checkboxZF").checked==false) && (document.getElementById("checkboxMedellin").checked==false) && (document.getElementById("checkboxTodos").checked==false)){
      $(".Bogota").attr('hidden', true);
      $(".ZF").attr('hidden', true);
      $(".Medellin").attr('hidden',true);
      $(".Todos").attr('hidden',true);
    }
  }

  function mostrarBogota(){

    document.getElementById("checkboxZF").checked = false;
    document.getElementById("checkboxMedellin").checked = false;
    document.getElementById("checkboxTodos").checked = false;
    $(".Bogota").attr('hidden', false);
    $(".ZF").attr('hidden', true);
    $(".Medellin").attr('hidden',true);
    $(".Todos").attr('hidden',true);
    mostrarValidar();
  }

  function mostrarZF(){

    document.getElementById("checkboxBogota").checked = false;
    document.getElementById("checkboxMedellin").checked = false;
    document.getElementById("checkboxTodos").checked = false;
    $(".Bogota").attr('hidden', true);
    $(".ZF").attr('hidden', false);
    $(".Medellin").attr('hidden',true);
    $(".Todos").attr('hidden',true);
    mostrarValidar();
  }

  function mostrarMedellin(){

    document.getElementById("checkboxZF").checked = false;
    document.getElementById("checkboxBogota").checked = false;
    document.getElementById("checkboxTodos").checked = false;
    $(".Bogota").attr('hidden', true);
    $(".ZF").attr('hidden', true);
    $(".Medellin").attr('hidden',false);
    $(".Todos").attr('hidden',true);
    mostrarValidar();
  }

  function mostrarTodos(){

    document.getElementById("checkboxZF").checked = false;
    document.getElementById("checkboxMedellin").checked = false;
    document.getElementById("checkboxBogota").checked = false;
    $(".Bogota").attr('hidden', true);
    $(".ZF").attr('hidden', true);
    $(".Medellin").attr('hidden',true);
    $(".Todos").attr('hidden',false);
    mostrarValidar();
  }

</script>

<script type="text/javascript" src="js/mostrar_ocultar3.js"></script>
</body>
</html>