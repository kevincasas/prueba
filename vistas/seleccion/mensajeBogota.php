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
  <link rel="stylesheet" href="css/estilos.css">
  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <script src="js/jquery-3.2.1.js"></script>
  <script src="js/main.js"></script>
  <script src="js/push.min.js"></script>
  <script src="js/sweetalert.js"></script>
</head>
<body >
  <header>
    <span id="button-menu" class="fa fa-bars"></span>

    <nav class="navegacion">
      <ul class="menu">
        <!-- TITULAR -->
        <li class="title-menu"><i id = "logoUsuario" class="fa fa-user-circle" aria-hidden="true" style="font-size: 70px;"></i><br><br>
          <label><?php echo $_SESSION['nombreUsuario'] ?></label><br>
          <label><?php echo $_SESSION['rolUsuario']?></label><br></li>

          <!-- TITULAR -->

          <li><a href="inicioJefe.php" class="irInicio"><span class="fa fa-home icon-menu"></span>Inicio</a></li>
          <li><a href="#" class="irInicio"><span class="fa fa-envelope icon-menu"></span>Solicitudes</a></li>


          <li><a href="#" class="buscarDatos"><span class="fa fa-search icon-menu"></span>Busqueda</a></li>
          <li class="item-submenu" menu="1">
           <a href="#"><span class="fa fa-pencil-square-o icon-menu"></span>Editar</a>
           <ul class="submenu">
            <li class="title-menu"><span class="fa fa-pencil-square-o icon-menu" style="font-size: 70px;"></span><br><br>Editar</li>
            <li class="go-back">Atrás</li>

            <li><a href="#"><span class="fa fa-cogs icon-menu"></span>Perfil</a></li>
            <li><a href="#"><span class="fa fa-users icon-menu"></span>Usuarios</a></li>
          </ul>
        </li>
        <li><a href="#" class="cerrarSesion"><span class="fa fa-sign-out icon-menu"></span>Log out</a><br><br><br><br></li>
      </ul>
    </nav>
    <label class="p">Poligrafía</label>
    <img src="css/logof4.jpg" align="right">
  </header>

  <div class="containerSolicitud" align="center">
    <br><br>

    <br><br>
    <br><br>
    <div class="row justify-content-center" style="color: white; background-color: rgba(0, 0, 0, 0.8);border-radius:9px; width: 90%;">
      <br /><br />
      <div class="solicitud">
        <form method="POST" action="mensajeBogota.php">
          <h2>TENER EN CUENTA</h2>
          <style>h2 { font-size: 55 }</style><br>
          <table class="table table-dark" style="width: 90%; border: hidden">
            <tr>
              <td style="width: 15%;">
                <p>Agradecemos diligenciar todos los cupos asignados con el número de cedula de ciudadanía, <u>el nombre completo</u>, cargo, así como el horario en el que ha sido citada la persona, de lo contrario <u>no quedaran agendados los cupos.</u> 
                </p><br>
                <p>El no enviar los datos completos y correctos de la persona citada a polígrafo causa las siguientes implicaciones:

                  <ul>1. No tener una evidencia en audio y video desde el inicio del examen o en su defecto tener un video cortado para realizar las correcciones respectivas de los datos del examinado en el nombre del archivo (el software no nos permite hacer correcciones en el nombre del archivo cuando estamos grabando).
                  </ul>
                  <ul>
                    2. El error en los datos del examinado puede causar a su vez error en el momento de archivar los exámenes en la nube y traumatismos en el proceso de búsqueda de un examen ya realizado.
                  </ul>
                </p>
                <p>
                  La persona citada debe anunciarse con el guarda de seguridad que se encuentra al ingreso de la RECEPCIÓN DE TORRE F (Oceanía) del COMPLEJO CONNECTA ECOSISTEMA DE NEGOCIOS (Cl. 26 #92-32, Bogotá frente a Portal del Dorado) que vienen para un examen en la OFICINA 104 con Carolina Campos o Lina Díaz. 
                  <li>Informar cualquier cambio realizado en la programación con anterioridad. 
                  </li>

                  <li>Los cupos no confirmados al responder en primera instancia este correo, no serán agendados y quedarán a disposición de los requerimientos del momento.
                  </li>
                  <li>
                    Es de aclarar que el área de poligrafía no reserva cupos, que no han sido confirmados vía correo electrónico. 
                  </li>
                </p>
                <p>
                  Para la presentación del examen se deben tener en cuenta las siguientes indicaciones (las cuales deben ser informadas a la persona citada a examen): 
                  <li>
                    Haber dormido mínimo 5 horas, antes de la presentación del examen.
                  </li>
                  <li>
                    No haber consumido sustancias alucinógenas y bebidas alcohólicas en las últimas 48 horas.
                  </li>
                  <li>
                    No haber ingerido medicamentos que no sean formulados por el médico para un tratamiento en específico (si son medicamentos auto formulados por la persona que presentara al examen si se deben suspender).
                  </li>
                  <li>
                    Ingerir alimentos (desayunar si es la mañana o almorzar si es en la tarde).
                  </li>
                  <li>
                    Presentar cedula original, (Contraseña con su respectivo denuncio)
                  </li>
                  <li>
                    Traer un documento diferente a la cedula de ciudadanía para que la recepción de Oceanía permita su ingreso a la torre F o en su defecto fotocopia de la cedula de ciudadanía.
                  </li>
                  <li>
                    Presentarse en ropa cómoda (sin fajas).
                  </li>
                  <li>
                    No estar embarazada o tener sospecha de embarazo.
                  </li>
                  <li>
                    No presentar gripa o alguna enfermedad a nivel respiratorio (gripe, tos, asma).
                  </li>
                  <li>
                    Tener una disponibilidad de tiempo de 2 horas. (Tiempo estimado de la evaluación).
                  </li>
                  <li>
                    Llegar con 10 de minutos de anticipación de la hora notificada.
                  </li>
                  <li>
                    No llevar acompañantes.
                  </li>
                </p>
              </td>
            </tr>
          </table>
          <h5>¡Agradecemos su atención!</h5>
          <br><br>
          <input type="submit" name="insert" class="btnAgregar btn btn-success" style="width: 16%; font-size: 16px;" value="Finalizar">
        </form>
        <br><br><br>


        <?php
        if(isset($_POST['insert'])){

          echo "<script>Swal.fire({
                type: 'success',
                title: 'La solicitud fue enviada con éxito',
                showConfirmButton: true
                }).then((result) => {
                  if (result.value) {
                    window.open('enviadas.php','_self');
                  }
                })</script>";
          /*
          $idccms = $_POST['ccms'];
          $usuario = $_POST['nombre'];
          $pass = $_POST['contra'];
          $cargo = $_POST['rol'];

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
            $insertar = "INSERT INTO usuarios_polig(ccms, nombre, contra, rol)VALUES('$idccms','$usuario', '$pass', '$cargo')";

            $ejecutar = odbc_exec($connect, $insertar);

            if ($ejecutar){
              */




/*
 echo "<script>Push.create('TUS DATOS HAN SIDO GUARDADOS',{
      body:'GRACIAS POR COLABORAR CON TELEPERFORMANCE',
      timeout: 8000,
      onClick: function(){
        window.open('http://localhost:8080/menu/','window');
        this.close();
      }
    })</script>";
*/



             /*




              sleep(10);timer: 1500
              echo "<script>window.open('busqueda.php', '_self')</script>";*/
            }

            ?>



          </div>
        </div><br><br>

        <script type="text/javascript" src="js/mostrar_ocultar2.js"></script>
      </body>
      </html>