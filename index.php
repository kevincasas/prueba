<?php
session_start();
?>
<?php require_once 'config/connection.php'; ?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Ingreso Poligrafía Teleperformance</title>
  <link rel="icon" type="" href="css/pluma.ico">
  <link rel="stylesheet" href="css/style2.css">
</head>
<body>
  <div class="fondo">
    <form class="" action="login.php" method="post">
      <div class="login-box">
        <h1> Inicio de sesión</h1>
        <div class="textbox">
          <p align="center"><label>Digite CCMS:</label></p>
          <i class="fas fa-user"></i>
          <input type="number" placeholder="ID CCMS" name="usuarioCCMS" onkeyup="this.value=NumText(this.value)" required>
        </div>

        <div class="textbox">
          <p align="center"><label>Contraseña:</label></p>
          <i class="fas fa-lock"></i>
          <input type="password" placeholder="Contraseña" name="usuarioContra">
        </div>

        <input type="submit" class="btn" value="Ingresar" name="submit">
        <br><br>
        <div class="info">
          <p align="center"><label>Teleperformance - HR Analytics</label></p><br />
        </div>
      </div>
    </form>
  </div>
  <script type="text/javascript">
function NumText(string){ 
  var out = '';
    var filtro = '1234567890'; 
    for (var i=0; i<string.length; i++)
     if (filtro.indexOf(string.charAt(i)) != -1) 
       out += string.charAt(i);
     return out;
   }

   function ValidarText(string){
  var out = '';
    var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890.,?!¿¡:;-_*+/&%$#áéíóúÁÉÍÓÚüÜ|°[](){}<>@ ';
    for (var i=0; i<string.length; i++)
     if (filtro.indexOf(string.charAt(i)) != -1) 
       out += string.charAt(i);
     return out;
   }
 </script>
</body>
</html>
<?php
session_destroy();
?>

