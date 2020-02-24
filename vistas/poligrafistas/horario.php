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
	<title>Poligrafía TP</title>
	<link rel="icon" type="" href="css/pluma.ico">
	<link rel="stylesheet" href="css/estilos2.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<script src="js/jquery-3.2.1.js"></script>
	<script src="js/main.js"></script>
	<script src="js/sweetalert.js"></script>
	<script src="js/push.min.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body >
	<header>
		<span id="button-menu" class="fa fa-bars"></span>

		<nav class="navegacion">
			<ul class="menu">
				<li class="title-menu"><i id = "logoUsuario" class="fa fa-user-circle" aria-hidden="true" style="font-size: 70px;"></i><br><br>
					<label><?php echo utf8_encode($_SESSION['nombreUsuario']) ?></label><br>
					<label><?php echo utf8_encode($_SESSION['rolUsuario'])?></label><br></li>

					<<li><a href="inicioPoligrafistas.php" class="irInicio"><span class="fa fa-home icon-menu"></span>Inicio</a></li>
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
		</header>
		<div align="center">
			<div class="wrapper">	
				<div style="background-color: rgba(0, 0, 0, 0.8);
				width: 750px;
				position: absolute;
				top: 100%;
				left: 50%;
				transform: translate(-50%,-50%);
				color: white;
				border-radius:9px;">
				<table class="table" style="width: 80%; border: hidden">
					<div class="row">
						<tr>
							<div class="col-md-5">
								<td>
									<p style="font-size: 20px;" align="center">Hora</p> 
								</td>  
							</div>
							<div class="col-md-5">
								<td>
									<p style="font-size: 20px;" align="center">Estado</p> 
								</td>  
							</div>
							<div class="col-md-2">
								<td>
									<p style="font-size: 20px;" align="center">Opción</p> 
								</td>  
							</div>
						</tr>

						<?php  

						$ciudadusu = $_SESSION['ciudadUsuario'];

						$query_horario = "SELECT idHora, hora, estadoHora FROM horario_poli WHERE ciudad = '$ciudadusu' ";

						$result_horario = odbc_exec($connect, utf8_decode($query_horario));

						$i = 0;

						while ($row_horario = odbc_fetch_array($result_horario))
						{

							$idHora = $row_horario['idHora'];
							$hora = $row_horario['hora'];
							$estadoHora = $row_horario['estadoHora'];
							$i++;

							?>

							<tr>
								<div class="col-md-5">
									<td>
										<p style="font-size: 16px;" align="center"><?php echo $hora ?></p> 
									</td>  
								</div>
								<div class="col-md-5">
									<td>
										<p style="font-size: 16px;" align="center"><?php echo $estadoHora ?></p> 
									</td>  
								</div>
								<div class="col-md-2">
									<td>
										<p style="font-size: 16px;" align="center"><a href="horario.php?idHora=<?php echo $idHora; ?>" class="editarUsuario"><i class="fa fa-check" aria-hidden="true"></i></a></p> 
									</td> 
									<td>
										<p style="font-size: 16px;" align="center"><a href="horario.php?hora=<?php echo $hora; ?>" class="editarUsuario"><i class="fa fa-close" aria-hidden="true"></i></a></p> 
									</td> 
								</div>
							</tr>

						<?php } ?>
					</div>
				</table>
				<?php
				if(isset($_GET['idHora'])){
					$idHora = $_GET['idHora'];	
					$ciudad = $_SESSION['ciudadUsuario'];

					$query = "UPDATE horario_poli SET estadoHora = 'activado' WHERE idHora = '$idHora' AND ciudad = '$ciudad'";

					$datos = odbc_exec($connect, utf8_decode($query));

					if ($datos) {
						echo "<script>Swal.fire({
							type: 'success',
							title: '¡Se actualizó el estado de la hora!',
							showConfirmButton: true
							}).then(function() {

								window.open('horario.php','_self');

							})</script>";
						} else {
							echo "<script>Swal.fire({
								type: 'error',
								title: '¡NO se actualizó el estado de la hora!',
								showConfirmButton: true
								}).then(function() {

									window.open('horario.php','_self');

								})</script>";
							}	


						}
						?>

						<?php
						if(isset($_GET['hora'])){
							$hora = $_GET['hora'];	
							$ciudad = $_SESSION['ciudadUsuario'];

							$query = "UPDATE horario_poli SET estadoHora = 'desactivado' WHERE hora = '$hora' AND ciudad = '$ciudad'";

							$datos = odbc_exec($connect, utf8_decode($query));

							if ($datos) {
								echo "<script>Swal.fire({
									type: 'success',
									title: '¡Se actualizó el estado de la hora!',
									showConfirmButton: true
									}).then(function() {

										window.open('horario.php','_self');

									})</script>";
								} else {
									echo "<script>Swal.fire({
										type: 'error',
										title: '¡NO se actualizó el estado de la hora!',
										showConfirmButton: true
										}).then(function() {

											window.open('horario.php','_self');

										})</script>";
									}					
								}
								?>
							</div>
						</div>
					</div>

					<script type="text/javascript" src="js/mostrar_ocultar2.js"></script>
				</body>
				</html>