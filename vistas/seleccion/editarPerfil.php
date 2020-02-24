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
  <title>Poligrafía TP</title>
  <link rel="icon" type="" href="css/pluma.ico">
  <link rel="stylesheet" href="css/editarUsuarios.css">
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
          <label><?php echo utf8_encode($_SESSION['nombreUsuario']) ?></label><br>
          <label><?php echo utf8_encode($_SESSION['rolUsuario'])?></label><br></li>

          <!-- TITULAR -->

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
    </header>
    <div class="container" align="center">
      <br><br><br><br><br><br>
      <div class="row justify-content-center" style="color: white; background-color: rgba(0, 0, 0, 0.8);border-radius:9px; width: 85%;">
        <br /><br />

        <?php

        $ccms = $_SESSION['ccmsUsuario'];
        $consulta = " USE HR_Analytics; SELECT ccms, nombre, contra, genero, rol FROM usuarios_polig WHERE ccms='$ccms'";
        $ejecutar = odbc_exec($connect, $consulta);

        $fila = odbc_fetch_array($ejecutar);

        $idccms = $fila['ccms'];
        $usuario = $fila['nombre'];
        $pa = $fila['contra'];
        $genero = $fila['genero'];
        $rol = $fila['rol'];


        ?>

        <?php

        $gen1 = null;
        $gen2 = null;

        if ($genero == "Masculino"){
          $gen1 = '<option value="Masculino">Masculino</option>';
          $gen2 = '<option value="Femenino">Femenino</option>';
        } else if ($genero == "Femenino"){
          $gen1 = '<option value="Femenino">Femenino</option>';
          $gen2 = '<option value="Masculino">Masculino</option>';
        }


        // $ciu1 = null;
        // $ciu2 = null;
        // $ciu3 = null;

        // if ($ciudad == "Bogotá"){
        //   $ciu1 = '<option>Bogotá</option>';
        //   $ciu2 = '<option>Bogotá - Zona Franca</option>';
        //   $ciu3 = '<option>Medellín</option>';
        // } else if ($ciudad == "Bogotá - Zona Franca"){
        //   $ciu1 = '<option>Bogotá - Zona Franca</option>';
        //   $ciu2 = '<option>Bogotá</option>';
        //   $ciu3 = '<option>Medellín</option>';
        // } else if ($ciudad == "Medellín"){
        //   $ciu1 = '<option>Medellín</option>';
        //   $ciu2 = '<option>Bogotá</option>';
        //   $ciu3 = '<option>Bogotá - Zona Franca</option>';

        // }


        $rol1 = null;
        $rol2 = null;
        $rol3 = null;

        if ($rol == "Administrador" || $rol == "Desarrollador"){
          $rol1 = '<option>Administrador</option>';
          $rol2 = '<option>Poligrafista</option>';
          $rol3 = '<option>Analista</option>';
        } else if ($rol == "Poligrafista"){
          $rol1 = '<option>Poligrafista</option>';
          $rol2 = '<option>Administrador</option>';
          $rol3 = '<option>Analista</option>';
        } else if ($rol == "Analista"){
          $rol1 = '<option>Analista</option>';
          $rol2 = '<option>Administrador</option>';
          $rol3 = '<option>Poligrafista</option>';
        }
        ?>    
        <div><i id = "logoUsuario" class="fa fa-address-book" aria-hidden="true" style="font-size: 120px;" align = "right"></i><br><br>
          <label style="font-size: 25px; font-weight: 100;text-decoration: none; "><?php echo $_SESSION['nombreUsuario'] ?></label><br>
          <label style="font-size: 25px; font-weight: 100;text-decoration: none; "><b style="font-size: 27px;">Rol: </b><?php echo $_SESSION['rolUsuario']?></label></div>
          <form method="POST" action="">
            <table class="table table-dark" style="width: 90%; border: hidden">
              <tr>
                <td style="width: 15%;"><div class="form-group"><label>CCMS:</label>
                  <input disabled type="number" name="ccms" class="form-control" placeholder="Escriba identificación" style="color: white; background-color: rgba(0, 0, 0, 0.7);border-radius:4px;" value="<?php echo $idccms; ?>" required></div></td>
                  <td style="width: 35%;"><div class="form-group"><label>Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Escriba el nombre completo" style="color: white; background-color: rgba(0, 0, 0, 0.7);border-radius:4px;" value="<?php echo $usuario; ?>" required></div></td>

                    <!--<td style="width: 35%;"><div class="form-group"><label>Ciudad:</label>
                      <select name="ciudad" class="form-control" id="ciudad" style="background-color: rgba(0, 0, 0, 0.5); color: white;font-size: 18;">
                      </select></div>
                    </td>-->
                    <td style="width: 35%;"><div class="form-group"><label>Contraseña:</label>
                      <input type="password" name="nombre" class="form-control" placeholder="Escriba el nombre completo" style="color: white; background-color: rgba(0, 0, 0, 0.7);border-radius:4px;" value="<?php echo $pa; ?>" required disabled></div></td>
                      <td style="width: 15%;"><div class="form-group"><label>Género:</label>
                        <select name="genero" class="form-control" id="genero" style="background-color: rgba(0, 0, 0, 0.5); color: white;font-size: 18;">
                          <?php echo $gen1; ?>
                          <?php echo $gen2; ?>
                        </select></div>
                      </td>
                    </tr>
                    <br>
                  </table>
                  <table class="table table-dark" style="width: 50%; border: hidden">
                    <tr>
                      <td>
                        <div class="form-group">        

                          <button type="button" id="btnActualizar" id="btnActualizar" class="btn btn-warning" style="font-size: 15px;font-family: 'Segoe UI'; width: 100%;"><i class="fa fa-user"></i>    Actualizar perfil</button>
                        </td>
                        <td>
                          <div class="form-group">        
                            <a href="actualizarContrasena.php" class="btn btn-danger" style = "width: 100%; font-size: 15px;font-family: 'Segoe UI';"><i class="fa fa-key" aria-hidden="true"></i> Actualizar contraseña</a></div></td>
                          </form>
                        </tr>
                      </table>

                    </div>
                  </div>
                  <script type="text/javascript" src="js/mostrar_ocultar2.js"></script>
                  <script type="text/javascript">
                    
                   var NuevoEvento;

                   $('#btnActualizar').click(function(){

                    var nomC = document.getElementById("nombre").value;
                    var genero = document.getElementById("genero").value; 

                    if (nomC == ""){
                      Swal.fire({
                        type: 'error',
                        title: '¡Debe escribir el nombre!',
                        showConfirmButton: true
                      }).then((result) => {
                        if (result.value) {
                        }
                      })
                    } else {
                      RecolectarDatosGUI();
                      actualizarPerfil('actualizarPerfil', NuevoEvento);

                    }
                  });

                   function RecolectarDatosGUI(){
                    NuevoEvento = {
                      nombre:$('#nombre').val(),
                      genero: $('#genero').val()

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
                            title: '¡Se actualizó el nombre y género del usuario!',
                            showConfirmButton: true
                          }).then(function() {

                            window.open('editarPerfil.php','_self');

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
                </script>

                
              </body>
              </html>