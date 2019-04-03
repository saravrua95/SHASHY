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
            
        $mysqli = @new mysqli('localhost', 'Pepe', 'pepe', 'pibd');

        if($mysqli->connect_errno) {
            echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error;
            echo '</p>';
            exit;
        }

       
        $sentenciaUsr = 'SELECT NomUsuario, Email, Sexo, FNacimiento, Ciudad, Pais, Foto FROM usuario WHERE IdUsuario="' . $_COOKIE['IdUsuario'] . '"';
    
        if(!($resultadoUsr = $mysqli->query($sentenciaUsr))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". $mysqli->error;
            echo "</p>";
            exit;
        }
    
        $dataUsr = mysqli_fetch_assoc($resultadoUsr);
    
        $sentenciaPais = 'SELECT NomPais FROM paises WHERE IdPais="' . $dataUsr['Pais'] . '"';
            
        if(!($resultadoPais = $mysqli->query($sentenciaPais))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentenciaPais</b>: ". $mysqli->error;
            echo "</p>";
            exit;
        }
        
        $nombreP = mysqli_fetch_assoc($resultadoPais);
        
        if($dataUsr['Sexo']=='1'){
            $sexo='Male';
        }
        else if($dataUsr['Sexo']=='0'){
            $sexo='Female';
        }
        else if($dataUsr['Sexo']=='2'){
            $sexo='Others';
        }
      
        echo "<img  src='" . $dataUsr['Foto'] . "' alt='" . $dataUsr['NomUsuario'] . "'><br>"; 
        echo "<p><b>User name:</b> " . $dataUsr['NomUsuario'] . "<br>";
        echo "<b>Sex:</b> " . $sexo . "<br>";
        echo "<b>Email:</b> " . $dataUsr['Email'] . "<br>"; 
        echo "<b>Birthday:</b> " . $dataUsr['FNacimiento'] . "<br>"; 
        echo "<b>Country:</b> " . $nombreP['NomPais'] . "<br>";
        echo "<b>City:</b> " . $dataUsr['Ciudad'] . "</p>";
        
        
    
    ?>
    
    <form action="editaperfil.php"><button type="submit">Edit profile</button></form>
    
    </section>  
</body>

<br><br><br>

<?php include("footer.php"); ?>

</html>