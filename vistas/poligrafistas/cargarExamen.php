<?php
session_start();
?>
<?php
/*
if (isset($_SESSION['responable'])) {
	# code...
}
else{
	header('location: index.php');
}
*/

if (isset($_FILES['archivo'])) {
	//echo $_FILES['archivo']['name'];
	$guardar = $_FILES['archivo']['tmp_name'];
	$nombre = $_FILES['archivo']['name'];
	//$nombre = $_POST['nombreArchivo'];
	if (move_uploaded_file($guardar, '../../../poligrafia_files/'.$nombre.'')) {
		 echo "<script>alert('El examen se cargó al sistema')
		 window.open('../../index.php','_self');</script>";
	} else {
		echo "<script>alert('El examen NO se cargó al sistema')
		 window.open('cargarExam.php','_self');</script>";
		//echo "Archivo No Guardado";
		//header('location: Inicio.php');		
	}
	
} else {
	header('location: Inicio.php');
}
?>