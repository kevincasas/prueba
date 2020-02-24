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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Poligrafía TP</title>
    <link rel="icon" type="" href="css/pluma.ico">
    <link rel="stylesheet" href="css/styleAgendas.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/main.js"></script>
    <script src="js/sweetalert.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/moment.min.js"></script>

    <link rel="stylesheet" href="css/fullcalendar.min.css">
    <script src="js/fullcalendar.min.js"></script>
    <script src="js/es.js"></script>
    <script src="js/push.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <style>
        .fc th{
            padding: 10px 0px;
            vertical-align: middle;
            font-size: 20px;
        }

        .fc tr{
            font-size: 17px;
            vertical-align: middle;
        }

        .fc h2{
            font-size: 30px;
        }

        .fc button{
            font-size: 16px;    
        }

        .fc td.fc-day-top.fc-mon.fc-today{
            color: black;
        }

        .fc td.fc-day-top.fc-tue.fc-today{
            color: black;
        }

        .fc td.fc-day-top.fc-wed.fc-today{
            color: black;
        }

        .fc td.fc-day-top.fc-thu.fc-today{
            color: black;
        }

        .fc td.fc-day-top.fc-fri.fc-today{
            color: black;
        }

        .fc td.fc-day-top.fc-sat.fc-today{
            color: black;
        }

        .fc td.fc-day-top.fc-sun.fc-today{
            color: black;
        }
    </style>
</head>
<body >
    <header>
        <span id="button-menu" class="fa fa-bars"></span>

        <nav class="navegacion">
            <ul class="menu">

                <li class="title-menu"><i id = "logoUsuario" class="fa fa-user-circle" aria-hidden="true" style="font-size: 70px;"></i><br><br>
                    <label><?php echo $_SESSION['nombreUsuario'] ?></label><br>
                    <label><?php echo $_SESSION['rolUsuario']?></label><br></li>


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
        </header><br><br><br><br><br><br><br><br>
        <div class="containersss" align="center">
            <div class="row justify-content-center" style="color: white; background-color: rgba(0, 0, 0, 0.8);border-radius:9px; width: 85%;">
                <div id="CalendarioWeb"></div><br><br><br><br>

            </div></div><br><br><br>
            <!--</div>-->



            <script>
                $(document).ready(function(){
                    $('#CalendarioWeb').fullCalendar({
                        header:{
                            left:'today,prev,next,',
                            center:'title'
                        },
                        dayClick: function(date,jsEvent,view){
                    //$('#btnGuardar').prop("disabled",true);
                    limpiarFormulario();
                    $('#txtFecha').val(date.format());
                    $('#modalEventos').modal('show');

                },

                events:'https://hranalytics.teleperformance.co/poligrafia/vistas/seleccion/eventoSolicitantes.php',




            });
                });
            </script>

            <div class="modal fade" id="modalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="font-size: 18px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tituloEvento" style="font-size: 18px;">Asignación de cupo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Fecha:</label>
                                    <input type="text" id="txtFecha" name="txtFecha" class="form-control" style="font-size: 16px;" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Hora:</label>
                                    <select class="form-control" id="txtHora" style="font-size: 16px; height: 34px;">
                                        <option value="6:00 AM">6:00 AM</option>
                                        <option value="8:00 AM">8:00 AM</option>
                                        <option value="10:00 AM">10:00 AM</option>
                                        <option value="12:00 PM">12:00 PM</option>
                                        <option value="2:00 PM">2:00 PM</option>
                                        <option value="4:00 PM">4:00 PM</option>
                                        <option value="6:00 PM">6:00 PM</option>
                                        <option value="8:00 PM">8:00 PM</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnGuardar" class="btn btn-success" style="font-size: 16px;">Guardar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size: 16px;">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>

                var NuevoEvento;

                $('#btnGuardar').click(function(){
                    RecolectarDatosGUI();
                    EnviarInformacion2('asignar', NuevoEvento);
                });

                function RecolectarDatosGUI(){
                    NuevoEvento = {
                        start:$('#txtFecha').val(),
                        hora: $('#txtHora').val()
                    };
                }

                function EnviarInformacion2(accion, objEvento, modal){
                    $.ajax({
                        type: 'POST',
                        url: 'eventoSolicitantes.php?accion='+accion,
                        data: objEvento,
                        success:function(msg){
                            if (msg){
                                $('#CalendarioWeb').fullCalendar('refetchEvents');
                                window.open('mensajeBogota.php','_self');
                            } else {
                                alert("no se asignó");
                            }
                        },
                        error: function(){
                            alert("hay un error ...");
                        }


                    });
                }

                function limpiarFormulario(){
                    $('#txtTitulo').val('');
                    $('#txtHora').val('');
                }
            </script>

            <script type="text/javascript" src="js/mostrar_ocultar2.js"></script>
        </body>
        </html>