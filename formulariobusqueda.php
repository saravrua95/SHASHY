<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<?php include("head.php"); ?>

<body>
<br>
<?php include("header.php"); ?>

<h3>Advanced search!</h3>
<section class="principales">
<form method="POST" action="respuestabusqueda.php">

	<h4>Search by:</h4>
    
    <input class="altinput" type="radio" name="busca" value="titulo" id= "radio1"> 
	<label for="radio1" class="en-linea"><b>Title:</b></label><br>
	<input type="text" name="titulo"><br><br><br>
    
    <input class="altinput" type="radio" name="busca" value="fecha" id= "radio2">
	<label for="radio2" class="en-linea"><b>Date (yy-mm-dd):</b></label><br>
	<label>Between: </label><input type="date" name="date1"> <label>and </label> <input type="date" name="date2"> <br><br><br>
    
    <input class="altinput" type="radio" name="busca" value="pais" id= "radio3">
	<label for="radio3" class="en-linea"><b>Country:</b></label><br>
	<input type="text" name="pais"><br><br>

	<button type="submit" name="Submit">Send!</button>
	

</form>
    </section>
</body>

<br><br><br>


<?php include("footer.php"); ?>


</html>