<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<?php include("head.php"); ?>

<body>
<br>

<?php include("header.php"); ?>
<h3>Join us!</h3>
    
<section class="principales">   
<form method="POST" action="formularioregistro.php">

     <label class="en-linea">User name:</label>
     <input class="input-registro" type="text" name="Nick">
     <br><br>
     <label class="en-linea">Email:</label>
     <input class="input-registro" type="text" name="Mail">
     <br><br>
     <label class="en-linea">Password:</label>
     <input class="input-registro" type="password" name="Contrasenya" title="">
     <br><br>
     <label class="en-linea">Repeat password:</label>
     <input class="input-registro" type="password" name="Contrasenya2">
     <br><br>
     <label>Gender:</label>
     <input class="altinput" type="radio" name="Genero" value="0">
     <label for="genero1">Woman</label>
     <input class="altinput" type="radio" name="Genero" value="1">
     <label for="genero2">Man</label>
     <input class="altinput" type="radio" name="Genero" value="2">
     <label for="genero3">Others</label>
     <br><br><br>
     <label>Birthday: </label>
     <input class="input-registro" type="date" name="fechaNac">
<br><br>
    
  <label>Home country:</label>
    
<select name="pais">
     <?php 
          include 'utilidades.php';
          $arraypaises = Utilidades::obtenerPaises();
          foreach ($arraypaises as $idpais => $nompais) {
               echo '<option value="'.$idpais.'">'.$nompais.'</option>';
          }
     ?>
</select>
<br><br>

<label class="en-linea">City of residence:</label>
     <input class="input-registro" type="text" name="ciudad">
     <br><br>
<br>
<br>

<button type="submit" name="Submit">Send!</button>
</form>
</section>
  
</body>
<br><br><br>
<?php include("footer.php"); ?>
</html>