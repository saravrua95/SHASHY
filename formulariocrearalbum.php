<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<?php include("head.php"); ?>

<body>
<br>
<?php include("header.php"); ?>

<h3>Create a new album!</h3>

<?php 
	if (isset($_POST['title'])) {
		$titulo =  $_POST['title'];
	}
	if (isset($_POST['albumdate'])) {
		$fecha =  $_POST['albumdate'];
	}
	if (isset($_POST['pais'])) {
		$pais =  $_POST['pais'];
	}
	if (isset($_POST['descalbum'])) {
		$descripcion =  $_POST['descalbum'];
	}
		
	$fechareg = date("Y-m-d");

	$insertado = false;
		$sql = "INSERT INTO albumes (Titulo, Descripcion, Fecha, Pais, Usuario)
			VALUES ('".$titulo."', '".$descripcion."', '".$fecha."', '".$pais."', '".$_COOKIE['IdUsuario']."')";

	
		include 'utilidades.php';
		$insertado = Utilidades::ejecutaInsert($sql);	

	if($insertado==true){
		echo "<p class='principales'>Your album was created successfully! Start uploading photos or go to your album list :D</p><br>
		<section class='principales'><form action='misalbumes.php'><button>My albums</button></form><br><br>
		<form action='subirfoto.php'><button>Upload a photo</button></form></section>
		";
	}
	else{
		echo "<p class='principales'>Ooops, something was wrong! Go back to try again.</p><br>
		<section class='principales'><form action='crealbum.php'><button>Go back</button></form></section>
		";
	}

?>



</body>

<br><br><br>


<?php include("footer.php"); ?>


</html>