<?php 
include("../../config/connection.php");
session_start();

if (!isset($_SESSION['rolUsuario']) || $_SESSION['rolUsuario'] != "Analista" && $_SESSION['rolUsuario'] != "Desarrollador"){

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
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <script src="js/jquery-3.2.1.js"></script>
  <script src="js/main.js"></script>
  <script src="js/sweetalert.js"></script>
  
  <style>
    #container {
      visibility: hidden;  
    }
  </style>
</head>
<body>
  <header>
    <span id="button-menu" class="fa fa-bars"></span>

    <nav class="navegacion">
      <ul class="menu">

        <li class="title-menu"><i id = "logoUsuario" class="fa fa-user-circle" aria-hidden="true" style="font-size: 70px;"></i><br><br>
          <label><?php echo $_SESSION['nombreUsuario'] ?></label><br>
          <label><?php echo $_SESSION['rolUsuario']?></label><br></li>

          <li><a href="inicioSeleccion.php" class="irInicio"><span class="fa fa-home icon-menu"></span>Inicio</a></li>
                    <!--  <li><a href="solicitudes.php" class="ir"><span class="fa fa-envelope icon-menu"></span>Solicitudes</a></li> -->
                    <li><a href="agendaMenu.php" class="irInicio"><span class="fa fa-calendar-check-o icon-menu"></span>Agenda</a></li>
                    <li class="item-submenu" menu="1">
                        <a href="#"><span class="fa fa-envelope icon-menu"></span>Solicitudes</a>
                        <ul class="submenu">
                            <li class="title-menu"><span class="fa fa-envelope icon-menu" style="font-size: 70px;"></span><br><br>Solicitudes</li>
                            <li class="go-back">Atrás</li>

                            <li><a href="solicitud.php"><span class="fa fa-plus icon-menu"></span>Nueva solicitud</a></li>
                            <li><a href="enviadas.php"><span class="fa fa-paper-plane icon-menu"></span>Enviadas</a></li>
                            <li><a href="historial.php"><span class="fa fa-history icon-menu"></span>Historial</a></li>
                        </ul>
                    </li>
                    <li><a href="busqueda.php" class="buscarDatos"><span class="fa fa-search icon-menu"></span>Busqueda</a></li>
                    <li><a href="editarPerfil.php" class="irInicio"><span class="fa fa-pencil-square-o icon-menu"></span>Editar perfil</a></li>
      <li><a href="#" class="cerrarSesion"><span class="fa fa-sign-out icon-menu"></span>Log out</a><br><br><br><br></li>
    </ul>
  </nav>
  <label class="p">Poligrafía</label>
  <img src="css/logof4.jpg" align="right">
</header>

<div class="containerSolicitud" align="center">
  <br><br>

  <br><br>
  <br><br>
  <div class="row justify-content-center" style="color: white; background-color: rgba(0, 0, 0, 0.8);border-radius:9px; width: 92%;">
    <br /><br />

    <div class="solicitud">

      <h1>Creación de Solicitud</h1><br>
      <style>h2 { font-size: 55 }</style><br>
      <form method="post" action="solicitud.php">

        <table class="table table-dark" style="width: 95%; border: hidden">
          <tr>
            <td style="width: 25%;">
              <div class="form-group"><label>Nombre solicitante:</label>
                <input type="text" name="nombreSoli" id="nombreSoli" class="form-control" value="<?php echo $_SESSION['nombreUsuario'] ?>" style="color: white; background-color: rgba(0, 0, 0, 0.7);border-radius:4px; width: 100%;" disabled>
              </div>
            </td>
            <td style="width: 25%;">
              <div class="form-group"><label>Cargo solicitante:</label>
                <input type="text" name="cargoSoli" id="cargoSoli" class="form-control" value="<?php echo $_SESSION['rolUsuario']?>"  style="color: white; background-color: rgba(0, 0, 0, 0.7);border-radius:4px; width: 100%;" disabled>
              </div>
            </td>
            <td style="width: 25%;"><div class="form-group"><label>Site de Poligrafía:</label>
              <select name="sitePoligrafia" class="form-control" id="sitePoligrafia" style="width: 100%; background-color: rgba(0, 0, 0, 0.5); color: white;font-size: 18;">
                <option style= "background-color: rgba(0, 0, 0, 0.5);" value="">Seleccione:</option>
                <option style= "background-color: rgba(0, 0, 0, 0.5);" value="Bogotá">Bogotá (Connecta)</option>
                <option style= "background-color: rgba(0, 0, 0, 0.5);" value="Bogotá - Zona Franca">Bogotá (Zona Franca)</option>
                <option style= "background-color: rgba(0, 0, 0, 0.5);" value="Medellín">Medellín</option>
              </select></div>
            </td>
            <td style="width: 25%;">
              <div class="form-group">
                <label>Fecha contratación: (aproximada)</label>
              <input type="date" name="fechaContra" id="fechaContra" class="form-control" style="color: white; background-color: rgba(0, 0, 0, 0.7);border-radius:4px; width: 100%;">
            </div>
        </td>
      </tr>
    </table>


    <table class="table table-dark" style="width: 95%; border: hidden">
      <tr>
        <td style="width: 25%;">
          <div class="form-group"><label>Tipo de convocatoria</label>
            <select name="tipoConvo" class="form-control" id="tipoConvo" style="width: 100%; background-color: rgba(0, 0, 0, 0.5); color: white;font-size: 18;">
              <option style= "background-color: rgba(0, 0, 0, 0.5);" value="">Seleccione:</option>
              <option style= "background-color: rgba(0, 0, 0, 0.5);" value="Externa">Externa</option>
              <option style= "background-color: rgba(0, 0, 0, 0.5);" value="Interna o Ascenso">Interna o Ascenso</option>
            </select>
          </div>
        </td>

        <td style="width: 25%;"><div class="form-group"><label>Tiempo laborando en TP</label>
          <select name="tiempoTeleperformance" class="form-control" id="tiempoTeleperformance" style="width: 100%; background-color: rgba(0, 0, 0, 0.5); color: white;font-size: 18;">
            <option style= "background-color: rgba(0, 0, 0, 0.5);" value="">Seleccione:</option>
            <option style= "background-color: rgba(0, 0, 0, 0.5);" value="N/A">N/A</option>
            <option style= "background-color: rgba(0, 0, 0, 0.5);" value="De 0 - 3 meses">De 0 - 3 meses</option>
            <option style= "background-color: rgba(0, 0, 0, 0.5);" value="De 3 - 6 meses">De 3 - 6 meses</option>
            <option style= "background-color: rgba(0, 0, 0, 0.5);" value="De 6 - 12 meses">De 6 - 12 meses</option>
            <option style= "background-color: rgba(0, 0, 0, 0.5);" value="Más de 12 meses">Más de 12 meses</option>
          </select></div>
        </td>
        <td style="width: 25%;">
          <div class="form-group"><label>¿Alguna vez trabajó con TP?</label>
           <select name="histTP" class="form-control" id="histTP" style="width: 100%; background-color: rgba(0, 0, 0, 0.5); color: white;font-size: 18;">
            <option style= "background-color: rgba(0, 0, 0, 0.5);" value="">Seleccione:</option>
            <option style= "background-color: rgba(0, 0, 0, 0.5);" value="Si">Sí</option>
            <option style= "background-color: rgba(0, 0, 0, 0.5);" value="No">No</option>
          </select>
        </div>
      </td>
      <td style="width: 25%;">
        <div class="form-group"><label>Campaña o área:</label>
          <input type="text" name="areaEva" id="areaEva" class="form-control" placeholder="Escriba la campaña o área" style="color: white; background-color: rgba(0, 0, 0, 0.7);border-radius:4px; width: 100%;">
        </div>
      </td>
    </tr>
  </table>
  <div class="formulario">

    <table class="table table-dark" style="width: 95%; border: hidden">
      <tr>            
        <td style="width: 25%;"><div class="form-group"><label>Tipo identificación:</label>
          <select name="tipoIdentificacion" class="form-control" id="tipoIdentificacion" style="width: 100%; background-color: rgba(0, 0, 0, 0.5); color: white;font-size: 18;">
            <option style= "background-color: rgba(0, 0, 0, 0.5);" value="">Seleccione:</option>
            <option style= "background-color: rgba(0, 0, 0, 0.5);" value="CC">CC</option>
            <option style= "background-color: rgba(0, 0, 0, 0.5);" value="TI">TI</option>
            <option style= "background-color: rgba(0, 0, 0, 0.5);" value="CE">CE</option>
            <option style= "background-color: rgba(0, 0, 0, 0.5);" value="PEP">PEP</option>
            <option style= "background-color: rgba(0, 0, 0, 0.5);" value="PASS">PASS</option>
          </select></div>
        </td>
        <!--<td>Password</td><-->
        <td style="width: 25%;"><div class="form-group"><label>Número identificación:</label>
          <input type="number" name="numeroIdentificacion" id="numeroIdentificacion" class="form-control" placeholder="Escriba identificación" style="color: white; background-color: rgba(0, 0, 0, 0.7);border-radius:4px; width: 100%;"></div>
        </td>
        <td style="width: 25%;"><div class="form-group"><label>Nombre Completo:</label>
          <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Escriba el nombre completo" style="color: white; background-color: rgba(0, 0, 0, 0.7);border-radius:4px;"></div>
        </td>
        <td style="width: 25%;">
          <div class="form-group"><label>Cargo:</label>
            <input type="text" name="cargo" id="cargo" class="form-control" placeholder="Escriba el cargo" style="color: white; background-color: rgba(0, 0, 0, 0.7);border-radius:4px; width: 100%;">
          </div>
        </td>
      </tr>
    </table>
</div>
  <button type="button" id="btnAgregar" class="btn btn-success" style="font-size: 15px;font-family: 'Segoe UI'; width: 19%;"><i class="fa fa-plus"></i>    Agregar otro(a) a la solicitud</button><br><br>
  <!--<a type="submit" name="insert" class="btn btn-light" style = "width: 10%; font-size: 14px;"><i class="fa fa-arrow-right " aria-hidden="true"></i>  Continuar</a><br /><br><br>-->


</div>
<div id="container" class="tabla">
  <div id="result"></div>
</div>



<button type="button" id="btnInsertar" value="Continuar" class="btn btn-success" style="font-size: 15px;font-family: 'Segoe UI'; width: 10%;"><i class="fa fa-arrow-right"></i>  Continuar</button><br><br>


<a href="enviadas.php" class="btn btn-danger" style = "width: 20%; font-size: 15px;font-family: 'Segoe UI';"><i class="fa fa-paper-plane " aria-hidden="true"></i>  Solicitudes enviadas</a><br>
<a href="historial.php" class="btn btn-danger" style = "width: 20%; font-size: 15px;font-family: 'Segoe UI';"><i class="fa fa-history " aria-hidden="true"></i>  Historial</a><br><br>
</form>
</div>



<?php

if(isset($_POST['insert'])){
  $sitePoligrafia = $_POST['sitePoligrafia'];
  $tipoIdentificacion = $_POST['tipoIdentificacion'];
  $numeroIdentificacion = $_POST['numeroIdentificacion'];
  $nombre = $_POST['nombre'];
  $cargo = $_POST['cargo'];
  $area = $_POST['area'];
  $nombreSoli = $_POST['nombreSoli'];
  $cargoSoli = $_POST['cargoSoli'];
  $ccms = $_SESSION['ccmsUsuario'];

  $_SESSION['sitePoligrafiaE'] = $sitePoligrafia;
  $_SESSION['tipoIdentificacionE'] = $tipoIdentificacion;
  $_SESSION['numeroIdentificacionE'] = $numeroIdentificacion;
  $_SESSION['nombreE'] = $nombre;
  $_SESSION['cargoE'] = $cargo;
  $_SESSION['areaE'] = $area;
  $_SESSION['nombreSoliE'] = $nombreSoli;
  $_SESSION['cargoSoliE'] = $cargoSoli;

  $disponible = "SELECT * FROM solicitud_poli WHERE 8<7;";
  $validarFecha = odbc_exec($connect, $disponible);
  $hayCupo = odbc_fetch_row($validarFecha);

  if ($hayCupo > 0){
    echo "<script>Swal.fire({
      type: 'error',
      title: '¡No hay disponiblilidad en la fecha y hora especificadas!',
      showConfirmButton: true,
      
    })</script>";
  } else {
    $revisar = "SELECT * FROM solicitud_poli WHERE usuarioRegistrador = '$ccms' and numeroIdentificacion = '$numeroIdentificacion' and tipoIdentificacion = '$tipoIdentificacion' and estadoPeticion = 'Solicitado';";
    $valida = odbc_exec($connect, $revisar);
    $saber = odbc_fetch_row($valida);

    if ($saber>0){
      echo "<script>Swal.fire({
        type: 'error',
        title: '¡Esa persona ya está en la lista de solicitudes!',
        showConfirmButton: false,
        timer: 1500
      })</script>";
    } else {
      $insertar = "INSERT INTO solicitud_poli(usuarioRegistrador, ciudadPeticion, tipoIdentificacion, numeroIdentificacion, nombreEvaluado, cargoEvaluado, areaEvaluado, nombreSolicitante, cargoSolicitante, tipoConvocatoria, estadoPeticion, color) VALUES ('$ccms','$sitePoligrafia', '$tipoIdentificacion',
      '$numeroIdentificacion', '$nombre', '$cargo', '$area', '$nombreSoli','$cargoSoli', 'Interna', 'Solicitado', '#FF0000')";

      $ejecutar = odbc_exec($connect, utf8_decode($insertar));

      if ($ejecutar){


        echo "<script>Swal.fire({
          title: '¡Ahora asigne la fecha y hora!',
          showConfirmButton: true
          }).then((result) => {
            if (result.value) {
              window.open('agendaSolicitantes.php','_self');
            }
          })</script>";

        }
      }
    }
  }

  ?>

</div>
</div><br><br>

<script type="text/javascript" src="js/mostrar_ocultar2.js"></script>
<script type="text/javascript">

  function mostrarInterna(){

    $(".preguntaInterno").attr('hidden', false);
    $(".preguntaExterno").attr('hidden', true);
    document.getElementById("cbxExterna").checked = false;
    
  }

  function mostrarExterna(){
    if(document.getElementById("cbxExterna").checked==true){
      $(".preguntaExterno").attr('hidden', false);
      $(".preguntaInterno").attr('hidden', true);
      document.getElementById("cbxInterna").checked = false;
      $(".formulario").attr('hidden',true);
    } else if(document.getElementById("cbxInterna").checked==true){
      $(".preguntaExterno").attr('hidden', true);
      $(".preguntaInterno").attr('hidden', false);
      document.getElementById("cbxExterna").checked = false;
      $(".formulario").attr('hidden',true);
    } else {
      $(".preguntaExterno").attr('hidden', true);
      $(".preguntaInterno").attr('hidden', true);
      document.getElementById("cbxInterna").checked = false;
      document.getElementById("cbxtrabajo1").checked = false;
      document.getElementById("cbxtrabajo2").checked = false;      
      $(".formulario").attr('hidden',true);
      document.ready = document.getElementById("fechaEstimada").value = '';
      document.ready = document.getElementById("tiempoTP").value = 'Seleccione:';
      document.ready = document.getElementById("horaEstimada").value = '0';
      document.ready = document.getElementById("sitePoligrafia").value = 'Seleccione:';
      document.ready = document.getElementById("tipoIdentificacion").value = 'Seleccione:';
      document.getElementById("numeroIdentificacion").value = "";
      document.getElementById("nombre").value = "";
      document.getElementById("cargo").value = "";
      document.getElementById("area").value = "";
      document.getElementById("nombreSoli").value = "";
      document.getElementById("cargoSoli").value = "";
    }
  }

  function formulario(){
    $(".formulario").attr('hidden',false);
  }

  function timeTP(){
    var select = document.getElementById("tiempoTP");
    var options=document.getElementsByTagName("option");
    if (select.value != 1){
      $(".formulario").attr('hidden',false);
    } else {
      $(".formulario").attr('hidden',true);
    }
  }
  
  function mostrarPassword3(){
    var cambio = document.getElementById("txtPassword3");
    if(cambio.type == "password"){
      cambio.type = "text";
    }else{
      document.ready = document.getElementById("tiempoTP").value = '0';
      cambio.type = "password";
    }
  }

  function validarCupo(){
    var horaEstimada = document.getElementById("horaEstimada").value;
    var fecha = document.getElementById("fechaEstimada").value;
    var site = document.getElementById("sitePoligrafia").value;


    $.get("validarCupo.php", {horaEstimada: $("#horaEstimada").val()})

  }

  var NuevoEvento;

  $('#btnInsertar').click(function(){
    var site = document.getElementById("sitePoligrafia").value;
    var fechaC = document.getElementById("fechaContra").value;
    var tipoC = document.getElementById("tipoConvo").value;
    var tiemTP = document.getElementById("tiempoTeleperformance").value;
    var r = document.getElementById("histTP").value;
    var Carea = document.getElementById("areaEva").value;
    var tipoI = document.getElementById("tipoIdentificacion").value;
    var num = document.getElementById("numeroIdentificacion").value;
    var nomC = document.getElementById("nombre").value;
    var car = document.getElementById("cargo").value; 

    var x = document.getElementById("container");
    if (window.getComputedStyle(x).visibility === "hidden"){

      if (site == ""){
        Swal.fire({
          type: 'error',
          title: '¡Seleccione un site de Poligrafía!',
          showConfirmButton: true
        }).then((result) => {
          if (result.value) {
          }
        })
      } else if (fechaC<1){
        Swal.fire({
          type: 'error',
          title: '¡Seleccione una fecha de contratación!',
          showConfirmButton: true
        }).then((result) => {
          if (result.value) {
          }
        })
      } else if (tipoC == ""){
        Swal.fire({
          type: 'error',
          title: '¡Seleccione un tipo de convocatoria!',
          showConfirmButton: true
        }).then((result) => {
          if (result.value) {
          }
        })
      }  else if (tiemTP == ""){
        Swal.fire({
          type: 'error',
          title: '¡Tiempo laborado en TP no es válido!',
          showConfirmButton: true
        }).then((result) => {
          if (result.value) {
          }
        })
      }  else if (r == ""){
        Swal.fire({
          type: 'error',
          title: '¡Respuesta no válida!',
          showConfirmButton: true
        }).then((result) => {
          if (result.value) {
          }
        })
      } else if (Carea == ""){
        Swal.fire({
          type: 'error',
          title: '¡Escriba una campaña o área!',
          showConfirmButton: true
        }).then((result) => {
          if (result.value) {
          }
        })
      } else if (tipoI == ""){
        Swal.fire({
          type: 'error',
          title: '¡Seleccione un tipo de identificación!',
          showConfirmButton: true
        }).then((result) => {
          if (result.value) {
          }
        })
      } else if (num<10000){
        Swal.fire({
          type: 'error',
          title: '¡Número de identificación no válido!',
          showConfirmButton: true
        }).then((result) => {
          if (result.value) {
          }
        })
      } else if (nomC == ""){
        Swal.fire({
          type: 'error',
          title: '¡Escriba el nombre completo!',
          showConfirmButton: true
        }).then((result) => {
          if (result.value) {
          }
        })
      } else if (car == ""){
        Swal.fire({
          type: 'error',
          title: '¡Escriba el cargo de la persona a examinar!',
          showConfirmButton: true
        }).then((result) => {
          if (result.value) {
          }
        })
      }

      else {

        RecolectarDatosGUI();
        validarInsertarInfo('validador1', NuevoEvento);

      }

    } else {
     RecolectarDatosGUI();
     insertarInfo('insertarVarios', NuevoEvento);
   }





 });

  $('#btnAgregar').click(function(){
    var site = document.getElementById("sitePoligrafia").value;
    var fechaC = document.getElementById("fechaContra").value;
    var tipoC = document.getElementById("tipoConvo").value;
    var tiemTP = document.getElementById("tiempoTeleperformance").value;
    var r = document.getElementById("histTP").value;
    var Carea = document.getElementById("areaEva").value;
    var tipoI = document.getElementById("tipoIdentificacion").value;
    var num = document.getElementById("numeroIdentificacion").value;
    var nomC = document.getElementById("nombre").value;
    var car = document.getElementById("cargo").value; 
    if (site == ""){
      Swal.fire({
        type: 'error',
        title: '¡Seleccione un site de Poligrafía!',
        showConfirmButton: true
      }).then((result) => {
        if (result.value) {
        }
      })
    } else if (fechaC<1){
      Swal.fire({
        type: 'error',
        title: '¡Seleccione una fecha de contratación!',
        showConfirmButton: true
      }).then((result) => {
        if (result.value) {
        }
      })
    } else if (tipoC == ""){
      Swal.fire({
        type: 'error',
        title: '¡Seleccione un tipo de convocatoria!',
        showConfirmButton: true
      }).then((result) => {
        if (result.value) {
        }
      })
    }  else if (tiemTP == ""){
      Swal.fire({
        type: 'error',
        title: '¡Tiempo laborado en TP no es válido!',
        showConfirmButton: true
      }).then((result) => {
        if (result.value) {
        }
      })
    }  else if (r == ""){
      Swal.fire({
        type: 'error',
        title: '¡Respuesta no válida!',
        showConfirmButton: true
      }).then((result) => {
        if (result.value) {
        }
      })
    } else if (Carea == ""){
      Swal.fire({
        type: 'error',
        title: '¡Escriba una campaña o área!',
        showConfirmButton: true
      }).then((result) => {
        if (result.value) {
        }
      })
    } else if (tipoI == ""){
      Swal.fire({
        type: 'error',
        title: '¡Seleccione un tipo de identificación!',
        showConfirmButton: true
      }).then((result) => {
        if (result.value) {
        }
      })
    } else if (num<10000){
      Swal.fire({
        type: 'error',
        title: '¡Número de identificación no válido!',
        showConfirmButton: true
      }).then((result) => {
        if (result.value) {
        }
      })
    } else if (nomC == ""){
      Swal.fire({
        type: 'error',
        title: '¡Escriba el nombre completo!',
        showConfirmButton: true
      }).then((result) => {
        if (result.value) {
        }
      })
    } else if (car == ""){
      Swal.fire({
        type: 'error',
        title: '¡Escriba el cargo de la persona a examinar!',
        showConfirmButton: true
      }).then((result) => {
        if (result.value) {
        }
      })
    }

    else {

      var x = document.getElementById("container");
      if (window.getComputedStyle(x).visibility === "hidden") {
        x.style.visibility = "visible";
      }

      /* $(".tabla").attr('hidden',false);*/

      RecolectarDatosGUI();
      EnviarInformacion('validador1', NuevoEvento);


/*
      $(".tabla").attr('hidden',false);
      RecolectarDatosGUI();
      EnviarInformacion('agregar', NuevoEvento);*/
    }

  });


  function RecolectarDatosGUI(){
    NuevoEvento = {
      ciudadPeticion:$('#sitePoligrafia').val(),
      fechaContratacion:$('#fechaContra').val(),
      tipoConvocatoria:$('#tipoConvo').val(),
      tiempoTP:$('#tiempoTeleperformance').val(),
      historiaTP:$('#histTP').val(),
      areaEvaluado:$('#areaEva').val(),
      tipoIdentificacion:$('#tipoIdentificacion').val(),
      numeroIdentificacion:$('#numeroIdentificacion').val(),
      nombreEvaluado:$('#nombre').val(),
      cargoEvaluado: $('#cargo').val()

    };
  }

  function validarInsertarInfo(accion, objEvento, modal){
    $.ajax({
      type: 'POST',
      url: 'tablaSolicitud.php?accion='+accion,
      data: objEvento,
      success:function(msg){
        if (msg){

          Swal.fire({
            type: 'error',
            title: '¡La solicitud de esta persona ya ha sido enviada!',
            showConfirmButton: true
          }).then((result) => {
            if (result.value) {
            }
          })

        } else {
          RecolectarDatosGUI();
          validarInsertarInfor('validador2', NuevoEvento);
        }
      },
      error: function(){
        alert("hay un error ... y sirve");
      }

    });
  }

  function validarInsertarInfor(accion, objEvento, modal){
    $.ajax({
      type: 'POST',
      url: 'tablaSolicitud.php?accion='+accion,
      data: objEvento,
      success:function(msg){
        if (msg){

          Swal.fire({
            type: 'error',
            title: '¡La persona ya se agregó!',
            showConfirmButton: true
          }).then((result) => {
            if (result.value) {
            }
          })

        } else {
          RecolectarDatosGUI();
          insertarInfo('insertar', NuevoEvento);
        }
      },
      error: function(){
        alert("hay un error ... y sirve");
      }

    });
  }


  function insertarInfo(accion, objEvento, modal){
    $.ajax({
      type: 'POST',
      url: 'tablaSolicitud.php?accion='+accion,
      data: objEvento,
      success:function(msg){
        if (msg){

          Swal.fire({
            title: '¡Ahora asigne la fecha y hora!',
            showConfirmButton: true
          }).then(function() {

            window.open('agendaSolicitantes.php','_self');
            
          })

        } else {
          alert ('Error en la inserción!');
        }
      },
      error: function(){
        alert("hay un error ... y sirve");
      }

    });
  }

  function agregarInfo(accion, objEvento, modal){
    $.ajax({
      type: 'POST',
      url: 'tablaSolicitud.php?accion='+accion,
      data: objEvento,
      success:function(msg){
        if (msg){

          $(document).ready(function(){
            function obtener_datos(){
              $.ajax({
                url:"tablaConsultaSolicitud.php",
                method: "POST",
                success: function(data){
                  $("#result").html(data)
                }
              })
            }

            obtener_datos();
            limpiarFormulario();
          })

        } else {
          alert ('Error en la inserción!');
        }
      },
      error: function(){
        alert("hay un error ... y sirve");
      }

    });
  }

  function EnviarInformacion(accion, objEvento, modal){
    $.ajax({
      type: 'POST',
      url: 'tablaSolicitud.php?accion='+accion,
      data: objEvento,
      success:function(msg){
        if (msg){
          Swal.fire({
            type: 'error',
            title: '¡La solicitud de esta persona ya ha sido enviada!',
            showConfirmButton: true
          }).then((result) => {
            if (result.value) {
            }
          })
          /*
         limpiarFormulario();
         $(document).ready(function(){
          function obtener_datos(){
            $.ajax({
              url:"tablaConsultaSolicitud.php",
              method: "POST",
              success: function(data){
                $("#result").html(data)
              }
            })
          }

          obtener_datos();
        })*/


          /*

             $('#result').ajax.reload();

          $('#result').fullCalendar('refetchEvents');

          window.open('mensajeBogota.php','_self');*/
        } else {
          RecolectarDatosGUI();
          EnviarInfo('validador2', NuevoEvento);
          
          
        }
      },
      error: function(){
        alert("hay un error ... y sirve punto 1");
      }


    });
  }

  function EnviarInfo(accion, objEvento, modal){
    $.ajax({
      type: 'POST',
      url: 'tablaSolicitud.php?accion='+accion,
      data: objEvento,
      success:function(msg){
        if (msg){
          Swal.fire({
            type: 'error',
            title: '¡La persona ya se agregó!',
            showConfirmButton: true
          }).then((result) => {
            if (result.value) {
            }
          })
        } else {
          RecolectarDatosGUI();
          agregarInfo('agregar', NuevoEvento);
        }
      },
      error: function(){
        alert("hay un error ... y sirve punto 2");
      }
    });
  }

  function limpiarFormulario(){

    $('#tipoIdentificacion').val('');
    $('#numeroIdentificacion').val('');
    $('#nombre').val('');
    $('#cargo').val('');

  }
</script>


<script>
  $(document).ready(function(){
    function obtener_datos(){
      $.ajax({
        url:"tablaConsultaSolicitud.php",
        method: "POST",
        success: function(data){
          $("#result").html(data)
        }
      })
    }

    obtener_datos();
  })
</script>
</body>
</html>