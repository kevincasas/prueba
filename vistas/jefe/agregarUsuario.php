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
  <div class="container" align="center">
    <br><br><br><br><br><br>
    <div class="row justify-content-center" style="color: white; background-color: rgba(0, 0, 0, 0.8);border-radius:9px; width: 50%;">
      <br>

      
      <!--class="col-md-8 col-md-offset-2"-->
      

      <div class="agre">
        <h1>Agregar usuario</h1><br>
        <form method="POST" action="agregarUsuario.php">
          <div class="" style="width: 70%;">
            <label>ID CCMS:</label>
            <input type="number" name="ccms" class="form-control" placeholder="Escriba CCMS" style="color: white; background-color: rgba(0, 0, 0, 0.7);border-radius:4px; width: 32%; font-size: 14px;" required><br />
            <label>Nombre:</label>
            <input type="text" name="nombre" class="form-control" placeholder="Escriba el nombre completo" style="color: white; background-color: rgba(0, 0, 0, 0.7);border-radius:4px; width: 70%;" required><br />
            <label>Contraseña:</label>
            <input type="password" name="contra" class="form-control" placeholder="Escriba la contraseña" style="color: white; background-color: rgba(0, 0, 0, 0.7);border-radius:4px; width: 50%;" required><br />
            <label>Género</label>
            <select name="genero" class="form-control" style="width: 50%; background-color:rgba(0, 0, 0, 0.7); color: white;font-size: 18;">
              <option>Seleccione género</option>
              <option>Masculino</option>
              <option>Femenino</option>
            </select><br>
            <label>Rol</label>
            <select name="rol" class="form-control" style="width: 40%;background-color:rgba(0, 0, 0, 0.7); color: white;font-size: 18;">
              <option>Seleccione rol</option>
              <option>Administrador</option>
              <option>Poligrafista</option>
              <option>Analista</option>
            </select><br>
            <label>Ciudad</label>
            <select name="ciudad" class="form-control" style="width: 51%;background-color:rgba(0, 0, 0, 0.7); color: white;font-size: 18;">
              <option>Seleccione ciudad</option>
              <option>Bogotá</option>
              <option>Bogotá - Zona Franca</option>
              <option>Medellín</option>
            </select>
          </div><br><br>
          <div class="form-group">                
            <input type="submit" name="insert" class="btnAgregar btn btn-success" style="width: 30%;" value="INSERTAR DATOS"><br />
            <a href="editarUsuarios.php"><input type="button" style = "width: 12%; font-size: 16px;" class="btn btn-danger" value="Volver"/></a>
          </div>
          <br />
        </form>
      </div>

      <?php
      if(isset($_POST['insert'])){
        $idccms = $_POST['ccms'];
        $usuario = $_POST['nombre'];
        $pass = $_POST['contra'];
        $cont = md5($pass);
        $genero = $_POST['genero'];
        $rol = $_POST['rol'];
        $ciudad = $_POST['ciudad'];

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
          $insertar = "INSERT INTO usuarios_polig(ccms, nombre, contra, genero, rol, ciudad)VALUES('$idccms','$usuario', '$cont', '$genero', '$rol', '$ciudad')";

          $ejecutar = odbc_exec($connect, utf8_decode($insertar));

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
      <?php
      if(isset($_GET['editar'])){
        include("editar.php");
      }

      ?>  

    </div>
  </div><br><br>

  <script type="text/javascript" src="js/mostrar_ocultar3.js"></script>
</body>
</html>