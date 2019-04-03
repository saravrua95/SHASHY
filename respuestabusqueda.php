<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">



<?php include("head.php"); ?>

<body>
<br>

<?php include("header.php"); ?>
    
<h2>Your search:</h2>
    
    <section class='principales'>
        
    <?php 
        
        if(isset($_POST['busca'])){
            if($_POST['busca']=='titulo'){

                echo "<h3><b>By title: </b>" . $_POST['titulo'] . "</h3>";
                
                $mysqli = @new mysqli('localhost', 'Pepe', 'pepe', 'pibd');

                if($mysqli->connect_errno) {
                        echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error;
                        echo '</p>';
                        exit;
                    }

       
                $sentenciaFoto = 'SELECT Fichero, Titulo, Fecha, Pais, IdFoto, Descripcion FROM fotos WHERE Titulo LIKE "%' . $_POST['titulo'] . '%"';


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
                
    
            }
        }
        
        if(isset($_POST['busca'])){
            if($_POST['busca']=='pais'){
                
               echo "<h3><b>By country: </b>" . $_POST['pais'] . "</h3>";
                
                $mysqli = @new mysqli('localhost', 'Pepe', 'pepe', 'pibd');

                if($mysqli->connect_errno) {
                        echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error;
                        echo '</p>';
                        exit;
                    }

            $sentenciaPais = 'SELECT IdPais, NomPais FROM paises WHERE NomPais="' . $_POST['pais'] . '"';
                
            if(!($resultadoPais = $mysqli->query($sentenciaPais))) {
                    echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". $mysqli->error;
                    echo "</p>";
                    exit;
                }
                
            $nombreP = mysqli_fetch_assoc($resultadoPais);
            
            $sentenciaFoto = 'SELECT Fichero, Titulo, Fecha, IdFoto, Descripcion FROM fotos WHERE Pais="' . $nombreP['IdPais'] . '"';
                
            if(!($resultadoFoto = $mysqli->query($sentenciaFoto))) {
                    echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: ". $mysqli->error;
                    echo "</p>";
                    exit;
                }
    
            echo "<article>";
                
            while($dataF = $resultadoFoto->fetch_assoc()) {
            
                echo "<a href='fotodetalle.php?id=" . $dataF['IdFoto'] . "'><img  src='" . $dataF['Fichero'] . "' alt='" . $dataF['Descripcion'] . "'></a>";
                echo "<p><b>" . $dataF['Titulo'] . "</b>: " . $dataF['Fecha'] . ", " . $nombreP['NomPais'] . ".</p><br><br><br>";

            }
            

            echo "</article><br><br>";
    
            }
        }
        
        if(isset($_POST['busca'])){
            if($_POST['busca']=='fecha'){
                
               echo "<h3><b>By date between: </b>" . $_POST['date1'] . " and " . $_POST['date2'] . "</h3>";
                
                 $mysqli = @new mysqli('localhost', 'Pepe', 'pepe', 'pibd');

                if($mysqli->connect_errno) {
                        echo '<p>Error al conectar con la base de datos: ' . $mysqli->connect_error;
                        echo '</p>';
                        exit;
                    }

       
                $sentenciaFoto = 'SELECT Fichero, Titulo, Fecha, Pais, IdFoto, Descripcion FROM fotos WHERE Fecha BETWEEN "' . $_POST['date1'] . '" AND "' . $_POST['date2'] . '"';


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
    
            }
        }
        
        
    ?>
        
    </section>
       
</body>

<br><br><br>

<?php include("footer.php"); ?>

</html>