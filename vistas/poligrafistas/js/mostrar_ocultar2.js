
$(document).ready(function(){
	$(".editarUsuarios").click(function(){

		$(".fondo").attr('hidden', !$(".fondo").attr(''));
		$(".container").attr('hidden', false);
		$(".inicio").attr('hidden', true);

		$('.navegacion').css({'width':'0%', 'background':'rgba(0,0,0,.0)'}); // Ocultamos el fonto transparente
			$('#button-menu').removeClass('fa fa-close').addClass('fa fa-bars'); // Agregamos el icono del Menu
			$('.navegacion .submenu').css({'left':'-320px'}); // Ocultamos los submenus
			$('.navegacion .menu').css({'left':'-320px'});
		});

	$(".buscarDatos").click(function(){

		$(".container").attr('hidden', true);
		$(".fondo").attr('hidden', false);
		$(".inicio").attr('hidden', true);

		$('.navegacion').css({'width':'0%', 'background':'rgba(0,0,0,.0)'}); // Ocultamos el fonto transparente
			$('#button-menu').removeClass('fa fa-close').addClass('fa fa-bars'); // Agregamos el icono del Menu
			$('.navegacion .submenu').css({'left':'-320px'}); // Ocultamos los submenus
			$('.navegacion .menu').css({'left':'-320px'});
		});

	$(".irInicio").click(function(){

		$(".container").attr('hidden', true);
		$(".fondo").attr('hidden', true);
		$(".inicio").attr('hidden', false);

		$('.navegacion').css({'width':'0%', 'background':'rgba(0,0,0,.0)'}); // Ocultamos el fonto transparente
			$('#button-menu').removeClass('fa fa-close').addClass('fa fa-bars'); // Agregamos el icono del Menu
			$('.navegacion .submenu').css({'left':'-320px'}); // Ocultamos los submenus
			$('.navegacion .menu').css({'left':'-320px'});
		});

	$(".agregarUsuario").click(function(){

		
		$(".agre").attr('hidden', false);
		$(".usu").attr('hidden', true);
	});

	

	$(".btnVolver").click(function(){
		$(".agre").attr('hidden', true);
		$(".usu").attr('hidden', false);
	});


	$(".editarUsuario").click(function(){

		
		$(".futo").attr('hidden', false);
	});


	$(".cerrarSesion").click(function(){

		Swal.fire({
			title: '¿Estás seguro?',
			text: "Se cerrará la sesión y volverás al inicio",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Sí'
		}).then((result) => {
			if (result.value) {
				window.open('../../index.php','_self');
			}
		})
	});

	$(".editarUsuariosdffsdf").click(function(){

		$(".container").attr('hidden', true);
		$(".fondo").attr('hidden', false);

		$('.navegacion').css({'width':'0%', 'background':'rgba(0,0,0,.0)'}); // Ocultamos el fonto transparente
			$('#button-menu').removeClass('fa fa-close').addClass('fa fa-bars'); // Agregamos el icono del Menu
			$('.navegacion .submenu').css({'left':'-320px'}); // Ocultamos los submenus
			$('.navegacion .menu').css({'left':'-320px'});
		});

	
})