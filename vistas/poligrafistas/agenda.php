<?php 
include("../../config/connection.php");
session_start();

if (!isset($_SESSION['rolUsuario']) || $_SESSION['rolUsuario'] != "Poligrafista" && $_SESSION['rolUsuario'] != "Desarrollador"){

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
	<link rel="stylesheet" href="css/estiloAgenda.css">
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


					<li><a href="inicioPoligrafistas.php" class="irInicio"><span class="fa fa-home icon-menu"></span>Inicio</a></li>
                    <li><a href="agenda.php" class="irInicio"><span class="fa fa-calendar-check-o icon-menu"></span>Agenda</a></li>
                    <li><a href="enviadas.php" class="irInicio"><span class="fa fa-envelope icon-menu"></span>Solicitudes</a></li>
                    <li><a href="historial.php" class="irInicio"><span class="fa fa-history icon-menu"></span>Historial</a></li>
                    

                    <li><a href="busqueda.php" class="buscarDatos"><span class="fa fa-search icon-menu"></span>Busqueda</a></li>
                    <li class="item-submenu" menu="1">
                       <a href="#"><span class="fa fa-wrench icon-menu"></span>Configuración</a>
                       <ul class="submenu">
                          <li class="title-menu"><span class="fa fa-wrench icon-menu" style="font-size: 70px;"></span><br><br>Configuración</li>
                          <li class="go-back">Atrás</li>

                          <li><a href="editarPerfil.php"><span class="fa fa-user icon-menu"></span>Perfil</a></li>
                          <li><a href="horario.php"><span class="fa fa-calendar icon-menu"></span>Horario</a></li>
                      </ul>
                  </li>
					<li><a href="#" class="cerrarSesion"><span class="fa fa-sign-out icon-menu"></span>Log out</a><br><br><br><br></li>
				</ul>
			</nav>
			<label class="p">Poligrafía</label>
			<img src="css/logof4.jpg" align="right">
		</header><br><br><br><br><br><br><br><br>
		<div class="containersss" align="center">
			<div class="row justify-content-center" style="color: white; background-color: rgba(0, 0, 0, 0.8);border-radius:9px; width: 85%;">
				<div id="CalendarioWeb"></div><br><br>
				<br><br>

			</div><br>
			<input type="text" name="" class=" btn btn-dark" style="width: 80px;background-color: #FF0000;font-size: 14px;" value="Solicitado" disabled>
			<input type="text" name="" class=" btn btn-dark" style="width: 80px;background-color: #1949B6;font-size: 14px;" value="Asignado" disabled>
			<input type="text" name="" class=" btn btn-dark" style="width: 90px;background-color: #49B619;font-size: 14px;" value="Terminado" disabled>
			<input type="text" name="" class=" btn btn-dark" style="width: 90px;background-color: #B66F19;font-size: 14px;" value="Novedad" disabled>
		</div><br><br>
		<!--</div>   poliperformance  -->


		<script>
			$(document).ready(function(){
				$('#CalendarioWeb').fullCalendar({
					header:{
						left:'today,prev,next,',
						center:'title',
						right:'month,basicWeek,basicDay'
					},
					dayClick: function(date,jsEvent,view){
					//$('#btnGuardar').prop("disabled",true);
					//limpiarFormulario();
					$('#txtFechaSoli').val(date.format());
					$('#txtFecha').val(date.format());
					$('#modalListaDia').modal('show');

				},

				//events:'https://hranalytics.teleperformance.co/poligrafia/vistas/poligrafistas/eventos.php',
				events:'http://localhost:8080/poligrafia/vistas/poligrafistas/eventos.php',

				eventClick:function(calEvent, jsEvent, view){
					$('#tituloEvento').html(calEvent.title);   
					$('#txtFecha').val(calEvent.start.format());
					$('#txtTitulo').val(calEvent.title);
					$('#txtTipoIden').val(calEvent.tipoIdentificacion);
					$('#txtNumIden').val(calEvent.numeroIdentificacion);
					$('#txtNombre').val(calEvent.nombreEvaluado);
					$('#txtCargo').val(calEvent.cargoEvaluado);
					$('#txtArea').val(calEvent.areaEvaluado);
					$('#txtEstado').val(calEvent.estadoPeticion);
					$('#tipoSite').val(calEvent.tipoSite);
					$('#ccmsRegistrador').val(calEvent.ccmsRegistrador);
					$('#txtNombreSoli').val(calEvent.nombreSolicitante);
					$('#txtCargoSoli').val(calEvent.cargoSolicitante);
					$('#txtFechaContra').val(calEvent.fechaContratacion);
					$('#txtTipoConvo').val(calEvent.tipoConvocatoria);
					$('#txtTiempoTP').val(calEvent.tiempoTP);
					$('#txtHaT').val(calEvent.historiaTP);

					

					$('#modalEventos').modal('show');

					if ((calEvent.estadoPeticion) == 'Terminado'){
						$('#tituloHora').prop("hidden",true);
						$('#horaEstimada').prop("hidden",true);
						$('#txtNombre').prop("disabled",true);
						$('#txtCargo').prop("disabled",true);
						$('#txtArea').prop("disabled",true);
						$('#tipoSite').prop("disabled",true);

						$('#txtNombreSoli').prop("disabled",true);
						$('#txtCargoSoli').prop("disabled",true);
						$('#txtFechaContra').prop("disabled",true);
						$('#txtTipoConvo').prop("disabled",true);
						$('#txtTiempoTP').prop("disabled",true);
						$('#txtHaT').prop("disabled",true);

						$('#btnAsignar').prop("disabled",true);
						$('#btnMover').prop("disabled",true);
						$('#btnModificar').prop("disabled",true);
						$('#btnBorrar').prop("disabled",true);
					} else if ((calEvent.estadoPeticion) == 'Asignado'){
						$('#tituloHora').prop("hidden",true);
						$('#horaEstimada').prop("hidden",true);
						$('#txtNombre').prop("disabled",true);
						$('#txtCargo').prop("disabled",true);
						$('#txtArea').prop("disabled",true);

						$('#txtNombreSoli').prop("disabled",true);
						$('#txtCargoSoli').prop("disabled",true);
						$('#txtFechaContra').prop("disabled",true);
						$('#txtTipoConvo').prop("disabled",true);
						$('#txtTiempoTP').prop("disabled",true);
						$('#txtHaT').prop("disabled",true);

						$('#btnMover').prop("disabled",false);
						$('#btnAsignar').prop("disabled",true);
						$('#btnModificar').prop("disabled",false);
						$('#btnBorrar').prop("disabled",true);
					} if ((calEvent.estadoPeticion) == 'Solicitado'){
						$('#tituloHora').prop("hidden",false);
						$('#horaEstimada').prop("hidden",false);
						$('#horaEstimada').prop("disabled",false);
						$('#txtNombre').prop("disabled",false);
						$('#txtCargo').prop("disabled",false);
						$('#txtArea').prop("disabled",false);

						$('#txtNombreSoli').prop("disabled",true);
						$('#txtCargoSoli').prop("disabled",true);
						$('#txtFechaContra').prop("disabled",true);
						$('#txtTipoConvo').prop("disabled",true);
						$('#txtTiempoTP').prop("disabled",true);
						$('#txtHaT').prop("disabled",true);

						$('#btnAsignar').prop("disabled",false);
						$('#btnModificar').prop("disabled",false);
						$('#btnBorrar').prop("disabled",false);
					}

					
					
				},
				editable:true,
				eventDrop:function(calEvent){
					//$('#txtTitulo').val(calEvent.title);
					//$('#txtDescripcion').val(calEvent.descripcion);
					//$('#txtFecha').val(calEvent.start.format());
					//RecolectarDatosGUI();
					//EnviarInformacion('asignar', NuevoEvento, true);
					$('#txtFecha').val(calEvent.start.format());
					if ((calEvent.estadoPeticion) == 'Terminado'){
						Swal.fire({
							type: 'error',
							title: '¡No se puede mover un examen ya realizado!',
							showConfirmButton: false,
							timer: 1500
						});
						$('#CalendarioWeb').fullCalendar('refetchEvents');
					} else {
						var horas = document.getElementById("horaEstimada").value;
						if (horas == 0){
							Swal.fire({
								type: 'warning',
								title: '¡Debe verificar la hora!',
								showConfirmButton: false,
								timer: 1500
							});

							$('#CalendarioWeb').fullCalendar('refetchEvents');
						} else {
							RecolectarDatosGUI();
							EnviarInformacion('asignar', NuevoEvento, true);
						}

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
			<?php

			$ciudadDeB = $_SESSION['ciudadUsuario'];

			$queryHoraBogota = "SELECT idHora, hora, estadoHora FROM horario_poli WHERE estadoHora = 'activado' AND ciudad = '$ciudadDeB'";

			$result_queryHoraBogota = odbc_exec($connect, utf8_decode($queryHoraBogota));

			?>
			<div class="modal-body">
				<div class="form-row">
					<div class="form-group col-md-6">
						<label>Fecha:</label>
						<input type="text" id="txtFecha" name="txtFecha" class="form-control" style="font-size: 16px;" disabled>
					</div>
					<div class="form-group col-md-6">
						<label>Hora de Cupo:</label>
						<select class="form-control" id="horaEstimada" id="horaEstimada" style="font-size: 16px; height: 34px;">
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
						<label>Tipo Identificación</label>
						<input type="text" id="txtTipoIden" name="txtTipoIden" class="form-control" style="font-size: 16px;" disabled>
					</div>
					<div class="form-group col-md-6">
						<label>Número Identificación</label>
						<input type="text" id="txtNumIden" name="txtNumIden" class="form-control" style="font-size: 16px;" disabled>
					</div>

					<div class="form-group col-md-12">
						<label>Nombre:</label>
						<input type="text" id="txtNombre" name="txtNombre" class="form-control" style="font-size: 16px;"disabled>
					</div>
					<div class="form-group col-md-6">
						<label>Cargo:</label>
						<input type="text" id="txtCargo" name="txtCargo" class="form-control" style="font-size: 16px;"disabled>
					</div>
					<div class="form-group col-md-6">
						<label>Campaña o Área:</label>
						<input type="text" id="txtArea" name="txtArea" class="form-control" style="font-size: 16px;"disabled>
					</div>
					<div class="form-group col-md-6">
						<label>Nombre Solicitante:</label>
						<input type="text" id="txtNombreSoli" name="txtNombreSoli" class="form-control" style="font-size: 16px;"disabled>
					</div>
					<div class="form-group col-md-6">
						<label>Cargo Solicitante:</label>
						<input type="text" id="txtCargoSoli" name="txtCargoSoli" class="form-control" style="font-size: 16px;"disabled>
					</div>
					<div class="form-group col-md-6">
						<label>Fecha Contratación:</label>
						<input type="text" id="txtFechaContra" name="txtFechaContra" class="form-control" style="font-size: 16px;"disabled>
					</div>
					<div class="form-group col-md-6">
						<label>Tipo de Convocatoria:</label>
						<input type="text" id="txtTipoConvo" name="txtTipoConvo" class="form-control" style="font-size: 16px;"disabled>
					</div>
					<div class="form-group col-md-6">
						<label>Tiempo Laborado en TP:</label>
						<input type="text" id="txtTiempoTP" name="txtTiempoTP" class="form-control" style="font-size: 16px;" disabled>
					</div>
					<div class="form-group col-md-6">
						<label>Ha trabajado con TP:</label>
						<input type="text" id="txtHaT" name="txtHaT" class="form-control" style="font-size: 16px;" disabled>
					</div>
					<div class="form-group col-md-6">
						<label>Estado:</label>
						<input type="text" id="txtEstado" name="txtEstado" class="form-control" style="font-size: 16px;" disabled>
					</div>	 

					<div class="form-group col-md-6">
						<label id="tituloSite">Site:</label>
						<select id="tipoSite" name="tipoSite" class="form-control" style="font-size: 16px; height: 34px;">
							<option value="">Seleccione:</option>
							<option value="Bogotá">Bogotá (Connecta)</option>
							<option value="Bogotá - Zona Franca">Bogotá (Zona Franca)</option>
							<option value="Medellín">Medellín</option>
						</select>
					</div>
					<div class="form-group col-md-12" hidden>
						<input type="text" id="ccmsRegistrador" name="ccmsRegistrador" class="form-control" style="font-size: 16px;" disabled >
					</div>
							<!-- <div class="form-group col-md-3"></div>
							<div class="form-group col-md-6">
							<button type="button" id="btnNovedad" class="btn btn-warning" style="font-size: 16px;">Crear Novedad</button>	
							<div class="form-group col-md-3"></div> -->
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" id="btnAsignar" class="btn btn-primary" style="font-size: 16px;">Asignar</button>
						<button type="button" id="btnModificar" class="btn btn-success" style="font-size: 16px;">Modificar</button>

						<button type="button" id="btnMover" class="btn btn-success" style="font-size: 16px;">Mover Site</button>
						<button type="button" id="btnCancelar" class="btn btn-danger" style="font-size: 16px;">Cancelar Cupo</button>
						<!--<button type="button" id="btnBorrar" class="btn btn-danger" style="font-size: 16px;">Borrar</button>-->
						<button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size: 16px;">Volver</button>
					</div>
				</div>
			</div>
		</div>
	</div>



	<div class="modal fade" id="modalListaDia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width: 100%">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="font-size: 18px;">
				<div class="modal-header">
					<h5 class="modal-title" id="tituloEvento" style="font-size: 18px;">Asignación de cupo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php

				$ciudadDonde = $_SESSION['ciudadUsuario'];

				$queryHora = "SELECT idHora, hora, estadoHora FROM horario_poli WHERE estadoHora = 'activado' AND ciudad = '$ciudadDonde'";

				$result_queryHora = odbc_exec($connect, utf8_decode($queryHora));

				?>
				<div class="modal-body">
					<div class="form-row">
						<div class="form-group col-md-6">
							<label>Fecha:</label>
							<input type="text" id="txtFechaSoli" name="txtFechaSoli" class="form-control" style="font-size: 16px;" disabled>
						</div>
						<div class="form-group col-md-6">
							<label>Hora de Cupo:</label>
							<select class="form-control" id="txtHoraSoli" name="txtHoraSoli" style="font-size: 16px; height: 34px;">
								<?php
								while ($rowqueryHora = odbc_fetch_array($result_queryHora))
								{
									echo '<option value='.$rowqueryHora["idHora"].'>'.$rowqueryHora["hora"].'</option>';
								}
								?>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label>Fecha de contratación:</label>
							<input type="date" id="fechaContraSoli" name="fechaContraSoli" class="form-control" style="font-size: 16px;" value="">
						</div>

						<div class="form-group col-md-6">
							<label>Tipo de Convocatoria:</label>
							<select class="form-control" id="tipoConvoSoli" style="font-size: 16px; height: 34px;">
								<option value="">Seleccione</option>
								<option value="Externa">Externa</option>
								<option value="Interna o Ascenso">Interna o Ascenso</option>
							</select>
						</div>

						<div class="form-group col-md-6">
							<label>Tiempo Laborado en TP:</label>
							<select class="form-control" id="tiempoTeleperformanceSoli" style="font-size: 16px; height: 34px;">
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
							<select class="form-control" id="histTPSoli" style="font-size: 16px; height: 34px;">
								<option value="">Seleccione:</option>
								<option value="Si">Sí</option>
								<option value="No">No</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label>Campaña o área:</label>
							<input type="text" id="areaEvaSoli" name="areaEvaSoli" class="form-control" style="font-size: 16px;">
						</div>
						
						<div class="form-group col-md-6">
							<label>Cargo:</label>
							<input type="text" id="cargoSoli" name="cargoSoli" class="form-control" style="font-size: 16px;">
							<input hidden type="text" id="ciudaddondeEsta" name="ciudaddondeEsta" class="form-control" value="<?php echo $_SESSION['ciudadUsuario'];?>">
						</div>
						<div class="form-group col-md-6">
							<label>Tipo identificación:</label>
							<select class="form-control" id="tipoIdentificacionSoli" style="font-size: 16px; height: 34px;">
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
							<input type="number" id="numeroIdentificacionSoli" name="numeroIdentificacionSoli" class="form-control" style="font-size: 16px;">
						</div>
						<div class="form-group col-md-12">
							<label>Nombre Completo:</label>
							<input type="text" id="nombreSoli" name="nombreSoli" class="form-control" style="font-size: 16px;">
						</div>
						
					</div>




				</div>
				<div class="modal-footer">
					<button type="button" id="btnSolicitar" class="btn btn-success" data-dismiss="modal" style="font-size: 16px;">Solicitar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size: 16px;">Volver</button>
				</div>
			</div>
		</div>
	</div>

	<script>

		var NuevoEvento;

		$('#btnSolicitar').click(function(){
				var site = document.getElementById("ciudaddondeEsta").value;
				var hor = document.getElementById("txtHoraSoli").value;
				var fechaC = document.getElementById("fechaContraSoli").value;
				var tipoC = document.getElementById("tipoConvoSoli").value;
				var tiemTP = document.getElementById("tiempoTeleperformanceSoli").value;
				var r = document.getElementById("histTPSoli").value;
				var Carea = document.getElementById("areaEvaSoli").value;
				var tipoI = document.getElementById("tipoIdentificacionSoli").value;
				var num = document.getElementById("numeroIdentificacionSoli").value;
				var nomC = document.getElementById("nombreSoli").value;
				var car = document.getElementById("cargoSoli").value; 

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

					RecolectarDatosGUISolicitante();
					validarInsertarSolicitud('validador1', NuevoEvento);

				}

			});

		$('#btnAsignar').click(function(){
			var horas = document.getElementById("horaEstimada").value;
			if (horas == 0){
				alert('¡Debe seleccionar una hora!');
			} else {
				RecolectarDatosGUI();
				EnviarInformacion('asignar', NuevoEvento);
			}				
		});

		$('#btnModificar').click(function(){
			$('#tituloHora').prop("hidden",false);
			$('#horaEstimada').prop("hidden",false);
			$('#horaEstimada').prop("disabled",false);
			$('#txtNombre').prop("disabled",false);
			$('#txtCargo').prop("disabled",false);
			$('#txtArea').prop("disabled",false);

			$('#txtNombreSoli').prop("disabled",false);
			$('#txtCargoSoli').prop("disabled",false);
			$('#txtFechaContra').prop("disabled",false);
			$('#txtTipoConvo').prop("disabled",false);
			$('#txtTiempoTP').prop("disabled",false);
			$('#txtHaT').prop("disabled",false);

			$('#btnAsignar').prop("disabled",false);
			$('#btnModificar').prop("disabled",true);
			$('#btnBorrar').prop("disabled",false);
		});

		function RecolectarDatosGUISolicitante(){
				NuevoEvento = {

					fechaPeticion:$('#txtFechaSoli').val(),
					horaPeticion:$('#txtHoraSoli').val(),
					ciudadPeticion:$('#ciudaddondeEsta').val(),
					fechaContratacion:$('#fechaContraSoli').val(),
					tipoConvocatoria:$('#tipoConvoSoli').val(),
					tiempoTP:$('#tiempoTeleperformanceSoli').val(),
					historiaTP:$('#histTPSoli').val(),
					areaEvaluado:$('#areaEvaSoli').val(),
					tipoIdentificacion:$('#tipoIdentificacionSoli').val(),
					numeroIdentificacion:$('#numeroIdentificacionSoli').val(),
					nombreEvaluado:$('#nombreSoli').val(),
					cargoEvaluado:$('#cargoSoli').val() 
				};				
			}

			function validarInsertarSolicitud(accion, objEvento, modal){
				$.ajax({
					type: 'POST',
					url: 'eventos.php?accion='+accion,
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
							RecolectarDatosGUISolicitante();
							validarInsertarInforSoli('validador2', NuevoEvento);
						}
					},
					error: function(){
						alert("hay un error ... y sirve");
					}

				});
			}


			function validarInsertarInforSoli(accion, objEvento, modal){
				$.ajax({
					type: 'POST',
					url: 'eventos.php?accion='+accion,
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
							RecolectarDatosGUISolicitante();
							insertarInfoSoli('insertarSolicitud', NuevoEvento);
						}
					},
					error: function(){
						alert("hay un error ... y sirve");
					}

				});
			}

			function insertarInfoSoli(accion, objEvento, modal){
				$.ajax({
					type: 'POST',
					url: 'eventos.php?accion='+accion,
					data: objEvento,
					success:function(msg){
						if (msg){

							$('#CalendarioWeb').fullCalendar('refetchEvents');
							Swal.fire({
								type: 'success',
								title: '¡Se solicitó el cupo!',
								showConfirmButton: true
							}).then((result) => {
								if (result.value) {
								}
							})
							limpiarFormularioSolicitud();

						} else {
							alert ('Error en la inserción!');
						}
					},
					error: function(){
						alert("hay un error ... y sirve");
					}

				});
			}

		$('#btnMover').click(function(){

			var valor = document.getElementById("tipoSite").value;

			if (valor == ""){
				Swal.fire({
					type: 'error',
					title: '¡Seleccione un site!',
					showConfirmButton: true
				})
			} else {
				Swal.fire({
					title: '¿Estás seguro?',
					text: "Se enviará la persona al nuevo site",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Sí'
				}).then((result) => {
					if (result.value) {
						RecolectarDatosGUI();
						MoverInformacion('mover', NuevoEvento);
					}
				})
					/*RecolectarDatosGUI();
					EnviarInformacion('asignar', NuevoEvento);*/
				}				
			});

		function RecolectarDatosGUI(){
			NuevoEvento = {
				fecha:$('#txtFecha').val(),
				hora:$('#horaEstimada').val(),
				tipoIden:$('#txtTipoIden').val(),
				numIden:$('#txtNumIden').val(),
				nombre:$('#txtNombre').val(),
				cargo:$('#txtCargo').val(),
				area:$('#txtArea').val(),
				estado:$('#txtEstado').val(),
				tipoSite: $('#tipoSite').val(),
				ccmsRegistrador:$('#ccmsRegistrador').val()
			};
		}

		function EnviarInformacion(accion, objEvento, modal){
			$.ajax({
				type: 'POST',
				url: 'eventos.php?accion='+accion,
				data: objEvento,
				success:function(msg){
					if (msg){
						$('#CalendarioWeb').fullCalendar('refetchEvents');

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

		function MoverInformacion(accion, objEvento, modal){
			$.ajax({
				type: 'POST',
				url: 'eventos.php?accion='+accion,
				data: objEvento,
				success:function(msg){
					if (msg){
						$('#CalendarioWeb').fullCalendar('refetchEvents');
						$('#modalEventos').modal('toggle'); 
						limpiarFormulario1();

						Swal.fire({
							type: 'success',
							title: '¡Se movió de site la solicitud!',
							showConfirmButton: true
						})

					} else {
						alert("no se movió");
					}
				},
				error: function(){
					alert("hay un error ...");
				}
			});
		}

		function limpiarFormularioSolicitud(){
				$('#txtFechaSoli').val('');
				$('#txtHoraSoli').val('');
				$('#fechaContraSoli').val('');
				$('#tipoConvoSoli').val('');
				$('#tiempoTeleperformanceSoli').val('');
				$('#histTPSoli').val('');
				$('#areaEvaSoli').val('');
				$('#tipoIdentificacionSoli').val('');
				$('#numeroIdentificacionSoli').val('');
				$('#nombreSoli').val('');
				$('#cargoSoli').val('');
			}

		function limpiarFormulario1(){
			$('#txtTitulo').val('');
			$('#txtFecha').val('');
			$('#horaEstimada').val(0);
			$('#txtTipoIden').val('');
			$('#txtNumIden').val('');
			$('#txtNombre').val('');
			$('#txtCargo').val('');
			$('#txtArea').val('');
			$('#txtEstado').val('');
			$('#tipoSite').val('');
			$('#ccmsRegistrador').val('');
		}
	</script>

	<script type="text/javascript" src="js/mostrar_ocultar2.js"></script>
</body>
</html>