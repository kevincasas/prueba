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
	<title>Poligrafía TP</title>
	<link rel="icon" type="" href="css/pluma.ico">
	<link rel="stylesheet" href="css/busque.css">
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
		<div class="containerBusqueda" align="center">
			<br><br>

			<br><br>
			<br><br>
			<div class="row justify-content-center" style="color: white; background-color: rgba(0, 0, 0, 0.8);border-radius:9px; width: 75%;">
				<br />
				<h1 align="center">Busqueda de registros</h1><br />

				<form method="post" action="resultados.php" align = "center">
					<table class="table table-dark" style="width: 100%; border: hidden">
						<tr>
							<td style="width: 20%;"></td>
							<td style="width: 60%;">
								<div class="modal-body" style="width: 100%">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label>Tipo Identificación</label>
											<select id="horaEstimada" class="form-control" style="font-size: 16px; background-color: rgba(0, 0, 0, 0.6); color: white; height: 34px;" >
												<option style= "background-color: rgba(0, 0, 0, 0.5);" value="Seleccione:">Seleccione:</option>
												<option style= "background-color: rgba(0, 0, 0, 0.5);" value="CC">CC</option>
												<option style= "background-color: rgba(0, 0, 0, 0.5);" value="TI">TI</option>
												<option style= "background-color: rgba(0, 0, 0, 0.5);" value="CE">CE</option>
												<option style= "background-color: rgba(0, 0, 0, 0.5);" value="PEP">PEP</option>
												<option style= "background-color: rgba(0, 0, 0, 0.5);" value="PASS">PASS</option>
											</select>
										</div>
										<div class="form-group col-md-6">
											<label>Número Identificación</label>
											<input type="number" id="idpersona" name="idpersona" class="form-control"  placeholder="Escriba el número de identificación" style="font-size: 16px; background-color: rgba(0, 0, 0, 0.6); color: white;"required>
										</div>
									</div>
									<div class="form-group">
										<input type="submit" style = "width: 200px; font-size: 16px;" name="buscar_persona" class="btn btn-danger" value="Buscar"/>
									</div>
								</div>
							</td>
							<td style="width: 20%;"></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		<!--
		<div hidden>
			<div>
				<table class="table table-dark" style="width: 100%; border: hidden">
					<tr>
						<td style="width: 36%;"></td>
						<td style="width: 14%;">
							<label for="cbxAvanzada">Busqueda avanzada</label>
						</td>
						<td style="width: 5%;">
							<input type="checkbox" id="cbxAvanzada" class="cbxAvanzada" value="opcion_1" onclick="mostrarExterna()">
						</td>
						<td style="width: 45%;"></td>
					</tr>
				</table>


				<button type="button" id="btnVolver" class="btn btn-primary" style="font-size: 16px; width: 25%;">Buscar a</button><br><br>
				<div>
					<div class="modal-body" style="width: 90%">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Fecha:</label>
								<input type="text" id="txtFecha" name="txtFecha" class="form-control" style="font-size: 16px;" disabled>
							</div>
							<div class="form-group col-md-6">
								<label id="tituloHora">Hora:</label>
								<select id="horaEstimada" class="form-control" style="font-size: 16px; height: 34px;" >
									<option value="0">Seleccione:</option>
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


							<div class="form-group col-md-6">
								<label>Tipo Identificación</label>
								<input type="text" id="txtTipoIden" name="txtTipoIden" class="form-control" style="font-size: 16px;" disabled>
							</div>
							<div class="form-group col-md-6">
								<label>Número Identificación</label>
								<input type="text" id="txtNumIden" name="txtNumIden" class="form-control" style="font-size: 16px;" disabled>
							</div>
						</div>
						<div class="form-group">
							<label>Nombre:</label>
							<input type="text" id="txtNombre" name="txtNombre" class="form-control" style="font-size: 16px;">
						</div>

						<div class="form-group col-md-6">
							<label>Estado:</label>
							<input type="text" id="txtEstado" name="txtEstado" class="form-control" style="font-size: 16px;" disabled>
						</div>	
						<div class="form-group col-md-6">
							<label id="tituloHora">Site:</label>
							<select id="horaEstimada" class="form-control" style="font-size: 16px; height: 34px;" >
								<option value="0">Seleccione:</option>
								<option value="Bogotá">Bogotá</option>
								<option value="Bogotá Zona Franca">Bogotá Zona Franca</option>
								<option value="Medellín">Bogotá</option>
							</select>
						</div>
					</div>
				</div>  
			</div>
		</div>
	-->
	<br><br>

		<script type="text/javascript" src="js/mostrar_ocultar3.js"></script>
	</body>
	</html>