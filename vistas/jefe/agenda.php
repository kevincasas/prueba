<?php 
include("../../config/connection.php");
session_start();

if (!isset($_SESSION['rolUsuario']) || $_SESSION['rolUsuario'] != "Administrador" && $_SESSION['rolUsuario'] != "Desarrollador") {

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
	<link rel="stylesheet" href="css/estiloagenda.css">
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
			color: #fff;
		}

		.fc td.fc-day-top.fc-tue.fc-today{
			color: #fff;
		}

		.fc td.fc-day-top.fc-wed.fc-today{
			color: #fff;
		}

		.fc td.fc-day-top.fc-thu.fc-today{
			color: #fff;
		}

		.fc td.fc-day-top.fc-fri.fc-today{
			color: #fff;
		}

		.fc td.fc-day-top.fc-sat.fc-today{
			color: #fff;
		}

		.fc td.fc-day-top.fc-sun.fc-today{
			color: #fff;
		}

		.fc td.fc-day.fc-widget-content.fc-mon.fc-today{
			background-color: rgba(121, 121, 121, 0.5);
		}

		.fc td.fc-day.fc-widget-content.fc-tue.fc-today{
			background-color: rgba(121, 121, 121, 0.5);
		}

		.fc td.fc-day.fc-widget-content.fc-wed.fc-today{
			background-color: rgba(121, 121, 121, 0.5);
		}

		.fc td.fc-day.fc-widget-content.fc-thu.fc-today{
			background-color: rgba(121, 121, 121, 0.5);
		}

		.fc td.fc-day.fc-widget-content.fc-fri.fc-today{
			background-color: rgba(121, 121, 121, 0.5);
		}

		.fc td.fc-day.fc-widget-content.fc-sat.fc-today{
			background-color: rgba(121, 121, 121, 0.5);
		}

		.fc td.fc-day.fc-widget-content.fc-sun.fc-today{
			background-color: rgba(121, 121, 121, 0.5);
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
		</header><br><br><br><br><br><br><br><br>
		<div class="containersss" align="center">

			<div class="form-group" style="width: 100%;">
				<label class="checkbox-inline" style="font-size: 15px; font-family: 'Segoe UI'; color: white; font-weight: bold;">
					<input type="checkbox" id="deBogota" value="opcion_3" onclick="listarBogota()"> Bogotá (Connecta)
				</label>
				<label class="checkbox-inline" style="font-size: 15px; font-family: 'Segoe UI'; color: white; font-weight: bold;">
					<input type="checkbox" id="deZonaFranca" value="opcion_3" onclick="listarZonaFranca()"> Zona Franca
				</label>
				<label class="checkbox-inline" style="font-size: 15px; font-family: 'Segoe UI'; color: white; font-weight: bold;">
					<input type="checkbox" id="deMedellin" value="opcion_3" onclick="listarMedellin()"> Medellín
				</label>

			</div><br>
			
			<div class="row justify-content-center " style="color: white; background-color: rgba(0, 0, 0, 0.8);border-radius:9px; width: 85%;">
				<br><br><br>
				<div class="calBogota" hidden>
					<div id="CalendarioWebBogota" style="width: 95%; z-index:0;"></div><br><br><br><br>
				</div>

				<div class="calZonaF" hidden>
					<div id="CalendarioWebZonaF" style="width: 95%; z-index:0;"></div><br><br><br><br>
				</div>

				<div class="calMedellin" hidden>
					<div id="CalendarioWebMedellin" style="width: 95%; z-index:0;"></div><br><br><br><br>
				</div>
			</div>

			<br>
			<input type="text" name="" class=" btn btn-dark" style="width: 80px;background-color: #FF0000;font-size: 14px;" value="Solicitado" disabled>
			<input type="text" name="" class=" btn btn-dark" style="width: 80px;background-color: #1949B6;font-size: 14px;" value="Asignado" disabled>
			<input type="text" name="" class=" btn btn-dark" style="width: 90px;background-color: #49B619;font-size: 14px;" value="Terminado" disabled>
			<input type="text" name="" class=" btn btn-dark" style="width: 90px;background-color: #B66F19;font-size: 14px;" value="Novedad" disabled>
		</div><br><br>
		<!--</div>-->



		<script>
			$(document).ready(function(){
				$('#CalendarioWebBogota').fullCalendar({
					header:{
						left:'today,prev,next,',
						center:'title',
						right:'month,basicWeek,basicDay'
					},
					dayClick: function(date,jsEvent,view){
					//$('#btnGuardar').prop("disabled",true);
					//limpiarFormulario();
					limpiarFormularioSolicitudBogota();
					$('#txtFechaBogota').val(date.format());
					$('#txtFechaSoliBogota').val(date.format());
					//$('#modalListaDiaBogota').modal('show');

				},

				//events:'https://hranalytics.teleperformance.co/poligrafia/vistas/seleccion/eventos.php',
				events:'http://localhost:8080/poligrafia/vistas/seleccion/eventosBogota.php',

				eventClick:function(calEvent, jsEvent, view){
					$('#tituloEvento').html(calEvent.title);   
					$('#txtFecha').val(calEvent.start.format());
					$('#txtTitulo').val(calEvent.title);
					$('#txtTipoIden').val(calEvent.tipoIdentificacion);
					$('#txtNumIden').val(calEvent.numeroIdentificacion);
					$('#txtNombre').val(calEvent.nombreEvaluado);
					$('#txtCargo').val(calEvent.cargoEvaluado);
					$('#txtArea').val(calEvent.areaEvaluado);
					$('#tipoSite').val(calEvent.tipoSite);
					$('#txtEstado').val(calEvent.estadoPeticion);

					$('#modalEventos').modal('show');

					if ((calEvent.estadoPeticion) == 'Terminado'){
						$('#tituloHora').prop("hidden",true);
						$('#horaEstimada').prop("hidden",true);
						$('#txtTipoIden').prop("disabled",true);
						$('#txtNumIden').prop("disabled",true);
						$('#txtNombre').prop("disabled",true);
						$('#txtCargo').prop("disabled",true);
						$('#txtArea').prop("disabled",true);
						$('#btnCancelar').prop("disabled",true);
						$('#btnModificar').prop("disabled",true);
						$('#btnActualizar').prop("disabled",true);
						

					} else if ((calEvent.estadoPeticion) == 'Asignado'){
						$('#tituloHora').prop("hidden",true);
						$('#horaEstimada').prop("hidden",true);

						$('#txtTipoIden').prop("disabled",true);
						$('#txtNumIden').prop("disabled",true);
						$('#txtNombre').prop("disabled",true);
						$('#txtCargo').prop("disabled",true);
						$('#txtArea').prop("disabled",true);

						$('#btnCancelar').prop("disabled",false);
						$('#btnModificar').prop("disabled",false);
						$('#btnActualizar').prop("disabled",true);

						
					} if ((calEvent.estadoPeticion) == 'Solicitado'){
						$('#tituloHora').prop("hidden",false);
						$('#horaEstimada').prop("hidden",true);

						$('#txtTipoIden').prop("disabled",true);
						$('#txtNumIden').prop("disabled",true);
						$('#txtNombre').prop("disabled",true);
						$('#txtCargo').prop("disabled",true);
						$('#txtArea').prop("disabled",true);

						$('#btnCancelar').prop("disabled",false);
						$('#btnModificar').prop("disabled",false);
						$('#btnActualizar').prop("disabled",true);
						
					}				
					
				}


			});
			});
		</script>

		<script>
			$(document).ready(function(){
				$('#CalendarioWebZonaF').fullCalendar({
					header:{
						left:'today,prev,next,',
						center:'title',
						right:'month,basicWeek,basicDay'
					},
					dayClick: function(date,jsEvent,view){
					//$('#btnGuardar').prop("disabled",true);
					//limpiarFormulario();
					limpiarFormularioSolicitudBogota();
					$('#txtFechaZonaF').val(date.format());
					$('#txtFechaSoliZonaF').val(date.format());
					//$('#modalListaDiaZonaF').modal('show');
					//$('#modalListaDia').modal('show');

				},

				//events:'https://hranalytics.teleperformance.co/poligrafia/vistas/seleccion/eventos.php',
				events:'http://localhost:8080/poligrafia/vistas/seleccion/eventosZonaF.php',

				eventClick:function(calEvent, jsEvent, view){
					$('#tituloEvento').html(calEvent.title);   
					$('#txtFecha').val(calEvent.start.format());
					$('#txtTitulo').val(calEvent.title);
					$('#txtTipoIden').val(calEvent.tipoIdentificacion);
					$('#txtNumIden').val(calEvent.numeroIdentificacion);
					$('#txtNombre').val(calEvent.nombreEvaluado);
					$('#txtCargo').val(calEvent.cargoEvaluado);
					$('#txtArea').val(calEvent.areaEvaluado);
					$('#tipoSite').val(calEvent.tipoSite);
					$('#txtEstado').val(calEvent.estadoPeticion);

					$('#modalEventos').modal('show');

					if ((calEvent.estadoPeticion) == 'Terminado'){
						$('#tituloHora').prop("hidden",true);
						$('#horaEstimada').prop("hidden",true);

					} else if ((calEvent.estadoPeticion) == 'Asignado'){
						$('#tituloHora').prop("hidden",true);
						$('#horaEstimada').prop("hidden",true);
						
					} if ((calEvent.estadoPeticion) == 'Solicitado'){
						$('#tituloHora').prop("hidden",false);
						$('#horaEstimada').prop("hidden",true);
						
					}

					
					
				}


			});
			});
		</script>


		<script>
			$(document).ready(function(){
				$('#CalendarioWebMedellin').fullCalendar({
					header:{
						left:'today,prev,next,',
						center:'title',
						right:'month,basicWeek,basicDay'
					},
					dayClick: function(date,jsEvent,view){
					//$('#btnGuardar').prop("disabled",true);
					//limpiarFormulario();
					limpiarFormularioSolicitudBogota();
					$('#txtFechaMedellin').val(date.format());
					$('#txtFechaSoliMedellin').val(date.format());
					//$('#modalListaDiaMedellin').modal('show');
					//$('#modalListaDia').modal('show');

				},

				//events:'https://hranalytics.teleperformance.co/poligrafia/vistas/seleccion/eventos.php',
				events:'http://localhost:8080/poligrafia/vistas/seleccion/eventosMedellin.php',

				eventClick:function(calEvent, jsEvent, view){
					$('#tituloEvento').html(calEvent.title);   
					$('#txtFecha').val(calEvent.start.format());
					$('#txtTitulo').val(calEvent.title);
					$('#txtTipoIden').val(calEvent.tipoIdentificacion);
					$('#txtNumIden').val(calEvent.numeroIdentificacion);
					$('#txtNombre').val(calEvent.nombreEvaluado);
					$('#txtCargo').val(calEvent.cargoEvaluado);
					$('#txtArea').val(calEvent.areaEvaluado);
					$('#tipoSite').val(calEvent.tipoSite);
					$('#txtEstado').val(calEvent.estadoPeticion);

					$('#modalEventos').modal('show');

					if ((calEvent.estadoPeticion) == 'Terminado'){
						$('#tituloHora').prop("hidden",true);
						$('#horaEstimada').prop("hidden",true);

					} else if ((calEvent.estadoPeticion) == 'Asignado'){
						$('#tituloHora').prop("hidden",true);
						$('#horaEstimada').prop("hidden",true);
						
					} if ((calEvent.estadoPeticion) == 'Solicitado'){
						$('#tituloHora').prop("hidden",false);
						$('#horaEstimada').prop("hidden",true);
						
					}
				}

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
								<label>Estado:</label>
								<input type="text" id="txtEstado" name="txtEstado" class="form-control" style="font-size: 16px;" disabled>
							</div>
							<div class="form-group col-md-6">
								<label>Tipo Identificación</label>
								<input type="text" id="txtTipoIden" name="txtTipoIden" class="form-control" style="font-size: 16px;" disabled>
							</div>
							<div class="form-group col-md-6">
								<label>Número Identificación</label>
								<input type="number" id="txtNumIden" name="txtNumIden" class="form-control" style="font-size: 16px;" disabled>
							</div>

							<div class="form-group col-md-6">
								<label>Nombre:</label>
								<input type="text" id="txtNombre" name="txtNombre" class="form-control" style="font-size: 16px;" disabled>
							</div>
							<div class="form-group col-md-6">
								<label>Cargo:</label>
								<input type="text" id="txtCargo" name="txtCargo" class="form-control" style="font-size: 16px;" disabled>
							</div>
							<div class="form-group col-md-6">
								<label>Campaña o Área:</label>
								<input type="text" id="txtArea" name="txtArea" class="form-control" style="font-size: 16px;" disabled>
							</div>
							<div class="form-group  col-md-6">
								<label>Site:</label>
								<input type="text" id="tipoSite" name="tipoSite" class="form-control" style="font-size: 16px;" disabled>
							</div>
						</div>
					</div>


					<div class="modal-footer">
						
						<button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size: 16px;">Volver</button>
					</div>
				</div>
			</div>
		</div>



		<div class="modal fade" id="modalListaDiaBogota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%">
			<div class="modal-dialog" role="document">
				<div class="modal-content" style="font-size: 18px;">
					<div class="modal-header">
						<h5 class="modal-title" id="tituloEvento" style="font-size: 18px;">Asignación de cupo</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php

					$queryHoraBogota = "SELECT idHora, hora, estadoHora FROM horario_poli WHERE estadoHora = 'activado' AND ciudad = 'Bogotá'";

					$result_queryHoraBogota = odbc_exec($connect, utf8_decode($queryHoraBogota));

					?>
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Fecha:</label>
								<input type="text" id="txtFechaSoliBogota" name="txtFechaSoliBogota" class="form-control" style="font-size: 16px;" disabled>
							</div>
							<div class="form-group col-md-6">
								<label>Hora de Cupo:</label>
								<select class="form-control" id="txtHoraSoliBogota" name="txtHoraSoliBogota" style="font-size: 16px; height: 34px;">
									<option value="0">Seleccione:</option>
									<?php
									while ($rowqueryHoraBogota = odbc_fetch_array($result_queryHoraBogota))
									{
										echo '<option value='.$rowqueryHoraBogota["idHora"].'>'.$rowqueryHoraBogota["hora"].'</option>';
									}
									?>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>Fecha de contratación:</label>
								<input type="date" id="fechaContraSoliBogota" name="fechaContraSoliBogota" class="form-control" style="font-size: 16px;" value="">
							</div>

							<div class="form-group col-md-6">
								<label>Tipo de Convocatoria:</label>
								<select class="form-control" id="tipoConvoSoliBogota" style="font-size: 16px; height: 34px;">
									<option value="">Seleccione</option>
									<option value="Externa">Externa</option>
									<option value="Interna o Ascenso">Interna o Ascenso</option>
								</select>
							</div>

							<div class="form-group col-md-6">
								<label>Tiempo Laborado en TP:</label>
								<select class="form-control" id="tiempoTeleperformanceSoliBogota" style="font-size: 16px; height: 34px;">
									<option value="">Seleccione:</option>
									<option value="N/A">N/A</option>
									<option value="De 0 - 3 meses">De 0 - 3 meses</option>
									<option value="De 3 - 6 meses">De 3 - 6 meses</option>
									<option value="De 6 - 12 meses">De 6 - 12 meses</option>
									<option value="Más de 12 meses">Más de 12 meses</option>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>¿Ha trabajado con TP?</label>
								<select class="form-control" id="histTPSoliBogota" style="font-size: 16px; height: 34px;">
									<option value="">Seleccione:</option>
									<option value="Si">Sí</option>
									<option value="No">No</option>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>Campaña o área:</label>
								<input type="text" id="areaEvaSoliBogota" name="areaEvaSoliBogota" class="form-control" style="font-size: 16px;">
							</div>
							<div class="form-group col-md-6">
								<label>Cargo:</label>
								<input type="text" id="cargoSoliBogota" name="cargoSoliBogota" class="form-control" style="font-size: 16px;">
								<input hidden type="text" id="ciudadBogota" name="ciudadBogota" class="form-control" value="Bogotá">
							</div>
							<div class="form-group col-md-6">
								<label>Tipo identificación:</label>
								<select class="form-control" id="tipoIdentificacionSoliBogota" style="font-size: 16px; height: 34px;">
									<option value="">Seleccione:</option>
									<option value="CC">CC</option>
									<option value="TI">TI</option>
									<option value="CE">CE</option>
									<option value="PEP">PEP</option>
									<option value="PASS">PASS</option>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>Número identificación:</label>
								<input type="number" id="numeroIdentificacionSoliBogota" name="numeroIdentificacionSoliBogota" class="form-control" style="font-size: 16px;">
							</div>
							<div class="form-group col-md-12">
								<label>Nombre Completo:</label>
								<input type="text" id="nombreSoliBogota" name="nombreSoliBogota" class="form-control" style="font-size: 16px;">
							</div>
							
						</div>

						


					</div>
					<div class="modal-footer">
						<button type="button" id="btnSolicitarBogota" class="btn btn-success" data-dismiss="modal" style="font-size: 16px;">Solicitar</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size: 16px;">Volver</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modalListaDiaZonaF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%">
			<div class="modal-dialog" role="document">
				<div class="modal-content" style="font-size: 18px;">
					<div class="modal-header">
						<h5 class="modal-title" id="tituloEvento" style="font-size: 18px;">Asignación de cupo</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php

					$queryHoraBogota = "SELECT idHora, hora, estadoHora FROM horario_poli WHERE estadoHora = 'activado' AND ciudad = 'Bogotá - Zona Franca'";

					$result_queryHoraBogota = odbc_exec($connect, utf8_decode($queryHoraBogota));

					?>
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Fecha:</label>
								<input type="text" id="txtFechaSoliZonaF" name="txtFechaSoliZonaF" class="form-control" style="font-size: 16px;" disabled>
							</div>
							<div class="form-group col-md-6">
								<label>Hora de Cupo:</label>
								<select class="form-control" id="txtHoraSoliZonaF" name="txtHoraSoliZonaF" style="font-size: 16px; height: 34px;">
									<option value="0">Seleccione:</option>
									<?php
									while ($rowqueryHoraBogota = odbc_fetch_array($result_queryHoraBogota))
									{
										echo '<option value='.$rowqueryHoraBogota["idHora"].'>'.$rowqueryHoraBogota["hora"].'</option>';
									}
									?>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>Fecha de contratación:</label>
								<input type="date" id="fechaContraSoliZonaF" name="fechaContraSoliZonaF" class="form-control" style="font-size: 16px;" value="">
							</div>

							<div class="form-group col-md-6">
								<label>Tipo de Convocatoria:</label>
								<select class="form-control" id="tipoConvoSoliZonaF" style="font-size: 16px; height: 34px;">
									<option value="">Seleccione</option>
									<option value="Externa">Externa</option>
									<option value="Interna o Ascenso">Interna o Ascenso</option>
								</select>
							</div>

							<div class="form-group col-md-6">
								<label>Tiempo Laborado en TP:</label>
								<select class="form-control" id="tiempoTeleperformanceSoliZonaF" style="font-size: 16px; height: 34px;">
									<option value="">Seleccione:</option>
									<option value="N/A">N/A</option>
									<option value="De 0 - 3 meses">De 0 - 3 meses</option>
									<option value="De 3 - 6 meses">De 3 - 6 meses</option>
									<option value="De 6 - 12 meses">De 6 - 12 meses</option>
									<option value="Más de 12 meses">Más de 12 meses</option>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>¿Ha trabajado con TP?</label>
								<select class="form-control" id="histTPSoliZonaF" style="font-size: 16px; height: 34px;">
									<option value="">Seleccione:</option>
									<option value="Si">Sí</option>
									<option value="No">No</option>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>Campaña o área:</label>
								<input type="text" id="areaEvaSoliZonaF" name="areaEvaSoliZonaF" class="form-control" style="font-size: 16px;">
							</div>
							<div class="form-group col-md-6">
								<label>Cargo:</label>
								<input type="text" id="cargoSoliZonaF" name="cargoSoliZonaF" class="form-control" style="font-size: 16px;">
								<input hidden type="text" id="ciudadZonaF" name="ciudadZonaF" class="form-control" value="Bogotá - Zona Franca">
							</div>
							<div class="form-group col-md-6">
								<label>Tipo identificación:</label>
								<select class="form-control" id="tipoIdentificacionSoliZonaF" style="font-size: 16px; height: 34px;">
									<option value="">Seleccione:</option>
									<option value="CC">CC</option>
									<option value="TI">TI</option>
									<option value="CE">CE</option>
									<option value="PEP">PEP</option>
									<option value="PASS">PASS</option>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>Número identificación:</label>
								<input type="number" id="numeroIdentificacionSoliZonaF" name="numeroIdentificacionSoliZonaF" class="form-control" style="font-size: 16px;">
							</div>
							<div class="form-group col-md-12">
								<label>Nombre Completo:</label>
								<input type="text" id="nombreSoliZonaF" name="nombreSoliZonaF" class="form-control" style="font-size: 16px;">
							</div>
							
						</div>

						


					</div>
					<div class="modal-footer">
						<button type="button" id="btnSolicitarZonaF" class="btn btn-success" data-dismiss="modal" style="font-size: 16px;">Solicitar</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size: 16px;">Volver</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modalListaDiaMedellin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%">
			<div class="modal-dialog" role="document">
				<div class="modal-content" style="font-size: 18px;">
					<div class="modal-header">
						<h5 class="modal-title" id="tituloEvento" style="font-size: 18px;">Asignación de cupo</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php

					$queryHoraBogota = "SELECT idHora, hora, estadoHora FROM horario_poli WHERE estadoHora = 'activado' AND ciudad = 'Medellín'";

					$result_queryHoraBogota = odbc_exec($connect, utf8_decode($queryHoraBogota));

					?>
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Fecha:</label>
								<input type="text" id="txtFechaSoliMedellin" name="txtFechaSoliMedellin" class="form-control" style="font-size: 16px;" disabled>
							</div>
							<div class="form-group col-md-6">
								<label>Hora de Cupo:</label>
								<select class="form-control" id="txtHoraSoliMedellin" name="txtHoraSoliMedellin" style="font-size: 16px; height: 34px;">
									<option value="0">Seleccione:</option>
									<?php
									while ($rowqueryHoraBogota = odbc_fetch_array($result_queryHoraBogota))
									{
										echo '<option value='.$rowqueryHoraBogota["idHora"].'>'.$rowqueryHoraBogota["hora"].'</option>';
									}
									?>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>Fecha de contratación:</label>
								<input type="date" id="fechaContraSoliMedellin" name="fechaContraSoliMedellin" class="form-control" style="font-size: 16px;" value="">
							</div>

							<div class="form-group col-md-6">
								<label>Tipo de Convocatoria:</label>
								<select class="form-control" id="tipoConvoSoliMedellin" style="font-size: 16px; height: 34px;">
									<option value="">Seleccione</option>
									<option value="Externa">Externa</option>
									<option value="Interna o Ascenso">Interna o Ascenso</option>
								</select>
							</div>

							<div class="form-group col-md-6">
								<label>Tiempo Laborado en TP:</label>
								<select class="form-control" id="tiempoTeleperformanceSoliMedellin" style="font-size: 16px; height: 34px;">
									<option value="">Seleccione:</option>
									<option value="N/A">N/A</option>
									<option value="De 0 - 3 meses">De 0 - 3 meses</option>
									<option value="De 3 - 6 meses">De 3 - 6 meses</option>
									<option value="De 6 - 12 meses">De 6 - 12 meses</option>
									<option value="Más de 12 meses">Más de 12 meses</option>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>¿Ha trabajado con TP?</label>
								<select class="form-control" id="histTPSoliMedellin" style="font-size: 16px; height: 34px;">
									<option value="">Seleccione:</option>
									<option value="Si">Sí</option>
									<option value="No">No</option>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>Campaña o área:</label>
								<input type="text" id="areaEvaSoliMedellin" name="areaEvaSoliMedellin" class="form-control" style="font-size: 16px;">
							</div>
							<div class="form-group col-md-6">
								<label>Cargo:</label>
								<input type="text" id="cargoSoliMedellin" name="cargoSoliMedellin" class="form-control" style="font-size: 16px;">
								<input hidden type="text" id="ciudadMedellin" name="ciudadMedellin" class="form-control" value="MedellÍn">
							</div>
							<div class="form-group col-md-6">
								<label>Tipo identificación:</label>
								<select class="form-control" id="tipoIdentificacionSoliMedellin" style="font-size: 16px; height: 34px;">
									<option value="">Seleccione:</option>
									<option value="CC">CC</option>
									<option value="TI">TI</option>
									<option value="CE">CE</option>
									<option value="PEP">PEP</option>
									<option value="PASS">PASS</option>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>Número identificación:</label>
								<input type="number" id="numeroIdentificacionSoliMedellin" name="numeroIdentificacionSoliMedellin" class="form-control" style="font-size: 16px;">
							</div>
							<div class="form-group col-md-12">
								<label>Nombre Completo:</label>
								<input type="text" id="nombreSoliMedellin" name="nombreSoliMedellin" class="form-control" style="font-size: 16px;">
							</div>
							
						</div>

						


					</div>
					<div class="modal-footer">
						<button type="button" id="btnSolicitarMedellin" class="btn btn-success" data-dismiss="modal" style="font-size: 16px;">Solicitar</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size: 16px;">Volver</button>
					</div>
				</div>
			</div>
		</div>

		<script>

			var NuevoEvento;


			$('#btnSolicitarBogota').click(function(){
				var site = 'Bogotá';
				var hor = document.getElementById("txtHoraSoliBogota").value;
				var fechaC = document.getElementById("fechaContraSoliBogota").value;
				var tipoC = document.getElementById("tipoConvoSoliBogota").value;
				var tiemTP = document.getElementById("tiempoTeleperformanceSoliBogota").value;
				var r = document.getElementById("histTPSoliBogota").value;
				var Carea = document.getElementById("areaEvaSoliBogota").value;
				var tipoI = document.getElementById("tipoIdentificacionSoliBogota").value;
				var num = document.getElementById("numeroIdentificacionSoliBogota").value;
				var nomC = document.getElementById("nombreSoliBogota").value;
				var car = document.getElementById("cargoSoliBogota").value; 

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
				} else if (hor == ""){
					Swal.fire({
						type: 'error',
						title: '¡Seleccione la hora del cupo!',
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

					RecolectarDatosGUISolicitanteBogota();
					validarInsertarSolicitudBogota('validador1', NuevoEvento);

				}

			});

			$('#btnSolicitarZonaF').click(function(){
				var site = 'Bogotá - Zona Franca';
				var hor = document.getElementById("txtHoraSoliZonaF").value;
				var fechaC = document.getElementById("fechaContraSoliZonaF").value;
				var tipoC = document.getElementById("tipoConvoSoliZonaF").value;
				var tiemTP = document.getElementById("tiempoTeleperformanceSoliZonaF").value;
				var r = document.getElementById("histTPSoliZonaF").value;
				var Carea = document.getElementById("areaEvaSoliZonaF").value;
				var tipoI = document.getElementById("tipoIdentificacionSoliZonaF").value;
				var num = document.getElementById("numeroIdentificacionSoliZonaF").value;
				var nomC = document.getElementById("nombreSoliZonaF").value;
				var car = document.getElementById("cargoSoliZonaF").value; 

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
				} else if (hor == ""){
					Swal.fire({
						type: 'error',
						title: '¡Seleccione la hora del cupo!',
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

					RecolectarDatosGUISolicitanteZonaF();
					validarInsertarSolicitudZonaF('validador1', NuevoEvento);

				}

			});

			$('#btnSolicitarMedellin').click(function(){
				var site = 'Medellín';
				var hor = document.getElementById("txtHoraSoliMedellin").value;
				var fechaC = document.getElementById("fechaContraSoliMedellin").value;
				var tipoC = document.getElementById("tipoConvoSoliMedellin").value;
				var tiemTP = document.getElementById("tiempoTeleperformanceSoliMedellin").value;
				var r = document.getElementById("histTPSoliMedellin").value;
				var Carea = document.getElementById("areaEvaSoliMedellin").value;
				var tipoI = document.getElementById("tipoIdentificacionSoliMedellin").value;
				var num = document.getElementById("numeroIdentificacionSoliMedellin").value;
				var nomC = document.getElementById("nombreSoliMedellin").value;
				var car = document.getElementById("cargoSoliMedellin").value; 

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
				} else if (hor == ""){
					Swal.fire({
						type: 'error',
						title: '¡Seleccione la hora del cupo!',
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

					RecolectarDatosGUISolicitanteMedellin();
					validarInsertarSolicitudMedellin('validador1', NuevoEvento);

				}

			});



			$('#btnModificar').click(function(){
				$('#tituloHora').prop("hidden",false);
				$('#horaEstimada').prop("hidden",false);
				$('#horaEstimada').prop("disabled",false);
				$('#txtNombre').prop("disabled",false);
				$('#txtCargo').prop("disabled",false);
				$('#txtArea').prop("disabled",false);
				$('#txtFechaContra').prop("disabled",false);
				$('#txtTipoConvo').prop("disabled",false);
				$('#txtTiempoTP').prop("disabled",false);
				$('#txtHaT').prop("disabled",false);
				$('#txtTipoIden').prop("disabled",false);
				$('#txtNumIden').prop("disabled",false);
				$('#btnModificar').prop("disabled",true);
				$('#btnActualizar').prop("disabled",false);
				$('#btnCancelar').prop("disabled",true);
			});

			$('#btnCancelar').click(function(){
				$('#tituloHora').prop("hidden",false);
				$('#horaEstimada').prop("hidden",false);
				$('#horaEstimada').prop("disabled",false);
				$('#txtNombre').prop("disabled",false);
				$('#txtCargo').prop("disabled",false);
				$('#txtArea').prop("disabled",false);
				$('#txtFechaContra').prop("disabled",false);
				$('#txtTipoConvo').prop("disabled",false);
				$('#txtTiempoTP').prop("disabled",false);
				$('#txtHaT').prop("disabled",false);
				$('#txtTipoIden').prop("disabled",false);
				$('#txtNumIden').prop("disabled",false);
				$('#btnModificar').prop("disabled",true);
				$('#btnActualizar').prop("disabled",false);
				$('#btnCancelar').prop("disabled",true);
				Swal.fire({
					title: '¿Estás seguro?',
					text: "¡Se cancelará el cupo!",
					type: 'question',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Sí',
					cancelButtonText: 'No'
				}).then((result) => {
					if (result.value) {
						RecolectarDatosGUI();
						CancelarCupoBogota('CancelarCupo', NuevoEvento);
					}
				})
			});

			$('#btnActualizar').click(function(){
				$('#tituloHora').prop("hidden",false);
				$('#horaEstimada').prop("hidden",false);
				$('#horaEstimada').prop("disabled",false);
				$('#txtNombre').prop("disabled",false);
				$('#txtCargo').prop("disabled",false);
				$('#txtArea').prop("disabled",false);
				$('#txtFechaContra').prop("disabled",false);
				$('#txtTipoConvo').prop("disabled",false);
				$('#txtTiempoTP').prop("disabled",false);
				$('#txtHaT').prop("disabled",false);
				$('#txtTipoIden').prop("disabled",false);
				$('#txtNumIden').prop("disabled",false);
				$('#btnModificar').prop("disabled",true);
				$('#btnActualizar').prop("disabled",false);
				$('#btnCancelar').prop("disabled",true);

				Swal.fire({
					title: '¿Estás seguro?',
					text: "¡Se actualizaran los datos del cupo!",
					type: 'question',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Sí',
					cancelButtonText: 'No'
				}).then((result) => {
					if (result.value) {
						RecolectarDatosGUI();
						ActualizarInformacion('actualizarCupo', NuevoEvento);
					}
				})

				

			});

			function validarInsertarSolicitudBogota(accion, objEvento, modal){
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
							RecolectarDatosGUISolicitanteBogota();
							validarInsertarInforSoliBogota('validador2', NuevoEvento);
						}
					},
					error: function(){
						alert("hay un error ... y sirve");
					}

				});
			}

			function validarInsertarSolicitudZonaF(accion, objEvento, modal){
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
							RecolectarDatosGUISolicitanteZonaF();
							validarInsertarInforSoliZonaF('validador2', NuevoEvento);
						}
					},
					error: function(){
						alert("hay un error ... y sirve");
					}

				});
			}

			function validarInsertarSolicitudMedellin(accion, objEvento, modal){
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
							RecolectarDatosGUISolicitanteMedellin();
							validarInsertarInforSoliMedellin('validador2', NuevoEvento);
						}
					},
					error: function(){
						alert("hay un error ... y sirve");
					}

				});
			}

			function validarInsertarInforSoliBogota(accion, objEvento, modal){
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
							RecolectarDatosGUISolicitanteBogota();
							insertarInfoSoliBogota('insertarSolicitud', NuevoEvento);
						}
					},
					error: function(){
						alert("hay un error ... y sirve");
					}

				});
			}

			function validarInsertarInforSoliZonaF(accion, objEvento, modal){
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
							RecolectarDatosGUISolicitanteZonaF();
							insertarInfoSoliZonaF('insertarSolicitud', NuevoEvento);
						}
					},
					error: function(){
						alert("hay un error ... y sirve");
					}

				});
			}

			function validarInsertarInforSoliMedellin(accion, objEvento, modal){
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
							RecolectarDatosGUISolicitanteMedellin();
							insertarInfoSoliMedellin('insertarSolicitud', NuevoEvento);
						}
					},
					error: function(){
						alert("hay un error ... y sirve");
					}

				});
			}

			function insertarInfoSoliBogota(accion, objEvento, modal){
				$.ajax({
					type: 'POST',
					url: 'tablaSolicitud.php?accion='+accion,
					data: objEvento,
					success:function(msg){
						if (msg){

							$('#CalendarioWebBogota').fullCalendar('refetchEvents');
							$('#CalendarioWebZonaF').fullCalendar('refetchEvents');
							$('#CalendarioWebMedellin').fullCalendar('refetchEvents');
							Swal.fire({
								type: 'success',
								title: '¡Se solicitó el cupo!',
								showConfirmButton: true
							}).then((result) => {
								if (result.value) {
								}
							})
							limpiarFormularioSolicitudBogota();

						} else {
							alert ('Error en la inserción!');
						}
					},
					error: function(){
						alert("hay un error ... y sirve");
					}

				});
			}

			function insertarInfoSoliZonaF(accion, objEvento, modal){
				$.ajax({
					type: 'POST',
					url: 'tablaSolicitud.php?accion='+accion,
					data: objEvento,
					success:function(msg){
						if (msg){

							$('#CalendarioWebBogota').fullCalendar('refetchEvents');
							$('#CalendarioWebZonaF').fullCalendar('refetchEvents');
							$('#CalendarioWebMedellin').fullCalendar('refetchEvents');
							Swal.fire({
								type: 'success',
								title: '¡Se solicitó el cupo!',
								showConfirmButton: true
							}).then((result) => {
								if (result.value) {
								}
							})
							limpiarFormularioSolicitudZonaF();

						} else {
							alert ('Error en la inserción!');
						}
					},
					error: function(){
						alert("hay un error ... y sirve");
					}

				});
			}

			function insertarInfoSoliMedellin(accion, objEvento, modal){
				$.ajax({
					type: 'POST',
					url: 'tablaSolicitud.php?accion='+accion,
					data: objEvento,
					success:function(msg){
						if (msg){

							$('#CalendarioWebBogota').fullCalendar('refetchEvents');
							$('#CalendarioWebZonaF').fullCalendar('refetchEvents');
							$('#CalendarioWebMedellin').fullCalendar('refetchEvents');
							Swal.fire({
								type: 'success',
								title: '¡Se solicitó el cupo!',
								showConfirmButton: true
							}).then((result) => {
								if (result.value) {
								}
							})
							limpiarFormularioSolicitudMedellin();

						} else {
							alert ('Error en la inserción!');
						}
					},
					error: function(){
						alert("hay un error ... y sirve");
					}

				});
			}


			function RecolectarDatosGUI(){
				NuevoEvento = {
					fecha:$('#txtFecha').val(),
					tipoIden:$('#txtTipoIden').val(),
					numIden:$('#txtNumIden').val(),
					nombre:$('#txtNombre').val(),
					cargo:$('#txtCargo').val(),
					area:$('#txtArea').val(),
					tipoSite:$('#tipoSite').val(),
					estado:$('#txtEstado').val()
				};
			}

			function RecolectarDatosGUISolicitanteBogota(){
				NuevoEvento = {

					fechaPeticion:$('#txtFechaSoliBogota').val(),
					horaPeticion:$('#txtHoraSoliBogota').val(),
					ciudadPeticion:$('#ciudadBogota').val(),
					fechaContratacion:$('#fechaContraSoliBogota').val(),
					tipoConvocatoria:$('#tipoConvoSoliBogota').val(),
					tiempoTP:$('#tiempoTeleperformanceSoliBogota').val(),
					historiaTP:$('#histTPSoliBogota').val(),
					areaEvaluado:$('#areaEvaSoliBogota').val(),
					tipoIdentificacion:$('#tipoIdentificacionSoliBogota').val(),
					numeroIdentificacion:$('#numeroIdentificacionSoliBogota').val(),
					nombreEvaluado:$('#nombreSoliBogota').val(),
					cargoEvaluado:$('#cargoSoliBogota').val() 
				};				
			}

			function RecolectarDatosGUISolicitanteZonaF(){
				NuevoEvento = {

					fechaPeticion:$('#txtFechaSoliZonaF').val(),
					horaPeticion:$('#txtHoraSoliZonaF').val(),
					ciudadPeticion:$('#ciudadZonaF').val(),
					fechaContratacion:$('#fechaContraSoliZonaF').val(),
					tipoConvocatoria:$('#tipoConvoSoliZonaF').val(),
					tiempoTP:$('#tiempoTeleperformanceSoliZonaF').val(),
					historiaTP:$('#histTPSoliZonaF').val(),
					areaEvaluado:$('#areaEvaSoliZonaF').val(),
					tipoIdentificacion:$('#tipoIdentificacionSoliZonaF').val(),
					numeroIdentificacion:$('#numeroIdentificacionSoliZonaF').val(),
					nombreEvaluado:$('#nombreSoliZonaF').val(),
					cargoEvaluado:$('#cargoSoliZonaF').val() 
				};				
			}

			function RecolectarDatosGUISolicitanteMedellin(){
				NuevoEvento = {

					fechaPeticion:$('#txtFechaSoliMedellin').val(),
					horaPeticion:$('#txtHoraSoliMedellin').val(),
					ciudadPeticion:$('#ciudadMedellin').val(),
					fechaContratacion:$('#fechaContraSoliMedellin').val(),
					tipoConvocatoria:$('#tipoConvoSoliMedellin').val(),
					tiempoTP:$('#tiempoTeleperformanceSoliMedellin').val(),
					historiaTP:$('#histTPSoliMedellin').val(),
					areaEvaluado:$('#areaEvaSoliMedellin').val(),
					tipoIdentificacion:$('#tipoIdentificacionSoliMedellin').val(),
					numeroIdentificacion:$('#numeroIdentificacionSoliMedellin').val(),
					nombreEvaluado:$('#nombreSoliMedellin').val(),
					cargoEvaluado:$('#cargoSoliMedellin').val() 
				};				
			}

			function ActualizarInformacion(accion, objEvento, modal){
				$.ajax({
					type: 'POST',
					url: 'eventos.php?accion='+accion,
					data: objEvento,
					success:function(msg){
						if (msg){
							$('#CalendarioWebBogota').fullCalendar('refetchEvents');
							$('#CalendarioWebZonaF').fullCalendar('refetchEvents');
							$('#CalendarioWebMedellin').fullCalendar('refetchEvents');

							Swal.fire({
								type: 'success',
								title: '¡Se actualizaron los datos del cupo!',
								showConfirmButton: true
							}).then((result) => {
								if (result.value) {
								}
							})
							limpiarFormulario1();
							
						} else {
							alert("no se asigno");
						}
					},
					error: function(){
						alert('Error en la, transacción bancaria del usuario exitosa')

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


			function CancelarCupoBogota(accion, objEvento, modal){
				$.ajax({
					type: 'POST',
					url: 'eventos.php?accion='+accion,
					data: objEvento,
					success:function(msg){
						if (msg){
							$('#CalendarioWebBogota').fullCalendar('refetchEvents');
							$('#CalendarioWebZonaF').fullCalendar('refetchEvents');
							$('#CalendarioWebMedellin').fullCalendar('refetchEvents');
							Swal.fire({
								type: 'success',
								title: '¡Se canceló el cupo!, ahora está libre',
								showConfirmButton: true
							}).then((result) => {
								if (result.value) {
								}
							})
							limpiarFormulario1();
							
						} else {
							alert("no se asigno");
						}
					},
					error: function(){
						alert('Error en la, transacción bancaria del usuario exitosa')

					}
				});
			}

			function EnviarInformacion(accion, objEvento, modal){
				$.ajax({
					type: 'POST',
					url: 'eventos.php?accion='+accion,
					data: objEvento,
					success:function(msg){
						if (msg){
							$('#CalendarioWebBogota').fullCalendar('refetchEvents');
							$('#CalendarioWebZonaF').fullCalendar('refetchEvents');
							$('#CalendarioWebMedellin').fullCalendar('refetchEvents');

							if (!modal) {								
								$('#modalEventos').modal('toggle'); 
							} else {
								limpiarFormulario1();

								Swal.fire({
									type: 'success',
									title: 'La citación fue actualizada',
									showConfirmButton: true
								})
							}
						} else {
							alert("no se asigno");
						}
					},
					error: function(){
						alert("hay un error ...");
					}
				});
			}

			function limpiarFormulario1(){
				$('#txtTitulo').val('');
				$('#txtFechaBogota').val('');
				$('#txtFechaZonaF').val('');
				$('#txtFechaMedellin').val('');
				$('#horaEstimada').val(0);
				$('#txtTipoIden').val('');
				$('#txtNumIden').val('');
				$('#txtNombre').val('');
				$('#txtCargo').val('');
				$('#txtArea').val('');
				$('#txtEstado').val('');
			}

			function limpiarFormularioSolicitudBogota(){
				$('#txtFechaSoliBogota').val('');
				$('#txtHoraSoliBogota').val(0);
				$('#fechaContraSoliBogota').val('');
				$('#tipoConvoSoliBogota').val('');
				$('#tiempoTeleperformanceSoliBogota').val('');
				$('#histTPSoliBogota').val('');
				$('#areaEvaSoliBogota').val('');
				$('#tipoIdentificacionSoliBogota').val('');
				$('#numeroIdentificacionSoliBogota').val('');
				$('#nombreSoliBogota').val('');
				$('#cargoSoliBogota').val('');
			}

			function limpiarFormularioSolicitudZonaF(){
				$('#txtFechaSoliZonaF').val('');
				$('#txtHoraSoliZonaF').val(0);
				$('#fechaContraSoliZonaF').val('');
				$('#tipoConvoSoliZonaF').val('');
				$('#tiempoTeleperformanceSoliZonaF').val('');
				$('#histTPSoliZonaF').val('');
				$('#areaEvaSoliZonaF').val('');
				$('#tipoIdentificacionSoliZonaF').val('');
				$('#numeroIdentificacionSoliZonaF').val('');
				$('#nombreSoliZonaF').val('');
				$('#cargoSoliZonaF').val('');
			}

			function limpiarFormularioSolicitudMedellin(){
				$('#txtFechaSoliMedellin').val('');
				$('#txtHoraSoliMedellin').val(0);
				$('#fechaContraSoliMedellin').val('');
				$('#tipoConvoSoliMedellin').val('');
				$('#tiempoTeleperformanceSoliMedellin').val('');
				$('#histTPSoliMedellin').val('');
				$('#areaEvaSoliMedellin').val('');
				$('#tipoIdentificacionSoliMedellin').val('');
				$('#numeroIdentificacionSoliMedellin').val('');
				$('#nombreSoliMedellin').val('');
				$('#cargoSoliMedellin').val('');
			}



			function listarBogota(){

				document.getElementById("deZonaFranca").checked = false;
				document.getElementById("deMedellin").checked = false;
				document.getElementById("deBogota").checked = true;

				$(".calBogota").attr('hidden', false);
				$(".calZonaF").attr('hidden', true);
				$(".calMedellin").attr('hidden', true);
				// document.getElementById("tipo").value = "Concepto";
				// $(".exportar").attr('hidden',false);
				// mostrarValidar();
			}

			function listarZonaFranca(){

				document.getElementById("deZonaFranca").checked = true;
				document.getElementById("deMedellin").checked = false;
				document.getElementById("deBogota").checked = false;
				
				$(".calBogota").attr('hidden', true);
				$(".calZonaF").attr('hidden', false);
				$(".calMedellin").attr('hidden', true);
				// document.getElementById("tipo").value = "Concepto";
				// $(".exportar").attr('hidden',false);
				// mostrarValidar();
			}

			function listarMedellin(){

				document.getElementById("deZonaFranca").checked = false;
				document.getElementById("deMedellin").checked = true;
				document.getElementById("deBogota").checked = false;
				
				$(".calBogota").attr('hidden', true);
				$(".calZonaF").attr('hidden', true);
				$(".calMedellin").attr('hidden', false);
				// document.getElementById("tipo").value = "Concepto";
				// $(".exportar").attr('hidden',false);
				// mostrarValidar();
			}

		</script>

		<script type="text/javascript" src="js/mostrar_ocultar3.js"></script>
	</body>
	</html>