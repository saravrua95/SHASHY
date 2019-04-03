<?php
session_start();
?>
<!DOCTYPE html>

<?php include("head.php"); ?>

<body>
<br>

<?php include("header.php"); ?>
    
<?php 
    
    if(isset($_SESSION['uname'])){
        
        $mysqli = @new mysqli('localhost', 'Pepe', 'pepe', 'pibd');

        if($mysqli->connect_errno) {
            echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error;
            echo '</p>';
            exit;
        }

        $sentencia = 'SELECT IdAlbum, Titulo, Descripcion, Fecha, Portada FROM albumes where Usuario="' . $_COOKIE['IdUsuario'] . '"';

        if(!($resultado = $mysqli->query($sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". $mysqli->error;
            echo "</p>";
            exit;
        }
        echo '<h2>My albums</h2>';

        while($fila = $resultado->fetch_assoc()) {
            echo '<section class="principales">';
            echo '<img src='. $fila['Portada'] .'><br>';
            echo '<p><a href="veralbum.php?idAlbum=' . $fila['IdAlbum'] . '">' . $fila['Titulo'] . '</a><br>';
            echo  $fila['Descripcion'];
            echo '<br>' . $fila['Fecha'] . '</br></p></section>';
            }
        
        // Libera la memoria ocupada por el resultado
        $resultado->close();
        // Cierra la conexión
        $mysqli->close();
        
    }
    
    else{
        echo "<section class='principales'><p>You have to be logged to see your albums. Sorry.</p>
        <form action='login.php'><button type='submit'>Log in!</button></form>
        </section>";
    }

    ?>
    
</body>

<br><br><br>
    
<?php include("footer.php"); ?>

</html>