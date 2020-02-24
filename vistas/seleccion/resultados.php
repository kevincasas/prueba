<?php 
include("../../config/connection.php");
session_start();

$_SESSION['nombreExamen'] = "";
$hid = "";
if (!isset($_SESSION['rolUsuario']) || $_SESSION['rolUsuario'] != "Analista" && $_SESSION['rolUsuario'] != "Desarrollador"){

  header('location: ../../index.php');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Resultados de busqueda</title>
  <link rel="icon" type="" href="css/pluma.ico">
  <link rel="stylesheet" href="css/estilos.css">
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
        <li class="title-menu"><i id = "logoUsuario" class="fa fa-user-circle" aria-hidden="true" style="font-size: 70px;"></i><br><br>
          <label><?php echo utf8_encode($_SESSION['nombreUsuario']) ?></label><br>
          <label><?php echo utf8_encode($_SESSION['rolUsuario'])?></label><br></li>
          <li><a href="inicioSeleccion.php" class="irInicio"><span class="fa fa-home icon-menu"></span>Inicio</a></li>
          <li><a href="agenda.php" class="irInicio"><span class="fa fa-calendar-check-o icon-menu"></span>Agenda</a></li>
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

    <div class="container" align="center">

      <br><br><br><br><br><br>
      <div class="row justify-content-center" style="color: white; background-color: rgba(0, 0, 0, 0.8);border-radius:10px; width: 70%;">
        <br>
        <?php  
        echo validar();  
        ?> 
        <h1 align="center">Resultados de busqueda</h1><br />  
        <div class="form-group" style="width: 100%;">
          <label class="checkbox-inline" style="font-size: 13px; font-family: 'Segoe UI';">
            <input type="checkbox" id="checkboxConcepto" value="opcion_3" onclick="mostrarConcepto()"> Concepto
          </label>
          <label class="checkbox-inline" style="font-size: 13px; font-family: 'Segoe UI';">
            <input type="checkbox" id="checkboxNovedad" value="opcion_3" onclick="mostrarNovedad()"> Novedad
          </label>

        </div><br>
        <div class="tblConcepto" hidden>
          <div class="table-responsive" style="font-size: 16px; width: 80%;" id="tablaConcepto">  
           <table class="table table-bordered">  

             <?php  
             echo fetch_concepto();  
             ?>  
           </table>  
         </div>
       </div>
       <div class="tblNovedad" hidden>
         <div class="table-responsive" style="font-size: 16px; width: 80%;" id="tablaNovedad">  
           <table class="table table-bordered">  

             <?php  
             echo fetch_novedad();  
             ?>  
           </table>  
         </div>
       </div>
       <div class="tblPreliminar" hidden>
         <div class="table-responsive" style="font-size: 16px; width: 80%;" id="tablaPreliminar">  
           <table class="table table-bordered">  

             <?php  
             echo fetch_preliminar();  
             ?>  
           </table>  
         </div>
       </div>
       <?php
       function validar()  
       {  
        $idpersona = $_POST['idpersona'];
        $output = '';

        $connect = odbc_connect("Driver={SQL Server ".$_SESSION['nat']."};Server=".$_SESSION['server'].";Database=".$_SESSION['database'].";", $_SESSION['user'], $_SESSION['pass']);

        $sql = "SELECT fechacreacion, ciudadexamen, tipoexamen, t_identificacion, no_id, nombre, areaaspira, cargoaspira, solicitador  FROM datos_generales_poli  WHERE no_id = ".$idpersona.";";  
        $result = odbc_exec($connect, $sql);  
        $p=0;
        while ($row = odbc_fetch_array($result)){
          $p++;
        }
        if ($p == 0){

          echo "<script>Swal.fire({
            type: 'error',
            title: '¡No se encontraron registros de exámenes!',
            showConfirmButton: true
            }).then(function() {

              window.open('busqueda.php','_self');
            })</script>";

          }
        }
        ?>

        <?php
        function fetch_concepto()  
        {  
          $idpersona = $_POST['idpersona'];
          $output = '';  

          $connect = odbc_connect("Driver={SQL Server ".$_SESSION['nat']."};Server=".$_SESSION['server'].";Database=".$_SESSION['database'].";", $_SESSION['user'], $_SESSION['pass']);

          $sql = "SELECT fechacreacion, ciudadexamen, tipoexamen, motivoexamen, estadoexamen, 
          t_identificacion, no_id, nombre, areaaspira, cargoaspira,
          case when color = 'Rojo' then 'NO PASO'
          when color = 'Verde' then 'SI PASO'
          when color = '' then ''
          end  color, estadocolor,
          notasft, solicitador, cargosolicitador, poligrafista, nombreExamen FROM datos_generales_poli  WHERE no_id = ".$idpersona.";";  
          $result = odbc_exec($connect, $sql);  
          $nombreExamen = odbc_result(odbc_exec($connect, $sql), 'nombreExamen');
          $_SESSION['nombreExamen'] = $nombreExamen;
          while($row = odbc_fetch_array($result))  
          {       
            $output .= '

            <tr>
            <th colspan="2"><p align="center">EXAMEN DE POLIGRAFÍA</p></th>
            </tr>
            <tr>  
            <th width="55%">FECHA EN QUE SE REALIZA EL EXAMEN</th>
            <th width="45%">'.utf8_encode($row["fechacreacion"]).'</th> 
            </tr>  
            <tr>  
            <th width="55%">CIUDAD EN QUE SE REALIZA</th>  
            <th width="45%">'.utf8_encode($row["ciudadexamen"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">TIPO DE EXAMEN</th>  
            <th width="45%">'.utf8_encode($row["tipoexamen"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">MOTIVO DE EXAMEN</th>  
            <th width="45%">'.utf8_encode($row["motivoexamen"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">ESTADO DE EXAMEN</th>  
            <th width="45%">'.$row["estadoexamen"].'</th> 
            </tr> 
            <tr>  
            <th width="55%">TIPO DE IDENTIFICACIÓN DE LA PERSONA EVALUADA</th>  
            <th width="45%">'.utf8_encode($row["t_identificacion"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">No. IDENTIFICACIÓN</th>  
            <th width="45%">'.$row["no_id"].'</th> 
            </tr> 
            <tr>  
            <th width="55%">NOMBRE DEL EVALUADO</th>  
            <th width="45%">'.utf8_encode($row["nombre"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">CAMPAÑA O AREA A LA QUE ASPIRA</th>  
            <th width="45%">'.utf8_encode($row["areaaspira"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">CARGO AL QUE ASPIRA</th>  
            <th width="45%">'.utf8_encode($row["cargoaspira"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">CONCEPTO</th>  
            <th width="45%">'.$row["color"].'</th> 
            </tr> 
            <tr>  
            <th width="55%">NOTAS</th>  
            <th width="45%">'.utf8_encode($row["notasft"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">PERSONA QUE SOLICITA EL EXAMEN</th>  
            <th width="45%">'.utf8_encode($row["solicitador"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">CARGO DE LA PERSONA QUE SOLICITA</th>  
            <th width="45%">'.utf8_encode($row["cargosolicitador"]).'</th> 
            </tr> 
            <tr> 
            <th width="55%">POLIGRAFISTA</th>  
            <th width="45%">'.utf8_encode($row["poligrafista"]).'</th> 
            </tr>  
            ';  
          }  
          return $output;  
        }
        ?> 

        <?php
        function fetch_novedad()  
        {  
          $idpersona = $_POST['idpersona'];
          $output = '';

          $connect = odbc_connect("Driver={SQL Server ".$_SESSION['nat']."};Server=".$_SESSION['server'].";Database=".$_SESSION['database'].";", $_SESSION['user'], $_SESSION['pass']);

          $sql = "SELECT fechacreacion, ciudadexamen, tipoexamen, motivoexamen, estadoexamen, 
          t_identificacion, no_id, nombre, areaaspira, cargoaspira,
          case when color = 'Rojo' then 'NO PASO'
          when color = 'Verde' then 'SI PASO'
          when color = '' then ''
          end  color, estadocolor,
          notasft, solicitador, cargosolicitador, poligrafista, nombreExamen FROM datos_generales_poli  WHERE no_id = ".$idpersona.";";  
          $result = odbc_exec($connect, $sql);  
          $nombreExamen = odbc_result(odbc_exec($connect, $sql), 'nombreExamen');
          $_SESSION['nombreExamen'] = $nombreExamen;
          while($row = odbc_fetch_array($result))  
          {       
            $output .= '

            <tr>
            <th colspan="2"><p align="center">EXAMEN DE POLIGRAFÍA</p></th>
            </tr>
            <tr>  
            <th width="55%">FECHA EN QUE SE REALIZA EL EXAMEN</th>
            <th width="45%">'.$row["fechacreacion"].'</th> 
            </tr>  
            <tr>  
            <th width="55%">CIUDAD EN QUE SE REALIZA</th>  
            <th width="45%">'.utf8_encode($row["ciudadexamen"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">TIPO DE EXAMEN</th>  
            <th width="45%">'.utf8_encode($row["tipoexamen"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">MOTIVO DE EXAMEN</th>  
            <th width="45%">'.utf8_encode($row["motivoexamen"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">ESTADO DE EXAMEN</th>  
            <th width="45%">'.utf8_encode($row["estadoexamen"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">TIPO DE IDENTIFICACIÓN DE LA PERSONA EVALUADA</th>  
            <th width="45%">'.utf8_encode($row["t_identificacion"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">No. IDENTIFICACIÓN</th>  
            <th width="45%">'.$row["no_id"].'</th> 
            </tr> 
            <tr>  
            <th width="55%">NOMBRE DEL EVALUADO</th>  
            <th width="45%">'.utf8_encode($row["nombre"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">CAMPAÑA O AREA A LA QUE ASPIRA</th>  
            <th width="45%">'.utf8_encode($row["areaaspira"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">CARGO AL QUE ASPIRA</th>  
            <th width="45%">'.utf8_encode($row["cargoaspira"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">NOVEDAD</th>  
            <th width="45%">'.$row["color"].'</th> 
            </tr> 
            <tr>  
            <th width="55%">NOTAS</th>  
            <th width="45%">'.utf8_encode($row["notasft"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">PERSONA QUE SOLICITA EL EXAMEN</th>  
            <th width="45%">'.utf8_encode($row["solicitador"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">CARGO DE LA PERSONA QUE SOLICITA</th>  
            <th width="45%">'.utf8_encode($row["cargosolicitador"]).'</th> 
            </tr> 
            <tr> 
            <th width="55%">POLIGRAFISTA</th>  
            <th width="45%">'.utf8_encode($row["poligrafista"]).'</th> 
            </tr>  
            ';  
          }  
          return $output;  
        }
        ?> 


        <?php
        function fetch_preliminar()  
        {  
          $idpersona = $_POST['idpersona'];
          $output = '';  
          $server = 'TPCV359-85.teleperformance.co\SQL2016STD,5081';
          $database = 'HR_Analytics';
          $user = 'Aplicaciones';
          $pass = 'Aplicaciones2019';

          $connect = odbc_connect("Driver={SQL Server ".$_SESSION['nat']."};Server=".$_SESSION['server'].";Database=".$_SESSION['database'].";", $_SESSION['user'], $_SESSION['pass']);

          $sql = "SELECT fechacreacion, ciudadexamen, tipoexamen, motivoexamen, estadoexamen, t_identificacion, no_id, nombre, areaaspira, cargoaspira, diagnostico, rq, color, estadocolor, admisiones, notasft, solicitador, cargosolicitador, poligrafista, nombreExamen  FROM datos_generales_poli  WHERE no_id = ".$idpersona.";";  
          $result = odbc_exec($connect, $sql);  
          $nombreExamen = odbc_result(odbc_exec($connect, $sql), 'nombreExamen');
          $_SESSION['nombreExamen'] = $nombreExamen;
          while($row = odbc_fetch_array($result))  
          {       
            $output .= '

            <tr>
            <th colspan="2"><p align="center">EXAMEN DE POLIGRAFÍA</p></th>
            </tr>
            <tr>  
            <th width="55%">FECHA EN QUE SE REALIZA EL EXAMEN</th>
            <th width="45%">'.$row["fechacreacion"].'</th> 
            </tr>  
            <tr>  
            <th width="55%">CIUDAD EN QUE SE REALIZA</th>  
            <th width="45%">'.utf8_encode($row["ciudadexamen"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">TIPO DE EXAMEN</th>  
            <th width="45%">'.$row["tipoexamen"].'</th> 
            </tr> 
            <tr>  
            <th width="55%">MOTIVO DE EXAMEN</th>  
            <th width="45%">'.$row["motivoexamen"].'</th> 
            </tr> 
            <tr>  
            <th width="55%">ESTADO DE EXAMEN</th>  
            <th width="45%">'.$row["estadoexamen"].'</th> 
            </tr> 
            <tr>  
            <th width="55%">TIPO DE IDENTIFICACIÓN DE LA PERSONA EVALUADA</th>  
            <th width="45%">'.$row["t_identificacion"].'</th> 
            </tr> 
            <tr>  
            <th width="55%">No. IDENTIFICACIÓN</th>  
            <th width="45%">'.$row["no_id"].'</th> 
            </tr> 
            <tr>  
            <th width="55%">NOMBRE DEL EVALUADO</th>  
            <th width="45%">'.utf8_encode($row["nombre"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">CAMPAÑA O AREA A LA QUE ASPIRA</th>  
            <th width="45%">'.utf8_encode($row["areaaspira"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">CARGO AL QUE ASPIRA</th>  
            <th width="45%">'.utf8_encode($row["cargoaspira"]).'</th> 
            </tr>
            <tr>  
            <th width="55%">DIAGNOSTICO</th>  
            <th width="45%">'.utf8_encode($row["diagnostico"]).'</th> 
            </tr>
            <tr>  
            <th width="55%">RQ</th>  
            <th width="45%">'.utf8_encode($row["rq"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">NOTAS FASE DEL TEST</th>  
            <th width="45%">'.utf8_encode($row["notasft"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">CONCEPTO</th>  
            <th width="45%">'.$row["color"].' '.$row["estadocolor"].'</th> 
            </tr> 
            <tr>  
            <th width="55%">ADMISIONES</th>  
            <th width="45%">'.utf8_encode($row["admisiones"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">ADMISIONES POST TEST</th>  
            <th width="45%">'.utf8_encode($row["notasft"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">PERSONA QUE SOLICITA EL EXAMEN</th>  
            <th width="45%">'.utf8_encode($row["solicitador"]).'</th> 
            </tr> 
            <tr>  
            <th width="55%">CARGO DE LA PERSONA QUE SOLICITA</th>  
            <th width="45%">'.utf8_encode($row["cargosolicitador"]).'</th> 
            </tr> 
            <tr> 
            <th width="55%">POLIGRAFISTA</th>  
            <th width="45%">'.utf8_encode($row["poligrafista"]).'</th> 
            </tr>  
            ';  
          }  
          return $output;  
        }
        ?> 
        <form method="post" action="crearPDF.php" target="_blank">
          <?php
          $idp = $_POST['idpersona'];
          $neim = $_SESSION['nombreExamen'];
          ?>
          <input name="idpersona" value="<?php echo $idp;?>" hidden>
          <input name="tipo" id="tipo" value="" hidden>
          <div class="exportar" hidden>
            <button type="submit" name="create_pdf" id="btnExportarSimple" class="btn btn-success" style="font-size: 16px; width: 20%;">Exportar a PDF</button></div>

            <br><br>
            <button type="button" id="btnVolver" class="btn btn-primary" style="font-size: 16px; width: 10%;">Volver</button>
            <br><br><br>

          </form>



        </div>
      </div><br><br>

      <script type="text/javascript">
        $('#btnVolver').click(function(){
          window.open('busqueda.php','_self');
        });
      </script>

      <script type="text/javascript">
        function validarExt(){
          var archivoInput = document.getElementById('archivo');
          var archivoRuta = archivo.value;
          var extPermitida = /(.pdf)$/i;

          if(!extPermitida.exec(archivoRuta)){
            alert('Por favor selecciona un archivo .PDF');
            archivoInput.value = '';
            document.getElementById('visorArchivo').innerHTML= '';
            return false;
          }
          else{
            if(archivoInput.files && archivoInput.files[0]){
              var visor = new FileReader();
              visor.onload = function(e)
              {
                document.getElementById('visorArchivo').innerHTML=
                '<p>Vista Previa:</p><embed src = "'+e.target.result+'" width = "500" height = "500" ><br><br>';
              }
              visor.readAsDataURL(archivoInput.files[0]);
            }
          }
        }
      </script>

      <script type="text/javascript">
        function mostrarValidar(){
          if ((document.getElementById("checkboxConcepto").checked==false) && (document.getElementById("checkboxNovedad").checked==false) ){
            $(".tblNovedad").attr('hidden', true);
            $(".tblConcepto").attr('hidden',true);
            $(".exportar").attr('hidden',true);
          }
        }

        function mostrarConcepto(){

          document.getElementById("checkboxNovedad").checked = false;
          $(".tblNovedad").attr('hidden', true);
          $('.tblConcepto').attr('hidden',false);
          document.getElementById("tipo").value = "Concepto";
          $(".exportar").attr('hidden',false);
          mostrarValidar();
        }


        function mostrarNovedad(){

          document.getElementById("checkboxConcepto").checked = false;
          $(".tblNovedad").attr('hidden', false);
          $(".tblConcepto").attr('hidden',true);
          document.getElementById("tipo").value = "Novedad";
          $(".exportar").attr('hidden',false);
          mostrarValidar();
        }

        function mostrarExamenCompleto(){

          $('.examenCompleto').attr('hidden', false);
        }
      </script>

      <script type="text/javascript" src="js/mostrar_ocultar3.js"></script>
    </body>
    </html>