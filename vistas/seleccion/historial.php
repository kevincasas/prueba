<?php 
include("../../config/connection.php");
session_start();
$ccmsUsu = $_SESSION['ccmsUsuario'];

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
          <label><?php echo utf8_encode($_SESSION['nombreUsuario'])?></label><br>
          <label><?php echo utf8_encode($_SESSION['rolUsuario'])?></label><br></li>

          <!-- TITULAR -->

          <li><a href="inicioSeleccion.php" class="irInicio"><span class="fa fa-home icon-menu"></span>Inicio</a></li>
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
<div class="containerEnviados" align="center">
  <br><br>

  <br><br>
  <br>
  <br><br>
  <div class="row justify-content-center" style="color: white; background-color: rgba(0, 0, 0, 0.8);border-radius:9px; width: 95%;">
    <br /><br /><br />


    <!--class="col-md-8 col-md-offset-2"-->
    <div class="usu">
      <h2>Historial de Solicitudes</h2>
      <style>h2 { font-size: 55 }</style><br>
      <table class="table table-bordered table-responsive" style="width: 95%;">
        <tr>
          <!--<td>ID</td>-->
          <td><b>Fecha</b></td>
          <td><b>Hora</b></td>
          <td><b>Nombre</b></td>
          <td><b>Tipo Identificación</b></td>
          <td><b>Número Identificación</b></td>
          <td><b>Cargo</b></td>
          <td><b>Área</b></td>
          <td><b>Site</b></td>
          <td><b>Tipo Convocatoria</b></td>
          <td><b>Estado</b></td>
        </tr>

        <?php
        $consulta = "USE HR_Analytics; SELECT fechaPeticion, horaPeticion, nombreEvaluado, tipoIdentificacion, numeroIdentificacion, cargoEvaluado, areaEvaluado, ciudadPeticion, tipoConvocatoria, estadoPeticion
        FROM solicitud_poli WHERE ccmsRegistrador = '$ccmsUsu'";

        $ejecutar = odbc_exec($connect, $consulta);

        $i = 0;

        while($fila = odbc_fetch_array($ejecutar)){
          $fechaPeticion = $fila['fechaPeticion'];
          $horaPeticion = $fila['horaPeticion'];
          $nombreEvaluado = $fila['nombreEvaluado'];
          $tipoIdentificacion = $fila['tipoIdentificacion'];
          $numeroIdentificacion = $fila['numeroIdentificacion'];
          $cargoEvaluado = $fila['cargoEvaluado'];
          $areaEvaluado = $fila['areaEvaluado'];
          $ciudadPeticion = $fila['ciudadPeticion'];
          $tipoConvocatoria = $fila['tipoConvocatoria'];
          $estadoPeticion = $fila['estadoPeticion'];
          $i++;

          ?>

          <tr align="center">
            <!--<td><?php //echo $id; ?></td>-->

            <td><?php echo utf8_encode($fechaPeticion); ?></td>
            <td><?php echo utf8_encode($horaPeticion); ?></td>
            <td><?php echo utf8_encode($nombreEvaluado); ?></td>
            <td><?php echo utf8_encode($tipoIdentificacion); ?></td>
            <td><?php echo utf8_encode($numeroIdentificacion); ?></td>
            <td><?php echo utf8_encode($cargoEvaluado); ?></td>
            <td><?php echo utf8_encode($areaEvaluado); ?></td>
            <td><?php echo utf8_encode($ciudadPeticion); ?></td>
            <td><?php echo utf8_encode($tipoConvocatoria); ?></td>
            <td><?php echo utf8_encode($estadoPeticion); ?></td>
          </i></a></td>
        </tr>

      <?php } ?>
      <br>
    </table>
    <!--<input type="" name="" value="<?php  $usuario; ?>">-->
    <br>
    <a href="solicitud.php" class="btn btn-danger" style = "width: 20%; font-size: 15px;font-family: 'Segoe UI';"><i class="fa fa-plus" aria-hidden="true"></i>  Nueva solicitud</a><br>
    <a href="enviadas.php" class="btn btn-danger" style = "width: 20%; font-size: 15px;font-family: 'Segoe UI';"><i class="fa fa-paper-plane " aria-hidden="true"></i>  Solicitudes enviadas</a><br><br>
  </div>

  <?php
  if(isset($_POST['insert'])){
    $idccms = $_POST['ccms'];
    $usuario = $_POST['nombre'];
    $pass = $_POST['contra'];
    $cargo = $_POST['rol'];

    $revisar = "SELECT * FROM usuarios_polig WHERE ccms = '$idccms';";
    $valida = odbc_exec($connect, $revisar);
    $saber = odbc_fetch_row($valida);

    if ($saber>0){
      echo "<script>Swal.fire({
        type: 'error',
        title: '¡Ya existe un usuario con ese ID CCMS!',
        showConfirmButton: false,
        timer: 1500
      })</script>";
    } else {
      $insertar = "INSERT INTO usuarios_polig(ccms, nombre, contra, rol)VALUES('$idccms','$usuario', '$pass', '$cargo')";

      $ejecutar = odbc_exec($connect, $insertar);

      if ($ejecutar){


        echo "<script>Swal.fire({
          type: 'success',
          title: 'El usuario fue ingresado al sistema',
          showConfirmButton: false,
          timer: 1500
        })</script>";
             /* sleep(10);
             echo "<script>window.open('busqueda.php', '_self')</script>";*/
           }
         }
       }

       ?>

       <?php
       if(isset($_GET['editar'])){
        $editar_id = $_GET['editar'];
        $consulta = " USE HR_Analytics; SELECT ccms, nombre, contra, rol FROM usuarios_polig WHERE id='$editar_id'";
        $ejecutar = odbc_exec($connect, $consulta);

        $fila = odbc_fetch_array($ejecutar);

        $idccms = $fila['ccms'];
        $usuario = $fila['nombre'];
        $password = $fila['contra'];
        $rol = $fila['rol'];

      }
      ?>

      <div class="col-md-8 col-md-offset-2" id = "futo" hidden>
        <form method="POST" action="">
          <div class="form-group">
            <label>ID CCMS:</label>
            <input type="number" name="idccms" class="form-control" value="<?php echo $idccms; ?>"><br />
          </div>
          <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="<?php echo $usuario; ?>"><br />
          </div>
          <div class="form-group">
            <label>Contraseña:</label>
            <input type="password" name="passw" class="form-control" value="<?php echo $password; ?>"><br />
          </div>
          <div class="form-group">
            <label>Rol: </label>
            <select name="rol" class="form-control" style="width: 40%;background-color:rgba(0, 0, 0, 0.7); color: white;font-size: 18;">
              <option><?php echo $rol; ?></option>
            </select><br />
          </div>
          <div class="form-group">                
            <input type="submit" name="actualizar" class="btn btn-warning" value="ACTUALIZAR DATOS"><br />
          </div>
          <div class="form-group">                
            <input type="submit" name="cancelar" class="btn btn-danger" value="CANCELAR"><br />
          </div>
        </form>
      </div>

      <?php
      if(isset($_GET['editar'])){
        include("editar.php");
      }

      ?>  

      <?php   
      if(isset($_GET['borrar'])){

        $borrar_id = $_GET['borrar'];

        $borrar = "DELETE FROM usuarios_polig WHERE id='$borrar_id'";

        $ejecutar = odbc_exec($connect, $borrar);

        if($ejecutar){

          echo "<script>Swal.fire({
            type: 'success',
            title: 'El usuario fue eliminado del sistema',
            showConfirmButton: true
            }).then(function(){
         
                window.open('editarUsuarios.php','_self');
              
            })</script>";
          }
        }
        ?>

      </div>
    </div><br><br>

    <script type="text/javascript" src="js/mostrar_ocultar2.js"></script>
  </body>
  </html>