<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<?php include("head.php"); ?>

<body>
<br>

<?php include("header.php"); ?>
<h3>Request an album!</h3>

    <p>Here you can pick your favourite album from your gallery and buy it. We will send you the printed copy with our best quality!</p><br><br> 

   
    <table>
    <caption><b><i>Album prices (Black and White Cover | Color Cover):</i></b></caption>
        <tr>
            <th>Image Resolution</th>
            <th colspan="2">0-10 pages</th>
            <th colspan="2">10-20 pages</th>
            <th colspan="2">20-40 pages</th>
            <th colspan="2">40-60 pages</th>
        </tr>
        <tr>
            <td><b>150 DPI</b></td>
            <td>10$/</td>
            <td>15$</td>
            <td>20$/</td>
            <td>25$</td>
            <td>40$/</td>
            <td>45$</td>
            <td>60$/</td>
            <td>65$</td>

        </tr>
        <tr>
            <td><b>300 DPI</b></td>
            <td>15$/</td>
            <td>20$</td>
            <td>25$/</td>
            <td>30$</td>
            <td>45$/</td>
            <td>50$</td>
            <td>65$/</td>
            <td>70$</td>
        </tr>
        <tr>
            <td><b>450 DPI</b></td>
            <td>20$/</td>
            <td>25$</td>
            <td>30$/</td>
            <td>35$</td>
            <td>50$/</td>
            <td>55$</td>
            <td>70$/</td>
            <td>75$</td>
        </tr>
        <tr>
            <td><b>600 DPI</b></td>
            <td>30$/</td>
            <td>35$</td>
            <td>40$/</td>
            <td>45$</td>
            <td>60$/</td>
            <td>65$</td>
            <td>70$/</td>
            <td>75$</td>
        </tr>
        <tr>
            <td><b>750 DPI</b></td>
            <td>40$/</td>
            <td>45$</td>
            <td>50$/</td>
            <td>55$</td>
            <td>70$/</td>
            <td>75$</td>
            <td>90$/</td>
            <td>95$</td>
        </tr>
        <tr>
            <td><b>900 DPI</b></td>
            <td>50$/</td>
            <td>55$</td>
            <td>60$/</td>
            <td>65$</td>
            <td>80$/</td>
            <td>85$</td>
            <td>100$/</td>
            <td>105$</td>
        </tr>
    </table>

<br><br>
    
<section class="principales">    
    <form action="formulariosolicitud.php" method="POST" >
    
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
    <label for="aname"><b>Name:</b></label>
    <input type="text" name="aname" id="aname" required maxlength="200">
    <br><br>
    <label><b>Title:</b></label>
    <input type="text" name="title" required maxlength="200">
    <br><br>
    <label><b>Additional Text:</b></label>
    <textarea maxlength="4000" name="descripcion">Write here your desired description</textarea>
    <br><br>

    <label><b>Adress:</b></label><br><br>
    <label><b>Street:</b></label><input type="text" name="calle">
    <label><b>Number:</b></label><input type="text" name="num">
    <label><b>Door:</b></label><input type="text" name="puerta"><br><br>
    <label><b>City:</b></label><input type="text" name="ciudad">
    <label><b>Country:</b></label><input type="text" name="pais"><br><br>
    <label><b>Post Code:</b></label><input type="text" name="pc">
    <br><br><br>

      <label><b>Select a color!</b></label>
        
        <input class="colores" type="color" name="favcolor" value="#ffb3ff">
 

    <br>

    <label><b>Copies:</b></label>
    <input type="num" name="copies" required><br><br>

        <label><b>Image Resolution:</b></label><br>

 
        <input class="altinput" type="radio" name="resu" value="150" id= "radio1"> 
        <label for="radio1"> 150 DPI</label>
        <br>
        <input class="altinput" type="radio" name="resu" value="300" id= "radio2"> 
        <label for="radio2"> 300 DPI</label>
        <br>
        <input class="altinput" type="radio" name="resu" value="450" id= "radio3">
        <label for="radio3"> 450 DPI</label>
        <br>
        <input class="altinput" type="radio" name="resu" value="600" id= "radio4"> 
        <label for="radio4"> 600 DPI</label>
        <br>
        <input class="altinput" type="radio" name="resu" value="750" id= "radio5"> 
        <label for="radio5"> 750 DPI</label>
        <br>
        <input class="altinput" type="radio" name="resu" value="900" id= "radio6"> 
        <label for="radio6"> 900 DPI</label>
        <br>


<br>

        <label><b>Print format:</b></label><br><br>
        <input type="radio" class="altinput" name="formato" value="color" id="formato1">
        <label for="formato1"> Color</label>
        <br>
        <input type="radio" class="altinput" name="formato" value="bn" id="formato2">
        <label for="formato2">Black and White</label>
<br><br>
    
    <label><b>Desired date of receiving:</b></label>
    <input type="date" name="fecha">

    <br><br>
        
    <button type="submit">Order album!</button>
    
</form>
</section>
</body>

<br><br><br>

<?php include("footer.php"); ?>

</html>