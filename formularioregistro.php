<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">



<?php include("head.php"); ?>

<body>
<br>


<section class="principales"> 
    

<?php 
	include("header.php");
	
	$correctname = false;
	$correctmail = false;
	$correctpass = false;
	$correctsecpass = false;
	$correctgender = false;
	$correctdate = false;
	$correctequalpass = false;

	$regexnombre = '^[a-zA-Z0-9]{3,15}$';
	$regexpass = '^[a-zA-Z0-9_]{6,15}$';
	$regexpassmayus = '^.*[A-Z].*$';
	$regexpassminus = '^.*[a-z].*$';
	$regexpassnum = '^.*[0-9].*$';


	if (isset($_POST['Mail'])) {
		$mail =  $_POST['Mail'];

		if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
			$correctmail = true;
		}
	}

	if(isset($_POST['Nick'])){
		$nick =  $_POST['Nick'];
		$matchnick = preg_match('/'.$regexnombre.'/', $nick);
		if ($matchnick > 0) {
			$correctname = true;
		}
	}

	if (isset($_POST['Contrasenya'])) {
		$pass =  $_POST['Contrasenya'];
		$matchpass = preg_match('/'.$regexpass.'/', $pass);
		$matchpassmayus = preg_match('/'.$regexpassmayus.'/', $pass);
		$matchpassminus = preg_match('/'.$regexpassminus.'/', $pass);
		$matchpassnum = preg_match('/'.$regexpassnum.'/', $pass);

		if (($matchpass > 0) &&
			($matchpassmayus > 0) &&
			($matchpassminus > 0) &&
			($matchpassnum > 0)) {

			$correctpass = true;
		}	
	}

	if (isset($_POST['Contrasenya2'])) {
		$rpass =  $_POST['Contrasenya2'];
		$matchrpass = preg_match('/'.$regexpass.'/', $rpass);
		$matchrpassmayus = preg_match('/'.$regexpassmayus.'/', $rpass);
		$matchrpassminus = preg_match('/'.$regexpassminus.'/', $rpass);
		$matchrpassnum = preg_match('/'.$regexpassnum.'/', $rpass);

		if (($matchrpass > 0) &&
			($matchrpassmayus > 0) &&
			($matchrpassminus > 0) &&
			($matchrpassnum > 0)) {

			$correctsecpass = true;
		}
	}

	if($correctpass && $correctsecpass){
		if (strcmp($pass, $rpass) === 0) {
			$correctequalpass = true;
		}
	}

	if (isset($_POST['fechaNac'])) {
		$fechanac =  $_POST['fechaNac'];
		
		if (DateTime::createFromFormat('Y-m-d', $fechanac)){
			$correctdate = true;
		}
		
	}

	if (isset($_POST['pais'])) {
		$pais =  $_POST['pais'];
	}

	if (isset($_POST['ciudad'])) {
		$ciudad =  $_POST['ciudad'];
	}

	if (isset($_POST['Genero'])) {
		$genero =  $_POST['Genero'];
		$correctgender = true;
	}

	$insertado = false;
	if($correctname && $correctmail && $correctpass && $correctsecpass && $correctgender && $correctdate && $correctequalpass){
		$cryptedpass = md5($pass);
		$fechareg = date("Y-m-d");
		$sql = "INSERT INTO usuario (NomUsuario, Email, Clave, Sexo, FNacimiento, Pais, Ciudad, FRegistro)
			VALUES ('".$nick."', '".$mail."', '".$cryptedpass."', '".$genero."', '".$fechanac."', '".$pais."', '".$ciudad."', '".$fechareg."')";

	
		include 'utilidades.php';
		$insertado = Utilidades::ejecutaInsert($sql);	

	}else{
		echo '<h4>Oops, something was wrong :< </h4>';	
	}


	if(!$insertado){
		if(!$correctname)
			echo '<label> Name has not the correct format.</label><br>';
		if(!$correctmail)
			echo '<label> Mail has not the correct format.</label><br>';
		if(!$correctpass)
			echo '<label> Password needs, at least, a number, an upper case and a lower case letter. It has to be between 6 and 15 characters long.</label><br>';
		if(!$correctequalpass)
			echo '<label> Passwords are not matching.</label><br>';
		if(!$correctgender)
			echo '<label> You have to choose a gender.</label><br>';
		if(!$correctdate)
			echo '<label> Your birthday date has not the correct format.</label><br>';
 		echo '<br><form action="registro.php"><button type="submit">Go back</button></form>';
    
	}else{
?>
<h3>User created succesfully!</h3>
    <p><b><label>User name: </label></b><?php echo $nick; ?><br>
    <b><label>Email: </label></b><?php echo $mail; ?><br>
    <b><label>Gender: </label></b><?php

    if($genero=='1'){
    	$genero='Male';
    }
     if($genero=='2'){
    	$genero='Others';
    }
     if($genero=='0'){
    	$genero='Female';
    }

     echo $genero; ?><br>
    <b><label>Birthday: </label></b><?php echo $fechanac; ?><br>
    <b><label>Home country: </label></b><?php echo $pais; ?><br>
    <b><label>City of residence: </label></b><?php echo $ciudad; ?></p><br><br>
    
    <form action="menuperfil.php"><button type="submit">Go to my profile page!</button></form><br>
    
    <form action="registro.php"><button type="submit">Go back</button></form>
   
<br><br><br>


<?php 	
	} 
	include("footer.php"); 
?>

   
</body>
</section>      
</html>