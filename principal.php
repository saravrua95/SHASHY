<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">


<?php include("head.php"); ?>

<body>
<br>
<?php include("header.php"); ?>

<h3>Highlight photo!</h3>

    <?php 
        
        $mysqli = @new mysqli('localhost', 'Pepe', 'pepe', 'pibd');

        if($mysqli->connect_errno) {
            echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error;
            echo '</p>';
            exit;
        }


        if (($fichero = file("criticos.txt")) == false) {
            echo "No se puede leer el archivo.";
        }else{
            
            $numale = rand(0, count($fichero)-1);
            $separa = explode("-", $fichero[$numale]);
            $consulta = "SELECT IdFoto, Titulo, Fecha, Fichero, Descripcion ,(SELECT NomUsuario FROM usuario WHERE IdUsuario = (SELECT Usuario FROM albumes WHERE IdAlbum = fotos.Album)) as NomUsuario FROM fotos WHERE IdFoto = ".$separa[1];
            $respuesta = $mysqli->query($consulta);
            if($respuesta != false){
                
                if($respuesta -> num_rows >0){
                    $destacada = $respuesta ->fetch_assoc();
                    $critico = $separa[0];
                    $id = $separa[1];
                    $motivo = $separa[2];

                    echo "<section class = 'principales'><a href='fotodetalle.php?id=" . $destacada['IdFoto'] . "'><img  src='" . $destacada['Fichero'] . "' alt='" . $destacada['Descripcion'] . "'></a>";
                    echo "<p><b>" . $destacada['Titulo'] . "</b>: " . $destacada['Fecha'] . ", <a href='perfil.php?nombre=" . $destacada['NomUsuario'] . "'>" . $destacada['NomUsuario'] . "</a>.</p>
                    <p>Selected by ". $critico .": '".$motivo."'</p></section><br><br><br>";


                }
            }else{
                echo $mysqli -> error;
            }

        }

       
        $sentenciaFoto = 'SELECT Fichero, Titulo, Fecha, Pais, IdFoto, Descripcion FROM fotos ORDER BY IdFoto DESC LIMIT 5';

        echo "<h2>What's in?</h2>";

        echo "<article>";
    
        if(!($resultadoFoto = $mysqli->query($sentenciaFoto))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". $mysqli->error;
            echo "</p>";
            exit;
        }
    
        while($dataF = $resultadoFoto->fetch_assoc()) {
            
            $sentenciaPais = 'SELECT NomPais FROM paises WHERE IdPais="' . $dataF['Pais'] . '"';
            if(!($resultadoPais = $mysqli->query($sentenciaPais))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". $mysqli->error;
            echo "</p>";
            exit;
            }
            $nombreP = mysqli_fetch_assoc($resultadoPais);
            
            echo "<a href='fotodetalle.php?id=" . $dataF['IdFoto'] . "'><img  src='" . $dataF['Fichero'] . "' alt='" . $dataF['Descripcion'] . "'></a>";
            echo "<p><b>" . $dataF['Titulo'] . "</b>: " . $dataF['Fecha'] . ", " . $nombreP['NomPais'] . ".</p><br><br><br>";

            }
            

        echo "</article><br><br>";
        

    ?>
    <br>

    <section class="principales">
    <h2>Photo uploads in the last week</h2>

    <img src="barchart.php"/></section>
    
</body>

<br><br><br>
    
<?php include("footer.php"); ?>

</html>