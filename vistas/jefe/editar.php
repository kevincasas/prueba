<?php

if(isset($_GET['editar'])){
	$editar_id = $_GET['editar'];
	$consulta = " USE HR_Analytics; SELECT ccms, nombre, contra, genero, rol FROM usuarios_polig WHERE id='$editar_id'";
	$ejecutar = odbc_exec($connect, $consulta);

	$fila = odbc_fetch_array($ejecutar);

	$idccms = $fila['ccms'];
	$usuario = $fila['nombre'];
	$password = $fila['contra'];
	$genero = $fila['genero'];
	$rol = $fila['rol'];

}
?>

<br />

<?php

$gen1 = null;
$gen2 = null;

if ($genero == "Masculino"){
	$gen1 = '<option>Masculino</option>';
	$gen2 = '<option>Femenino</option>';
} else if ($genero == "Femenino"){
	$gen1 = '<option>Femenino</option>';
	$gen2 = '<option>Masculino</option>';
}


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

<div class="col-md-8 col-md-offset-2">
	<form method="POST" action="">
		<div class="form-group">
			<label>ID CCMS:</label>
			<input type="number" name="idccms" class="form-control" style="color: white; background-color: rgba(0, 0, 0, 0.4);border-radius:4px; width: 30%; font-size: 14px;" value="<?php echo $idccms; ?>"><br />
		</div>
		<div class="form-group">
			<label>Nombre:</label>
			<input type="text" name="nombre" class="form-control" style="color: white; background-color: rgba(0, 0, 0, 0.4);border-radius:4px; width: 60%;" value="<?php echo $usuario; ?>"><br />
		</div>
		<div class="form-group">
			<label>Contraseña:</label>
			<input type="password" name="passw" class="form-control" style="color: white; background-color: rgba(0, 0, 0, 0.4);border-radius:4px; width: 45%;" value="<?php echo $password; ?>"><br />
		</div>
		<div class="form-group">
			<label>Género: </label>
			<select name="genero" class="form-control" style="width: 27%;background-color:rgba(0, 0, 0, 0.4); color: white;font-size: 18;">
				<?php echo $gen1; ?>
				<?php echo $gen2; ?>
			</select>
		</div><br />
		<div class="form-group">
			<label>Rol: </label>
			<select name="rol" class="form-control" style="width: 30%;background-color:rgba(0, 0, 0, 0.4); color: white;font-size: 18;">
				<?php echo $rol1; ?>
				<?php echo $rol2; ?>
				<?php echo $rol3; ?>
			</select>
		</div>
		<div class="form-group">				
			<input type="submit" name="actualizar" class="btn btn-warning"  style="width: 42%;" value="ACTUALIZAR DATOS"><br />
		</div>
		<div class="form-group">				
			<input type="submit" name="cancelar" class="btn btn-danger" style="width: 27%;" value="CANCELAR"><br />
		</div>
	</form>
</div>

<?php

if(isset($_POST['actualizar'])){
	$actualizar_idccms = $_POST['idccms'];
	$actualizar_nombre = $_POST['nombre'];
	$actualizar_password = $_POST['passw'];
	$actualizar_pass = md5($actualizar_password);
	$actualizar_genero = $_POST['genero'];
	$actualizar_rol = $_POST['rol'];

	$consulta = "USE HR_Analytics; UPDATE usuarios_polig SET ccms='$actualizar_idccms', nombre='$actualizar_nombre', contra='$actualizar_pass', genero = '$actualizar_genero', rol='$actualizar_rol' WHERE id='$editar_id'";

	$ejecutar = odbc_exec($connect, utf8_decode($consulta));

	if($ejecutar){
		echo "<script>Swal.fire({
          type: 'success',
          title: 'Datos actualizados',
          showConfirmButton: true
      }).then((result) => {
            if (result.value) {
                window.open('editarUsuarios.php','_self');
            }
        })</script>";
	}			
}

if(isset($_POST['cancelar'])){
	echo "<script>window.open('editarUsuarios.php', '_self')</script>";
}

?>