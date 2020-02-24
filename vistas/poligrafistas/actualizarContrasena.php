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
	<link rel="stylesheet" href="css/actualizacionContras.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<script src="js/jquery-3.2.1.js"></script>
	<script src="js/main.js"></script>
	<script src="js/sweetalert.js"></script>
	<style>
		.error {color:red;}
	</style>
	<script>
		const showError = (element, error) => {
			const errorEl=document.createElement("div");
			errorEl.setAttribute("class","error");
			errorEl.innerHTML=error;
			document.querySelector(element).parentElement.prepend(errorEl);
		}

		const validatePassword = () => {
				//Cogemos los valores actuales del formulario
				const pasActual=document.formName.passwordActual.value;
				const pasNew1=document.formName.passwordNew1.value;
				const pasNew2=document.formName.passwordNew2.value;

				//Patron para los numeros
				const patron1=new RegExp("[0-9]+");
				//Patron para las letras
				const patron2=new RegExp("[a-zA-Z]+");

				// Eliminamos los posible errores
				for (let el of document.querySelectorAll("div[class=error]")) {
					el.remove();
				}

				if (pasNew1!=pasNew2 || pasNew1.length<6 || pasActual=="" || pasNew1.search(patron1)<0 || pasNew1.search(patron2)<0) {
					if (pasActual=="") {
						showError("input[name=passwordActual]", "Indica tu contraseña actual");
					}
					if (pasNew1.length<6) {
						showError("input[name=passwordNew1]", "La longitud mínima tiene que ser de 6 caracteres");
					} else if (pasNew1!=pasNew2) {
						showError("input[name=passwordNew1]", "La copia de la nueva contraseña no coincide");
					} else if (pasNew1.search(patron1)<0 || pasNew1.search(patron2)<0) {
						showError("input[name=passwordNew1]", "La contraseña tiene que tener numeros y letras");
					}
					return false;
				}
				return true;

			}
		</script>
	</head>
	<body >
		<header>
			<span id="button-menu" class="fa fa-bars"></span>

			<nav class="navegacion">
				<ul class="menu">
					<li class="title-menu"><i id = "logoUsuario" class="fa fa-user-circle" aria-hidden="true" style="font-size: 70px;"></i><br><br>
						<label><?php echo utf8_encode($_SESSION['nombreUsuario']) ?></label><br>
						<label><?php echo utf8_encode($_SESSION['rolUsuario'])?></label><br></li>

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
			</header>
			<div class="containers" align="center">
			<br><br><br><br><br><br>
			<div class="row justify-content-center" style="color: white; background-color: rgba(0, 0, 0, 0.8);border-radius:9px;width: 50%;">
				<br />
				<div><br> 
					<label style="font-size: 35px; font-weight: 100;text-decoration: none; ">Actualización de contraseña</label><br><br>
					<input disabled hidden name="contraReal" id="contraReal" value="<?php echo utf8_encode($_SESSION['contraLibre']) ?>">
				</div>

					<form name="formName" action="">

						<div class="form-group" style="width: 35%;"><label>Contraseña actual:</label>
							<input type="password" name="passwordActual"  id="passwordActual" class="form-control" placeholder="Escriba contraseña actual" style="color: white; background-color: rgba(0, 0, 0, 0.5);border-radius:4px;" value="">
							<label class="checkbox-inline" style="font-size: 13px; font-family: 'Segoe UI';">
								<input type="checkbox" id="checkboxEnLinea1" value="" onclick="mostrarPassword1()"> Mostrar contraseña
							</label></div><br>

							<div class="form-group" style="width: 35%;"><label>Contraseña nueva:</label>
								<input type="password" name="passwordNew1" id="passwordNew1"class="form-control" placeholder="Escriba contraseña nueva" style="color: white; background-color: rgba(0, 0, 0, 0.5);border-radius:4px;" value="">
								<label class="checkbox-inline" style="font-size: 13px; font-family: 'Segoe UI';">
									<input type="checkbox" id="checkboxEnLinea2" value="" onclick="mostrarPassword2()"> Mostrar contraseña
								</label></div><br>

								<div class="form-group" style="width: 35%;"><label>Repita la contraseña nueva:</label>
									<input type="password" name="passwordNew2" id="passwordNew2" class="form-control" placeholder="Escriba contraseña nueva" style="color: white; background-color: rgba(0, 0, 0, 0.5);border-radius:4px;" value="">
									<label class="checkbox-inline" style="font-size: 13px; font-family: 'Segoe UI';">
										<input type="checkbox" id="checkboxEnLinea3" value="" onclick="mostrarPassword3()"> Mostrar contraseña
									</label></div>

									<table class="table table-dark" style="width: 50%; border: hidden">
										<tr>
											<td>
												<div class="form-group">        
													<button type="button" name="btnActualizarPass" id="btnActualizarPass" class="btn btn-warning" style="font-size: 15px;font-family: 'Segoe UI'; width: 100%;"><i class="fa fa-unlock"></i>    Actualizar contraseña</button>
												</div>
											</td>
										</form>
									</tr>
								</table>
							</div>
						</div>


						<script type="text/javascript">

							function mostrarPassword1(){
								var cambio = document.getElementById("passwordActual");
								if(cambio.type == "password"){
									cambio.type = "text";
								}else{
									cambio.type = "password";
								}
							} 

							function mostrarPassword2(){
								var cambio = document.getElementById("passwordNew1");
								if(cambio.type == "password"){
									cambio.type = "text";
								}else{
									cambio.type = "password";
								}
							} 

							function mostrarPassword3(){
								var cambio = document.getElementById("passwordNew2");
								if(cambio.type == "password"){
									cambio.type = "text";
								}else{
									cambio.type = "password";
								}
							} 


							var NuevoEvento;

							$('#btnActualizarPass').click(function(){
								var pa = document.getElementById("passwordActual").value;
								var pr = document.getElementById("contraReal").value;
								var p1 = document.getElementById("passwordNew1").value; 
								var p2 = document.getElementById("passwordNew2").value; 
							
								 if (pa != pr){
									Swal.fire({
										type: 'error',
										title: '¡La contraseña actual no coincide con la ingresada!',
										showConfirmButton: true
									}).then((result) => {
										if (result.value) {
										}
									});
									limpiarFormulario();
								}else if (pa == ""){
									Swal.fire({
										type: 'error',
										title: '¡Debe escribir la contraseña actual!',
										showConfirmButton: true
									}).then((result) => {
										if (result.value) {
										}
									});
									limpiarFormulario();
								} else if (p1 == ""){
									Swal.fire({
										type: 'error',
										title: '¡Debe escribir la contraseña nueva!',
										showConfirmButton: true
									}).then((result) => {
										if (result.value) {
										}
									});
									limpiarFormulario();
								} else if (p2 == ""){
									Swal.fire({
										type: 'error',
										title: '¡Debe repetir la contraseña nueva!',
										showConfirmButton: true
									}).then((result) => {
										if (result.value) {
										}
									});
									limpiarFormulario();
								} else if (p1 != p2){
									Swal.fire({
										type: 'error',
										title: '¡La contraseña nueva no coincide!',
										showConfirmButton: true
									}).then((result) => {
										if (result.value) {
										}
									});
									limpiarFormulario();
								} else {
									RecolectarDatosGUI();
									actualizarPerfil('actualizarContra', NuevoEvento);
								}
							});

							function RecolectarDatosGUI(){
								NuevoEvento = {
									pass:$('#passwordNew1').val()

								};
							}

							function actualizarPerfil(accion, objEvento, modal){
								$.ajax({
									type: 'POST',
									url: 'eventos.php?accion='+accion,
									data: objEvento,
									success:function(msg){
										if (msg){

											Swal.fire({
												type: 'success',
												title: '¡Se actualizó la contraseña!',
												showConfirmButton: true
											}).then(function() {
												limpiarFormulario();
												window.open('actualizarContrasena.php','_self');

											})

										} else {
											alert("hay un error al actualizar...");
										}
									},
									error: function(){
										alert("hay un error ...");
									}

								});
							}

							function limpiarFormulario(){

								$('#passwordActual').val('');
								$('#passwordNew1').val('');
								$('#passwordNew2').val('');

							}
						</script>
						<script type="text/javascript" src="js/mostrar_ocultar2.js"></script>
					</body>
					</html>