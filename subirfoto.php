<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">



<?php include("head.php"); ?>

<body>
<br>

<?php include("header.php"); ?>

    <h2>Upload a new photo!</h2>
    
<section class="principales"> 
    
    <form action="subida.php" method="post" enctype="multipart/form-data">
        
        <label><b>Select your album:</b></label><br><br>
        
        <?php
        
        $mysqli = @new mysqli('localhost', 'Pepe', 'pepe', 'pibd');

        if($mysqli->connect_errno) {
            echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error;
            echo '</p>';
            exit;
        }
        $sentencia = 'SELECT IdAlbum, Titulo FROM albumes where Usuario="' . $_COOKIE['IdUsuario'] . '"';

        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". $mysqli->error;
            echo "</p>";
            exit;
        }
        
        
        while($titAlbum = $resultado->fetch_assoc()) {
            
        echo '<input class="altinput" type="radio" name="album" value= "' . $titAlbum['IdAlbum'] . '">'; 
        echo '<label for="' . $titAlbum['IdAlbum'] . '">' . $titAlbum['Titulo'] . '</label><br>';
            
        }
        
        // Libera la memoria ocupada por el resultado
        $resultado->close();
        // Cierra la conexión
        $mysqli->close();
        
        ?>
    
        <br>
    <label for="titulo"><b>Title:</b></label>
    <input type="text" name="titulo" id="titulo">
    <br><br>
    <label><b>Description:</b></label>
    <textarea name="descripcion">Write your description here!</textarea>
    <br><br>
    <label><b>Date:</b></label>
    <input type="date" name="fecha">
    <br><br>
    <label><b>Country:</b></label>
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
    <label><b>Select a photo:</b></label>
    <input type="file" name="imagen" accept="image/gif, image/jpeg, image/png">
    <br><br>
    <label><b>Set photo as album cover</b></label><input method="post" class="altinput" type="checkbox" name="portada" value="setportada">  
    <br><br><br>
        
        
        <button type="submit">Upload</button></form>
    
    </section>  
</body>

<br><br><br>

<?php include("footer.php"); ?>

</html>