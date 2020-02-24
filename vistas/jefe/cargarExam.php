<?php 
include("../../config/connection.php");
session_start();

if (!isset($_SESSION['rolUsuario']) || $_SESSION['rolUsuario'] != "Administrador" && $_SESSION['rolUsuario'] != "Desarrollador"){

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
  <link rel="stylesheet" href="css/estiloss.css">
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
          <label><?php echo $_SESSION['nombreUsuario'] ?></label><br>
          <label><?php echo $_SESSION['rolUsuario']?></label><br></li>
          <li><a href="inicioJefe.php" class="irInicio"><span class="fa fa-home icon-menu"></span>Inicio</a></li>
                    <li><a href="agenda.php" class="irInicio"><span class="fa fa-calendar-check-o icon-menu"></span>Agenda</a></li>
                    <li><a href="enviadas.php" class="irInicio"><span class="fa fa-envelope icon-menu"></span>Solicitudes</a></li>
                    <li><a href="historial.php" class="irInicio"><span class="fa fa-history icon-menu"></span>Historial</a></li>
                    

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

  <div class="container" align="center">

    <br><br><br><br><br><br>
    <div class="row justify-content-center" style="color: white; background-color: rgba(0, 0, 0, 0.8);border-radius:10px; width: 70%;">
      <br>
      <?php  
      echo validar();  
      ?> 
      <h1 align="center">Resultados de busqueda</h1><br />  
      <div class="table-responsive" style="font-size: 16px; width: 80%;" id="tablam">  
       <table class="table table-bordered">  

         <?php  
         echo fetch_data();  
         ?>  
       </table>  
     </div>  
     <?php
     function validar()  
     {  
      $idpersona = $_POST['idpersona'];
      $output = '';  
      $server = 'TPCV359-85.teleperformance.co\SQL2016STD,5081';
      $database = 'HR_Analytics';
      $user = 'Aplicaciones';
      $pass = 'Aplicaciones2019';

      $connect = odbc_connect("Driver={SQL Server Native Client 11.0};Server=$server;Database=$database;", $user, $pass);

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
          }).then((result) => {
            if (result.value) {
              window.open('busqueda.php','_self');
            }
          })</script>";


        }
      }
      ?>

      <?php
      function fetch_data()  
      {  
        $idpersona = $_POST['idpersona'];
        $output = '';  
        $server = 'TPCV359-85.teleperformance.co\SQL2016STD,5081';
        $database = 'HR_Analytics';
        $user = 'Aplicaciones';
        $pass = 'Aplicaciones2019';

        $connect = odbc_connect("Driver={SQL Server Native Client 11.0};Server=$server;Database=$database;", $user, $pass);

        $sql = "SELECT fechacreacion, ciudadexamen, tipoexamen, motivoexamen, t_identificacion, no_id, nombre, areaaspira, cargoaspira, color, notasft, solicitador, cargosolicitador, poligrafista  FROM datos_generales_poli  WHERE no_id = ".$idpersona.";";  
        $result = odbc_exec($connect, $sql);  
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
          <th width="55%">TIPO DE IDENTIFICACIÓN DE LA PERSONA EVALUADA</th>  
          <th width="45%">'.$row["t_identificacion"].'</th> 
          </tr> 
          <tr>  
          <th width="55%">No. IDENTIFICACIÓN</th>  
          <th width="45%">'.$row["no_id"].'</th> 
          </tr> 
          <tr>  
          <th width="55%">NOMBRE DEL EVALUADO</th>  
          <th width="45%">'.$row["nombre"].'</th> 
          </tr> 
          <tr>  
          <th width="55%">CAMPAÑA O AREA A LA QUE ASPIRA</th>  
          <th width="45%">'.$row["areaaspira"].'</th> 
          </tr> 
          <tr>  
          <th width="55%">CARGO AL QUE ASPIRA</th>  
          <th width="45%">'.$row["cargoaspira"].'</th> 
          </tr> 
          <tr>  
          <th width="55%">CONCEPTO</th>  
          <th width="45%">'.$row["color"].'</th> 
          </tr> 
          <tr>  
          <th width="55%">NOTAS</th>  
          <th width="45%">'.$row["notasft"].'</th> 
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
          <th width="45%">'.$row["poligrafista"].'</th> 
          </tr>  
          ';  
        }  
        return $output;  
      }
      ?> 
      <form method="post" action="crearPDF.php" target="_blank">
        <?php
        $idp = $_POST['idpersona'];
        $neim = "Pre-empleo";
        ?>
        <input name="idpersona" value="<?php echo $idp;?>" hidden>
        <button type="submit" name="create_pdf" id="btnExportarSimple" class="btn btn-success" style="font-size: 16px; width: 20%;">Exportar a PDF</button>
        <br><br><br>
        
        
        <label>¡El examen completo está disponible!</label><br>
        
        <button type="button" id="btnAsignar" class="btn btn-success" style="font-size: 16px; width: 35%;">Ver examen completo</button>

        
        <br><br><br>
        <button type="button" id="btnVolver" class="btn btn-primary" style="font-size: 16px; width: 10%;">Volver</button>
        <br><br><br>
        <a href="../../../menu_files/<?php echo($neim) ?>.pdf" target="blank" class="btn btn-primary">mira el pdf we</a>
      </form>


      <div class="resumir">
  <h3>Cargue de examen realizado</h3><br>
<form action="cargarExamen.php" method="post" enctype="multipart/form-data">
  <?php
  echo "<input type='hidden' name = 'nombreArchivo' value = '123'/>";
  ?>  
  <input type="file" id="archivo" name="archivo" required onchange="return validarExt()">
  <br><br>
  <div id="visorArchivo"></div>
  <button type="submit" name="create_pdf" id="btnGuardarExamen" class="btn btn-success" style="font-size: 16px; width: 20%;">Guardar examen</button><br><br>
</form>
</div>
      
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

  <script type="text/javascript" src="js/mostrar_ocultar3.js"></script>
</body>
</html>