<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<?php include("head.php"); ?>


    
<body>
<br>
<?php include("header.php"); ?>

<h2>Create a new album!</h2><br>
<section class="principales">
<form method="post" action="formulariocrearalbum.php">
    <label><b>Title</b></label>
    <input type="text" name="title" required>
    <br><br>
    <label><b>Description</b></label>
    <textarea class="descalbum" name="descalbum">
    	Write here your description!
    </textarea>
	<br><br> 
    <label><b>Date!</b></label>
    <input type="date" name="albumdate" required>
    <br><br>
    <label><b>Country!</b></label>
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
    <button type="submit">Create!</button>
</form>
    </section>


</body>

<br><br><br>
    
 <?php include("footer.php"); ?>

</html>