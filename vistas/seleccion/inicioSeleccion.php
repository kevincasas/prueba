<?php
include("../../config/connection.php");
session_start();

if (!isset($_SESSION['rolUsuario']) || $_SESSION['rolUsuario'] != "Analista" && $_SESSION['rolUsuario'] != "Desarrollador") {

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
        <script src="js/push.min.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <header>
            <span id="button-menu" class="fa fa-bars"></span>

            <nav class="navegacion">
                <ul class="menu">
                    <!-- TITULAR -->
                    <li class="title-menu"><i id = "logoUsuario" class="fa fa-user-circle" aria-hidden="true" style="font-size: 70px;"></i><br><br>
                        <label><?php echo utf8_encode($_SESSION['nombreUsuario']) ?></label><br>
                        <label><?php echo utf8_encode($_SESSION['rolUsuario']) ?></label><br></li>

                    <!-- TITULAR -->

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
        <div class="inicio">
            <div class="cajaBusqueda2">

                <?php
                $Bienvenida = null;
                if ($_SESSION['generoUsuario'] == "Masculino") {
                    $Bienvenida = "Bienvenido ";
                } else if ($_SESSION['generoUsuario'] == "Femenino") {
                    $Bienvenida = "Bienvenida ";
                }
                ?>
                <p align="center" style="font-size: 40px; font-family: 'Segoe UI';"><?php echo $Bienvenida;
                echo utf8_encode($_SESSION['nombreUsuario']) ?></p><br>          
                <br>
                <?php
                $mensaje = null;
                $ccmsRegistrador = $_SESSION['ccmsUsuario'];
                $notificaciones = odbc_result(odbc_exec($connect, "SELECT COUNT(*) AS notificaciones FROM notificaciones_poli WHERE ccmsRegistrador = '$ccmsRegistrador'"), "notificaciones");

                if ($notificaciones > 0) {
                    $mensaje = "Hay " . $notificaciones . " notificaciones nuevas";
                } else {
                    $mensaje = "No hay notificaciones nuevas";
                }
                ?>

                <label onclick="mostrarlo()" style="font-size: 16px; font-family: 'Segoe UI'; cursor:pointer;"><?php echo $mensaje; ?></label>
            </div>
        </div>


        <div class="container" hidden align="center">
            <br><br><br><br><br><br><br>
            <div class="row justify-content-center" style="color: white; background-color: rgba(0, 0, 0, 0.8);border-radius:9px; width: 70%;">
                <br /><br /><br />
            </div>
        </div><br><br>
        <div class="modal fade" id="modalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="font-size: 18px;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tituloEvento" style="font-size: 18px;">Centro de notificaciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">

                            <table class="table table-responsive" style="width: 95%;">
                                <tr>
                                    <td style="width: 70%;"><div class="form-group"><b><center>Tipo de evento</center></b></td>
                                    <td style="width: 25%;"><div class="form-group"><b>Cantidad</b></td>
                                    <td style="width: 5%;"><div class="form-group"><b></b></td>
                                </tr>

                                <?php
                                $ccmsRegistrador = $_SESSION['ccmsUsuario'];
                                $consulta = "SELECT DISTINCT CASE WHEN tipoNotificacion = 'AsignoCita' then'Asignación de cupo' end tipoEvento ,COUNT(*) AS cantidad FROM notificaciones_poli WHERE tipoNotificacion = 'AsignoCita' AND ccmsRegistrador = '$ccmsRegistrador' GROUP BY tipoNotificacion
                                UNION
                                SELECT DISTINCT CASE WHEN tipoNotificacion = 'Movimiento' then'Movimiento de cupo' end tipoEvento ,COUNT(*) AS cantidad FROM notificaciones_poli WHERE tipoNotificacion = 'Movimiento' AND ccmsRegistrador = '$ccmsRegistrador' GROUP BY tipoNotificacion
                                UNION
                                SELECT DISTINCT CASE WHEN tipoNotificacion = 'ExamTerminado' then'Finalización de examen' end tipoEvento ,COUNT(*) AS cantidad FROM notificaciones_poli WHERE tipoNotificacion = 'ExamTerminado' AND ccmsRegistrador = '$ccmsRegistrador' GROUP BY tipoNotificacion";

                                $ejecutar = odbc_exec($connect, utf8_decode($consulta));

                                $i = 0;

                                while ($fila = odbc_fetch_array($ejecutar)) {
                                    $tipoNotificacion = $fila['tipoEvento'];
                                    $ccmsRegistrador = $fila['cantidad'];
                                    $i++;
                                    ?>

                                    <tr align="center">
                                      <!--<td><?php //echo $id;  ?></td>-->

                                        <td><?php echo utf8_encode($tipoNotificacion); ?></td>
                                        <td><?php echo utf8_encode($ccmsRegistrador); ?></td>
                                        <td><a href='agenda.php' class='editarUsuario'><i class='fa fa-eye' aria-hidden='true'></i></a></td>

                                    </tr>

                                <?php } ?>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" id="btnLimpiar" class="btn btn-success" style="font-size: 16px;">Limpiar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size: 16px;">Volver</button>
                    </div>
                </div>
            </div>
        </div>



        <?php
        $ccmsRegistrador = $_SESSION['ccmsUsuario'];
        $notificaciones = odbc_result(odbc_exec($connect, "SELECT COUNT(*) AS notificaciones FROM notificaciones_poli WHERE ccmsRegistrador = '$ccmsRegistrador'"), "notificaciones");
        ?>
        <script type="text/javascript">

            Push.create("Centro de notificaciones", {
                body: "Hay <?php echo $notificaciones ?> notificaciones nuevas.",
                icon: "css/LogoTP.PNG",
                timeout: 5000,
                onClick: function () {
                    window.location = "http://localhost:8080/poligrafia/vistas/seleccion/agenda.php";
                    this.close();
                }
            });
        </script>

        <script type="text/javascript">
            function mostrarlo() {
                $('#modalEventos').modal('show');
            }

            var NuevoEvento;

  $('#btnLimpiar').click(function(){
    
        validarInsertarInfo('limpiar', NuevoEvento);


 });

  function validarInsertarInfo(accion, objEvento, modal){
    $.ajax({
      type: 'POST',
      url: 'tablaSolicitud.php?accion='+accion,
      data: objEvento,
      success:function(msg){
        if (msg){

          Swal.fire({
            type: 'success',
            title: '¡Las notificaciones se limpiaron!',
            showConfirmButton: true
            }).then(function() {
      
                window.open('inicioSeleccion.php','_self');
              
            })

        } else {
        }
      },
      error: function(){
        alert("hay un error ... y sirve");
      }

    });
  }
        </script>

        <script type="text/javascript" src="js/mostrar_ocultar2.js"></script>
    </body>
</html>