<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<?php include("head.php"); ?>

<body>
<br>

<?php include("header.php"); ?>

    
<section class="principales">
    
    <?php
        
        if(isset($_SESSION['uname'])){
            
        $mysqli = @new mysqli('localhost', 'Pepe', 'pepe', 'pibd');

        if($mysqli->connect_errno) {
            echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error;
            echo '</p>';
            exit;
        }

       
        $sentenciaFoto = 'SELECT Fichero, Titulo, Pais, Album, FRegistro, Descripcion FROM fotos WHERE IdFoto="' . $_GET['id'] . '"';
    
        if(!($resultadoFoto = $mysqli->query($sentenciaFoto))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". $mysqli->error;
            echo "</p>";
            exit;
        }
    
        $dataF = mysqli_fetch_assoc($resultadoFoto);
        
        $sentenciaPais = 'SELECT NomPais FROM paises WHERE IdPais="' . $dataF['Pais'] . '"';
        $sentenciaAlbum = 'SELECT Usuario FROM albumes WHERE IdAlbum="' . $dataF['Album'] . '"';
            
            
        if(!($resultadoPais = $mysqli->query($sentenciaPais))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentenciaPais</b>: ". $mysqli->error;
            echo "</p>";
            exit;
        }
            
        if(!($resultadoAlbum = $mysqli->query($sentenciaAlbum))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentenciaAlbum</b>: ". $mysqli->error;
            echo "</p>";
            exit;
        }
        
        $nombreP = mysqli_fetch_assoc($resultadoPais);
        $idUsr = mysqli_fetch_assoc($resultadoAlbum);
        
        $sentenciaUsuario = 'SELECT NomUsuario FROM usuario WHERE IdUsuario="' . $idUsr['Usuario'] . '"';
        
        if(!($resultadoUsuario = $mysqli->query($sentenciaUsuario))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentenciaUsuario</b>: ". $mysqli->error;
            echo "</p>";
            exit;
        }
        
        $autor = mysqli_fetch_assoc($resultadoUsuario);
        
            
        echo "<h1><img  src='" . $dataF['Fichero'] . "' alt='" . $dataF['Descripcion'] . "'></h1>";
        echo "<p><b>Country:</b> " . $nombreP['NomPais'] . "</p>"; 
        echo "<p><b>Author:</b> <a href='perfil.php?nombre=" . $autor['NomUsuario'] . "'>" . $autor['NomUsuario'] . "</a></p>"; 
        echo "<p><b>Title:</b> " . $dataF['Titulo'] . "</p>"; 
        echo "<p><b>Date of publication:</b> " . $dataF['FRegistro'] . "</p>"; 

        
        }
    
        else{
            
            echo "<p>You have to be logged to see the image details. Sorry</p>
                <form action='login.php'><button type='submit'>Log in!</button></form>";
            
        }
    
    ?>

</section>

</body>

<br><br><br>

<?php include("footer.php"); ?>


</html>