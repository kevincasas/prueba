<?php 
include("../../config/connection.php");
session_start();
/*
if (!isset($_SESSION['rolUsuario']) || $_SESSION['rolUsuario'] != "Poligrafista" && $_SESSION['rolUsuario'] != "Desarrollador"){

  header('location: ../../index.php');
}*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Cargue de Examen</title>
  <link rel="icon" type="" href="css/pluma.ico">
  <link rel="stylesheet" href="css/estilos2.css">
  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <script src="js/jquery-3.2.1.js"></script>
  <script src="js/main.js"></script>
  <script src="js/sweetalert.js"></script>
</head>
<body >
  <header>
    
    <label class="p">Poligrafía</label>
    <img src="css/logof4.jpg" align="right">
  </header>

  <div class="container" align="center">

    <br><br><br><br><br><br><br><br><br>
    <div class="row justify-content-center" style="color: white; background-color: rgba(0, 0, 0, 0.8);border-radius:10px; width: 70%;">
      <br>
      
      <div class="resumir">
  <h1>Cargue de examen realizado</h1><br>
<form action="cargarExamen.php" method="post" enctype="multipart/form-data"> 
  <input type="file" id="archivo" name="archivo" required onchange="return validarExt()">
  <br><br>
  <div id="visorArchivo"></div>
  <button type="submit" name="create_pdf" id="btnGuardarExamen" class="btn btn-success" style="font-size: 16px; width: 20%;">Guardar examen</button><br><br>
</form>
</div>
      
    </div>
  </div><br><br>

  <script type="text/javascript">
    $('#btnVolver').click(function(){
      window.open('busqueda.php','_self');
    });
  </script>

  <script type="text/javascript">
  function validarExt(){
    var archivoInput = document.getElementById('archivo');
    var archivoRuta = archivo.value;
    var extPermitida = /(.pdf)$/i;

    if(!extPermitida.exec(archivoRuta)){
      alert('Por favor selecciona un archivo .PDF');
      archivoInput.value = '';
      document.getElementById('visorArchivo').innerHTML= '';
      return false;
    }
    else{
      if(archivoInput.files && archivoInput.files[0]){
        var visor = new FileReader();
        visor.onload = function(e)
        {
          document.getElementById('visorArchivo').innerHTML=
          '<p>Vista Previa:</p><embed src = "'+e.target.result+'" width = "500" height = "500" ><br><br>';
        }
        visor.readAsDataURL(archivoInput.files[0]);
      }
    }
  }
</script>

  <script type="text/javascript" src="js/mostrar_ocultar3.js"></script>
</body>
</html>